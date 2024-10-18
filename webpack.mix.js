const mix = require('laravel-mix');
require('laravel-mix-jigsaw');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build');

mix.jigsaw()
    .js('source/_assets/js/main.js', 'js')
    .js('source/_assets/js/receitas.js', 'js')
    .js('source/_assets/js/search.js', 'js')
    .css('source/_assets/css/main.css', 'css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .css('source/_assets/css/responsive.css', 'css')
    .css('source/_assets/css/reset.css', 'css')
    .options({
        processCssUrls: false,
    })
    .version();
