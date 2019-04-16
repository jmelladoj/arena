<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Arena - Finalizar Inscripción')</title>
        
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}">
        <link rel="shortcut icon" href="{{ asset('home/images/favicon.png') }}">
    </head>
      <body class="pushmenu-push" style="background-image: url({{ asset('home/images/fondo.jpg') }});">
        <a href="#" class="scrollToTop"><i class="fa fa-angle-up"></i></a>
        
        @include('plantilla.header-home')
      
        <!--Paralax -->
        <section id="inscripcion" class="section" style="padding-top: 150px">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center wow bounceIn margin_top" id="app">    
                  <h1 style="font-weight: 600;" class="top50 whitecolor text-center">{{ $titulo }}</h1>
                  <br><br>
                  <h3 style="font-weight: 600;" class="top50 whitecolor text-center"> 
                    {!! $texto !!}
                  </h3>
                  <ul class="social_icon black top25 bottom20">
                    <li><a href="https://www.facebook.com/Torneo-Arena-326242074680970/" class="facebook" target="__blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/torneoarena/" class="instagram" target="__blank"><i class="fa fa-instagram"></i></a></li>
                  </ul>
                  <center style="padding: 0;"><a href="{{ url('/')}}" class="border_radius btn_common blue">Ir a inicio</a></center>
              </div>
            </div>
          </div>
        </section>
        <!--Paralax -->

        <div class="copyright">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <p class="text-center" style="color: #fff">Arena &copy; 2019. Todos los derechos reservados.</p>
              </div>
            </div>
          </div>
        </div>
        <!--FOOTER ends-->

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/home.js') }}"></script>
        <script src="{{ url('http://maps.google.com/maps/api/js?key=AIzaSyAOBKD6V47-g_3opmidcmFapb3kSNAR70U') }}"></script>
    </body>
</html>
