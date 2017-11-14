<?php

namespace Tests\Feature\OMR;

use Tests\TestCase;

class RedirectTest extends TestCase
{

    public function setUp()
    {
      $this->dontSetupDatabase();
      parent::setUp();
    }

    /** @test */
    public function legacy_redirects()
    {
        $this->get(url('/schema/list.html'))->assertRedirect(url('elementsets'))->assertStatus(301);
        $this->get(url('/schema/show/id/83.html'))->assertRedirect(url('elementsets/83'))->assertStatus(301);
        $this->get(url('elementsets/83.rdf'))->assertRedirect(url('/schema/show/id/83.rdf'))->assertStatus(301);
        $this->get(url('/schema/export/id/83.html'))->assertRedirect(url('elementsets/83/exports/create'))->assertStatus(301);
        $this->get(url('/schemahistory/list/schema_id/83.html'))->assertRedirect(url('elementsets/83/history'))->assertStatus(301);
        $this->get(url('/schemauser/list/schema_id/83.html'))->assertRedirect(url('elementsets/83/maintainers'))->assertStatus(301);

        $this->get(url('/schemaprop/list/schema_id/83.html'))->assertRedirect(url('elementsets/83/elements'))->assertStatus(301);
        $this->get(url('/schemahistory/list/schema_property_id/14328.html'))->assertRedirect(url('elements/14328/history'))->assertStatus(301);
        $this->get(url('/schemaprop/show/id/14328.html'))->assertRedirect(url('elementsets/83/elements/14328'))->assertStatus(301);
        $this->get(url('elementsets/83/elements/14328.rdf'))->assertRedirect(url('/schemaprop/show/id/14328.rdf'))->assertStatus(301);

        $this->get(url('/concept/list/vocabulary_id/37.html'))->assertRedirect(url('vocabularies/37/concepts'))->assertStatus(301);
        $this->get(url('/concept/show/id/475.html'))->assertRedirect(url('vocabularies/37/concepts/475'))->assertStatus(301);
        $this->get(url('vocabularies/37/concepts/475.rdf'))->assertRedirect(url('/concept/show/id/475.rdf'))->assertStatus(301);
        $this->get(url('/history/list/concept_id/475.html'))->assertRedirect(url('concepts/475/history'))->assertStatus(301);

        $this->get(url('/schemapropel/list/schema_property_id/14328.html'))->assertRedirect(url('elements/14328/statements'))->assertStatus(301);
        $this->get(url('/schemapropel/show/id/107698.html'))->assertRedirect(url('elements/14328/statements/107698'))->assertStatus(301);
        $this->get(url('/schemahistory/list/schema_property_element_id/107698.html'))->assertRedirect(url('statements/107698/history'))->assertStatus(301);

        $this->get(url('/conceptprop/list/concept_id/475.html'))->assertRedirect(url('concepts/475/properties'))->assertStatus(301);
        $this->get(url('/conceptprop/show/id/1281.html'))->assertRedirect(url('concepts/475/properties/1281'))->assertStatus(301);
        $this->get(url('/history/list/property_id/1281.html'))->assertRedirect(url('properties/1281/history'))->assertStatus(301);

        $this->get(url('/schemahistory/show/id/223712.html'))->assertRedirect(url('statements/107698/history/223712'))->assertStatus(301);

        $this->get(url('/vocabulary/list.html'))->assertRedirect(url('vocabularies'))->assertStatus(301);
        $this->get(url('/vocabulary/show/id/37.html'))->assertRedirect(url('vocabularies/37'))->assertStatus(301);
        $this->get(url('vocabularies/37.rdf'))->assertRedirect(url('/vocabulary/show/id/37.rdf'))->assertStatus(301);
        $this->get(url('/vocabulary/export/id/37.html'))->assertRedirect(url('vocabularies/37/exports/create'))->assertStatus(301);
        $this->get(url('/history/list/vocabulary_id/37.html'))->assertRedirect(url('vocabularies/37/history'))->assertStatus(301);
        $this->get(url('/version/list/vocabulary_id/37.html'))->assertRedirect(url('vocabularies/37/versions'))->assertStatus(301);
        $this->get(url('/vocabuser/list/vocabulary_id/37.html'))->assertRedirect(url('vocabularies/37/maintainers'))->assertStatus(301);

        $this->get(url('/agent/list.html'))->assertRedirect(url('projects'))->assertStatus(301);
        $this->get(url('/agent/show/id/177.html'))->assertRedirect(url('projects/177'))->assertStatus(301);

        $this->get(url('/user/show/id/422.html'))->assertRedirect(url('members/422'))->assertStatus(301);
        $this->get(url('/agentuser/list/user_id/422.html'))->assertRedirect(url('members/422/projects'))->assertStatus(301);
        $this->get(url('/vocabuser/list/user_id/422.html'))->assertRedirect(url('members/422/vocabulary_maintainers'))->assertStatus(301);
        $this->get(url('/schemauser/list/user_id/422.html'))->assertRedirect(url('members/422/elementset_maintainers'))->assertStatus(301);

        $this->get(url('/import/show/id/449.html'))->assertRedirect(url('elementsets/83/imports/449'))->assertStatus(301);
        $this->get(url('/import/show/id/29.html'))->assertRedirect(url('vocabularies/37/imports/29'))->assertStatus(301);
        $this->get(url('/import/list/schema_id/83.html'))->assertRedirect(url('elementsets/83/imports'))->assertStatus(301);
        $this->get(url('import/list/vocabulary_id/37.html'))->assertRedirect(url('vocabularies/37/imports'))->assertStatus(301);
        $this->get(url('/schemahistory/list/import_id/449.html'))->assertRedirect(url('schemaimports/449/history'))->assertStatus(301);
    }
}
