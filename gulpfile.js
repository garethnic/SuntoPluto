var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.browserify(['app.js'], 'public/js/app.js');

    mix.styles('app.css', 'public/css');

    mix.version('css/app.css');
});