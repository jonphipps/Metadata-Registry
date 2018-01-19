<?php

namespace App\Jobs;

use App\Models\Access\User\User as betaUser;
use App\Models\Omr\Agent;
use App\Models\Omr\User as omrUser;
use App\Models\Project;
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
        $this->updateUsers();
        $this->updateAgents();

        // open the beta table and get the date of last created date
        // open the omr table and get everything created newer than the last beta update
        // ...and write it to beta
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
                    $betaUser->deleted_at = $omrUser->deleted_at;
                    $betaUser->nickname   = $omrUser->nickname;
                    $betaUser->name       = $omrUser->nickname;
                    $betaUser->salutation = $omrUser->salutation;
                    $betaUser->first_name = $omrUser->first_name;
                    $betaUser->last_name  = $omrUser->last_name;
                    $betaUser->email      = $omrUser->email;
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
            $betaUser             = new betaUser();
            $betaUser->id         = $omrUser->id;
            $betaUser->created_at = $omrUser->created_at;
            $betaUser->updated_at = $omrUser->last_updated;
            $betaUser->deleted_at = $omrUser->deleted_at;
            $betaUser->nickname   = $omrUser->nickname;
            $betaUser->name       = $omrUser->nickname;
            $betaUser->salutation = $omrUser->salutation;
            $betaUser->first_name = $omrUser->first_name;
            $betaUser->last_name  = $omrUser->last_name;
            $betaUser->email      = $omrUser->email;
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

    /**
     * @param      $toModel
     * @param      $fromModel
     * @param bool $create
     */
    private function UpdateMatchingAgent($toModel, $fromModel, $create = false): void
    {
        if ($create) {
            $toModel->id           = $fromModel->id;
            $toModel->created_at   = $fromModel->created_at;
            $toModel->last_updated = $fromModel->updated_at;
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
}
