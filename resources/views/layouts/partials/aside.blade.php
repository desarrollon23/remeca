@php
  /* para fondo verde */
  /* $fondoc='style="background: #c3d69b;"';
  $fondoo='style="background: #3f7819;"'; */

  /* para fondo naranja */
  /*   $fondoo='style="background: #ad4d12;"'; */
  /* $fondoc='style="background: #eb8647;"'; */

  /* para fondo azul */
  /* $fondoc='style="background: #6699cc;"'; */
  $fondoo='style="background: #336699;"';
  
 /*  $texto='style="color: white;"';
  $textom='style="color: white; hover-opacity-6; font-weight: bold;"';
  $textos='style="color: white; hover-opacity-6;"'; */

  /* para fondo blanco */
  $fondoc='style="background: white;"';
  $texto='style="color: white;"';
  $textom='style="color: black; font-weight: bold;"';
  $textos='style="color: black;"';
@endphp
<!--aside class="main-sidebar sidebar-dark-primary elevation-4" -->
  <aside class="main-sidebar elevation-4" @php echo $fondoo; @endphp>
  <!-- LOGO -->
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="REMECA" class="brand-image img-circle elevation-3" style="opacity: .8">
    <!--span class="brand-text font-weight-light">REMECA</span-->
    <span class="brand-text" @php echo $texto; @endphp>REMECA</span>
  </a>
  <div class="sidebar" @php echo $fondoc; @endphp>
    <!-- PANEL DEL USUARIO -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('img/pkc16x16.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block" @php echo $textom; @endphp>{{ Auth::user()->name }}</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <x-jet-dropdown-link href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                          this.closest('form').submit();">
              {{ __('Salir') }}
          </x-jet-dropdown-link>
        </form>
      </div>
    </div>
    <!-- MENU GENERAL -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        {{-- <li class="nav-item">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i><p>TABLERO</p>
          </a>
        </li> --}}{{-- PRESIDENCIA --}}
        <li class="nav-item">
          <!--a href="#" class="nav-link active"-->
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt hover-opacity-6"></i>
            <p @php echo $textom; @endphp>PRESIDENCIA<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i><p class="hover-color " @php echo $textos; @endphp>Administración</p></a>
              </li><li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i><p class="hover-color " @php echo $textos; @endphp>Logística</p></a>
              </li><li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i><p class="hover-color " @php echo $textos; @endphp>Almacen</p></a>
            </li></ul>
        </li>{{-- AUDITORIA --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p @php echo $textom; @endphp>FINANZAS<i class="fas fa-angle-left right"></i></p></a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i><p @php echo $textos; @endphp>Administración</p></a>
            </li><li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i><p @php echo $textos; @endphp>Logística</p></a>
            </li><li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i><p @php echo $textos; @endphp>Almacen</p></a>
          </li></ul>
        </li>{{-- LOGÍSTICA --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i><p @php echo $textom; @endphp>LOGISTICA<i class="fas fa-angle-left right"></i></p>
          </a><ul class="nav nav-treeview">
            <li class="nav-item"><a href="{{ route('admin.users') }}" class="nav-link request()->is('admin/users') ? 'active' : '' "><i class="far fa-circle nav-icon"></i>
            <p @php echo $textom; @endphp>Operaciones</p></a>
            <li class="nav-item"><a href="{{ route('admin.users') }}" class="nav-link request()->is('admin/users') ? 'active' : '' "><i class="far fa-circle nav-icon"></i>
              <p @php echo $textom; @endphp>Transporte</p></a>
          </li></ul>
        </li>{{-- ADMINISTRACION --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i><p @php echo $textom; @endphp>ADMINISTRACION<i class="fas fa-angle-left right"></i></p>
          </a><ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link request()->is('admin/users') ? 'active' : '' ">
                <i class="far fa-circle nav-icon"></i><p @php echo $textos; @endphp>Compras</p></a>
            </li><li class="nav-item">
              <a href="#" class="nav-link request()->is('admin/users') ? 'active' : '' ">
                <i class="far fa-circle nav-icon"></i><p @php echo $textos; @endphp>Ventas</p></a>
          </li></ul>
        </li>{{-- ALMACEN --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i><p @php echo $textom; @endphp>ALMACEN<i class="fas fa-angle-left right"></i></p>
          </a><ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('almacen.material-reception') }}" 
                class="nav-link request()->is('livewire/almacen/material-reception') ? 'active' : '' ">
                <i class="far fa-circle nav-icon"></i><p @php echo $textos; @endphp>Recepción</p></a>
            </li>
            <li class="nav-item">
              <a href="#{{-- {{ route('admin.users') }} --}}" class="nav-link request()->is('admin/users') ? 'active' : '' ">
                <i class="far fa-circle nav-icon"></i><p @php echo $textos; @endphp>Entrega</p></a>
          </li></ul>
        </li>{{-- MANTENIMIENTOS --}}
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i><p @php echo $textom; @endphp>MANTENIMIENTOS<i class="fas fa-angle-left right"></i></p>
          </a><ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('livewire.pproveedores') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i><p @php echo $textos; @endphp>Proveedores</p></a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i><p @php echo $textos; @endphp>Clientes</p></a>
            </li>
            <li class="nav-item">
              <a href="{{ route('livewire.productos') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i><p @php echo $textos; @endphp>Materiales</p></a>
            </li>
            <li class="nav-item">
              <a href="{{ route('livewire.sucursales') }}" class="nav-link request()->is('livewire/sucursales') ? 'active' : '' ">
                <i class="far fa-circle nav-icon"></i><p @php echo $textos; @endphp>Sucursales</p></a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i><p @php echo $textos; @endphp>Vehículos</p></a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.users') }}" class="nav-link request()->is('admin/users') ? 'active' : '' ">
                <i class="nav-icon fas fa-users"></i><p @php echo $textos; @endphp>Usuarios</p></a>
          </li></ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>