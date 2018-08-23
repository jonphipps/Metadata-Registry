<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2018-02-17,  Time: 6:48 PM */

namespace App\Services\Publish;

use App\Exceptions\GithubAuthenticationException;
use App\Models\Release;
use Github\Client as GitHubClient;
use Github\Exception\RuntimeException;
use GrahamCampbell\GitHub\Facades\GitHub;

class GitHubService
{
    /**
     * @var \App\Models\Release
     */
    private $release;
    private $owner;
    private $repo;
    private $github_id;

    /**
     * GitHubService constructor.
     *
     * @param \App\Models\Release $release
     */
    public function __construct(Release $release)
    {
        $this->release = $release;
        $path          = $release->project->repo;
        if ($path) {
            $this->owner     = str_before($path, '/');
            $this->repo      = str_after($path, '/');
            $this->github_id = $release->github_id;
        }
    }

    /**
     * @param $path
     *
     * @return string|bool json
     */
    public static function GetPublicRepo($path)
    {
        $owner = str_before($path, '/');
        $repo  = str_after($path, '/');
        try {
            return GitHub::repo()->show($owner, $repo);
        } catch (RuntimeException $e) {
            return false;
        }
    }

    public function getRelease()
    {
        try {
            return GitHub::repo()->releases()->show($this->owner, $this->repo, $this->github_id);
        } catch (RuntimeException $e) {
            return false;
        }
    }

    /**
     * @return \App\Models\Release
     * @throws \Github\Exception\InvalidArgumentException
     * @throws \App\Exceptions\GithubAuthenticationException
     */
    public function setRelease()
    {
        //GET /repos/:owner/:repo/releases/tags/:tag

        $content = [
            'tag_name'         => $this->release->tag_name,
            'target_commitish' => $this->release->target_commitish,
            'name'             => $this->release->name,
            'body'             => $this->release->body ?? '',
            'draft'            => $this->release->is_draft ?? false,
            'prerelease'       => $this->release->is_prerelease ?? false,
        ];

        $client   = new GitHubClient();
        $token    = auth()->user()->githubToken;
        $nickname = auth()->user()->nickname;

        if(!$token){
            throw new GithubAuthenticationException();
        }

        $client->authenticate($nickname, $token, GitHubClient::AUTH_HTTP_PASSWORD);

        if ($this->github_id) {  //if there is a release, update it
            $gitHub = $client->api('repo')->releases()->edit($this->owner, $this->repo, $this->github_id, $content);
        } else {  //if there's no release, make a new one
            $gitHub = $client->api('repo')->releases()->create($this->owner, $this->repo, $content);
            //we're going to want to store the GitHub release ID in the record
            $this->release->github_id = $gitHub->id;
        }
        $this->release->github_response = $gitHub;
        //need to do something special with changing prerelease to release here
        $this->release->save();

        return $this->release;
    }
}
