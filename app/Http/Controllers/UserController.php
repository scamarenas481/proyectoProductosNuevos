<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
       $roles = Role::all(); // Obtén todos los roles
    return view('users.create', compact('roles'));
    }

    public function store(Request $request)
{
    $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);
        $roles = $request->input('roles'); // Obtener los roles seleccionados

        $user->syncRoles($roles);
         auth()->login($user);
    return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
}


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->syncRoles($request->input('roles', []));
        return redirect()->route('users.index')->with('success', 'Roles actualizados correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

public function selectRole()
{
    $userRoles = auth()->user()->roles;
    $selectedRole = auth()->user()->activeRole; // Asegúrate de tener el nombre correcto de la relación

    return view('selectRole', compact('userRoles', 'selectedRole'));
}


public function setActiveRole(Request $request)
{
    $user = auth()->user();
    $selectedRoleId = $request->input('role_id');

    // Asegúrate de validar que el rol seleccionado pertenezca al usuario antes de actualizarlo
    if ($user->roles->contains($selectedRoleId)) { // Cambio aquí
        $user->active_role_id = $selectedRoleId;
        $user->save();
    }

    return redirect('/home'); // Redirige a la vista principal del rol
}



}
