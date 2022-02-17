const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/Control.OSMGeocoder.js', 'public/js')
    .js('resources/js/toppage.js', 'public/js')
    .js('resources/js/showSelectedPlan.js', 'public/js')
    .js('resources/js/addPlanDetailByClick.js', 'public/js')
    .js('resources/js/adminPwCheck.js', 'public/js')
    .js('resources/js/calendar.js', 'public/js')
    .js('resources/js/planEdit.js', 'public/js')
    .js('resources/js/header.js', 'public/js')
    .js('resources/js/sharedPlan.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

if (mix.inProduction()) {
    mix.version();
}
