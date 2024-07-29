<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{Vite::asset('resources/images/logo.png')}}" type="image/x-icon">
        <title>El Redentor</title>

        <!-- Fonts -->
        @vite(['resources/css/errors.css'])
    </head>
    <body class="cloak__wrapper">
    <h1>401</h1>
    <div >
  <div class="cloak__container">
    <div class="cloak"></div>
  </div>
</div>
<div class="info-error">
  <h2>Servicio no disponible</h2>
  <p>
  Lo sentimos, este servicio no está disponible en este momento... estamos haciendo todo lo posible por solucionarlo</p><a href="/" rel="noreferrer noopener">Volver al inicio</a>
</div>
    </body>
</html>
