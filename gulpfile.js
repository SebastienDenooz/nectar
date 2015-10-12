var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
var bowerDir = './resources/assets/bower/';

elixir(function(mix) {
    mix.sass('app.scss');
    mix.styles([
        bowerDir + 'bootstrap/dist/css/bootstrap.min.css',
        bowerDir + 'font-awesome/css/font-awesome.min.css',
        bowerDir + 'selectize/dist/css/selectize.css',
        bowerDir + 'selectize/dist/css/selectize.bootstrap3.css'
    ]);
    mix.scripts([
        'jquery/dist/jquery.min.js',
        'selectize/dist/js/standalone/selectize.min.js',
        'bootstrap/dist/js/bootstrap.min.js'
    ], 'public/js/all.js', bowerDir);

});
