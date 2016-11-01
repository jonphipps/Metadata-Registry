const elixir = require('laravel-elixir');

require('laravel-elixir-codeception');
require('laravel-elixir-vue-2');
require('./elixir-extensions');
elixir.config.publicPath = 'web';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    /**
     * Copy needed files from /node directories
     * to /public directory.
     */
    mix.copy(
        'node_modules/font-awesome/fonts',
        'web/build/fonts/font-awesome'
    )
    .copy(
        'node_modules/bootstrap-sass/assets/fonts/bootstrap',
        'web/build/fonts/bootstrap'
    )

    /**
     * Process frontend SCSS stylesheets
     */
    .sass([
        'frontend/app.scss',
        'plugin/sweetalert/sweetalert.scss'
    ], 'resources/assets/css/frontend/app.css')
    /**
     * Combine pre-processed frontend CSS files
     */
    .styles([
        'frontend/app.css'
    ], 'web/css/frontend.css')
    /**
     * Pack it up
     * Saves to a dist folder in resources, it is then combined and placed in public
     */
    .webpack('frontend/app.js', './resources/assets/js/dist/frontend.js')
    /**
     * Combine frontend scripts
     */
    .scripts([
        'dist/frontend.js',
        'plugin/sweetalert/sweetalert.min.js',
        'plugins.js'
    ], 'web/js/frontend.js')
    /**
     * Process backend SCSS stylesheets
     */
    .sass([
        'backend/app.scss',
        'plugin/toastr/toastr.scss',
        'plugin/sweetalert/sweetalert.scss'
    ], 'resources/assets/css/backend/app.css')
    /**
     * Combine pre-processed backend CSS files
     */
    .styles([
        'backend/app.css'
    ], 'web/css/backend.css')
    /**
     * Pack it up
     * Saves to a dist folder in resources, it is then combined and placed in public
     */
    .webpack('backend/app.js', './resources/assets/js/dist/backend.js')
    /**
     * Make RTL (Right To Left) CSS stylesheet for the backend
     */
    .rtlCss()
    /**
     * Combine backend scripts
     */
    .scripts([
        'dist/backend.js',
        'plugin/sweetalert/sweetalert.min.js',
        'plugin/toastr/toastr.min.js',
        'plugins.js',
        'backend/custom.js'
    ], 'web/js/backend.js')
    /**
     * Combine pre-processed rtl CSS files
     */
    .styles([
        'rtl/bootstrap-rtl.css'
    ], 'web/css/rtl.css')
    /**
     * Apply version control
     */
    .version([
        "web/css/frontend.css",
        "web/js/frontend.js",
        "web/css/backend.css",
        "web/css/backend-rtl.css",
        "web/js/backend.js",
        "web/css/rtl.css"
    ]);
    /**
     * Run tests
     */
    //.phpUnit();
});

