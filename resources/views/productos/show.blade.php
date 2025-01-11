@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <!-- Encabezado -->
        <div class="row justify-content-between align-items-center mb-4">
            <div class="col-md-6">
                <h5 class="m-2 p-2 d-flex align-items-center">
                    <x-heroicon-c-link style="width: 15px; height: 15px;" class="me-2" />
                    <span>Categoria:</span>
                    <a href="{{ url('/categories', [$product->category->id ?? '']) }}" class="fw-semibold ms-1">
                        {{ $product->category->name ?? 'No category' }}
                    </a>
                </h5>
            </div>
            <div class="col-md-6 text-md-end text-start mt-2 mt-md-0">
                <a href="{{ route('product', $previous->slug ?? '') }}" 
                   class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover me-2">
                   << {{ $previous->slug ?? '' }}
                </a> |
                <a href="{{ route('product', $next->slug) }}" 
                   class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ms-2">
                   {{ $next->slug }} >>
                </a>
            </div>
        </div>

        <!-- Detalles del producto -->
        <div class="row g-4 align-items-start">
            <div class="col-md-4">
                <img src="{{ $product->image_url }}" 
                     alt="{{ $product->name }}" 
                     class="img-fluid rounded shadow-sm w-100 mb-3" />
                <favorite-button :product-id="{{ $product->id }}" class="mt-3 w-100" />
            </div>
            <div class="col-md-8">
                <h2 class="h2 d-flex align-items-center">
                    {{ $product->name }}
                    @auth
                        <a href="{{ url('/product/edit', [$product->id]) }}" 
                           class="btn btn-sm btn-outline-primary ms-3">
                            Editar
                        </a>
                    @endauth
                </h2>
                <p class="text-body-secondary fs-5 p-2">{{ $product->description }}</p>
                
                <!-- Comparar precios -->
                @if (count($product->links) > 0)
                    <h5 class="fw-semibold mt-4">Compara precios:</h5>
                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        @foreach ($product->links as $link)
                            <div class="col">
                                <div class="card shadow-sm">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div>
                                            <x-heroicon-o-shield-check style="width: 20px; height: 20px;" class="me-2" />
                                            <a href="{{ $link->url }}" class="text-decoration-none">
                                                {{ $link->getDominioAttribute() }}
                                            </a>
                                        </div>
                                        <div class="text-end fw-bold text-primary">
                                            {{ $link->price }} €
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                <!-- Contador -->
                <div class="mt-4">
                    <!-- <counter :urls="{{ $product->links }}"></counter> -->
                </div>
            </div>
        </div>

        <!-- Otros productos de la misma categoría -->
        @if (!empty($category->products))
            <div class="row mt-5">
                <div class="col">
                    <h5 class="fw-semibold mb-3">Otros productos de la misma categoría</h5>
                    <product-slider product-slug="{{ $product->name }}" :products="{{ $category->products }}"></product-slider>
                </div>
            </div>
        @endif
    </div>
@endsection
