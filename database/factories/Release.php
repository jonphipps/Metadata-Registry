<?php

use Faker\Generator as Faker;

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Release::class, function (Faker $faker) {
    return [
        'user_id'          => getRandomClassId('Access\User\User'),
        'agent_id'         => getRandomClassId('Project'),
        'name'             => $faker->name,
        'body'             => $faker->text,
        'tag_name'         => $faker->word,
        'target_commitish' => 'master',
        'is_draft'         => $faker->boolean,
        'is_prerelease'    => $faker->boolean,
        'github_response'  => getGitHubResponse(),
    ];
});

$factory->state(
    App\Models\Release::class,
    'testing',
    function () {
        return [
            'created_at' => '2017-10-17 20:58:41',
            'updated_at' => '2017-10-17 20:58:41',
            'tag_name'   => 'v2.7.3',
        ];
    }
);

$factory->define(
    App\Models\Releasable::class,
    function (Faker $faker) {
        $type = $faker->randomElement([ 'Elementset', 'Vocabulary' ]);

        return [
            'release_id' => $release = getRandomClassId('Release'),
            'releaseable_id' => getRandomClassId($type),
            'releasable_type' => "App\Models\{$type}",
        ];
    }
);

$factory->state(
    App\Models\Releasable::class,
    'vocabulary',
    function () {
        return [
            'release_id'      => getRandomClassId('Release'),
            'releaseable_id'  => getRandomClassId('Vocabulary'),
            'releasable_type' => 'App\Models\Vocabulary',
        ];
    }
);

$factory->state(
    App\Models\Releasable::class,
    'elementset',
    function () {
        return [
            'release_id'      => getRandomClassId('Release'),
            'releaseable_id'  => getRandomClassId('ElementSet'),
            'releasable_type' => 'App\Models\Elementset',
        ];
    }
);

if (! function_exists('getGitHubResponse')) {
    function getGitHubResponse()
    {
        return '{
  "url": "https://api.github.com/repos/octocat/Hello-World/releases/1",
  "html_url": "https://github.com/octocat/Hello-World/releases/v1.0.0",
  "assets_url": "https://api.github.com/repos/octocat/Hello-World/releases/1/assets",
  "upload_url": "https://uploads.github.com/repos/octocat/Hello-World/releases/1/assets{?name,label}",
  "tarball_url": "https://api.github.com/repos/octocat/Hello-World/tarball/v1.0.0",
  "zipball_url": "https://api.github.com/repos/octocat/Hello-World/zipball/v1.0.0",
  "id": 1,
  "tag_name": "v1.0.0",
  "target_commitish": "master",
  "name": "v1.0.0",
  "body": "Description of the release",
  "draft": false,
  "prerelease": false,
  "created_at": "2013-02-27T19:35:32Z",
  "published_at": "2013-02-27T19:35:32Z",
  "author": {
    "login": "octocat",
    "id": 1,
    "avatar_url": "https://github.com/images/error/octocat_happy.gif",
    "gravatar_id": "",
    "url": "https://api.github.com/users/octocat",
    "html_url": "https://github.com/octocat",
    "followers_url": "https://api.github.com/users/octocat/followers",
    "following_url": "https://api.github.com/users/octocat/following{/other_user}",
    "gists_url": "https://api.github.com/users/octocat/gists{/gist_id}",
    "starred_url": "https://api.github.com/users/octocat/starred{/owner}{/repo}",
    "subscriptions_url": "https://api.github.com/users/octocat/subscriptions",
    "organizations_url": "https://api.github.com/users/octocat/orgs",
    "repos_url": "https://api.github.com/users/octocat/repos",
    "events_url": "https://api.github.com/users/octocat/events{/privacy}",
    "received_events_url": "https://api.github.com/users/octocat/received_events",
    "type": "User",
    "site_admin": false
  },
  "assets": [

  ]
}';
    }
}
