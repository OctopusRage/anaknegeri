const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/scss/app.scss', 'public/css/')
  .copy('resources/assets/css/bootstrap-datepicker.standalone.min.css', 'public/css/bootstrap-datepicker.min.css')
  .copy('resources/assets/css/dataTables.bootstrap4.min.css', 'public/css/dataTables.bootstrap4.min.css')
  .copy('node_modules/chart.js/dist/Chart.min.js', 'public/js/Chart.min.js')
  .copy('resources/assets/js/bootstrap-datepicker.min.js', 'public/js/bootstrap-datepicker.min.js')
  .copy('resources/assets/js/jquery.dataTables.min.js', 'public/js/jquery.dataTables.min.js')
  .copy('resources/assets/js/dataTables.bootstrap4.min.js', 'public/js/dataTables.bootstrap4.min.js')
  .copyDirectory('node_modules/tinymce', 'public/tinymce')
  .copyDirectory('node_modules/tinymce', 'public/tinymce')
  .copyDirectory('resources/assets/img', 'public/img')
  .copyDirectory('resources/assets/filemanager', 'public/tinymce/filemanager')
  .version();
