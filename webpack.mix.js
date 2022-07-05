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

mix.disableNotifications();
mix.webpackConfig({
    stats: {
        children: true,
    }
});

mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/efecto.js', 'public/js')
mix.js('resources/js/select.js', 'public/js')
mix.js('resources/js/login.js', 'public/js')
mix.js('resources/js/addToCart.js', 'public/js')
mix.js('resources/js/cart.js', 'public/js')
.css('resources/css/style.css', 'public/css')
.css('resources/css/main.css', 'public/css')
.css('resources/css/grid_vista.css', 'public/css')
.css('resources/css/cart.css', 'public/css')
.css('resources/css/login.css', 'public/css');
