<?php

namespace App\Providers;

use Illuminate\Contracts\Logging\Log;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
    public function boot()
    {
        /**
     * Application locale defaults for various components
     * These will be overridden by LocaleMiddleware if the session local is set
     */

        /**
     * setLocale for php. Enables ->formatLocalized() with localized values for dates
     */
        setlocale(LC_TIME, config('app.locale_php'));

        /**
     * setLocale to use Carbon source locales. Enables diffForHumans() localized
     */
        Carbon::setLocale(config('app.locale'));

        /**
     * Set the session variable for whether or not the app is using RTL support
     * For use in the blade directive in BladeServiceProvider
     */
        if (config('locale.languages')[config('app.locale')][2]) {
            session([ 'lang-rtl' => true ]);
        } else {
            session()->forget('lang-rtl');
        }

        // Force SSL in production
        if ($this->app->environment() == 'production') {
            //URL::forceScheme('https');
        }
        //set the default string length for l5.4
        Schema::defaultStringLength(191);
    }


  /**
   * Register any application services.
   *
   * @return void
   */
    public function register()
    {
        /**
     * Sets third party service providers that are only needed on local environments
     */
        if ($this->app->environment() != 'production') {
            /**
             * Loader for registering facades.
             */
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();

            /*
             * Load third party local providers
             */
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);

            /*
             * Load third party local aliases
             */
            $loader->alias('Debugbar', \Barryvdh\Debugbar\Facade::class);

      $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
      $this->app->register(\Mpociot\LaravelTestFactoryHelper\TestFactoryHelperServiceProvider::class);
      $this->app->register(\Antennaio\Codeception\DbDumpServiceProvider::class);

    }
    $this->app->alias('bugsnag.multi', Log::class);
    $this->app->alias('bugsnag.multi', LoggerInterface::class);
    $this->app->bind('path.public',
        function () {
          return base_path() . '/web';
        });
  }
}