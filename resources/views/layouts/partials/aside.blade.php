<aside class="main-sidebar elevation-4" style="background: #336699;">
<!--aside class="main-sidebar sidebar-dark-primary elevation-4" -->
    @php
    /* para fondo verde */
    /* $fondoc='style="background: #c3d69b;"'; */#336699
    /* $fondoo='style="background: #3f7819;"'; */
  
    /* para fondo naranja */
    /* $fondoc='style="background: #eb8647;"'; */
    /* $fondoo='style="background: #ad4d12;"'; */
  
    /* para fondo azul */
    /* $fondoc='style="background: #6699cc;"'; */
    $fondoo='style="background: #336699;"';
    
   /*  $texto='style="color: white;"';
    $textom='style="color: white; hover-opacity-6; font-weight: bold;"';
    $textos='style="color: white; hover-opacity-6;"'; */
  
    /* para fondo blanco */
    $fondoc='style="background: white;"';
    $texto='style="color: white; text-align: center; text-shadow: 2px 2px 2px black;"';
    $textom='style="color: black; font-weight: bold;"';
    $textos='style="color: black;"';
  @endphp
  <!-- LOGO style="color: white; text-shadow: 2px 2px 2px black;" --> 
  <img src="{{ asset('../img/logo.png') }}" alt="REMECA" class="brand-image animate__slideInLeft" height="500px" width="500px">
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    {{-- <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="REMECA" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
    {{-- <img src="{{ asset('../img/logo.png') }}" alt="REMECA" class="brand-image" height="500px" width="500px"> --}}
    <!--span class="brand-text font-weight-light">REMECA</span-->
    <h1 class="brand-text" @php echo $texto; @endphp>REMECA&nbsp;&nbsp;&nbsp;&nbsp;</h1>
  </a>

  <div class="sidebar" @php echo $fondoc; @endphp>
    <!-- PANEL DEL USUARIO -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
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
    </div> --}}
    <!-- MENU GENERAL -->
    <nav class="mt-2" style="background-color: #d9d9d9">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        {{-- <li class="nav-item">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i><p>TABLERO</p>
          </a>
        </li> --}}{{-- PRESIDENCIA --}}@role('Admin|Auditor|Presidencia')
        <li class="nav-item">
          <!--a href="#" class="nav-link active"-->
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt hover-opacity-6"></i>
            <p @php echo $textom; @endphp>PRESIDENCIA<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-money-bill-wave"></i><p class="hover-color " @php echo $textos; @endphp>Administración</p></a>
              </li><li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clipboard-check"></i><p class="hover-color " @php echo $textos; @endphp>Logística</p></a>
              </li><li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-warehouse"></i><p class="hover-color " @php echo $textos; @endphp>Almacen</p></a>
            </li></ul>
        </li>@endrole<div></div>{{-- FINANZAS --}}@role('Admin|Auditor|Finanzas')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-dollar-sign"></i>
            <p @php echo $textom; @endphp>FINANZAS<i class="fas fa-angle-left right"></i></p></a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('livewire.purchases.show') }}" class="nav-link">
                <i class="nav-icon fas fa-money-bill-wave"></i><p @php echo $textos; @endphp>Administración</p></a>
            </li><li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-clipboard-check"></i><p @php echo $textos; @endphp>Logística</p></a>
            </li><li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-warehouse"></i><p @php echo $textos; @endphp>Almacen</p></a>
          </li></ul>
        </li>@endrole<div></div>{{-- LOGÍSTICA --}}@role('Admin|Auditor|Logistica')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-clipboard-check"></i>
            <p @php echo $textom; @endphp>LOGISTICA<i class="fas fa-angle-left right"></i></p></a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-clipboard-list"></i><p @php echo $textos; @endphp>Operaciones</p></a>
            </li><li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-truck"></i><p @php echo $textos; @endphp>Transporte</p></a>
          </li></ul>
        </li>@endrole<div></div>{{-- ADMINISTRACION --}}@role('Admin|Auditor|Administracion')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-money-bill-wave"></i><p @php echo $textom; @endphp>ADMINISTRACION<i class="fas fa-angle-left right"></i></p>
          </a><ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('livewire.comprador-component') }}" class="nav-link request()->is('admin/users') ? 'active' : '' ">
                <i class="nav-icon fas fa-cart-plus"></i><p @php echo $textos; @endphp>Compras</p></a>
            </li><li class="nav-item">
              <a href="{{ route('livewire.compras.negociacion') }}" class="nav-link request()->is('admin/users') ? 'active' : '' ">
                <i class="nav-icon fas fa-cart-arrow-down"></i></i><p @php echo $textos; @endphp>Negociación de Compras</p></a>
          </li><li class="nav-item">
            <a href="{{ route('livewire.ventas.venta') }}" class="nav-link request()->is('admin/users') ? 'active' : '' ">
              <i class="nav-icon fas fa-cart-arrow-down"></i></i><p @php echo $textos; @endphp>Ventas</p></a>
        </li><li class="nav-item">
          <a href="{{ route('livewire.ventas.negociacion') }}" class="nav-link request()->is('admin/users') ? 'active' : '' ">
            <i class="nav-icon fas fa-cart-arrow-down"></i></i><p @php echo $textos; @endphp>Negociación de Ventas</p></a>
      </li></ul>
        </li>@endrole<div></div>{{-- ALMACEN --}}@role('Admin|Auditor|Almacen')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-warehouse"></i><p @php echo $textom; @endphp>ALMACEN<i class="fas fa-angle-left right"></i></p>
          </a><ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('almacen.material-reception') }}" 
                class="nav-link request()->is('livewire/almacen/material-reception') ? 'active' : '' ">
                <i class="nav-icon fas fa-dolly"></i><p @php echo $textos; @endphp>Recepción</p></a>
            </li>
            <li class="nav-item">
              <a href="{{ route('livewire.despacho-component') }}"
              class="nav-link request()->is('admin/users') ? 'active' : '' ">
                <i class="nav-icon fas fa-people-carry"></i><p @php echo $textos; @endphp>Entrega</p></a>
          </li></ul>
        </li>@endrole<div></div>{{-- MANTENIMIENTOS --}}@role('Admin|Auditor|Mantenimiento')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-wrench"></i><p @php echo $textom; @endphp>MANTENIMIENTOS<i class="fas fa-angle-left right"></i></p>
          </a><ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('livewire.pproveedores') }}" class="nav-link">
                <i class="nav-icon fas fa-user-tie"></i><p @php echo $textos; @endphp>Proveedores</p></a>
            </li>
            <li class="nav-item">
              <a href="{{ route('livewire.client') }}" class="nav-link">
                <i class="nav-icon fas fa-id-card"></i><p @php echo $textos; @endphp>Clientes</p></a>
            </li>
            <li class="nav-item">
              <a href="{{ route('livewire.productos') }}" class="nav-link">
                <i class="nav-icon fas fa-truck-loading"></i><p @php echo $textos; @endphp>Materiales</p></a>
            </li>
            <li class="nav-item">
              <a href="{{ route('livewire.sucursales') }}" class="nav-link request()->is('livewire/sucursales') ? 'active' : '' ">
                <i class="nav-icon fas fa-store"></i><p @php echo $textos; @endphp>Sucursales</p></a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-truck"></i><p @php echo $textos; @endphp>Vehículos</p></a>
            </li>{{-- CRUD DE USUARIOS --}}
            <li class="nav-item">
              <a href="{{ route('admin.users.index') }}" class="nav-link">
                <i class="nav-icon nav-icon fas fa-users"></i><p @php echo $textos; @endphp>Usuarios</p></a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.roles.index') }}" class="nav-link">
                <i class="nav-icon fas fa-users-cog"></i><p @php echo $textos; @endphp>Roles de Usuarios</p></a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{ route('admin.users') }}" class="nav-link request()->is('admin/users') ? 'active' : '' ">
                <i class="nav-icon fas fa-users"></i><p @php echo $textos; @endphp>Usuarios</p></a>
            </li> --}}
          </ul>
        </li>@endrole
      </ul>
    </nav>
  </div>
</aside>