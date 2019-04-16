const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.styles([
   'public/home/css/bootstrap.min.css',
   'public/home/css/font-awesome.min.css',
   'public/home/css/Xwin-icons.css',
   'public/home/css/animate.min.css',
   'public/home/css/owl.carousel.css',
   'public/home/css/owl.transitions.css',
   'public/home/css/cubeportfolio.min.css',
   'public/home/css/settings.css',
   'public/home/css/bootsnav.css',
   'public/home/css/style.css'
], 'public/css/home.css'),
mix.scripts([
   'public/home/js/jquery-2.2.3.js',
   'public/home/js/bootstrap.min.js',
   'public/home/js/bootsnav.js',
   'public/home/js/jquery.appear.js',
   'public/home/js/jquery-countTo.js',
   'public/home/js/jquery.parallax-1.1.3.js',
   'public/home/js/owl.carousel.min.js',
   'public/home/js/jquery.cubeportfolio.min.js',
   'public/home/js/jquery.matchHeight-min.js',
   'public/home/js/jquery.themepunch.tools.min.js',
   'public/home/js/jquery.themepunch.revolution.min.js',
   'public/home/js/revolution.extension.layeranimation.min.js',
   'public/home/js/revolution.extension.navigation.min.js',
   'public/home/js/revolution.extension.parallax.min.js',
   'public/home/js/revolution.extension.slideanims.min.js',
   'public/home/js/revolution.extension.video.min.js',
   'public/home/js/wow.min.js',
   'public/home/js/functions.js',
   'public/home/js/gmaps.min.js',
   'public/home/js/jquery.rut.js'
], 'public/js/home.js');

mix.styles([
   'public/public_intranet/css/pages/login-register-lock.css',
   'public/public_intranet/css/style.css'
], 'public/css/login.css'),
mix.scripts([
   'public/public_intranet/node_modules/popper/popper.min.js'
], 'public/js/login.js');

mix.styles([
   'public/public_intranet/node_modules/morrisjs/morris.css',
   'public/public_intranet/css/style.min.css',
   'public/public_intranet/css/pages/dashboard1.css',
   'public/public_intranet/css/pages/floating-label.css'
], 'public/public_intranet/css/estilos_intranet.css')
.scripts([
   'public/public_intranet/node_modules/popper/popper.min.js',
   'public/public_intranet/js/perfect-scrollbar.jquery.min.js',
   'public/public_intranet/js/waves.js',
   'public/public_intranet/js/sidebarmenu.js',
   'public/public_intranet/js/custom.min.js',
   'public/public_intranet/node_modules/jquery-sparkline/jquery.sparkline.min.js',
   'public/public_intranet/node_modules/raphael/raphael-min.js',
   'public/public_intranet/node_modules/morrisjs/morris.min.js',
   'public/public_intranet/js/dashboard1.js',
   'public/public_intranet/js/sweetalert2.all.js'
], 'public/public_intranet/js/plugins_intranet.js');
