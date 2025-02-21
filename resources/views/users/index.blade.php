<!-- resources/views/admin/users/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Administrar Usuarios</h1>

        <!-- Tabla de usuarios -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                            <a href="{{ route('admin.users.show', $user->id) }}">
                                {{ $user->name }}
                            </a>                            
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-{{ $user->role ? 'success' : 'secondary' }}">
                                    {{ $user->role ? $user->role->name : 'Sin rol' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <!-- Editar usuario -->
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-sm mx-1">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>

                                    <!-- Eliminar usuario -->
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mx-1" 
                                                onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay usuarios registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection