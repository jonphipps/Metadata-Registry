<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2018-02-15,  Time: 4:19 PM */

namespace App\Services\Publish;

use App\Jobs\GenerateRdf;
use App\Models\Access\User\User;
use App\Models\Project;
use App\Models\Release;
use GitWrapper\GitException;
use GitWrapper\GitWorkingCopy;
use GitWrapper\GitWrapper;
use Illuminate\Support\Facades\Storage;

class Git
{
    /**
     * @param \App\Models\Project $project
     * @param                     $message
     * @param string              $disk
     *
     * @return void
     * @throws GitException
     */
    public static function commitDir(Project $project, $message, $disk = GenerateRdf::REPO_ROOT): void
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
     * @param \App\Models\Project          $project
     * @param string                       $disk
     * @param \App\Models\Access\User\User $user
     *
     * @return void
     */
    public static function initDir(Project $project, $disk = GenerateRdf::REPO_ROOT, User $user): void
    {
        $projectPath = self::getProjectPath($project->id);
        $repo        = self::getProjectRepo($project,$user);
        $dir         = Storage::disk($disk)->path($projectPath);
        /** @var GitWrapper $wrapper */
        $wrapper = static::getWrapper();

        //this is what happens when the working directory exists (published), but has never been synced with a github remote
        if (Storage::disk($disk)->exists($projectPath) && $repo) {
            $git = $wrapper->workingCopy($dir);
            if (empty($git->getRemotes())) {
                //todo: this is much too heavy-handed. There may be previously published vocabs that aren't being published now
                //delete the dir
                Storage::disk($disk)->deleteDir($projectPath);
            }
        }
        if (! Storage::disk($disk)->exists($projectPath)) {
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

    public static function getProjectPath(int $projectId): string
    {
        return GenerateRdf::PROJECT_ROOT . "/{$projectId}/";
    }

    public static function getProjectRepo(Project $project, User $user): ?string
    {
        $repo   = $project->repo;
        $access = '';

        if ($repo) {
            if ($user->githubToken) {
                $token    = $user->githubToken;
                $nickname = $user->nickname;
                $access   = "{$nickname}:{$token}@";
            }

            return "https://{$access}github.com/{$repo}.git";
        }

        return null;
    }

    /**
     * @return GitWrapper
     * @throws GitException
     */
    public static function getWrapper(): GitWrapper
    {
        try {
            $wrapper = new GitWrapper();
        } catch (GitException $e) {
            //we couldn't find the default and have to use the config
            $wrapper = new GitWrapper(config('app.git_executable'));
        }

        //$wrapper->setEnvVar('GIT_SSH_COMMAND', 'ssh -o StrictHostKeyChecking=no');
        return $wrapper;
    }

    /**
     * @param \App\Models\Project $project
     * @param                     $tag
     * @param string              $disk
     *
     * @return void
     */
    public static function tagDir(Project $project, $tag, $disk = GenerateRdf::REPO_ROOT)
    {
        $projectPath = self::getProjectPath($project->id);
        $dir         = Storage::disk($disk)->path($projectPath);

        /** @var GitWrapper $wrapper */
        $wrapper = static::getWrapper();
        $git     = $wrapper->workingCopy($dir);

        try {
            $git->tag($tag, '-f');
        } catch (GitException $e) {
        }
    }

    /**
     * @param \App\Models\Release          $release
     * @param string                       $disk
     * @param \App\Models\Access\User\User $user
     *
     * @return void
     * @throws \GitWrapper\GitException
     */
    public static function updateRemote(Release $release, $disk = GenerateRdf::REPO_ROOT, User $user): void
    {
        $projectId   = $release->project_id;
        $tag         = $release->tag_name;
        $projectPath = self::getProjectPath($projectId);
        $dir         = Storage::disk($disk)->path($projectPath);

        /** @var GitWrapper $wrapper */
        $wrapper = static::getWrapper();
        $git     = $wrapper->workingCopy($dir);
        $git->config('user.name', $user->nickname);
        $git->config('user.email', $user->email);

        try {
            if ($git->hasRemote('origin')) {
                self::pushToGitHub($git);
            }
        } catch (GitException $e) {
            if (str_contains($e->getMessage(), 'fatal: No such remote')) {
                $repo = $release->project->repo;
                if ($repo) {
                    $url = 'https://github.com/' . $repo . '.git';
                    $git->addRemote('origin', $url);
                    self::pushToGitHub($git);
                }
            }
        }
    }

    /**
     * @param $git
     *
     * @throws \GitWrapper\GitException
     */
    private static function pushToGitHub(GitWorkingCopy $git): void
    {
        $git->push('origin', 'master');
    }
}
