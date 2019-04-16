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
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <li><a href="{{ url('/#inscripcion') }}">Inscríbete</a></li>
                <!--<li><a href="#">Bases</a></li>-->
                <li><a href="{{ url('/contacto') }}">Contácto</a></li>
            </ul>
        </div>
        </div>
        <div class="sidebar_menu">
            <nav class="pushmenu pushmenu-right">
            <a class="push-logo" href="#"><img src="{{ asset('home/images/logo.png') }}" alt="logo"></a>
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