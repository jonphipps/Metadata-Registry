<?php

/**
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

use App\Models\Elementset;
use App\Models\ElementsetUser;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Vocabulary;
use App\Models\VocabularyUser;
use Illuminate\Support\Facades\Route;

Route::get('updatelanguages', function(){
    {
        $vocabLanguages = Vocabulary::whereNotNull('languages')->get();
        foreach ($vocabLanguages as $vocabLanguage) {
            //get the project
            /** @var Project $project */
            $project = $vocabLanguage->project()->first();
            //update the project language and save
            $project->timestamps = false;
            $project->languages = $vocabLanguage->languages;
            $project->save();
        }
        $elementsets = Elementset::whereNotNull('languages')->get();
        foreach ($elementsets as $elementset) {
            //get the project
            $project = $elementset->project()->first();
            //update the project language and save
            $array              = collect($project->languages)->union(collect($elementset->languages));
            $project->languages = $array->toArray();
            $project->timestamps = false;
            $project->save();
        }
        $projects = Project::whereNull('languages')->get();
        foreach ($projects as $project) {
            $project->languages = ['en'];
            $project->timestamps = false;
            $project->save();
        }
        $projects = VocabularyUser::whereNull('languages')->get();
        foreach ($projects as $project) {
            $project->languages = [ 'en' ];
            $project->timestamps = false;
            $project->save();
        }
        $projects = ElementsetUser::whereNull('languages')->get();
        foreach ($projects as $project) {
            $project->languages = [ 'en' ];
            $project->timestamps = false;
            $project->save();
        }
        $projects = ProjectUser::whereNull('languages')->get();
        foreach ($projects as $project) {
            $project->languages = [ 'en' ];
            $project->timestamps = false;
            $project->save();
        }
    }
});
Route::get('updateusers', function() {
    {
        //get the users for each vocab
        $users = VocabularyUser::with(['vocabulary', 'user'])->get();
        foreach ($users as $user) {
            $projectVocabUsers = $user->vocabulary->project->members;
        }

        //if they don't exist on the project, add them as maintainers

    }
});

// Switch between the included languages
Route::get('lang/{lang}', 'LanguageController@swap');

/* ----------------------------------------------------------------------- */

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__ . '/Frontend/');
});

/* ----------------------------------------------------------------------- */

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    includeRouteFiles(__DIR__ . '/Backend/');
});

includeRouteFiles(__DIR__ . '/Legacy/');
