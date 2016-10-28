const elixir = require('laravel-elixir');

require('laravel-elixir-codeception');
require('laravel-elixir-vue-2');

elixir.config.publicPath = 'web';

elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js');
});

