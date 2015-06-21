<?php

namespace spec\ImportVocab;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

// This is global bootstrap for autoloading
define( 'SF_ROOT_DIR', realpath( dirname( __file__ ) . '/../../../../..' ) );
define( 'SF_APP', 'frontend' );
define( 'SF_ENVIRONMENT', 'test-update' );
define( 'SF_DEBUG', isset( $debug ) ? $debug : true );
//initialize composer
require_once( SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php' );
// initialize symfony
require_once( SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php' );
// initialize database manager
$databaseManager = new \sfDatabaseManager();
$databaseManager->initialize();

class ExportVocabSpec extends ObjectBehavior {

    function let()
    {
        $vocabId = 1;
        $userId  = 1;
        $this->beConstructedWith( $vocabId, $userId );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType( 'ImportVocab\ExportVocab' );
    }


    function it_finds_an_array_of_used_columns_based_on_a_schema_id_in_display_order()
    {
        /** @var \ImportVocab\ExportVocab $this */
        $this->findColumns();
        $this->getColumns()->shouldHaveCount( 14 );
        $this->getColumns()[1]['profile']->shouldHaveType( 'ProfileProperty' );
        $this->getColumns()[12]['count']->shouldEqual( 3 );
        $this->getColumns()[4]['languages']['en']->shouldEqual( 1 );
        $this->getColumns()[4]['languages']['fr']->shouldEqual( 1 );
        $id = \ProfilePropertyPeer::retrieveByPK( 9 )->getId();
        $this->getColumns()[12]['id']->shouldEqual( $id );
    }

    function it_finds_an_array_of_all_columns_based_on_a_schema_id_in_display_order()
    {
        $schema = \SchemaPeer::retrieveByPK(1);
        $schema->setLanguages(['en','fr']);
        $schema->save();

        /** @var \ImportVocab\ExportVocab $this */
        $this->setAsTemplate(true);
        $columns = $this->getSchema()->getAllProfileProperties();
        $columns->shouldHaveCount( 26 );
        $columns[1]['profile']->shouldHaveType( 'ProfileProperty' );
        $columns[9]['count']->shouldEqual( 1 );
        $columns[3]['languages']['en']->shouldEqual( 1 );
        $columns[3]['languages']['fr']->shouldEqual( 1 );
        $id = \ProfilePropertyPeer::retrieveByPK( 9 )->getId();
        $columns[12]['id']->shouldEqual( $id );
    }

    function it_gets_the_schema_languages_as_array()
    {
        /** @var \ImportVocab\ExportVocab $this */
        $this->getLanguages()->shouldBeArray();
        $this->getLanguages()[0]->shouldEqual('en');
        $this->getLanguages()->shouldHaveCount(2);
        ;
    }

    function it_sends_a_csv_template_to_a_file()
    {
        //todo: test for language selection
        /** @var \ImportVocab\ExportVocab $this */
        $this->setAsTemplate(true);
        $this->write();

    }

    function it_sets_the_filename_based_on_template_status( ){
        $this->setAsTemplate(true);
        $this->getFileName()->shouldEqual("testelement_template.csv");
        $this->setAsTemplate(false);
        $this->getFileName()->shouldEqual("testelement.csv");
    }

    function it_sends_a_csv_template_to_output()
    {
        //todo: test for language selection
        /** @var \ImportVocab\ExportVocab $this */
        $this->setAsTemplate(true);
        $this->output();
        $foo ='how do I test this?';
    }

    function it_should_have_a_schema_object_set_in_the_constructor()
    {
        /** @var \ImportVocab\ExportVocab $this */
        $this->getSchema()->shouldHaveType( 'Schema' );
        $this->getSchema()->getProfileId()->shouldBe( 1 );
    }

    function it_should_have_a_user_object_set_in_the_constructor()
    {
        /** @var \ImportVocab\ExportVocab $this */
        $this->getUser()->shouldHaveType( 'User' );
    }

    function it_finds_languages_for_the_selected_schema()
    {
        /** @var \ImportVocab\ExportVocab $this */
        $this->findLanguages();
        $this->getLanguages()->shouldReturn(['en','fr']);
    }

    function it_retrieves_a_list_of_prefixes()
    {
        /** @var \ImportVocab\ExportVocab $this */
        $this->getSchema()->setPrefixes(
          [
            'rdf' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
            'owl' => 'http://www.w3.org/2002/07/owl#'
          ]
        );
        $this->retrievePrefixes()->shouldReturn(
          [
            'rdf' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
            'owl' => 'http://www.w3.org/2002/07/owl#',
            0     => 'http://iflastandards.info/ns/fr/frbr/frbroo/',
            'crm' => 'http://www.cidoc-crm.org/cidoc-crm/'
          ]
        );

        $this->getSchema()->setPrefixes( array() );
        $this->retrievePrefixes()->shouldReturn(
          [
            0     => 'http://iflastandards.info/ns/fr/frbr/frbroo/',
            'crm' => 'http://www.cidoc-crm.org/cidoc-crm/'
          ]
        );
        $this->retrievePrefixes()->shouldReturn(
          [
            0     => 'http://iflastandards.info/ns/fr/frbr/frbroo/',
            'crm' => 'http://www.cidoc-crm.org/cidoc-crm/'
          ]
        );

        $this->getSchema()->setPrefixes(
          [
            0     => 'http://iflastandards.info/ns/fr/frbr/frbroo/',
            'crm' => 'http://www.cidoc-crm.org/cidoc-crm/'
          ]
        );
        $this->retrievePrefixes()->shouldReturn(
          [
            0     => 'http://iflastandards.info/ns/fr/frbr/frbroo/',
            'crm' => 'http://www.cidoc-crm.org/cidoc-crm/'
          ]
        );
        $headerCount = $this->getHeaderCount();
        $this->getPrefixRows()[0]->shouldHaveCount($headerCount);

    }

    function it_sets_the_prolog_headers_for_an_empty_template_for_all_languages()
    {
        /** @var \ImportVocab\ExportVocab $this */
        $this->setAsTemplate(true);
        $header = $this->getPrologHeader();
        $header[0]->shouldHaveCount(34);
        $header[0][0]->shouldEqual("ID");
        $header[0][1]->shouldEqual("uri");
        $header[0][3]->shouldEqual("name (en)");
        $header[0][4]->shouldEqual("name (fr)");
        $header[0][8]->shouldEqual("lexicalAlias (fr)");
        $header[0][18]->shouldEqual("parent_class");
        $header[1][18]->shouldEqual("rdfs:subClassOf");
        $header[0][19]->shouldEqual("subClassOf");
        $header[0][20]->shouldEqual("parent_property");
        $header[1][20]->shouldEqual("rdfs:subPropertyOf");
        $header[0][21]->shouldEqual("subPropertyOf");
        $header[1][25]->shouldEqual("owl:disjointWith");

    }

    function it_gets_the_prolog_metadata_padded_with_empty_columns()
    {
        /** @var \ImportVocab\ExportVocab $this */
        $metadata = $this->getMetadata();
        $headerCount = $this->getHeaderCount();
        $metadata->shouldHaveCount(10);
        $metadata[0]->shouldHaveCount($headerCount);
    }

    function it_gets_the_headers_for_an_empty_template_for_a_single_language()
    {
        /** @var \ImportVocab\ExportVocab $this */
        $this->setAsTemplate(true);
        $this->setLanguages([ 'en' ]);
        $header = $this->getPrologHeader( );
        $header[0]->shouldHaveCount( 27 );
        $header[0][0]->shouldEqual( "ID" );
        $header[0][1]->shouldEqual( "uri" );
        $header[0][3]->shouldEqual( "name (en)" );
        $header[0][4]->shouldNotEqual( "name (fr)" );
        $header[0][2]->shouldEqual( "type" );
        $header[0][15]->shouldEqual( "subPropertyOf" );
        $header[1][19]->shouldEqual( "owl:disjointWith" );
    }

    function it_populates_a_csv_file_with_data( ){
        /** @var \ImportVocab\ExportVocab $this */
        $this->getSchema()->setPrefixes(
          [
            'frbroo' => 'http://iflastandards.info/ns/fr/frbr/frbroo/',
            'crm' => 'http://www.cidoc-crm.org/cidoc-crm/'
          ]
        );
        $this->setAsTemplate(false);
        $this->write();
        //todo: test file contents against ideal
        $foo="how do I test this?";
    }

    function it_gets_a_header_row_that_is_mapped_to_profile_ids(){
        /** @var \ImportVocab\ExportVocab $this */
        $map = $this->getHeaderMap();
        $this->getHeaderCount()->shouldEqual(19);
        $map->shouldHaveCount(17);
        $map[9]->shouldHaveCount(2);
        $map['9parent'][0]->shouldEqual(11);

        $foo = $map;

    }


}
