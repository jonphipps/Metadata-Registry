const { mix } = require('laravel-mix');
const WebpackRTLPlugin = require('webpack-rtl-plugin');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.setPublicPath('web/');
mix.sass('resources/assets/sass/frontend/app.scss', 'web/css/frontend.css')
    .sass('resources/assets/sass/backend/app.scss', 'web/css/backend.css')
    .js([
        'resources/assets/js/frontend/app.js',
        'resources/assets/js/plugin/sweetalert/sweetalert.min.js',
        'resources/assets/js/plugins.js'
    ], 'web/js/frontend.js')
    .js([
        'resources/assets/js/backend/app.js',
        'resources/assets/js/plugin/sweetalert/sweetalert.min.js',
        'resources/assets/js/plugins.js'
    ], 'web/js/backend.js')
    .webpackConfig({
        plugins: [
            new WebpackRTLPlugin('/css/[name].rtl.css')
        ]
    })
mix.copy('node_modules/smartwizard/dist/js/jquery.smartWizard.min.js', 'web/js/frontend/jquery.smartWizard.min.js');
mix.copy('node_modules/smartwizard/dist/css/smart_wizard.min.css', 'web/css/frontend/smart_wizard.css');
mix.copy('node_modules/smartwizard/dist/css/smart_wizard_theme_dots.min.css', 'web/css/frontend/smart_wizard_theme_dots.css');

if(mix.config.inProduction){
    mix.version();
}
/*
 | See https://browsersync.io/docs/options
*/
// mix.browsersync({
//     files: [
//         'app/**/*.php',
//         'resources/views/**/*.php',
//         'web/js/**/*.js',
//         'web/css/**/*.css'
//     ]
// });
