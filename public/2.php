<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="vendor/backstretch/js/jquery.backstretch.min.js"></script>
  <script>
    $(document).ready(function(e){
      $.backstretch([
        "img/fnd/f1.jpeg",
        "img/fnd/f2.jpg",
        "img/fnd/f3.jpg",
        "img/fnd/f4.jpg",
        "img/fnd/f5.jpg",
        "img/fnd/f6.jpg"
      ],{
        fade:750,
        duration:10000
      });
    });
  </script>
    </body>
</html>
