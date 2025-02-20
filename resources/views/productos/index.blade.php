@extends('layouts.app')

@section('content')
<div class="container my-4">    
    <!-- Título y barra de búsqueda -->
    <div class="row mb-4">
        <div class="col text-center">
            <h2 class="fw-bold">Productos</h2>
        </div>
        <div class="col-md-4 mx-auto">
            <form action="{{ route('products.search') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Buscar productos..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-info">Buscar</button>
            </form>
        </div>
    </div>

    <!-- Lista de productos -->
    @foreach ($productos->chunk(4) as $items)
        <div class="row gy-4"> <!-- Espaciado entre filas -->
            @foreach ($items as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card h-100 text-center shadow-sm border-0">
                        <!-- Imagen del producto -->
                        <a href="{{ route('product', $product->slug ?? '') }}">
                            <img 
                                src="{{ $product->image_url }}" 
                                alt="{{ $product->name }}" 
                                class="card-img-top img-thumbnail mx-auto"
                                style="max-width: 200px; height: auto;">
                        </a>
                        
                        <!-- Información del producto -->
                        <div class="card-body">
                            <h6 class="card-title">
                                <a href="{{ route('product', $product->slug ?? '') }}" 
                                   class="text-decoration-none text-dark">
                                    {{ $product->name }}
        
                                </a>
                                <span class="ms-2 text-secondary">
                                    <i class="fas fa-link"></i> {{ count($product->links) }}
                                </span>
                            </h6>                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    <!-- Paginación -->
    @if (method_exists($productos, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $productos->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>

@endsection