<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Julawbook') }}</title>
    <!-- Julaw favicon -->
    <link rel="icon" href="{{asset('images/julaw.png')}}" type="image/x-icon" style="border-radius: 15px">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('interface/admin/plugins/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
  </head>
  <body class="font-sans antialiased bg-light">
    {{ $slot }}
  </body>
</html>
