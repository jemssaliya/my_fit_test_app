let mix = require('laravel-mix');

// mix.setPublicPath('public/');

mix.js('resources/js/app.js', 'public/js/dist')
    .js('resources/js/dashboard.js', 'public/js/dist')
    .js('resources/js/vueapp.js', 'public/js/dist')
    .sass('resources/sass/home.scss', 'public/css/dist/public.css')
    .sass('resources/sass/dashboard.scss', 'public/css/dist/dashboard.css')
    .sass('resources/sass/auth.scss', 'public/css/dist/auth.css')
    .vue()
    .version()
    .sourceMaps();

mix.browserSync({ proxy: 'localhost:8000' });

mix.webpackConfig({
  resolve: {
    extensions: ['.wasm', '.mjs', '.js', '.jsx', '.json', '.vue']
  }
});
