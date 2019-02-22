let mix = require('laravel-mix');

mix.setResourceRoot('/fleet_training_request/public/');

mix.js('resources/assets/js/admin.js', 'public/js/admin.js')
.js('resources/assets/js/client.js', 'public/js/client.js')
.js('resources/src/main.js', 'public/js/main.js')
.sourceMaps()
.version()
.browserSync({
  proxy: 'http://localhost/fleet_training_request/'
})
.disableNotifications();

/**
 * mix.copy('node_modules/material-design-icons-iconfont/dist/material-design-icons.css', 'public/css/material-design-icons.css').sourceMaps();
 * mix.copy('node_modules/@fortawesome/fontawesome-free/css/all.min.css', 'public/css/font-awesome.css').sourceMaps();
 */