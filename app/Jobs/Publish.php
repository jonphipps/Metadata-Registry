<?php

namespace App\Jobs;

use App\Models\Release;
use App\Notifications\Frontend\ReleaseWasPublished;
use App\Services\Publish\Git;
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
     * @throws \InvalidArgumentException
     * @throws \GitWrapper\GitException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     * @throws \Symfony\Component\Process\Exception\ProcessFailedException
     * @throws \Symfony\Component\Process\Exception\LogicException
     */
    public function handle()
    {
        //todo:lot's more try/catch here
        $project    = $this->release->project;
        $repo       = $project->repo;
        //todo: rdf generator shouldn't responsible for storage management
        Git::initDir($project, $this->disk);
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
        Git::commitDir($project, $this->disk, $this->release->tag_name);
        //tag the commit with the version
        //push the repo to github
        //run the GenerateDocs job
        //notify the user that it's done
        $this->release->User->notify(new ReleaseWasPublished($this->release));
    }
}
