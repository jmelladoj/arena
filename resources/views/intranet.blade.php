<!DOCTYPE html>
<html lang="en">

<head>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Arena - Admin')</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('public_intranet/css/estilos_intranet.css') }}" rel="stylesheet">

        <link rel="shortcut icon" href="{{ asset('public_intranet/images/logo-icon.png') }}">
    </head>
</head>
<body class="skin-blue fixed-layout">
    <div id="app">
        <div id="main-wrapper">

            @include('plantilla/header')
            @include('plantilla/sidebar')
            
            @yield('content')
 
            <footer class="footer">
                Arena © 2018. Todos los derechos reservados.
            </footer>

        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('public_intranet/js/plugins_intranet.js') }}"></script>
</body>

</html>