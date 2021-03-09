const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/list.js', 'public/js');

mix.js('resources/src/js/main.js', 'public/dist/js')
    .sass('resources/src/scss/style.scss', 'public/dist/css');

mix.js('resources/leap/js/bootstrap/index.js', 'public/leap/js')
    .sass('resources/leap/scss/theme-mobile-app.scss', 'public/leap/css');
