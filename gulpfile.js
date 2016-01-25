var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.browserify(['app.js'], 'public/js/app.js');

    mix.styles(['app.css', 'bootstrap-3.3.6/css/bootstrap.min.css'], 'public/css/app.css');

    mix.scripts([
        'plugins/jquery-1.12.0.min.js',
        'plugins/bootstrap.min.js',
    ], 'public/js/site.js');

    mix.scripts([
        'plugins/jquery-1.12.0.min.js',
        'plugins/bootstrap.min.js',
        'plugins/parsley.min.js'
    ], 'public/js/plugins.js');

    mix.version([
        'css/app.css',
        'js/site.js',
        'js/app.js',
        'js/plugins.js'
    ]);
});