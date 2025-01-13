<!-- app/views/links/create.blade.php -->
@extends('layouts.app')

	@section('content')

	<div class="container my-4">
    <!-- Cabecera -->
    <h1 class="text-center mb-4">Crear un Enlace</h1>

    <!-- Mensajes de error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario de creación -->
    <div class="card w-50 mx-auto shadow-sm p-4">
        {{ Form::open(['url' => 'links', 'method' => 'POST']) }}

        <!-- Campo Producto -->
        <div class="form-group mb-3">
            {{ Form::label('product', 'Producto', ['class' => 'form-label fw-bold']) }}
            <example-component></example-component>
        </div>

        <!-- Campo URL -->
        <div class="form-group mb-3">
            {{ Form::label('url', 'URL', ['class' => 'form-label fw-bold']) }}
            {{ Form::url('url', old('url'), ['class' => 'form-control', 'placeholder' => 'Introduce la URL...']) }}
        </div>

        <!-- Botón Crear -->
        <div class="text-center">
            {{ Form::submit('Crear Enlace', ['class' => 'btn btn-primary px-5']) }}
        </div>

        {{ Form::close() }}
    </div>
</div>

	
	
@endsection