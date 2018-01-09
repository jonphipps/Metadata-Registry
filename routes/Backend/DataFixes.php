<?php

/**
 * All route names are prefixed with 'admin.'.
 */

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Vocabulary;

Route::get('fixprojectlanguages', function(){
    $agents = Project::with('vocabularies', 'elementsets')->get();
    $languages =[];
    /** @var Project $agent */
    foreach ($agents as $agent) {
        $languages[$agent->id]['languages'] = $agent->languages;
        /** @var Vocabulary $vocabulary */
        foreach ($agent->vocabularies as $vocabulary) {
            if ($vocabulary->languages) {
                $languages[ $agent->id ]['languages'] += $vocabulary->languages;
            }
        }
        foreach ($agent->elementsets as $vocabulary) {
            if ($vocabulary->languages) {
                $languages[ $agent->id ]['languages'] += $vocabulary->languages;
            }
        }
        if (count($languages[ $agent->id ]['languages'])) {
            $agent->languages =$languages[ $agent->id ]['languages'];
            $agent->save();
        }
        // $languages[ $agent->id ]['count'] = count($languages[ $agent->id ]['languages']);
    }
    return $agents;
});
Route::get('update_authorized_as', function(){
    //$agents = Project::with('members', 'vocabularies.members', 'elementsets.members')->find(177);
    ProjectUser::where('is_maintainer_for', 1)->where('is_admin_for', 0)->update(['authorized_as' => 1]);
    // $projectUsers = ProjectUser::with('user', 'project.vocabularies.members', 'project.elementsets.members')->where('agent_id',177)->first();
    $projectUsers = ProjectUser::get();

    return $projectUsers->where('authorized_as',1);

});
