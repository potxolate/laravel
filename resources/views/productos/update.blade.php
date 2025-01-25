@extends('layouts.app')

@section('content')

<div class="container my-4">
    <!-- Cabecera -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-4 text-center">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-8">
            {{ Form::open(['url' => 'product/update/' . $product->id, 'method' => 'POST', 'class' => 'card p-4 shadow-sm']) }}            

            <!-- Campo Nombre -->
            <div class="form-group mb-3">
                {{ Form::label('name', 'Nombre del Producto', ['class' => 'form-label fw-bold']) }}
                {{ Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Nombre del producto...']) }}
            </div>

            <!-- Campo Descripción -->
            <div class="form-group mb-3">
                {{ Form::label('description', 'Descripción', ['class' => 'form-label fw-bold']) }}
                {{ Form::textarea('description', $product->description, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Descripción del producto...']) }}
            </div>

            <!-- Campo Categoría -->
            <div class="form-group mb-4">
                {{ Form::label('category', 'Categoría', ['class' => 'form-label fw-bold']) }}
                {{ Form::select('category_id', $categories, $product->category_id, ['class' => 'form-select']) }}
            </div>

            <!-- Botón de Envío -->
            <div class="form-group text-center">
                {{ Form::submit('Actualizar Producto', ['class' => 'btn btn-primary px-5']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>

    <!-- Sección de Enlaces -->
    <div class="row">
        <div class="col-md-8 mx-auto">            
            <h3 class="text-center mb-4">Enlaces Asociados</h3>
            <ul class="list-group mb-4">
                @foreach ($links as $link)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary me-3">{{ $link->price }} €</span>
                            <a href="{{ $link->url }}" target="_blank" class="text-decoration-none text-dark fw-bold">
                                {{ $link->getDominioAttribute() }}
                            </a>                            
                        </div>
                        <div class="d-flex">
                            <update-price-button :link-id="{{ $link->id }}" class="me-2"></update-price-button>
                            <a href="{{ route('products.removeLink', ['product' => $product->id, 'link' => $link->id]) }}"
                            class="btn btn-sm btn-danger d-flex align-items-center gap-1">
                                <x-heroicon-m-minus-circle style="width: 18px; height: 18px;" />
                                <span>Eliminar</span>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>       
            

            <!-- Añadir Enlace -->
            <div class="text-center">                
                    @csrf
                    <div class="input-group w-50 mx-auto">
                        <input type="text" name="link" id="link" class="form-control" placeholder="Añadir nuevo enlace...">
                        <button type="submit" class="btn btn-success">Agregar Enlace</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Navegación entre productos -->
    <div class="row text-center mt-4">
        <h5>
            <a href="{{ route('product', $previous->slug ?? '') }}" class="text-secondary">
                &lt;&lt; Previous
            </a>
            |
            <a href="{{ route('product', $next->slug ?? '') }}" class="text-secondary">
                Next &gt;&gt;
            </a>
        </h5>
    </div>
</div>

@endsection