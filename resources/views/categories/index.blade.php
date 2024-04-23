@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-auto">
            <h1 class="text-center my-2">Categorías</h1>
            <table class="table table-responsive table-striped table-bordered mx-auto">
                <thead>
                    <tr class="text-center">
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></td>
                        <td>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-info">Editar</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('categories.create') }}" class="btn btn-success">Crear nueva categoría</a>
        </div>
    </div>
</div>
@endsection