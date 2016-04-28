var gulp = require('gulp');
var elixir = require('laravel-elixir');

var bourbon = require('bourbon');
var neat = require('bourbon-neat');

elixir.config.assetsPath = 'source/_assets';
elixir.config.publicPath = 'source';

elixir(function(mix) {
    mix
        .sass('main.scss', 'source/css', {
            includePaths: bourbon.includePaths.concat(neat.includePaths)
        })
        .exec('vendor/bin/jigsaw build --pretty=false', ['./source/**/*', '!./source/_assets/**/*'])
        .browserSync({
            server: { baseDir: 'build_local' },
            proxy: null,
            files: [ 'build_local/**/*' ]
        });
});
