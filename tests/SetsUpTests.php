<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-09,  Time: 12:34 PM */

namespace Tests;

use App\Exceptions\Handler;
use App\Models\Access\Role\Role;
use App\Models\Access\User\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

trait SetsUpTests
{
    public static $setupDatabase = true;
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl;
    /** @var  User $admin */
    protected $admin;
    /** @var  User $executive */
    protected $executive;
    /** @var  User $user */
    protected $user;
    /** @var  Role $adminRole */
    protected $adminRole;
    /** @var  Role $executiveRole */
    protected $executiveRole;
    /** @var  Role $userRole */
    protected $userRole;
    protected $oldExceptionHandler;

    /**
     * Set up tests.
     */
    public function setUpTests()
    {
        //this resets the test environment for a Symfony instance that is running independently of the test environment
        if (method_exists($this, 'setTestEnvironment')) {
            $this->setTestEnvironment();
        }

        $this->baseUrl = config('app.url', 'http://registry.test');
        // Run the tests in English
        App::setLocale('en');
        if (self::$setupDatabase) {
            $this->setupDatabase();
        }
        ini_restore('arg_separator.output');
        ini_set('memory_limit', '-1');
        /*
         * Create class properties to be used in tests
         */
        $this->admin         = User::find(1);
        $this->executive     = User::find(2);
        $this->user          = User::find(3);
        $this->adminRole     = Role::find(1);
        $this->executiveRole = Role::find(2);
        $this->userRole      = Role::find(3);

        //$this->disableExceptionHandling();
    }

    public function setupDatabase()
    {
        // Set up the database
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
        //Artisan::call('migrate:refresh');
        //Artisan::call('db:seed', [ '--class' => 'AdminSeeder' ]);
        //Artisan::call('db:seed');
        self::$setupDatabase = false;
    }

    public function dontSetupDatabase()
    {
        self::$setupDatabase = false;
    }

    public function seedTestData(): void
    {
        $this->artisan('db:seed', [ '--class' => 'RDAClassesSeeder' ]);
        $this->artisan('db:seed', [ '--class' => 'RDAMediaTypeSeeder' ]);

        if (method_exists($this, 'clearSymfonyCache')) {
            $this->clearSymfonyCache();
        }

        $process = new Process('php symfony cc');
        $process->run();
    }

    protected function disableExceptionHandling()
    {
        /** @var \app\MyApp $this ->app */
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        /**  @formatter:off */
        /** @noinspection PhpMissingParentConstructorInspection */
        $this->app->instance(
            ExceptionHandler::class,
            new class extends Handler
            {
                public function __construct()
                {
                }

                public function report(\Exception $e)
                {
                }

                public function render($request, \Exception $e)
                {
                    throw $e;
                }
            }
        );
        /**  @formatter:on */
    }

    protected function withExceptionHandling()
    {
        /** @var \app\MyApp $this ->app */
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }

    /**
     * @param string           $uri
     * @param null|string|null $message
     *
     * @return $this
     */
    protected function assertPageLoaded($uri, $message = null)
    {
        /** @var \Illuminate\Http\Response $this->response */
        if ($this->response->getStatusCode() == 418) {
            //it's not a route that laravel recognizes
            //so we fire up symfony
            define('SF_APP', 'frontend');
            define('SF_ENVIRONMENT', env('SF_ENVIRONMENT', 'prod'));
            define('SF_DEBUG', env('SF_DEBUG', 'false'));
            require_once SF_ROOT_DIR .
                DIRECTORY_SEPARATOR .
                'apps' .
                DIRECTORY_SEPARATOR .
                SF_APP .
                DIRECTORY_SEPARATOR .
                'config' .
                DIRECTORY_SEPARATOR .
                'config.php';
            /** @noinspection PhpUndefinedClassInspection */
            sfContext::getInstance()->getController()->dispatch();
        }
        parent::assertPageLoaded($uri, $message);
    }

    public function tearDown()
    {
        if (method_exists($this, 'resetEnvironment')) {
            $this->resetEnvironment();
        }
        //this is necessary because the laravel test suite always starts session output capture
        if (ob_get_level() > 1) {
            ob_end_clean();
        }

        $this->beforeApplicationDestroyed(function () {
            DB::disconnect();
        });

        parent::tearDown();
    }
}
