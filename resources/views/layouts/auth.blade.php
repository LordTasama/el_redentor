@auth
<script>
window.location = "{{route('home')}}"
</script>
@endauth
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Control de una prisión(prisioneros, guardias, etc)">
    <meta name="author" content="Larzuck/LordTasama">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{Vite::asset('resources/media/images/logo.png')}}">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>


    <!-- Custom fonts for this template-->

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    @vite(['resources/sass/app.scss'])


</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div class="app">

        @yield('content')
    </div>
    <!-- Custom scripts for all pages-->
    @vite(['resources/js/app.js'])

</body>

</html>