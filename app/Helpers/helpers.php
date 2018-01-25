<?php

if (! function_exists('laravel_link_to')) {
    /**
     * Generate a HTML link.
     *
     * @param string $url
     * @param string $title
     * @param array  $attributes
     * @param bool   $secure
     * @param bool   $escape
     *
     * @return string
     */
    function laravel_link_to($url, $title = null, $attributes = [], $secure = null, $escape = true)
    {
        return app('html')->link($url, $title, $attributes, $secure, $escape);
    }
}

if (! function_exists('laravel_link_to_asset')) {
    /**
     * Generate a HTML link to an asset.
     *
     * @param string $url
     * @param string $title
     * @param array  $attributes
     * @param bool   $secure
     *
     * @return string
     */
    function laravel_link_to_asset($url, $title = null, $attributes = [], $secure = null)
    {
        return app('html')->linkAsset($url, $title, $attributes, $secure);
    }
}

if (! function_exists('laravel_link_to_route')) {
    /**
     * Generate a HTML link to a named route.
     *
     * @param string $name
     * @param string $title
     * @param array  $parameters
     * @param array  $attributes
     *
     * @return string
     */
    function laravel_link_to_route($name, $title = null, $parameters = [], $attributes = [])
    {
        return app('html')->linkRoute($name, $title, $parameters, $attributes);
    }
}

if (! function_exists('laravel_link_to_action')) {
    /**
     * Generate a HTML link to a controller action.
     *
     * @param string $action
     * @param string $title
     * @param array  $parameters
     * @param array  $attributes
     *
     * @return string
     */
    function laravel_link_to_action($action, $title = null, $parameters = [], $attributes = [])
    {
        return app('html')->linkAction($action, $title, $parameters, $attributes);
    }

    if (! function_exists('tinker')) {
        function tinker()
        {
            eval(\Psy\sh());
        }
    }

    if (! function_exists('getLanguageListFromSymfony')) {
        /**
         * @param string $culture
         *
         * @return array
         */
        function getLanguageListFromSymfony($culture = 'en')
        {
            //we should get the culture to get the correct file, but default to English
            $c       = unserialize(file_get_contents(base_path("/data/symfony/i18n/{$culture}.dat")), [true]);
            $options = [];

            foreach ($c['Languages'] as $key => $value) {
                $options[$key] = $value[0];
            }

            return $options;
        }
    }

    if (! function_exists('initSymfonyEnv')) {
        /**
         * @return void
         */
        function initSymfonyEnv()
        {
            if (! defined('SF_APP')) {
                define('SF_APP', 'frontend');
                define('SF_ENVIRONMENT', env('SF_ENVIRONMENT', 'prod'));
                define('SF_DEBUG', env('SF_DEBUG', 'false'));
            }
            if (! defined('SF_ROOT_DIR')) {
                define('SF_ROOT_DIR', env('SF_ROOT_DIR', base_path()));
            }
        }
    }
    if (! function_exists('getSymfonyApp')) {
        /**
         * @return sfContext
         */
        function getSymfonyApp()
        {
            initSymfonyEnv();

            /** @noinspection PhpIncludeInspection */
            require_once app()->basePath('apps/frontend/config/config.php');

            //make sure we have a fresh instance since it's never an internal symfony forward
            if (sfContext::hasInstance()) {
                sfContext::removeInstance();
            }

            return sfContext::getInstance();
        }
    }
    if (! function_exists('initSymfonyDb')) {
        function initSymfonyDb()
        {
            initSymfonyEnv();

            /** @noinspection PhpIncludeInspection */
            require_once app()->basePath('apps/frontend/config/config.php');

            // initialize database manager
            $databaseManager = new \sfDatabaseManager();
            $databaseManager->initialize();
        }
    }
}
