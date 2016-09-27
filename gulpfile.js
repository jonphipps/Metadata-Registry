const elixir = require('laravel-elixir');

require('laravel-elixir-codeception');
require('laravel-elixir-vue');

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js')
       .codeception(null, {testSuite: 'functional'});
});

//
// elixir(function(mix) {
//     mix.sass('app.scss');
// });
