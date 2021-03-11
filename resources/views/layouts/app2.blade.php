<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">        
        <title>{{ config('app.name', 'REMECA') }}</title> 
        <meta http-equiv="X-UA-Compatible" content="ie=edge"> {{--   <title>REMECA</title> --}}<!-- Fonts -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}"> <!-- Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        @livewireStyles
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
<body class="bg-gray-200 pt-4">
  {{$slot}}
  @livewireScripts
</body>
</html>



<!-- ESTA ES LA BUENA  -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">        
        <title>{{ config('app.name', 'REMECA') }}</title>

  <meta http-equiv="X-UA-Compatible" content="ie=edge"> {{--   <title>REMECA</title> --}}<!-- Fonts -->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('adminltemaster/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminltemaster/dist/css/adminlte.min.css') }}">
  {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <!-- Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.partials.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.partials.aside')
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    {{-- {{$slot}} --}}
    @yield('content')
    </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('layouts.partials.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('adminltemaster/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminltemaster/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminltemaster/dist/js/adminlte.min.js') }}"></script>
@stack('modals')
@livewireScripts
</body>
</html>