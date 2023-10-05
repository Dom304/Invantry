const mix = require('laravel-mix');
const { FALSE } = require('sass');

mix.js('resources/js/app.js', 'public/js')
   .vue({ version: 3 })
   .sass('resources/sass/app.scss', 'public/css');

   mix.webpackConfig({
    stats: {
        children: false,
    },
});