@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row">
        <h1 class="text-center my-2">Productos</h1>
        <div class="d-flex justify-content-end m-3">
            <form action="{{ route('products.search') }}" method="GET" >
                <input type="text" name="search" placeholder="Search Products">
                <button type="submit" class="btn btn-small btn-info m-2">Search</button>
            </form>
        </div>
    </div>
    @foreach ($productos->chunk(4) as $items)
        <div class="row g-2"> <!-- Espaciado entre columnas -->
            @foreach ($items as $product)
                <div class="col-md-3">
                    <div class="card h-100 text-center shadow-sm border-0">
                        <a href="{{ route('product', $product->slug ?? '') }}">
                            <img src="{{ $product->image_url }}" 
                                alt="{{ $product->name }}" 
                                class="card-img-top img-thumbnail mx-auto"
                                style="max-width: 200px; height: auto;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('product', $product->slug ?? '') }}" class="text-decoration-none text-dark">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            <p class="card-text fw-bold">{{ $product->price }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

</div>
@endsection