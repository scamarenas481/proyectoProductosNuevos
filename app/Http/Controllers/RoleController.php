<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        // Muestra el formulario para crear un nuevo rol
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            // Puedes agregar más reglas de validación según tus necesidades
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            // Puedes asignar más campos aquí según tus necesidades
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol agregado correctamente.');
    }

    public function edit(Role $role)
    {
      
        return view('roles.edit', compact('role'));
    }

   public function update(Request $request, Role $role)
{
    $role->update([
        'name' => $request->input('name'),
    ]);

    return redirect()->route('roles.index')->with('success', 'Nombre del rol actualizado correctamente.');
}


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
    }
}
