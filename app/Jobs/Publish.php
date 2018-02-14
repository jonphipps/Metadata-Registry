<?php

namespace App\Jobs;

use App\Models\Release;
use App\Notifications\Frontend\ReleaseWasPublished;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class Publish implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Release
     */
    private $release;
    /**
     * @var string
     */
    private $disk;

    /**
     * Create a new job instance.
     *
     * @param Release $release
     * @param string  $disk
     */
    public function __construct(Release $release, $disk = GenerateRdf::REPO_ROOT)
    {
        $this->release = $release;
        $this->disk    = $disk;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \GitWrapper\GitException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     * @throws \Symfony\Component\Process\Exception\ProcessFailedException
     * @throws \Symfony\Component\Process\Exception\LogicException
     */
    public function handle()
    {
        //todo:lot's more try/catch here
        $project_id = $this->release->project_id;
        $repo       = $this->release->project->repo;
        //todo: rdf generator shouldn't responsible for storage management or git stuff
        GenerateRdf::initDir($project_id, $this->disk);
        //if the project has a github repo
        //and it's a valid repo
        //pull the repo

        //now we're ready to go...

        //todo: this section should be in a transaction
        $this->release->published_at = Carbon::now();
        $this->release->save();
        //foreach selected vocabulary
        $vocabs = $this->release->vocabularies()->get();
        foreach ($vocabs as $vocab) {
            $job = new GenerateRdf($vocab, $this->release, $this->disk);
            $job->handle();
        }
        $vocabs = $this->release->elementsets()->get();
        foreach ($vocabs as $vocab) {
            $job = new GenerateRdf($vocab, $this->release, $this->disk);
            $job->handle();
        }
        //when the jobs are complete:
        //commit the generated rdf with the version as the commit message
        //tag the commit with the version
        //push the repo to github
        //run the GenerateDocs job
        //notify the user that it's done
        $this->release->User->notify(new ReleaseWasPublished($this->release));
    }
}
