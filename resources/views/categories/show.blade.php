@extends('layouts.app')

@section('content')
    <h1>Categoría: {{ $category->name }}</h1>
    <div class="row">
        <div class="col my-3">
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('categories.destroy', $category) }}" method="post" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
    @foreach ($category->products->chunk(4) as $chunk)
    <div class="row gy-4">
        @foreach ($chunk as $product)
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
    
@endsection