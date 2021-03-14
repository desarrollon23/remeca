<x-admin-layout>
  <div style="background: white;">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row aling: center">
          <div class="col-lg-12 col-md-6 col-xs-4">
            <h1 class="m-0">Editar Rol</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    @if (session('info'))
        <div class="alert alert-success"><strong>{{ session('info') }}</strong></div>
    @endif
    <div class="content col-lg-12 col-md-6 col-xs-4">
      <div class="card">
        <div class="card-body">
          {!! Form::model($role, ['route' => ['admin.roles.update', $role], 'method' => 'put']) !!}
            @include('admin.roles.partials.form')
            {!! Form::submit('Modificar Rol', ['class' => 'btn btn-primary']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    
  </div>
</x-admin-layout>