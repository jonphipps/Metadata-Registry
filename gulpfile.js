const elixir = require('laravel-elixir');

require('laravel-elixir-codeception');
require('laravel-elixir-vue-2');

elixir.config.publicDir = 'web';

elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js');
});

//
// elixir(function(mix) {
//     mix.sass('app.scss');
// });
