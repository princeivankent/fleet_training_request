let mix = require('laravel-mix');

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
mix.setResourceRoot('/laravel5.2/public/');
mix.js('resources/assets/js/admin.js', 'public/js/admin.js').sourceMaps().version();
mix.js('resources/assets/js/client.js', 'public/js/client.js').sourceMaps().version();

/**
 * mix.copy('node_modules/material-design-icons-iconfont/dist/material-design-icons.css', 'public/css/material-design-icons.css').sourceMaps();
 * mix.copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/css/font-awesome.css').sourceMaps();
 * 
 */

/**
 * mix.browserSync('e-learning');
 * mix.disableNotifications();
 */
