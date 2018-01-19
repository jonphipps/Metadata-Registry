<?php

namespace App\Jobs;

use App\Models\Access\User\User as betaUser;
use App\Models\Elementset;
use App\Models\ElementsetUser;
use App\Models\Import as betaImport;
use App\Models\Omr\Agent;
use App\Models\Omr\AgentUser;
use App\Models\Omr\Import as omrImport;
use App\Models\Omr\Schema;
use App\Models\Omr\SchemaUser;
use App\Models\Omr\User as omrUser;
use App\Models\Omr\Vocabulary as omrVocabulary;
use App\Models\Omr\VocabularyUser as omrVocabularyUser;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Vocabulary as betaVocabulary;
use App\Models\VocabularyUser as betaVocabularyUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class SyncProduction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $firstRun;
    private $lastRunTimestamp;

    /**
     * Create a new job instance.
     *
     * @param $firstRun
     */
    public function __construct(bool $firstRun)
    {
        ob_implicit_flush(1);

        $this->firstRun = $firstRun;
        if (! $this->firstRun) {
            Cache::forget('last_run_timestamp');
        }

        //set last run to 0 if it wasn't cached
        $this->lastRunTimestamp = Cache::get('last_run_timestamp',
            function () {
                return Carbon::createFromTimestamp(0)->toDateTimeString();
            });
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //for each table in the list:
        /**
         * user
         * reg_agent
         * reg_agent_has_user
         * reg_vocabulary_has_user
         * reg_schema
         * schema_has_user
         * reg_file_import_history
         * reg_vocabulary
         */

        //***************
        // MUST DO A ONE-WAY UPDATE OF BETA FROM PRODUCTION ONCE BEFORE RUNNING
        //***************
        $this->updateUsers();
        $this->updateAgents();
        $this->updateAgentUsers();
        $this->updateVocabularies();
        $this->updateVocabularyUsers();
        $this->updateSchema();
        $this->updateSchemaUsers();
        $this->updateImportHistory();

        /** for each history table
         * reg-concept_property_history
         * reg_schema_property_element_history
         * open the beta table and get the date of last created date
         * open the omr table and get everything created newer than the last beta update
         * step through the history and create or update the concept and schema_property tables
         * reg_concept
         * reg_schema_property
         *  ...and write it to beta
         * and then
         * reg_concept_property
         * reg_schema_property_element
         */
        Cache::rememberForever('last_run_timestamp',
            function () {
                return now()->toDateTimeString();
            });
    }

    private function updateUsers(): void
    {
        $betaUsers = betaUser::where('updated_at', '>', $this->lastRunTimestamp)->get();
        foreach ($betaUsers as $betaUser) {
            echo $betaUser->id.', ';
            $omrUser = omrUser::withTrashed()->find($betaUser->id);
            if ($omrUser) {
                //if it's the first run, then we always update beta
                if ($this->firstRun || $omrUser->last_updated->gt($betaUser->updated_at)) {
                    $betaUser->deleted_at        = $omrUser->deleted_at;
                    $betaUser->nickname          = $omrUser->nickname;
                    $betaUser->name              = $omrUser->nickname;
                    $betaUser->salutation        = $omrUser->salutation;
                    $betaUser->first_name        = $omrUser->first_name;
                    $betaUser->last_name         = $omrUser->last_name;
                    $betaUser->email             = $omrUser->email;
                    $betaUser->confirmation_code = $betaUser->confirmation_code ?? md5($omrUser->sha1_password.$omrUser->salt);
                    if ($betaUser->isDirty()) {
                        $betaUser->updated_at = $omrUser->last_updated;
                        $betaUser->save();
                    }
                }
                if (! $this->firstRun && $betaUser->updated_at->gt($omrUser->last_updated)) {
                    $omrUser->deleted_at = $betaUser->deleted_at;
                    $omrUser->nickname   = $betaUser->nickname;
                    $omrUser->salutation = $betaUser->salutation;
                    $omrUser->first_name = $betaUser->first_name;
                    $omrUser->last_name  = $betaUser->last_name;
                    $omrUser->email      = $betaUser->email;
                    if ($omrUser->isDirty()) {
                        $omrUser->last_updated = $betaUser->updated_at;
                        $omrUser->save();
                    }
                }
            } else { //we have a betaUser that doesn't exist in the OMR
                $omrUser               = new omrUser();
                $omrUser->id           = $betaUser->id;
                $omrUser->created_at   = $betaUser->created_at;
                $omrUser->last_updated = $betaUser->updated_at;
                $omrUser->deleted_at   = $betaUser->deleted_at;
                $omrUser->nickname     = $betaUser->nickname;
                $omrUser->salutation   = $betaUser->salutation;
                $omrUser->first_name   = $betaUser->first_name;
                $omrUser->last_name    = $betaUser->last_name;
                $omrUser->email        = $betaUser->email;
                $omrUser->save();
            }
        }
        $betaId   = betaUser::latest()->first()->id;
        $omrUsers = omrUser::where('id', '>', $betaId)->get();
        foreach ($omrUsers as $omrUser) {
            $betaUser                    = new betaUser();
            $betaUser->id                = $omrUser->id;
            $betaUser->created_at        = $omrUser->created_at;
            $betaUser->updated_at        = $omrUser->last_updated;
            $betaUser->deleted_at        = $omrUser->deleted_at;
            $betaUser->nickname          = $omrUser->nickname;
            $betaUser->name              = $omrUser->nickname;
            $betaUser->salutation        = $omrUser->salutation;
            $betaUser->first_name        = $omrUser->first_name;
            $betaUser->last_name         = $omrUser->last_name;
            $betaUser->email             = $omrUser->email;
            $betaUser->confirmation_code = $betaUser->confirmation_code ?? md5($omrUser->sha1_password.$omrUser->salt);
            $betaUser->save();
        }
    }

    private function updateAgents(): void
    {
        $betaProjects = Project::where('updated_at', '>', $this->lastRunTimestamp)->get();
        foreach ($betaProjects as $betaProject) {
            echo $betaProject->id.', ';
            $omrAgent = Agent::withTrashed()->find($betaProject->id);
            if ($omrAgent) {
                //if it's the first run, then we always update beta
                if ($this->firstRun || $omrAgent->last_updated->gt($betaProject->updated_at)) {
                    $this->UpdateMatchingAgent($betaProject, $omrAgent);
                }
                if (! $this->firstRun && $betaProject->updated_at->gt($omrAgent->last_updated)) {
                    $this->UpdateMatchingAgent($omrAgent, $betaProject);
                }
            } else { //we have a betaProject that doesn't exist in the OMR
                $this->UpdateMatchingAgent(new Agent(), $betaProject, true);
            }
        }
        $betaId    = Project::latest()->first()->id;
        $omrAgents = Agent::where('id', '>', $betaId)->get();
        foreach ($omrAgents as $omrAgent) {
            $this->UpdateMatchingAgent(new Project(), $omrAgent, true);
        }
    }

    private function updateAgentUsers(): void
    {
        $betaProjectUsers = ProjectUser::where('updated_at', '>', $this->lastRunTimestamp)->get();
        foreach ($betaProjectUsers as $betaProjectUser) {
            echo $betaProjectUser->id.', ';
            $omrAgentUser = AgentUser::withTrashed()->find($betaProjectUser->id);
            if ($omrAgentUser) {
                //if it's the first run, then we always update beta
                if ($this->firstRun || $omrAgentUser->updated_at->gt($betaProjectUser->updated_at)) {
                    $this->UpdateMatchingAgentUser($betaProjectUser, $omrAgentUser);
                }
                if (! $this->firstRun && $betaProjectUser->updated_at->gt($omrAgentUser->updated_at)) {
                    $this->UpdateMatchingAgentUser($omrAgentUser, $betaProjectUser);
                }
            } else { //we have a betaProject that doesn't exist in the OMR
                $this->UpdateMatchingAgentUser(new AgentUser(), $betaProjectUser, true);
            }
        }
        $betaId        = ProjectUser::latest()->first()->id;
        $omrAgentUsers = AgentUser::where('id', '>', $betaId)->get();
        foreach ($omrAgentUsers as $omrAgentUser) {
            $this->UpdateMatchingAgentUser(new ProjectUser(), $omrAgentUser, true);
        }
    }

    private function updateVocabularies(): void
    {
        $betaVocabularies = betaVocabulary::where('updated_at', '>', $this->lastRunTimestamp)->get();
        foreach ($betaVocabularies as $betaVocabulary) {
            echo $betaVocabulary->id.', ';
            $omrVocabulary = omrVocabulary::withTrashed()->find($betaVocabulary->id);
            if ($omrVocabulary) {
                //if it's the first run, then we always update beta
                if ($this->firstRun || $omrVocabulary->last_updated->gt($betaVocabulary->updated_at)) {
                    $this->UpdateMatchingVocabulary($betaVocabulary, $omrVocabulary);
                }
                if (! $this->firstRun && $betaVocabulary->updated_at->gt($omrVocabulary->last_updated)) {
                    $this->UpdateMatchingVocabulary($omrVocabulary, $betaVocabulary);
                }
            } else { //we have a betaProject that doesn't exist in the OMR
                $this->UpdateMatchingVocabulary(new omrVocabulary(), $betaVocabulary, true);
            }
        }
        $betaId          = betaVocabulary::latest()->first()->id;
        $omrVocabularies = omrVocabulary::where('id', '>', $betaId)->get();
        foreach ($omrVocabularies as $omrVocabulary) {
            $this->UpdateMatchingVocabulary(new betaVocabulary(), $omrVocabulary, true);
        }
    }

    private function updateVocabularyUsers(): void
    {
        $betaVocabularyUsers = betaVocabularyUser::where('updated_at', '>', $this->lastRunTimestamp)->get();
        foreach ($betaVocabularyUsers as $betaVocabularyUser) {
            echo $betaVocabularyUser->id.', ';
            $omrVocabularyUser = omrVocabularyUser::withTrashed()->find($betaVocabularyUser->id);
            if ($omrVocabularyUser) {
                //if it's the first run, then we always update beta
                if ($this->firstRun || $omrVocabularyUser->updated_at->gt($betaVocabularyUser->updated_at)) {
                    $this->UpdateMatchingVocabularyUser($betaVocabularyUser, $omrVocabularyUser);
                }
                if (! $this->firstRun && $betaVocabularyUser->updated_at->gt($omrVocabularyUser->updated_at)) {
                    $this->UpdateMatchingVocabularyUser($omrVocabularyUser, $betaVocabularyUser);
                }
            } else { //we have a betaProject that doesn't exist in the OMR
                $this->UpdateMatchingVocabularyUser(new omrVocabularyUser(), $betaVocabularyUser, true);
            }
        }
        $betaId             = betaVocabularyUser::latest()->first()->id;
        $omrVocabularyUsers = omrVocabularyUser::where('id', '>', $betaId)->get();
        foreach ($omrVocabularyUsers as $omrVocabularyUser) {
            $this->UpdateMatchingVocabularyUser(new betaVocabularyUser(), $omrVocabularyUser, true);
        }
    }

    private function updateSchema(): void
    {
        $elementsets = Elementset::where('updated_at', '>', $this->lastRunTimestamp)->get();
        foreach ($elementsets as $elementset) {
            echo $elementset->id.', ';
            $schema = Schema::withTrashed()->find($elementset->id);
            if ($schema) {
                //if it's the first run, then we always update beta
                if ($this->firstRun || $schema->updated_at->gt($elementset->updated_at)) {
                    $this->UpdateMatchingSchema($elementset, $schema);
                }
                if (! $this->firstRun && $elementset->updated_at->gt($schema->updated_at)) {
                    $this->UpdateMatchingSchema($schema, $elementset);
                }
            } else { //we have a betaProject that doesn't exist in the OMR
                $this->UpdateMatchingSchema(new Schema(), $elementset, true);
            }
        }
        $betaId  = Elementset::latest()->first()->id;
        $schemas = Schema::where('id', '>', $betaId)->get();
        foreach ($schemas as $schema) {
            $this->UpdateMatchingSchema(new Elementset(), $schema, true);
        }
    }

    private function updateSchemaUsers(): void
    {
        $elementsetUsers = ElementsetUser::where('updated_at', '>', $this->lastRunTimestamp)->get();
        foreach ($elementsetUsers as $elementsetUser) {
            echo $elementsetUser->id.', ';
            $schemaUser = SchemaUser::withTrashed()->find($elementsetUser->id);
            if ($schemaUser) {
                //if it's the first run, then we always update beta
                if ($this->firstRun || $schemaUser->updated_at->gt($elementsetUser->updated_at)) {
                    $this->UpdateMatchingSchemaUser($elementsetUser, $schemaUser);
                }
                if (! $this->firstRun && $elementsetUser->updated_at->gt($schemaUser->updated_at)) {
                    $this->UpdateMatchingSchemaUser($schemaUser, $elementsetUser);
                }
            } else { //we have a betaProject that doesn't exist in the OMR
                $this->UpdateMatchingSchemaUser(new SchemaUser(), $elementsetUser, true);
            }
        }
        $betaId             = ElementsetUser::latest()->first()->id;
        $omrVocabularyUsers = SchemaUser::where('id', '>', $betaId)->get();
        foreach ($omrVocabularyUsers as $schemaUser) {
            $this->UpdateMatchingSchemaUser(new ElementsetUser(), $schemaUser, true);
        }
    }

    private function updateImportHistory(): void
    {
        $betaImports = betaImport::where('created_at', '>', $this->lastRunTimestamp)->get();
        foreach ($betaImports as $betaImport) {
            echo $betaImport->id.', ';
            $omrImport = omrImport::withTrashed()->find($betaImport->id);
            if ($omrImport) {
                //if it's the first run, then we always update beta
                if ($this->firstRun || $omrImport->created_at->gt($betaImport->created_at)) {
                    $this->UpdateMatchingImport($betaImport, $omrImport);
                }
                if (! $this->firstRun && $betaImport->created_at->gt($omrImport->created_at)) {
                    $this->UpdateMatchingImport($omrImport, $betaImport);
                }
            } else { //we have a betaProject that doesn't exist in the OMR
                $this->UpdateMatchingImport(new omrImport(), $betaImport, true);
            }
        }
        $betaId     = betaImport::latest()->first()->id;
        $omrImports = omrImport::where('id', '>', $betaId)->get();
        foreach ($omrImports as $omrImport) {
            $this->UpdateMatchingImport(new betaImport(), $omrImport, true);
        }
    }

    private function UpdateMatchingAgent($toModel, $fromModel, $create = false): void
    {
        if ($create) {
            $toModel->id         = $fromModel->id;
            $toModel->created_at = $fromModel->created_at;
        }
        $toModel->deleted_at      = $fromModel->deleted_at;
        $toModel->org_email       = $fromModel->org_email;
        $toModel->org_name        = $fromModel->org_name;
        $toModel->ind_affiliation = $fromModel->ind_affiliation;
        $toModel->ind_role        = $fromModel->ind_role;
        $toModel->address1        = $fromModel->address1;
        $toModel->address2        = $fromModel->address2;
        $toModel->city            = $fromModel->city;
        $toModel->state           = $fromModel->state;
        $toModel->postal_code     = $fromModel->postal_code;
        $toModel->country         = $fromModel->country;
        $toModel->phone           = $fromModel->phone;
        $toModel->web_address     = $fromModel->web_address;
        $toModel->type            = $fromModel->type;
        if ($toModel->isDirty()) {
            if ($toModel instanceof Agent) {
                $toModel->updated_at = $fromModel->last_updated;
            } else {
                $toModel->last_updated = $fromModel->updated_at;
            }
            $toModel->save();
        }
    }

    private function UpdateMatchingAgentUser($toModel, $fromModel, $create = false): void
    {
        if ($create) {
            $toModel->id         = $fromModel->id;
            $toModel->created_at = $fromModel->created_at;
        }
        $toModel->deleted_at       = $fromModel->deleted_at;
        $toModel->user_id          = $fromModel->user_id;
        $toModel->agent_id         = $fromModel->agent_id;
        $toModel->is_registrar_for = $fromModel->is_registrar_for;
        $toModel->is_admin_for     = $fromModel->is_admin_for;
        if ($toModel->isDirty()) {
            $toModel->updated_at = $fromModel->updated_at;
            $toModel->save();
        }
    }

    private function UpdateMatchingVocabulary($toModel, $fromModel, $create = false): void
    {
        if ($create) {
            $toModel->id         = $fromModel->id;
            $toModel->created_at = $fromModel->created_at;
        }
        $toModel->deleted_at            = $fromModel->deleted_at;
        $toModel->agent_id              = $fromModel->agent_id;
        $toModel->name                  = $fromModel->name;
        $toModel->note                  = $fromModel->note;
        $toModel->uri                   = $fromModel->uri;
        $toModel->url                   = $fromModel->url;
        $toModel->base_domain           = $fromModel->base_domain;
        $toModel->token                 = $fromModel->token;
        $toModel->status_id             = $fromModel->status_id;
        $toModel->language              = $fromModel->language;
        $toModel->languages             = $fromModel->languages;
        $toModel->profile_id            = $fromModel->profile_id;
        $toModel->ns_type               = $fromModel->ns_type;
        $toModel->prefixes              = $fromModel->prefixes;
        $toModel->repo                  = $fromModel->repo;
        $toModel->prefix                = $fromModel->prefix;
        $toModel->created_user_id       = $fromModel->created_user_id;
        $toModel->updated_user_id       = $fromModel->updated_user_id;
        $toModel->child_updated_at      = $fromModel->child_updated_at;
        $toModel->child_updated_user_id = $fromModel->child_updated_user_id;
        if ($toModel->isDirty()) {
            if ($toModel instanceof omrVocabulary) {
                $toModel->updated_at = $fromModel->last_updated;
            } else {
                $toModel->last_updated = $fromModel->updated_at;
            }
            $toModel->save();
        }
    }

    private function UpdateMatchingVocabularyUser($toModel, $fromModel, $create = false): void
    {
        if ($create) {
            $toModel->id         = $fromModel->id;
            $toModel->created_at = $fromModel->created_at;
        }
        $toModel->deleted_at        = $fromModel->deleted_at;
        $toModel->vocabulary_id     = $fromModel->vocabulary_id;
        $toModel->user_id           = $fromModel->user_id;
        $toModel->is_maintainer_for = $fromModel->is_maintainer_for;
        $toModel->is_registrar_for  = $fromModel->is_registrar_for;
        $toModel->is_admin_for      = $fromModel->is_admin_for;
        $toModel->languages         = $fromModel->languages;
        $toModel->default_language  = $fromModel->default_language;
        $toModel->current_language  = $fromModel->current_language;
        if ($toModel->isDirty()) {
            $toModel->updated_at = $fromModel->updated_at;
            $toModel->save();
        }
    }

    private function UpdateMatchingSchema($toModel, $fromModel, $create = false): void
    {
        if ($create) {
            $toModel->id         = $fromModel->id;
            $toModel->created_at = $fromModel->created_at;
        }
        $toModel->deleted_at            = $fromModel->deleted_at;
        $toModel->agent_id              = $fromModel->agent_id;
        $toModel->created_user_id       = $fromModel->created_user_id;
        $toModel->updated_user_id       = $fromModel->updated_user_id;
        $toModel->child_updated_at      = $fromModel->child_updated_at;
        $toModel->child_updated_user_id = $fromModel->child_updated_user_id;
        $toModel->name                  = $fromModel->name;
        $toModel->note                  = $fromModel->note;
        $toModel->uri                   = $fromModel->uri;
        $toModel->url                   = $fromModel->url;
        $toModel->base_domain           = $fromModel->base_domain;
        $toModel->token                 = $fromModel->token;
        $toModel->community             = $fromModel->community;
        $toModel->last_uri_id           = $fromModel->last_uri_id;
        $toModel->status_id             = $fromModel->status_id;
        $toModel->language              = $fromModel->language;
        $toModel->profile_id            = $fromModel->profile_id;
        $toModel->ns_type               = $fromModel->ns_type;
        $toModel->prefixes              = $fromModel->prefixes;
        $toModel->languages             = $fromModel->languages;
        $toModel->repo                  = $fromModel->repo;
        if ($toModel->isDirty()) {
            $toModel->updated_at = $fromModel->updated_at;
            $toModel->save();
        }
    }

    private function UpdateMatchingSchemaUser($toModel, $fromModel, $create = false): void
    {
        if ($create) {
            $toModel->id         = $fromModel->id;
            $toModel->created_at = $fromModel->created_at;
        }
        $toModel->deleted_at        = $fromModel->deleted_at;
        $toModel->schema_id         = $fromModel->schema_id;
        $toModel->user_id           = $fromModel->user_id;
        $toModel->is_maintainer_for = $fromModel->is_maintainer_for;
        $toModel->is_registrar_for  = $fromModel->is_registrar_for;
        $toModel->is_admin_for      = $fromModel->is_admin_for;
        $toModel->languages         = $fromModel->languages;
        $toModel->default_language  = $fromModel->default_language;
        $toModel->current_language  = $fromModel->current_language;
        if ($toModel->isDirty()) {
            $toModel->updated_at = $fromModel->updated_at;
            $toModel->save();
        }
    }

    private function UpdateMatchingImport($toModel, $fromModel, $create = false): void
    {
        if ($create) {
            $toModel->id         = $fromModel->id;
            $toModel->created_at = $fromModel->created_at;
        }
        $toModel->map                   = $fromModel->map;
        $toModel->user_id               = $fromModel->user_id;
        $toModel->vocabulary_id         = $fromModel->vocabulary_id;
        $toModel->schema_id             = $fromModel->schema_id;
        $toModel->file_name             = $fromModel->file_name;
        $toModel->source_file_name      = $fromModel->source_file_name;
        $toModel->file_type             = $fromModel->file_type;
        $toModel->batch_id              = $fromModel->batch_id;
        $toModel->results               = $fromModel->results;
        $toModel->total_processed_count = $fromModel->total_processed_count;
        $toModel->error_count           = $fromModel->error_count;
        $toModel->success_count         = $fromModel->success_count;
        if ($toModel->isDirty()) {
            $toModel->save();
        }
    }
}
