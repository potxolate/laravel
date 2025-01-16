@extends('layouts.app')

@section('content')
    <h1>Crear categoría: </h1>

    {{ Form::open(array('url' => 'categories')) }}
        @csrf        
        <div class="form-group">
            <label for="name">Nombre de la categoría:</label>
            <input type="text" class="form-control" id="name" name="name" value="type">
        </div>
        <button type="submit" class="btn btn-primary m-2">Guardar cambios</button>
    {{ Form::close() }}
@endsection