let mix = require('laravel-mix');
//let bs = require('bootstrap-loader');
let WebpackRTLPlugin = require('webpack-rtl-plugin');

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
mix.sass('resources/assets/sass/frontend/app.scss', 'css/frontend.css')
  .sass('resources/assets/sass/backend/app.scss', 'css/backend.css')
  .combine(['web/vendor/adminlte/bootstrap/css/bootstrap.min.css',
    'web/vendor/adminlte/dist/css/AdminLTE.min.css',
    'web/vendor/adminlte/dist/css/skins/skin-blue.min.css',
    'web/vendor/adminlte/plugins/pace/pace.min.css',
    'web/vendor/backpack/pnotify/pnotify.custom.min.css',
    'web/vendor/backpack/backpack.base.css'
  ], 'web/css/all.css')
  .js([
    'resources/assets/js/frontend/app.js',
    'resources/assets/js/plugin/sweetalert/sweetalert.min.js',
    'resources/assets/js/plugins.js'
  ], 'js/frontend.js')
  .js([
    'resources/assets/js/backend/app.js',
    'resources/assets/js/plugin/sweetalert/sweetalert.min.js',
    'web/vendor/adminlte/plugins/pace/pace.min.js',
    'web/vendor/adminlte/plugins/slimScroll/jquery.slimscroll.min.js',
    'web/vendor/adminlte/plugins/fastclick/fastclick.js',
    'web/vendor/adminlte/dist/js/app.min.js',
    'resources/assets/js/plugins.js'
  ], 'js/backend.js')
  .webpackConfig({
    plugins: [
      new WebpackRTLPlugin('/css/[name].rtl.css')
    ]
  });

  mix.js('resources/assets/js/app.js', 'web/js')
  .extract(['vue', 'axios', 'jquery', 'lodash']);
mix.copy('node_modules/jqwidgets-framework/jqwidgets', 'vendor/jqwidgets');

if(mix.inProduction){
  mix.version();
}
mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
  purifyCss: true // Remove unused CSS selectors.
//   uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
});
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

// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.standaloneSass('src', output); <-- Faster, but isolated from Webpack.
// mix.less(src, output);
// mix.stylus(src, output);
// mix.browserSync('my-site.dev');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.

