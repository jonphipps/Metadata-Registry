<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-09,  Time: 12:34 PM */

namespace Tests;

use App\Models\Access\Role\Role;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

trait SetsUpTests
{

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl;

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

    public static $setupDatabase = true;

    /**
     * Set up tests.
     */
    public function setUpTests()
    {
        $this->baseUrl = config('app.url', 'http://registry.dev');

        // Run the tests in English
        App::setLocale('en');

        if (self::$setupDatabase) {
            $this->setupDatabase();
        }

        ini_restore('arg_separator.output');

        /*
         * Create class properties to be used in tests
         */
        $this->admin = User::find(1);
        $this->executive = User::find(2);
        $this->user = User::find(3);
        $this->adminRole = Role::find(1);
        $this->executiveRole = Role::find(2);
        $this->userRole = Role::find(3);
    }

    public function setupDatabase()
    {
        // Set up the database
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed', ['--class' => 'AdminSeeder']);
        // Artisan::call('db:seed');

        self::$setupDatabase = false;
    }

    public function dontSetupDatabase()
    {
        self::$setupDatabase = false;
    }
    /**
     * @param string           $uri
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

            require_once SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';

            sfContext::getInstance()
                     ->getController()
                     ->dispatch();
        }
        parent::assertPageLoaded($uri);
    }

}
