<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Publish implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //data:
            //project
            //release
            //list of vocabularies to publish
            //current user making the request
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //foreach selected vocabulary
            //run the generateRdf job
            //update the entry in the published table
        //when the jobs are complete:
        //commit the generated rdf with the version as the commit message
        //tag the commit with the version
        //push the repo to github
        //run the GenerateDocs job
    }
}
