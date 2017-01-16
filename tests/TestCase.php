<?php

define('SF_ROOT_DIR', realpath(dirname(__FILE__) . '/..'));

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

  protected $userTable;
  protected $roleUserTable;
  protected $roleTable;
  protected $permissionRoleTable;


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

    ini_restore('arg_separator.output');

    // Run the tests in English
    App::setLocale('en');

    if (self::$setupDatabase) {
      $this->setupDatabase();
    }

    /**
     * Create class properties to be used in tests
     */
    $this->admin         = User::find(1);
    $this->executive     = User::find(2);
    $this->user          = User::find(3);
    $this->adminRole     = Role::find(1);
    $this->executiveRole = Role::find(2);
    $this->userRole      = Role::find(3);

    /** Define tables */

    $this->userTable     = config('access.users_table');
    $this->roleUserTable = config('access.role_user_table');
    $this->roleTable = config('access.roles_table');
    $this->permissionRoleTable = config('access.permission_role_table');

  }


  public function setupDatabase()
  {
    // Set up the database
    Artisan::call('migrate:refresh');
    Artisan::call('db:seed');

    self::$setupDatabase = false;
  }


  /**
   * @param string $uri
   * @param null|string|null $message
   *
   * @return $this
   */
  protected function assertPageLoaded($uri, $message = null)
  {
    if ($this->response->getStatusCode() == 418) {
      //it's not a route that laravel recognizes
      //so we fire up symfony
      define('SF_APP', 'frontend');
      define('SF_ENVIRONMENT', env('SF_ENVIRONMENT', 'prod'));
      define('SF_DEBUG', env('SF_DEBUG', 'false'));

      require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

      sfContext::getInstance()->getController()->dispatch();
    }
    parent::assertPageLoaded($uri);
  }

}
