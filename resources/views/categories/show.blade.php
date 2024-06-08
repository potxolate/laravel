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
    <div class="row">
        @foreach ($chunk as $product)
        <div class="col-md-3 p-3 ">
            <div class="thumbnail">
                <div class="caption text-center">
                    <a href="{{ route('product', $product->slug ?? '' ) }}"><img src="{{ $product->image_url }}" alt="product" class="img-thumbnail"></a>
                    <h4 class="title m-1">
                        <a href="{{ route('product', $product->slug ?? '' ) }}" class="text-inherit text-decoration-none">
                            {{ $product->name }}
                        </a>                        
                    </h4>
                </div> <!-- end caption -->
            </div> <!-- end thumbnail -->
        </div> <!-- end col-md-3 -->
        @endforeach
    </div>
    @endforeach
    
@endsection