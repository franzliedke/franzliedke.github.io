const mix = require('laravel-mix');
require('laravel-mix-jigsaw');

let bourbon = require('bourbon');
let neat = require('bourbon-neat');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build');

mix.jigsaw()
    .js('source/_assets/js/main.js', 'js')
    .sass('source/_assets/sass/main.scss', 'css', {
        sassOptions: {
            includePaths: [].concat(
                bourbon.includePaths,
                neat.includePaths
            )
        }
    })
    .options({
        processCssUrls: false,
    })
    .version();