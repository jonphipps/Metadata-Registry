<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2018-02-17,  Time: 6:48 PM */

namespace App\Services\Publish;

use Github\Exception\RuntimeException;
use GrahamCampbell\GitHub\Facades\GitHub;

class GitHubService
{
    /**
     * @param $path
     *
     * @return string|bool json
     */
    public static function GetPublicRepo($path)
    {
        $user = str_before($path, '/');
        $repo = str_after($path, '/');
        try {
            return GitHub::repo()->show($user, $repo);
        }
        catch (RuntimeException $e) {
            return false;
        }
    }
}
