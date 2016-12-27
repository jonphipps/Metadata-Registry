<?php

use App\Models\Access\User\User;
use App\Models\Access\Role\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class TestCase
 */
abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{

  use DatabaseTransactions;
  /**
   * The base URL to use while testing the application.
   *
   * @var string
   */
  protected $baseUrl = 'http://registry.dev';
  protected $admin;
  protected $executive;
  protected $user;
  protected $adminRole;
  protected $executiveRole;
  protected $userRole;

  public static $setupDatabase = false;


  /**
   * Creates the application.
   *
   * @return \Illuminate\Foundation\Application
   */
  public function createApplication()
  {
    $app = require __DIR__ . '/../bootstrap/app.php';

    $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

    return $app;
  }


  public function setUp()
  {
    parent::setUp();
    // Run the tests in English
    App::setLocale('en');

    if (self::$setupDatabase) {
      $this->setupDatabase();
    }
  }


  public function setupDatabase()
  {
    // Set up the database
    Artisan::call('migrate:refresh');
    Artisan::call('db:seed');

    /**
     * Create class properties to be used in tests
     */
    $this->admin         = User::find(1);
    $this->executive     = User::find(2);
    $this->user          = User::find(3);
    $this->adminRole     = Role::find(1);
    $this->executiveRole = Role::find(2);
    $this->userRole      = Role::find(3);

    self::$setupDatabase = false;
  }
}
