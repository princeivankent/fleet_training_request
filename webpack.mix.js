let mix = require('laravel-mix');

mix.setResourceRoot('/fleet_training_request/public/')
.js('resources/assets/js/admin.js', 'public/js/admin.js')
.js('resources/assets/js/client.js', 'public/js/client.js')
.js('resources/src/main.js', 'public/js/app.js')
.browserSync('http://localhost/fleet_training_request/')
.disableNotifications();

Mix.listen('configReady', (webpackConfig) => {
  if (Mix.isUsing('hmr')) {
    // Remove leading '/' from entry keys
    webpackConfig.entry = Object.keys(webpackConfig.entry).reduce((entries, entry) => {
      entries[entry.replace(/^\//, '')] = webpackConfig.entry[entry];
      return entries;
    }, {});

    // Remove leading '/' from ExtractTextPlugin instances
    webpackConfig.plugins.forEach((plugin) => {
      if (plugin.constructor.name === 'ExtractTextPlugin') {
        plugin.filename = plugin.filename.replace(/^\//, '');
      }
    });
  }
});