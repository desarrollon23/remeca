<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'REMECA') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
          <!-- Google Font: Source Sans Pro -->
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
          <!-- Font Awesome --><link rel="stylesheet" href="../../../../adminltemaster/plugins/fontawesome-free/css/all.min.css">
          <!-- Ionicons --><link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
          <!-- Tempusdominus Bootstrap 4 --><link rel="stylesheet" href="../../../../adminltemaster/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
          <!-- iCheck --><link rel="stylesheet" href="../../../../adminltemaster/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
          <!-- JQVMap --><link rel="stylesheet" href="../../../../adminltemaster/plugins/jqvmap/jqvmap.min.css">
          <!-- Theme style --><link rel="stylesheet" href="../../../../adminltemaster/dist/css/adminlte.min.css">
          <!-- overlayScrollbars --><link rel="stylesheet" href="../../../../adminltemaster/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
          <!-- Daterange picker --><link rel="stylesheet" href="../../../../adminltemaster/plugins/daterangepicker/daterangepicker.css">
          <!-- summernote --><link rel="stylesheet" href="../../../../adminltemaster/plugins/summernote/summernote-bs4.min.css">
              </head>
    <body>
      <div>
        <!--div class="card-header"><h3 class="card-title">BIENVENIDO</h3></div-->
        <div class="content">
          <div class="container-fluid">
            <div class="row aling: center">
              <div class="col-lg-6 col-md-6 col-xs-4">
                <!--div class="card card-success"-->
                  <!--div class="card-header">
                    <h3 class="card-title"><label class="d-flex justify-content-center">FECHA: { { date('d-m-Y') } }   |   # DE CIERRE</label></h3>
                  </div>
                  <div-->
                    <div style="margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%);">
                      {{-- <label class="d-flex justify-content-center">BIENVENIDO al sistema REMECA</label> --}}
                      <img src="../../../../img/logov.png" class="center">
                    </div>
                  <!--/div>
                </div-->
              </div>
              <div class="col-lg-6 col-md-6 col-xs-4" style="background: #ad4d12;">
                <!--div class="card card-success">
                  <div class="card-header"-->
                    <!--h3 class="card-title"><label class="d-flex justify-content-center">FECHA: { { date('d-m-Y') } }   |   # DE CIERRE</label></h3>
                  </div-->
                  {{-- <div class="card-body">
                    <div> --}}
                        {{ $slot }}
                    {{-- </div>
                  </div> --}}
                <!--/div-->
              </div>
            </div>
          </div>
        </div>
      </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!--script src="vendor/backstretch/js/jquery.backstretch.min.js"></script>
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
  </script-->
          <!-- Google Font: Source Sans Pro -->
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
          <!-- Font Awesome --><link rel="stylesheet" href="../../../../adminltemaster/plugins/fontawesome-free/css/all.min.css">
          <!-- Ionicons --><link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
          <!-- Tempusdominus Bootstrap 4 --><link rel="stylesheet" href="../../../../adminltemaster/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
          <!-- iCheck --><link rel="stylesheet" href="../../../../adminltemaster/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
          <!-- JQVMap --><link rel="stylesheet" href="../../../../adminltemaster/plugins/jqvmap/jqvmap.min.css">
          <!-- Theme style --><link rel="stylesheet" href="../../../../adminltemaster/dist/css/adminlte.min.css">
          <!-- overlayScrollbars --><link rel="stylesheet" href="../../../../adminltemaster/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
          <!-- Daterange picker --><link rel="stylesheet" href="../../../../adminltemaster/plugins/daterangepicker/daterangepicker.css">
          <!-- summernote --><link rel="stylesheet" href="../../../../adminltemaster/plugins/summernote/summernote-bs4.min.css">
              </head>
</html>
