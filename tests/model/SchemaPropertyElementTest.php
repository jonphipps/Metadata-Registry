<?php


class SchemaPropertyElementTest extends \Codeception\TestCase\Test
{

    use Codeception\Specify;

    /**
     * @var \ModelTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testCanGetArrayOfNamespaces()
    {
        $this->specify(
          "Given a schemaId, we can get an array of unique namespaces",
          function ()
          {
              $schemaId = 1;
              $n = SchemaPropertyElementPeer::getNamespaceList($schemaId);
              verify( count($n) )->equals( 2 );
          }
        );
    }

}
