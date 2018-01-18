<?php

namespace App\Jobs;

use App\Models\Access\User\User as betaUser;
use App\Models\Omr\User as OmrUser;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SyncProduction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $firstRun;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($firstRun)
    {
        //
        $this->firstRun = $firstRun;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ob_implicit_flush (1);
        if (! $this->firstRun) {
            Cache::forget ('last_run_timestamp');
        }
        //set last run to 0 if it wasn't cached
        $lastRunTimestamp = Cache::get ('last_run_timestamp',
            function () {
                return Carbon::createFromTimestamp (0)->toDateTimeString ();
            });

        //for each table in the list:
        /**
         * user
         * reg_agent
         * reg_agent_has_user
         * reg_vocabulary
         * reg_vocabulary_has_user
         * reg_schema
         * schema_has_user
         * reg_file_import_history
         */
        $betaUsers = betaUser::where('updated_at', '>', $lastRunTimestamp)->get();
        foreach ($betaUsers as $betaUser) {
            echo $betaUser->id. ', ';
            $omrUser = OmrUser::withTrashed()->find($betaUser->id);
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
                    $omrUser->deleted_at   = $betaUser->deleted_at;
                    $omrUser->nickname     = $betaUser->nickname;
                    $omrUser->salutation   = $betaUser->salutation;
                    $omrUser->first_name   = $betaUser->first_name;
                    $omrUser->last_name    = $betaUser->last_name;
                    $omrUser->email        = $betaUser->email;
                    if ($omrUser->isDirty()) {
                        $omrUser->last_updated = $betaUser->updated_at;
                        $omrUser->save();
                    }
                }
            } else { //we have a betaUser that doesn't exist in the OMR
                $omrUser               = new OmrUser();
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
        $omrUsers = OmrUser::where('id', '>', $betaId)->get();
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
            function() {
                return now()->toDateTimeString();
            });
    }

    public static function getNewerThanBeta($model)
    {
        $betaId = \App\Models\Access\User\User::latest()->first()->id;
        static::where('id', '>', $betaId)->get();
    }
}
