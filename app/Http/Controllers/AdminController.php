<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Editar un usuario
    public function edit(User $user)
    {
        $roles = Role::all(); // Recuperar todos los roles disponibles
        return view('users.edit', compact('user', 'roles'));
    }

    // Eliminar un usuario
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
