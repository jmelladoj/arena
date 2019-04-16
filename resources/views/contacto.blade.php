<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Arena - Inicio')</title>
        
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}">
        <link rel="shortcut icon" href="{{ asset('home/images/favicon.png') }}">
    </head>
    <body style="background-image: url({{ asset('home/images/fondo.jpg') }});">
        <a href="#" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
        
        
        <!--Header-->
        <header>
            <nav class="navbar navbar-default navbar-fixed white no-background bootsnav pushy">
            <div class="container"> 
                <div id="menu_bars" class="right">
                <span class="t1"></span>
                <span class="t2"></span>
                <span class="t3"></span>
                </div>
                <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <img src="images/logo.png" class="logo logo-scrolled" alt="">
                </a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOut">
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ url('/#inscripcion') }}">Inscríbete</a></li>
                    <!--<li><a href="#">Bases</a></li>-->
                    <li><a href="{{ url('/contacto') }}">Contácto</a></li>
                </ul>
                </div>
            </div>
            <div class="sidebar_menu">
                <nav class="pushmenu pushmenu-right">
                    <a class="push-logo" href="#"><img src="images/logo.png" alt="logo"></a>
                    <ul class="push_nav centered">
                    <li><a href="{{ url('/') }}"> Inicio</a></li>
                    <li><a href="{{ url('/#inscripcion') }}"> Inscríbete</a></li>
                    <!--<li><a href="#"> Bases</a></li>-->
                    <li><a href="{{ url('/contacto') }}"> Contácto</a></li>
                    </ul>
                    <div class="clearfix"></div>
                    <ul class="social_icon black top25 bottom20">
                    <li><a href="https://www.facebook.com/Torneo-Arena-326242074680970/" class="facebook" target="__blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/torneoarena/" class="instagram" target="__blank"><i class="fa fa-instagram"></i></a></li>
                </ul>
                </nav>
                </div>   
            </nav>
        </header>
        
        <!--Contact Deatils -->
        <section id="contact" class="padding">
            <div class="container" id="app">
                <div class="row padding-bottom">
                    <h1 style="font-weight: 600;" class="bottom25 whitecolor text-center">CONTÁCTO</h1>
                    <div class="col-md-12 wow fadeInRight">
                    <form class="form-inline findus" id="contact-form" onSubmit="return false">
                        <div class="row">
                        <div class="col-md-12">
                            <div id="result"></div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nombre"  name="name" id="name" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <textarea placeholder="Escríbenos aquí ..."  name="message" id="message"></textarea>
                            <button class="btn-block btn_common btn-success border_radius" id="btn_submit">Enviar</button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="row wow bounceIn" style="width: 100%; padding: 0; margin: 0;">
                    <div class="col-md-12" style="-webkit-filter: grayscale(100%); filter: grayscale(100%);">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3198.097790347796!2d-73.11099108520769!3d-36.7202125799651!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x96683575023181e1%3A0xe66acd3ddfd11308!2sColiseo+La+Tortuga!5e0!3m2!1ses!2scl!4v1552062384693" width="100%" height="500px" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
         </section>
      <!--Contact Deatils -->
      
      
      
      <!--Footer-->
      <div class="copyright">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <p class="text-center" style="color: white;">Arena &copy; 2019. Todos los derechos reservados.</p>
            </div>
          </div>
        </div>
      </div>
      <!--FOOTER ends-->

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/home.js') }}"></script>
        <script src="{{ url('http://maps.google.com/maps/api/js?key=AIzaSyAOBKD6V47-g_3opmidcmFapb3kSNAR70U') }}"></script>
            
</html>
