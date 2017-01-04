<?php
/**
 * Created by PhpStorm.
 * User: jonphipps
 * Date: 2016-12-27
 * Time: 2:13 PM
 */

namespace features;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewProjectTest extends \TestCase
{

  /**
   * @test
   */
  public function ListProjects()
  {
    $this->visit('/projects')
        ->see('NSDL Registry');
  }
}
