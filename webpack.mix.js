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

// Admin
mix.js('resources/assets/js/admin/app.js', 'public/js/admin.js')
   .sass('resources/assets/sass/admin/app.scss', 'public/css/admin.css');

// Platform
mix.js('resources/assets/js/platform/app.js', 'public/js/platform.js')
   .copyDirectory('resources/assets/images', 'public/images')
   .copy('resources/assets/images/favicon.png', 'public/images/favicon.png')
   .sass('resources/assets/sass/platform/app.scss', 'public/css/platform.css');