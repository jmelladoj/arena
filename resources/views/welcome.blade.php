<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}">
        

        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/home.js') }}"></script>
        <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js') }}"></script>
    </head>
    <body id="page-top">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top ml-auto pull-left" id="mainNav" name="mainNav">
            <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#">¿Qué es arena?</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#">Bases</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#">Contácto</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#" target="__blank"><span><i class="fa fa-facebook"></i></span></a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#" target="__blank"><span><i class="fa fa-instagram"></i></span></a></li>
                </ul>
            </div>
            </div>
        </nav>

        <div id="app">
            <header class="masthead">
                <div class="container h-100">
                    <div class="row h-100">
                        <div class="col-lg-6 my-auto">
                            <img src="img/logo-arena.png" class="img-fluid bottom" alt="">
                        </div>
                        <div class="col-lg-6 my-auto">
                            <div class="header-content mx-auto">
                                <h4 class="text-left">CATEGORÍAS</h4>
                                <button class="btn btn-outline btn-xl btn-block js-scroll-trigger text-right">SCALED</button>
                                <button class="btn btn-outline btn-xl btn-block js-scroll-trigger text-right">RX</button>
                                <button class="btn btn-outline btn-xl btn-block js-scroll-trigger text-right">MASTER +35</button>
                                <button class="btn btn-outline btn-xl btn-block js-scroll-trigger text-right">DUPLAS BÁSICO</button>
                                <button class="btn btn-outline btn-xl btn-block js-scroll-trigger text-right">TRIOS SCALED</button>
                                <button class="btn btn-outline btn-xl btn-block js-scroll-trigger text-right">TRIOS RX</button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>    
    </body>
</html>
