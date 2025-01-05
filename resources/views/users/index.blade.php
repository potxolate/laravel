<!-- resources/views/admin/users/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Administrar Usuarios</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role ? $user->role->name : 'Sin rol' }}</td> <!-- Manejar usuarios sin rol -->
                        <td>
                            <!-- Acciones de administración -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection