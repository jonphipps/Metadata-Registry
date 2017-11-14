<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-11-14,  Time: 1:13 PM */

use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\Element;
use App\Models\ElementAttribute;
use App\Models\ElementAttributeHistory;
use App\Models\Import;
use Illuminate\Support\Facades\Route;

//legacy redirects
Route::get('/vocabulary/list.html', function() { return redirect('vocabularies', 301); });
Route::get('/vocabulary/show/id/{id}.html', function($id) { return redirect('vocabularies/' . $id, 301); });
Route::get('/vocabulary/export/id/{id}.html', function($id) { return redirect("vocabularies/{$id}/exports/create", 301); });
Route::get('/vocabularies/{id}.rdf', function($id) { return redirect("vocabulary/show/id/$id.rdf", 301); });

Route::get('/schema/list.html', function() { return redirect('elementsets', 301); });
Route::get('/schema/show/id/{id}.html', function($id) { return redirect('elementsets/' . $id, 301); });
Route::get('/schema/export/id/{id}.html', function($id) { return redirect("elementsets/{$id}/exports/create", 301); });
Route::get('/elementsets/{id}.rdf', function($id) { return redirect("schema/show/id/$id.rdf", 301); });

Route::get('/schemaprop/list/schema_id/{id}.html', function($id) { return redirect('elementsets/' . $id . '/elements', 301); });
Route::get('/schemaprop/show/id/{id}.html', function($id) {
        $elementsetId = Element::findOrFail($id)->schema_id;
        return redirect("elementsets/{$elementsetId}/elements/{$id}", 301);
    });
Route::get('elementsets/{elementsetId}/elements/{id}.rdf', function($elementsetId, $id) { return redirect("/schemaprop/show/id/{$id}.rdf", 301); });

Route::get('/concept/list/vocabulary_id/{id}.html', function($id) { return redirect('vocabularies/' . $id . '/concepts', 301); });
Route::get('/concept/show/id/{id}.html', function($id) {
        $vocabId = Concept::findOrFail($id)->vocabulary_id;
        return redirect("vocabularies/{$vocabId}/concepts/{$id}", 301);
    });
Route::get('vocabularies/{vocabId}/concepts/{id}.rdf', function($vocabId, $id) {return redirect("/concept/show/id/{$id}.rdf", 301); });

Route::get('/conceptprop/list/concept_id/{id}.html', function($id) { return redirect('concepts/' . $id . '/properties', 301); });
Route::get('/conceptprop/show/id/{id}.html', function($id) {
        $conceptId = ConceptAttribute::findOrFail($id)->concept_id;
        return redirect("concepts/{$conceptId}/properties/{$id}", 301);
    });

Route::get('/schemapropel/list/schema_property_id/{id}.html', function($id) { return redirect('elements/' . $id . '/statements', 301); });
Route::get('/schemapropel/show/id/{id}.html', function($id) {
        $elementId = ElementAttribute::findOrFail($id)->schema_property_id;
        return redirect("elements/{$elementId}/statements/{$id}", 301);
    });

Route::get('/version/list/vocabulary_id/{id}.html', function($id) { return redirect('vocabularies/' . $id . '/versions', 301); });

Route::get('/history/list/vocabulary_id/{id}.html', function($id) { return redirect('vocabularies/' . $id . '/history', 301); });
Route::get('/history/list/concept_id/{id}.html', function($id) { return redirect('concepts/' . $id . '/history', 301); });
Route::get('/history/list/property_id/{id}.html', function($id) { return redirect('properties/' . $id . '/history', 301); });

Route::get('/schemahistory/list/schema_id/{id}.html', function($id) { return redirect('elementsets/' . $id . '/history', 301); });
Route::get('/schemahistory/list/schema_property_id/{id}.html', function($id) { return redirect('elements/' . $id . '/history', 301); });
Route::get('/schemahistory/list/import_id/{id}.html', function($id) { return redirect('schemaimports/' . $id . '/history', 301); });
Route::get('/schemahistory/list/schema_property_element_id/{id}.html', function($id) { return redirect('statements/' . $id . '/history', 301); });
Route::get('/schemahistory/show/id/{id}.html', function($id) {
        $statementId = ElementAttributeHistory::findOrFail($id)->schema_property_element_id;
        return redirect("statements/{$statementId}/history/{$id}", 301);
    });

Route::get('/agent/list.html', function() { return redirect('projects', 301); });
Route::get('/agent/show/id/{id}.html', function($id) { return redirect('projects/' . $id, 301); });

Route::get('/user/show/id/{id}.html', function($id) { return redirect('members/' . $id, 301); });
Route::get('/agentuser/list/user_id/{id}.html', function($id) { return redirect('members/' . $id . '/projects', 301); });

Route::get('/vocabuser/list/user_id/{id}.html', function($id) { return redirect('members/' . $id . '/vocabulary_maintainers', 301); });
Route::get('/vocabuser/list/vocabulary_id/{id}.html', function($id) { return redirect('vocabularies/' . $id . '/maintainers', 301); });

Route::get('/schemauser/list/user_id/{id}.html', function($id) { return redirect('members/' . $id . '/elementset_maintainers', 301); });
Route::get('/schemauser/list/schema_id/{id}.html', function($id) { return redirect('elementsets/' . $id . '/maintainers', 301); });

Route::get('/import/list/schema_id/{id}.html', function($id) { return redirect('elementsets/' . $id . '/imports', 301); });
Route::get('/import/show/id/{id}.html', function($id) {
        $import = Import::findOrFail($id);
        if ($import->schema_id) {
            $parentId = $import->schema_id;
            return redirect("elementsets/{$parentId}/imports/{$id}", 301);
        }

        $parentId = $import->vocabulary_id;
        return redirect("vocabularies/{$parentId}/imports/{$id}", 301);
    });
Route::get('/import/list/vocabulary_id/{id}.html', function($id) { return redirect('vocabularies/' . $id . '/imports', 301); });
