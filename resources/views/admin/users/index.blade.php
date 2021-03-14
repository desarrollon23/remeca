<x-admin-layout>
  <div style="background: white;">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row aling: center">
          <div class="col-lg-12 col-md-6 col-xs-4">
            <h1 class="m-0">Lista de Usuarios</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row aling: center">
          <div class="col-lg-12 col-md-6 col-xs-4">
            @livewire('admin.users-index')
          </div>
        </div>
      </div>
    </div>
    
  </div>
</x-admin-layout>