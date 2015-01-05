<?php

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

    protected function _before()
    {
        $this->PrefixPeer = new \PrefixPeer();
        $this->Prefix     = new \Prefix();
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

    public function testPopulate()
    {
        $this->specify(
          "The database is populated from prefix.cc",
          function ()
          {
              $c = new Criteria();
              verify( $this->PrefixPeer->doCount( $c ) )->equals( 0 );
              $this->PrefixPeer->populatePrefixes();
              verify( $this->PrefixPeer->doCount( $c ) )->greaterThan( 0 );
          }
        );
    }

    public function test_get_record_by_prefix()
    {

        //$this->tester->haveInDatabase( "reg_prefix", [ 'uri' => "http://www.w3.org/1999/02/22-rdf-syntax-ns#", 'rank' => '2', 'rdf' ] );
        $this->specify(
          "that the record can be retrieved by uri",
          function ()
          {
              verify($this->PrefixPeer->findByUri( "http://www.w3.org/1999/02/22-rdf-syntax-ns#" )->getPrefix())->equals( "rdf" );
        }
        );
    }
}
