<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

// This is global bootstrap for autoloading
define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../../../../..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'test');
define('SF_DEBUG',       isset($debug) ? $debug : true);
//initialize composer
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
// initialize symfony
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
//$databaseManager = new \sfDatabaseManager();
//$databaseManager->initialize();

class ExportVocabSpec extends ObjectBehavior
{

    function let()
    {
        $vocabId = 1;
        $userId = 1;
        $this->beConstructedWith($vocabId, $userId);
        // initialize database manager
        $databaseManager = new \sfDatabaseManager();
        $databaseManager->initialize();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('ExportVocab');
    }

    function it_gets_a_prolog_as_an_array() {
        $this->getCsvProlog();
    }

    function it_finds_an_array_of_prefixes_based_based_on_a_schema_id()
    {
        $this->findPrefixes();
    }
    function it_finds_an_array_of_used_columns_based_on_a_schema_id(){
        $this->findColumns();
        $this->getColumns()->shouldHaveCount(14);
        $this->getColumns()[0]->shouldHaveType('ProfileProperty');

    }

    function it_should_have_a_schema_object_set_in_the_constructor(){
        $this->getSchema()->shouldHaveType('Schema');
        $this->getSchema()->getProfileId()->shouldBe(1);
    }

    function it_should_have_a_user_object_set_in_the_constructor(){
        $this->getUser()->shouldHaveType('User');
    }

    function it_finds_languages_for_the_selected_schema( ){
        $this->findLanguages();
        $this->getLanguages()->shouldReturn(['en','fr']);
    }

    function it_retrieves_a_list_of_prefixes_from_prefix_cc()
    {
        $this->retrievePrefixes();
    }


}
