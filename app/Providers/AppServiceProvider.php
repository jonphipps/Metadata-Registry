<?php

namespace App\Providers;

use App\Rules\ValidateGoogleUrl;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use Mpociot\LaravelTestFactoryHelper\TestFactoryHelperServiceProvider;
use Recca0120\LaravelTracy\LaravelTracyServiceProvider;
use STS\Filesystem\VfsFilesystemServiceProvider;
use Way\Generators\GeneratorsServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Application locale defaults for various components
         *
         * These will be overridden by LocaleMiddleware if the session local is set
         */

        /*
         * setLocale for php. Enables ->formatLocalized() with localized values for dates
         */
        setlocale(LC_TIME, config('app.locale_php'));

        /*
         * setLocale to use Carbon source locales. Enables diffForHumans() localized
         */
        Carbon::setLocale(config('app.locale'));

        /*
         * Set the session variable for whether or not the app is using RTL support
         * For use in the blade directive in BladeServiceProvider
         */
        if (config('locale.languages')[config('app.locale')][2]) {
            session(['lang-rtl' => true]);
        } else {
            session()->forget('lang-rtl');
        }

        // Force SSL in production
        if ($this->app->environment() === 'production') {
            //URL::forceScheme('https');
        } else {
            DB::enableQueryLog();
            // DB::listen(function ($query) {
            //   var_dump([ $query->sql, $query->bindings, $query->time ]);
            // });
        }

        // Set the default string length for Laravel5.4
        // https://laravel-news.com/laravel-5-4-key-too-long-error
        Schema::defaultStringLength(191);

        if (app()->resolved('bugsnag')) {
            $bugsnag = app('bugsnag');
            $bugsnag->setReleaseStage(config('bugsnag.release_stage'));
            $bugsnag->setErrorReportingLevel(E_ALL & ~E_NOTICE);
        }

        //register validation rules
        Validator::extend('googleUrl', ValidateGoogleUrl::class . '@validateSheet');

        //throttle emails if it gets crazy (mostly for testing)
        $throttleRate = config('mail.throttleToMessagesPerMin');
        if ($throttleRate) {
            $throttlerPlugin = new \Swift_Plugins_ThrottlerPlugin($throttleRate, \Swift_Plugins_ThrottlerPlugin::MESSAGES_PER_MINUTE);
            Mail::getSwiftMailer()->registerPlugin($throttlerPlugin);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Sets third party service providers that are only needed on local/testing environments
         */
        $environment = $this->app->environment();
        if ($environment !== 'production') {
            /**
             * Loader for registering facades.
             */
            $loader = AliasLoader::getInstance();
            /*
             * Load third party local providers and facades
             */
            //$this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            //$loader->alias('Debugbar', Facade::class);
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(TestFactoryHelperServiceProvider::class);
            $this->app->register(GeneratorsServiceProvider::class);
            // $this->app->register(MigrationsGeneratorServiceProvider::class);
            // $this->app->register(IseedServiceProvider::class);
            $this->app->register(DuskServiceProvider::class);
            // $this->app->register(DbSnapshotsServiceProvider::class);
            $this->app->register(\Backpack\Generators\GeneratorsServiceProvider::class);
            if (class_exists(VfsFilesystemServiceProvider::class)) {
                $this->app->register(VfsFilesystemServiceProvider::class);
            }
        }
        if (! \in_array($environment, ['production', 'testing'], true)) {
            $this->app->register(LaravelTracyServiceProvider::class);
        }
        $this->app->bind('path.public',
            function () {
                return base_path() . '/web';
            });
        $this->app->alias('bugsnag.multi', \Illuminate\Contracts\Logging\Log::class);
        $this->app->alias('bugsnag.multi', \Psr\Log\LoggerInterface::class);
    }
}
