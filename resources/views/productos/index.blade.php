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
    <div class="row">
        @foreach ($items as $product)
        <div class="col-md-3 py-md-3">
            <div class="thumbnail">
                <div class="caption text-center">
                    <a href="{{ route('product', $product->slug ?? '' ) }}"><img src="{{ $product->image_url }}" alt="product" class="img-thumbnail mb-3"></a>
                    <h4 class="title m-1">
                        <a href="{{ route('product', $product->slug ?? '') }}" class="text-inherit text-decoration-none">{{ $product->name }}</a>
                    </h4>
                    <p>{{ $product->price }}</p>                    
                </div> <!-- end caption -->
            </div> <!-- end thumbnail -->
        </div> <!-- end col-md-3 -->
        @endforeach
    </div> <!-- end row -->
    @endforeach
</div>
@endsection