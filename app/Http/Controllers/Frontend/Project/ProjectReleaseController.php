<?php

namespace App\Http\Controllers\Frontend\Project;

use App\Jobs\Publish;
use App\Models\Project;
use App\Models\Release;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectReleaseController extends Controller
{
    public function publish($project_id, Release $release)
    {
        $this->dispatch(new Publish($release));
    }
}
