<x-admin-layout>
  <div style="background: white;">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row aling: center">
          <div class="col-lg-12 col-md-6 col-xs-4">
            <h1 class="m-0">Crear nuevo Rol</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content col-lg-12 col-md-6 col-xs-4">
      <div class="card">
        <div class="card-body">
          {!! Form::open(['route' => 'admin.roles.store']) !!}
            @include('admin.roles.partials.form')
            {!! Form::submit('Crear Rol', ['class' => 'btn btn-primary']) !!}
           {!! Form::close() !!}
        </div>
      </div>
    </div>
    
  </div>
</x-admin-layout>