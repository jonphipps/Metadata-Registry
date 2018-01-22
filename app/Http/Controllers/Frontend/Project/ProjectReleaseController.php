<?php

namespace App\Http\Controllers\Frontend\Project;

use App\Http\Controllers\Controller;
use App\Jobs\Publish;
use App\Models\Release;

class ProjectReleaseController extends Controller
{
    public function publish($project_id, Release $release)
    {
        $this->dispatch(new Publish($release));
    }
}
