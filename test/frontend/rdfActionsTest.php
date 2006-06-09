<?php

class rdfActionsWebBrowserTest extends UnitTestCase
{
  private
    $browser = null;

  public function setUp ()
  {
    // create a new test browser
    $this->browser = new sfTestBrowser();
    $this->browser->initialize('hostname');
  }

  public function tearDown ()
  {
    $this->browser->shutdown();
  }

  public function test_simple()
  {
    $url = '/rdf/index';
    $html = $this->browser->get($url);
    $this->assertWantedPattern('/rdf/', $html);
  }
}

?>