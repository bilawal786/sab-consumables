const mix = require('laravel-mix');
mix.webpackConfig({
    stats: {
        children: true,
    },
});
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

mix.js('resources/js/app.js', 'public/js').vue()
    .js('resources/js/distribution.js', 'public/js').vue()
    .js('resources/js/damages.js', 'public/js').vue()
    .js('resources/js/stock.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css')
    // .sass('resources/sass/main.scss', 'public/css')
    .sass('resources/sass/color_skins.scss', 'public/css');
