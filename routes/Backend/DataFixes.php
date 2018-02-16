<?php

/**
 * All route names are prefixed with 'admin.'.
 */
use App\Jobs\SyncProduction;
use App\Models\Elementset;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Releasable;
use App\Models\Release;
use App\Models\Vocabulary;
use GrahamCampbell\GitHub\Facades\GitHub;
use GrahamCampbell\GitHub\GitHubFactory;
use Illuminate\Support\Carbon;

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
    Releasable::truncate();
    Release::truncate();

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
            'published_at'     => Carbon::parse($release['published_at']),
            'github_response'  => $release,
        ]);
    }

    //reset the timestamps and set the released vocabularies and elementsets
    $dbReleases = Release::where('agent_id', 177)->get();
    /** @var Release $dbRelease */
    foreach ($dbReleases as $dbRelease) {
        $dbRelease->timestamps = false;
        $dbRelease->created_at = $dbRelease->github_created_at;
        $publishedAt = $dbRelease->published_at;
        $dbRelease->updated_at = $dbRelease->published_at;
        $vocabularies = Vocabulary::where([['agent_id', '=', 177], ['created_at', '<=', $dbRelease->updated_at]])->get(['id'])->pluck('id')->toArray();
        foreach ($vocabularies as $vocabulary) {
            $dbRelease->vocabularies()->attach([$vocabulary => ['created_at' => $dbRelease->created_at, 'updated_at' => $publishedAt, 'published_at'=> $publishedAt]]);
        }
        $elementsets = Elementset::where([['agent_id', '=', 177], ['created_at', '<=', $dbRelease->updated_at]])->get(['id'])->pluck('id')->toArray();
        foreach ($elementsets as $elementset) {
            $dbRelease->elementsets()->attach([$elementset => ['created_at' => $dbRelease->created_at, 'updated_at' => $publishedAt, 'published_at' => $publishedAt]]);
        }
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
    } catch (Exception $e) {
        return '<table>' . $e->xdebug_message . '</table>';
    }
});
Route::get('hack_rda_prefix',
    function () {
        $rdaPrefixes   = [
            'rdaar'   => 'http://rdaregistry.info/termList/AspectRatio/',
            'rdabf'   => 'http://rdaregistry.info/termList/bookFormat/',
            'rdabs'   => 'http://rdaregistry.info/termList/broadcastStand/',
            'rdacarx' => 'http://rdaregistry.info/termList/RDACarrierEU/',
            'rdacc'   => 'http://rdaregistry.info/termList/RDAColourContent/',
            'rdacct'  => 'http://rdaregistry.info/termList/CollTitle/',
            'rdacdt'  => 'http://rdaregistry.info/termList/RDACartoDT/',
            'rdaco'   => 'http://rdaregistry.info/termList/RDAContentType/',
            'rdacpc'  => 'http://rdaregistry.info/termList/configPlayback/',
            'rdact'   => 'http://rdaregistry.info/termList/RDACarrierType/',
            'rdafmn'  => 'http://rdaregistry.info/termList/MusNotation/',
            'rdafnm'  => 'http://rdaregistry.info/termList/formatNoteMus/',
            'rdafnv'  => 'http://rdaregistry.info/termList/noteMove/',
            'rdafr'   => 'http://rdaregistry.info/termList/frequency/',
            'rdafs'   => 'http://rdaregistry.info/termList/fontSize/',
            'rdaft'   => 'http://rdaregistry.info/termList/fileType/',
            'rdaftn'  => 'http://rdaregistry.info/termList/TacNotation/',
            'rdagen'  => 'http://rdaregistry.info/termList/RDAGeneration/',
            'rdagrp'  => 'http://rdaregistry.info/termList/groovePitch/',
            'rdagw'   => 'http://rdaregistry.info/termList/grooveWidth/',
            'rdaill'  => 'http://rdaregistry.info/termList/IllusContent/',
            'rdalay'  => 'http://rdaregistry.info/termList/layout/',
            'rdamat'  => 'http://rdaregistry.info/termList/RDAMaterial/',
            'rdami'   => 'http://rdaregistry.info/termList/ModeIssue/',
            'rdamt'   => 'http://rdaregistry.info/termList/RDAMediaType/',
            'rdapf'   => 'http://rdaregistry.info/termList/presFormat/',
            'rdapm'   => 'http://rdaregistry.info/termList/RDAproductionMethod/',
            'rdapo'   => 'http://rdaregistry.info/termList/RDAPolarity/',
            'rdarm'   => 'http://rdaregistry.info/termList/recMedium/',
            'rdarr'   => 'http://rdaregistry.info/termList/RDAReductionRatio/',
            'rdasca'  => 'http://rdaregistry.info/termList/scale/',
            'rdasco'  => 'http://rdaregistry.info/termList/soundCont/',
            'rdasoi'  => 'http://rdaregistry.info/termList/statIdentification/',
            'rdaspc'  => 'http://rdaregistry.info/termList/specPlayback/',
            'rdatc'   => 'http://rdaregistry.info/termList/trackConfig/',
            'rdaterm' => 'http://rdaregistry.info/termList/RDATerms/',
            'rdatr'   => 'http://rdaregistry.info/termList/typeRec/',
            'rdavf'   => 'http://rdaregistry.info/termList/videoFormat/',
        //elementPrefixes
            'rdac'  => 'http://rdaregistry.info/Elements/c/',
            'rdaa'  => 'http://rdaregistry.info/Elements/a/',
            'rdaad' => 'http://rdaregistry.info/Elements/a/datatype/',
            'rdaao' => 'http://rdaregistry.info/Elements/a/object/',
            'rdae'  => 'http://rdaregistry.info/Elements/e/',
            'rdaed' => 'http://rdaregistry.info/Elements/e/datatype/',
            'rdaeo' => 'http://rdaregistry.info/Elements/e/object/',
            'rdai'  => 'http://rdaregistry.info/Elements/i/',
            'rdaid' => 'http://rdaregistry.info/Elements/i/datatype/',
            'rdaio' => 'http://rdaregistry.info/Elements/i/object/',
            'rdam'  => 'http://rdaregistry.info/Elements/m/',
            'rdamd' => 'http://rdaregistry.info/Elements/m/datatype/',
            'rdamo' => 'http://rdaregistry.info/Elements/m/object/',
            'rdan'  => 'http://rdaregistry.info/Elements/n/',
            'rdand' => 'http://rdaregistry.info/Elements/n/datatype/',
            'rdano' => 'http://rdaregistry.info/Elements/n/object/',
            'rdap'  => 'http://rdaregistry.info/Elements/p/',
            'rdapd' => 'http://rdaregistry.info/Elements/p/datatype/',
            'rdapo' => 'http://rdaregistry.info/Elements/p/object/',
            'rdat'  => 'http://rdaregistry.info/Elements/t/',
            'rdatd' => 'http://rdaregistry.info/Elements/t/datatype/',
            'rdato' => 'http://rdaregistry.info/Elements/t/object/',
            'rdau'  => 'http://rdaregistry.info/Elements/u/',
            'rdaw'  => 'http://rdaregistry.info/Elements/w/',
            'rdawd' => 'http://rdaregistry.info/Elements/w/datatype/',
            'rdawo' => 'http://rdaregistry.info/Elements/w/object/',
            'rdax'  => 'http://rdaregistry.info/Elements/x/',
            'rdaxd' => 'http://rdaregistry.info/Elements/x/datatype/',
            'rdaxo' => 'http://rdaregistry.info/Elements/x/object/',
            'rdaz'  => 'http://rdaregistry.info/Elements/z/',
        ];
        $project         = Project::find(177);
        $vocabs          = $project->vocabularies;
        $elements        = $project->elementsets;
        foreach ($vocabs as $vocab) {
            $vocab->prefixes = $rdaPrefixes;
            $vocab->save();
        }
        foreach ($elements as $element) {
            $element->prefixes = $rdaPrefixes;
            $element->save();
        }
    });
