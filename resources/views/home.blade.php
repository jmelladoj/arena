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
      <body class="pushmenu-push" style="background-image: url({{ asset('home/images/fondo.jpg') }});">
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
                <img id="logo" name="logo" src="{{ asset('home/images/logo.png') }}" class="logo logo-scrolled" alt="">
                </a>
              </div>
              <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOut">
                  <li><a href="#inicio">Inicio</a></li>
                  <li><a href="#inscripcion">Inscríbete</a></li>
                  <li><a href="{{ asset('bases.pdf') }}" target="__blank">Bases</a></li>
                  <li><a href="{{ url('/contacto') }}">Contácto</a></li>
                </ul>
              </div>
            </div>
            <div class="sidebar_menu">
                <nav class="pushmenu pushmenu-right">
                  <a class="push-logo" href="#"><img src="{{ asset('home/images/logo.png') }}" alt="logo"></a>
                  <ul class="push_nav centered">
                    <li><a href="#inicio"> Inicio</a></li>
                    <li><a href="#inscripcion"> Inscríbete</a></li>
                    <li><a href="{{ asset('bases.pdf') }}" target="__blank"> Bases</a></li>
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
      
        <!--Slider-->
        <section class="rev_slider_wrapper text-center" id="inicio">			
        <!-- START REVOLUTION SLIDER 5.0 auto mode -->
          <div id="rev_slider_video" class="rev_slider"  data-version="5.0">
            <ul>	
            <!-- SLIDE  -->
              <li data-transition="fade">
                <!-- MAIN IMAGE -->
                <!--<img src="images/fondo.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgparallax="10" class="rev-slidebg">	-->						
                        
                <!-- LAYER NR. 1 -->
                <div class="tp-caption tp-resizeme" 							
                data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                data-y="['80','50','0','-120']" data-voffset="['0','0','0','0']"						
                data-responsive_offset="on"
                data-auto_responsive="on"
                data-textAlign="['center','center','center','center']"
                data-type="text"
                data-visibility="['on','on','on','on']"
                data-transform_idle="o:1;"
                data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"							 
                data-start="800"><img src="{{ asset('home/images/logo-solo.png') }}" alt="" class="img-fluid">
                </div>
                
                <div class="tp-caption text-center" 							
                data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                data-y="['400','360','320','190']" data-voffset="['0','0','0','0']"							
                data-responsive_offset="on"
                data-auto_responsive="on"
                data-width="['auto', 'auto', 'auto', 'auto']"
                data-visibility="['on','on','on','on']"
                data-textAlign="['center','center','center','center']"
                data-transform_idle="o:1;"
                data-transform_in="y:[-200%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" 
                data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;" 
                data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
                data-mask_out="x:0;y:0;s:inherit;e:inherit;" 							 
                data-start="1500">
                <center style="padding: 0;"><a href="#inscripcion" class="border_radius btn_common blue">Inscripciones</a></center>
                </div>
              </li>
            </ul>				
          </div><!-- END REVOLUTION SLIDER -->
        </section>	
      
        <!--Paralax -->
        <section id="inscripcion" class="section" style="padding-top: 70px">
          <div class="container">
            <div class="row">
              <h1 style="font-weight: 600;" class="bottom25 whitecolor text-center">INSCRIPCIONES</h1>
              <div class="col-md-12 text-center wow bounceIn margin_top" id="app">    
                <home></home>
              </div>
            </div>
          </div>
        </section>
        <!--Paralax -->

        <!--Contact Deatils -->
        <section id="contacto">
          <div class="container" style="width: 100%; padding: 0; margin: 0;">
            <div class="row wow bounceIn" data-wow-delay="300ms">
              <div class="col-md-12" style="-webkit-filter: grayscale(100%); filter: grayscale(100%);">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3198.097790347796!2d-73.11099108520769!3d-36.7202125799651!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x96683575023181e1%3A0xe66acd3ddfd11308!2sColiseo+La+Tortuga!5e0!3m2!1ses!2scl!4v1552062384693" width="100%" height="700px" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </section>

        <div class="copyright">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center">
                <p class="text-center">Arena &copy; 2019. Todos los derechos reservados.</p>
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
