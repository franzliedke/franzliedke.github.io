let mix = require('laravel-mix');
let build = require('./tasks/build.js');

let bourbon = require('bourbon');
let neat = require('bourbon-neat');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build');
mix.webpackConfig({
    plugins: [
        build.jigsaw,
        build.browserSync(),
        build.watch(['source/**/*.md', 'source/**/*.php', 'source/**/*.scss', '!source/**/_tmp/*']),
    ]
});

mix.js('source/_assets/js/main.js', 'js')
    .sass('source/_assets/sass/main.scss', 'css', {
        includePaths: [].concat(
          bourbon.includePaths,
          neat.includePaths
        )
    })
    .options({
        processCssUrls: false,
    }).version();
