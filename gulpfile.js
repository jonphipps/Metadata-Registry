var elixir = require('laravel-elixir');

require('laravel-elixir-codeception');

elixir(function (mix) {
    mix.codeception(null, {testSuite: 'functional'});
});

//
// elixir(function(mix) {
//     mix.sass('app.scss');
// });
