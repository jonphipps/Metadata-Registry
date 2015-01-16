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
$databaseManager = new \sfDatabaseManager();
$databaseManager->initialize();

class ExportVocabSpec extends ObjectBehavior {

    function let()
    {
        $vocabId = 1;
        $userId  = 1;
        $this->beConstructedWith( $vocabId, $userId );
        // initialize database manager
        //$databaseManager = new \sfDatabaseManager();
        //$databaseManager->initialize();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType( 'ImportVocab\ExportVocab' );
    }

    function it_gets_a_prolog_as_an_array()
    {
        /** @var \ImportVocab\ExportVocab $this */
        $this->getCsvProlog();
    }

    function it_finds_an_array_of_used_columns_based_on_a_schema_id()
    {
        /** @var \ImportVocab\ExportVocab $this */
        $this->findColumns();
        $this->getColumns()->shouldHaveCount( 14 );
        $this->getColumns()[1]['en']['profile']->shouldHaveType( 'ProfileProperty' );
        $this->getColumns()[9]['en']['count']->shouldEqual( 3 );
        $this->getColumns()[2]['en']['count']->shouldEqual( 1 );
        $this->getColumns()[2]['fr']['count']->shouldEqual( 1 );
        $id = \ProfilePropertyPeer::retrieveByPK( 9 )->getId();
        $this->getColumns()[9]['en']['id']->shouldEqual( $id );
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
        /**  */
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
        $this->getSchema()->getPrefixes()->shouldReturn(
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
        $this->retrievePrefixes()->shouldReturn(
          [
            0     => 'http://iflastandards.info/ns/fr/frbr/frbroo/',
            'crm' => 'http://www.cidoc-crm.org/cidoc-crm/'
          ]
        );
    }
}
