<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * Class TestCase.
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
  //use DatabaseTransactions;
    use SetsUpTests;


    public function setUp()
    {
        parent::setUp();
        $this->setUpTests();
    }
}
