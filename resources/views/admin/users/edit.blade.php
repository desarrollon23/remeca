<x-admin-layout>
  <div {{-- style="background: white;" --}}>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row aling: center">
          <div class="col-lg-12 col-md-6 col-xs-4">
            <h1 class="m-0">Asignar Rol a Usuarios</h1>
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
          <p class="h5">Nombre:</p>
          <p class="form-control">{{ $user->name }}</p>
          <h2 class="h5">Listado de Roles</h2>
          {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}
            @foreach ($roles as $role)
              <div>
                <label>
                  {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                  {{$role->name}}
                </label>
              </div>
            @endforeach
            {!! Form::submit('Asignar Roles', ['class' => 'btn btn-primary mt-2']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
    
  </div>
</x-admin-layout>