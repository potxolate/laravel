@extends('layouts.app')

@section('content')
    <h1>Editar categoría: {{ $category->name }}</h1>

    <form action="{{ route('categories.update', $category) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre de la categoría:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
        </div>
        <button type="submit" class="btn btn-primary m-2">Guardar cambios</button>
    </form>
@endsection