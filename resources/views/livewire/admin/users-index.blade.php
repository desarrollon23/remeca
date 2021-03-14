<div>
    <div class="card">
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
          {{-- <table class="table table-hover">--}}<thead><tr> 
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Email</th>
              <th scope="col">Opciones</th>
            </tr></thead><tbody>
            @foreach ($users as $user)
            <tr><th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                {{-- <a class="btn btn-primary" href="{{ route('admin.users.edit', $user)}}">Editar</a> --}}
                {{-- <a href="" wire:click.prevent="edit({{ $user }})"><i class="fa fa-edit mr-2"></i></a> --}}
                <a href="{{ route('admin.users.edit', $user)}}" ><i class="fa fa-edit mr-2"></i></a>
                <a href="" wire:click.prevent="confirmUserRemoval({{ $user->id }})"><i class="fa fa-trash text-danger"></i></a>
            </td></tr>@endforeach</tbody>
          </table>
        </div>
        {{-- <div class="card-footer d-flex justify-content-end">
          {{ $users->links() }}
        </div> --}}
      </div>
</div>
