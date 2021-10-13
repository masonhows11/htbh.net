const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | files for the application as well as bundling up all the JS files.
 |
 */
let productionSourceMaps = false;

mix.js('resources/js/app.js', 'public/js')
    .sourceMaps(productionSourceMaps, 'source-map')
    .css('resources/css/app_style.css','public/css')
   .sass('resources/sass/app.scss','public/css')
    .postCss('resources/css/app.css', 'public/css',[
        require('tailwindcss'),])
    .copy('node_modules/@fortawesome/fontawesome-free/webfonts','public/webfonts');
