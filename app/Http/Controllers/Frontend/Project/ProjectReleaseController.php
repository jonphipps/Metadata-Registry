<?php

namespace App\Http\Controllers\Frontend\Project;

use App\Http\Controllers\Controller;
use App\Jobs\Publish;
use App\Models\Release;
use Illuminate\Support\Facades\Redirect;
use Prologue\Alerts\Facades\Alert;

class ProjectReleaseController extends Controller
{
    public function publish($project_id, Release $release)
    {
        if ($release->project->repo && $release->user->github_token === null) {
            return Redirect::back()->withErrors([
                'You\'re trying to access GitHub, but you don\'t seem to have any current GitHub credentials.',
                'You must logout of the OMR, and login to the OMR again using the \'Login with GitHub\' link.'
            ]);
        }
        $this->dispatch(new Publish($release));
        Alert::success(trans('strings.frontend.publish.queued'))->flash();

        return redirect(route('frontend.crud.projects.show', ['id' => $project_id]));
    }
}
