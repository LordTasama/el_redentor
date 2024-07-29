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
    <title>{{ config('app.name', 'Laravel') }} - No Autorizado</title>
    <!-- Fonts -->
    @vite(['resources/css/errors.css'])
</head>

<body class="cloak__wrapper">
    <h1>401</h1>
    <div>
        <div class="cloak__container">
            <div class="cloak"></div>
        </div>
    </div>
    <div class="info-error">
        <h2>No autorizado</h2>
        <p>
            Lo sentimos, no estás autorizado aún. Comunicate con un administrador para obtener el acceso</p>
    </div>
</body>

</html>