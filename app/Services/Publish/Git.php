<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2018-02-15,  Time: 4:19 PM */

namespace App\Services\Publish;

use App\Jobs\GenerateRdf;
use App\Models\Project;
use GitWrapper\GitException;
use GitWrapper\GitWrapper;
use Illuminate\Support\Facades\Storage;

class Git
{
    public static function getProjectPath(int $projectId): string
    {
        return GenerateRdf::PROJECT_ROOT . "/{$projectId}/";
    }

    public static function getProjectRepo(Project $project): ?string
    {
        $repo = $project->repo;

        return $repo ? "https://github.com/{$repo}.git" : null;
    }

    /**
     * @param \App\Models\Project $project
     * @param string              $disk
     *
     * @return void
     * @throws \GitWrapper\GitException
     */
    public static function initDir(Project $project, $disk = GenerateRdf::REPO_ROOT): void
    {
        $projectPath = self::getProjectPath($project->id);
        if (! Storage::disk($disk)->exists($projectPath)) {
            $dir = Storage::disk($disk)->path($projectPath);

            /** @var GitWrapper $wrapper */
            $wrapper = static::getWrapper();
            $repo    = self::getProjectRepo($project);
            if ($repo) {
                $git = $wrapper->cloneRepository($repo, $dir);
                if (! $git->isCloned()) {
                    throw new GitException($git);
                }
            } else {
                Storage::disk($disk)->createDir($projectPath);
                $wrapper->init($dir);
            }
        }
    }

    /**
     * @param \App\Models\Project $project
     * @param string              $disk
     * @param                     $message
     *
     * @return void
     * @throws \GitWrapper\GitException
     */
    public static function commitDir(Project $project, $disk, $message): void
    {
        $projectPath = self::getProjectPath($project->id);
        $dir         = Storage::disk($disk)->path($projectPath);

        /** @var GitWrapper $wrapper */
        $wrapper = static::getWrapper();
        $git     = $wrapper->workingCopy($dir);

        if ($git->hasChanges()) {
            $git->add('.');
            $git->commit($message);
        }
    }

    /**
     * @return \GitWrapper\GitWrapper
     * @throws \GitWrapper\GitException
     */
    private static function getWrapper(): GitWrapper
    {
        return new GitWrapper('/usr/bin/git');
    }
}
