<?php

/**
 * All route names are prefixed with 'admin.'.
 */
use App\Jobs\SyncProduction;
use App\Models\Elementset;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Release;
use App\Models\Vocabulary;
use GrahamCampbell\GitHub\Facades\GitHub;
use GrahamCampbell\GitHub\GitHubFactory;

Route::get('fixprojectlanguages', function () {
    $agents = Project::with('vocabularies', 'elementsets')->get();
    $languages =[];
    /** @var Project $agent */
    foreach ($agents as $agent) {
        $languages[$agent->id]['languages'] = $agent->languages ?? [];
        /** @var Vocabulary $vocabulary */
        foreach ($agent->vocabularies as $vocabulary) {
            if ($vocabulary->languages) {
                $languages[$agent->id]['languages'] += $vocabulary->languages;
            }
        }
        foreach ($agent->elementsets as $vocabulary) {
            if ($vocabulary->languages) {
                $languages[$agent->id]['languages'] += $vocabulary->languages;
            }
        }
        if (count($languages[$agent->id]['languages'])) {
            $agent->languages =$languages[$agent->id]['languages'];
            $agent->save();
        }
        // $languages[ $agent->id ]['count'] = count($languages[ $agent->id ]['languages']);
    }

    return $agents;
});
Route::get('update_authorized_as', function () {
    //$agents = Project::with('members', 'vocabularies.members', 'elementsets.members')->find(177);
    ProjectUser::where('is_maintainer_for', 1)->where('is_admin_for', 0)->update(['authorized_as' => 1]);
    // $projectUsers = ProjectUser::with('user', 'project.vocabularies.members', 'project.elementsets.members')->where('agent_id',177)->first();
    $projectUsers = ProjectUser::get();

    return $projectUsers->where('authorized_as', 1);
});

Route::get('update_rda_releases', function () {
    // return Release::withCount([ 'vocabularies', 'elementsets' ])->get();

    //get rid of bad test data
    //Release::withTrashed()->find(1)->forceDelete();
    //Releasable::withTrashed()->where('release_id',1)->forceDelete();

    //get the releases from GitHub
    $releases = GitHub::repos()->releases()->all('RDARegistry', 'RDA-Vocabularies');
    $user =\App\Models\Access\User\User::where('nickname', 'jonphipps')->firstOrFail();
    foreach ($releases as $release) {
        Release::create([
            'user_id'          => $user->id,
            'agent_id'         => 177,
            'name'             => empty($release['name']) ? 'Release ' . trim($release['tag_name'], 'v') : $release['name'],
            'body'             => $release['body'],
            'tag_name'         => $release['tag_name'],
            'target_commitish' => $release['target_commitish'],
            'is_draft'         => $release['draft'],
            'is_prerelease'    => $release['prerelease'],
            'github_response'  => $release,
        ]);
    }

    //reset the timestamps and set the released vocabularies and elementsets
    $dbReleases = Release::where('agent_id', 177)->get();
    /** @var Release $dbRelease */
    foreach ($dbReleases as $dbRelease) {
        $dbRelease->timestamps = false;
        $dbRelease->created_at = $dbRelease->github_created_at;
        $dbRelease->updated_at = $dbRelease->published_at;
        $vocabularies = Vocabulary::where([['agent_id', '=', 177], ['created_at', '<=', $dbRelease->updated_at]])->get(['id'])->pluck('id')->toArray();
        $elementsets = Elementset::where([['agent_id', '=', 177], ['created_at', '<=', $dbRelease->updated_at]])->get(['id'])->pluck('id')->toArray();
        $dbRelease->vocabularies()->sync($vocabularies);
        $dbRelease->elementsets()->sync($elementsets);
        $dbRelease->save();
    }

    return Release::withCount(['vocabularies', 'elementsets'])->get();
});

Route::get('sync_production', function () {
    //FOR TESTING!!
    dispatch(new SyncProduction());
});

Route::get('check_github', function () {
    //FOR TESTING!!
    try {
        // these don't work...
        //$releases = GitHub::repos()->releases()->all('jonphipps','Metadata-Registry');
        //$release = GitHub::repos()->releases()->create('jonphipps', 'Metadata-Registry', ['tag_name' => 'v2.0.1']);

        // token authentication requires an authenticated client
        // after which we are using the knplabs interface, rather than the laravel_github facade
        $client = app(GitHubFactory::class)->make(['token' => Auth::user()->githubToken, 'method' => 'token', 'cache' => true]);
        $releases = $client->api('repo')->releases()->all('jonphipps', 'Metadata-Registry');
        $release = $client->api('repo')->releases()->create('jonphipps', 'Metadata-Registry', ['tag_name' => 'v1.1']);

        return $release;
    }
    catch (Exception $e) {
        return '<table>'.$e->xdebug_message. '</table>';
    }
});
