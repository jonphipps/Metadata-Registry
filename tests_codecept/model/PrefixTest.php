<?php

use Codeception\Configuration;
use Codeception\Module\Db;
use Codeception\Module\Dbh;
use Codeception\Module\DbHelper;
use Codeception\Scenario;

class PrefixTest extends \Codeception\TestCase\Test {

    use Codeception\Specify;

    /**
     * @var \ModelTester
     */
    protected $tester;

    /** @var  \PrefixPeer */
    protected $PrefixPeer;

    /** @var  \Prefix */
    protected $Prefix;

    public function __construct()
    {
        $this->PrefixPeer = new \PrefixPeer();
        $this->Prefix     = new \Prefix();
    }

    public static function setUpBeforeClass()
    {
    }

    protected function _before()
    {
        $config = Configuration::config();
        //get  the unit settings
        $settings = Configuration::suiteSettings("unit", $config);
    }

    protected function _after()
    {
    }

    // tests
    public function testInstance()
    {
        $this->specify(
          "There is an instance of PrefixPeer",
          function ()
          {
              verify( $this->PrefixPeer instanceof \PrefixPeer )->true();
              verify( $this->Prefix instanceof \Prefix )->true();
          }
        );
    }

    /**
     * This test is executed only for an empty database
     * @env empty
     */
    public function testPopulateFromLocalFile()
    {
        $this->specify(
          "An empty table in the database is populated from a local file",
          function ()
          {
              $c = new Criteria();
              verify( $this->PrefixPeer->doCount( $c ) )->equals( 0 );
              $config = Configuration::config();

              $xhtml = simplexml_load_file( $config['paths']['data'] . '/prefix.cc.local.xml' );
              $count = count($xhtml->body->ol->li);
              $this->PrefixPeer->populatePrefixes( $xhtml );
              verify( $this->PrefixPeer->doCount( $c ) )->equals( $count );
          }
        );
    }

    public function testGetPrefixCC()
    {
        $this->specify(
          "The we can get prefix.cc",
          function ()
          {
              $xhtml = PrefixPeer::getPrefixcc();
              verify( count($xhtml->body->ol) )->equals( 1 );
          }
        );
    }

    public function test_get_record_by_uri()
    {
        //$this->tester->haveInDatabase( "reg_prefix", [ 'uri' => "http://www.w3.org/1999/02/22-rdf-syntax-ns#", 'rank' => '2', 'rdf' ] );
        $this->specify(
          "that the record can be retrieved by uri",
          function ()
          {
              verify( $this->PrefixPeer->findByUri( "http://www.w3.org/1999/02/22-rdf-syntax-ns#" )->getPrefix() )->equals( "rdf" );
          }
        );
    }
}
