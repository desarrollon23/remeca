<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct() //PROTEGE LAS RUTAS PARA QUE NO LA ABRA UN USUARIO SI NO TIENE PERMISO
    {
        $this->middleware('can:admin.roles.index')->only('index');
        $this->middleware('can:admin.roles.create')->only('create', 'store');
        $this->middleware('can:admin.roles.edit')->only('edit', 'update');
        $this->middleware('can:admin.roles.destroy')->only('destroy');
    }

    public function index()
    {
        /* if(request()->page){    //MANEJO DE CACHE PARA AHORRAR RECURSOS DEL SERVIDOR
            $key = 'roles' . request()->page;
        }else{
            $key = 'roles';
        }
        if(Cache::has($key)){
            $roles = Cache::get($key);
        }else{
            $roles = Role::all();
            Cache::put($key, $roles);
        }   */                     //FIN MANEJO DE CACHE PARA AHORRAR RECURSOS DEL SERVIDOR
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);
        return redirect()->route('admin.roles.edit', $role)->with('info', 'El Rol se creó Correctamente');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);
        return redirect()->route('admin.roles.edit', $role)->with('info', 'El Rol se Modificó Correctamente');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index', $role)->with('info', 'El Rol se Eliminó Correctamente');
    }
}
