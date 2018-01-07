<?php

/**
 * All route names are prefixed with 'admin.'.
 */

use App\Models\Project;
use App\Models\Vocabulary;

Route::get('fixprojectlanguages', function(){
    $agents = Project::with('vocabularies', 'elementsets')->get();
    $languages =[];
    /** @var Project $agent */
    foreach ($agents as $agent) {
        $languages[$agent->id]['languages'] = $agent->languages;
        /** @var Vocabulary $vocabulary */
        // foreach ($agent->vocabularies as $vocabulary) {
        //     if ($vocabulary->languages) {
        //         $languages[ $agent->id ] += $vocabulary->languages;
        //     }
        // }
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
