<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

/**
 * Class TestCase.
 */
abstract class BrowserKitTest extends BaseTestCase
{
  use CreatesApplication;
  use DatabaseTransactions;
  use SetsUpTests;


  public function setUp()
  {
    parent::setUp();
    $this->setUpTests();
  }

}
