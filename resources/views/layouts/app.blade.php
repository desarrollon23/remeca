<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="../favicons/favicon.ico" />
  <title>{{ config('app.name', 'REMECA') }}</title> 
  <meta http-equiv="X-UA-Compatible" content="ie=edge"> {{--   <title>REMECA</title> --}}<!-- Fonts -->
  <link rel="stylesheet" href="{{asset('css/app.css')}}"> <!-- Font -->
  <link rel="stylesheet" href="http://filamentgroup.github.io/tablesaw/dist/tablesaw.css">
	<link rel="stylesheet" href="http://filamentgroup.github.io/tablesaw/demo/demo.css">
  <link rel="stylesheet" href="//filamentgroup.github.io/demo-head/demohead.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <style>
    .democolwidth {
      width: 150px;
    }
  </style>
    	<script src="http://filamentgroup.github.io/tablesaw/dist/tablesaw.js"></script>
      <script src="http://filamentgroup.github.io/tablesaw/dist/tablesaw-init.js"></script>
      <script src="//filamentgroup.github.io/demo-head/loadfont.js"></script>
  <!-- AQUÍ VA EL FAVICONS -->
  {{-- <link rel="shortcut icon" href="../favicons/favicon.ico" />
  <title>REMECA</title> --}}
  <!-- INICIO ESTILOS ADMINLTEMASTER-->
  <!-- Ionicons -->  {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <!-- Tempusdominus Bootstrap 4 -->    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
    <!-- iCheck -->    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
    <!-- JQVMap -->    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/jqvmap/jqvmap.min.css') }}"> --}}
    <!-- Theme style -->    {{-- <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}"> --}}
    <!-- overlayScrollbars -->    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> --}}
    <!-- Daterange picker -->    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}"> --}}
    <!-- summernote -->    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}"> --}}
  <!-- FIN ESTILOS ADMINLTEMASTER-->

  <!-- INICIO ESTILOS ADMINLTE -->
  <!-- Google Font: Source Sans Pro -->  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome Icons -->  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css')}}">
  <!-- FIN ESTILOS ADMINLTE -->
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link href="{{ asset('backend/plugins/toastr/toastr.min.css') }}" rel="stylesheet"/>
   <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ mix('css/app.css')}}">
  
  <script src="{{ mix('js/app.js') }}" defer></script>
  <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

<script language="javascript">
	function mascara(o,f){  
		v_obj=o;  
		v_fun=f;  
		setTimeout("execmascara()",1);  
	}  
	function execmascara(){   
		v_obj.value=v_fun(v_obj.value);
	}  
	function cpf(v){     
		v=v.replace(/([^0-9\.]+)/g,''); 
		/* v=v.replace(/^[\.]/,''); 
		v=v.replace(/[\.][\.]/g,''); 
		v=v.replace(/\.(\d)(\d)(\d)/g,'.$1$2'); 
		v=v.replace(/\.(\d{1,2})\./g,'.$1');  
		v = v.toString().split('').reverse().join('').replace(/(\d{3})/g,'$1,');    
		/* v = v.split('').reverse().join('').replace(/^[\,]/,'');  */
		return v;  
	}  
	/* function calcularjs(){
		var varMonto;
		var varIva;
		var varSubTotal;
		
		varMonto = document.getElementById("importe").value;	
		varMonto = varMonto.replace(/[\,]/g,''); 
		
		varIva = parseFloat(varMonto).toFixed(2) * 0.15;
		document.getElementById("iva").value = addCommas(parseFloat(varIva).toFixed(2)) ;
		
		varSubTotal = parseFloat(varMonto) + parseFloat(varIva);
		document.getElementById("subtotal").value = addCommas(parseFloat(varSubTotal).toFixed(2)) ;

	} */
	
	/* function addCommas(nStr){
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	} */
	
</script>

@livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed antialiased">
<div class="wrapper">
{{-- <body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100"> --}}

  <!-- Navbar -->
  {{-- @include('layouts.partials.navbar') --}}
  @livewire('navigation')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.partials.aside')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: white;">
    <main>
      {{ $slot }}
    </main>
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

<!-- INICIO SCRIPTS ADMINLTE -->
<!-- jQuery --><script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 --><script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App --><script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<!-- FIN SCRIPTS ADMINLTE -->

<!-- INICIO SCRIPTS ADMINLTEMASTER -->
<!-- jQuery -->{{-- <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script> --}}
<!-- jQuery UI 1.11.4 -->{{-- <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{-- <script>
  $.widget.bridge('uibutton', $.ui.button)
</script> --}}
<!-- Bootstrap 4 -->{{-- <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
<!-- ChartJS -->{{-- <script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script> --}}
<!-- Sparkline -->{{-- <script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script> --}}
<!-- JQVMap -->{{-- <script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
<!-- jQuery Knob Chart -->{{-- <script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}
<!-- daterangepicker -->{{-- <script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script> --}}
{{-- <script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
<!-- Tempusdominus Bootstrap 4 -->{{-- <script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
<!-- Summernote -->{{-- <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}
<!-- overlayScrollbars -->{{-- <script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
<!-- AdminLTE App -->{{-- <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script> --}}
<!-- AdminLTE for demo purposes -->{{-- <script src="{{ asset('backend/dist/js/demo.js') }}"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script> --}}
<!-- FIN SCRIPTS ADMINLTEMASTER -->

@stack('modals')

@livewireScripts

<script src="/livewire/livewire.js?id=d9e06c155e467adb5de2" data-turbo-eval="false" data-turbolinks-eval="false"></script>
{{-- Este SCRIPT que está comentado abajo genera el mensage de warnig --}}
{{-- <script data-turbo-eval="false" data-turbolinks-eval="false">
    if (window.livewire) {
        console.warn('Livewire: It looks like Livewire\'s @livewireScripts JavaScript assets have already been loaded. Make sure you aren\'t loading them twice.')
    }
    window.livewire = new Livewire();
    window.livewire.devTools(true);
    window.Livewire = window.livewire;
    window.livewire_app_url = '';
    window.livewire_token = 'MGixmdPgl2u9Ugt5dkVdUCSLo2kUw6U8TGmnRWCM';

    /* Make sure Livewire loads first. */
    if (window.Alpine) {
        /* Defer showing the warning so it doesn't get buried under downstream errors. */
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function() {
                console.warn("Livewire: It looks like AlpineJS has already been loaded. Make sure Livewire\'s scripts are loaded before Alpine.\n\n Reference docs for more info: http://laravel-livewire.com/docs/alpine-js")
            })
        });
    }

    /* Make Alpine wait until Livewire is finished rendering to do its thing. */
    window.deferLoadingAlpine = function (callback) {
        window.addEventListener('livewire:load', function () {
            callback();
        });
    };

    document.addEventListener("DOMContentLoaded", function () {
        window.livewire.start();
    });
</script> --}}
{{-- validar numeros --}}
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.0.2/cleave.min.js"></script>
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function (){
    $('body').on('keyup','.numeric', function(){
      new Cleave('.numeric', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
      });
    })
  })
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": ">",
            "previous": "<"
        },
    },
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<script>
  $(document).ready(function(){
    toastr.options = {
      "progressBar": true,
      "positionClass": "toast-bottom-right",
    }
    window.addEventListener('hide-form', event => {
      $('#form').modal('hide');
      toastr.success(event.detail.message, '¡Satisfactorio!');
    })

    //$this->dispatchBrowserEvent('hide-form', ['message' => 'Compra de Material Generada']);

    window.addEventListener('busnumalmacen', event => {
      Swal.fire({
        title: event.detail.message,
        showClass: {
          popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp'
        }
      });
    })

    window.addEventListener('confirmar', event => {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      });
    })

  });
</script>
<script>
  window.addEventListener('show-form', event => {
    $('#form').modal('show');
  })
  window.addEventListener('show-delete-modal', event => {
    $('#confirmationModal').modal('show');
  })
  window.addEventListener('hide-delete-modal', event => {
    $('#confirmationModal').modal('hide');
    toastr.success(event.detail.message, '¡Satisfactorio!');
  })
</script>
<script>$.widget.bridge('uibutton', $.ui.button)</script>

{{-- INICIO ACORDEON --}}
{{-- <script>
  var acc = document.getElementsByClassName("accordion");
  var i;
  
  for (i = 0; i < acc.length; i++) {
      acc[i].onclick = function(){
          this.classList.toggle("active");
          this.nextElementSibling.classList.toggle("show");
    }
  }
  
  var acd = document.getElementsByClassName("accordiond");
  var i;
  
  for (i = 0; i < acd.length; i++) {
      acd[i].onclick = function(){
          this.classList.toggle("active");
          this.nextElementSibling.classList.toggle("show");
    }
  }
  </script> --}}
  {{-- FIN ACORDEON --}}
@yield('js')
</body>
</html>
