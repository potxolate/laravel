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
    <div class="row">
        @foreach ($category->products as $product)
        <div class="col px-md-3">
            <div class="thumbnail">
                <div class="caption text-center">
                    <a href="{{ url('product', [$product->id]) }}"><img src="{{ $product->image_url }}" alt="product" class="img-thumbnail"></a>
                    <h4 class="title m-1">
                        <a href="{{ url('product', [$product->id]) }}" class="text-inherit text-decoration-none">
                            {{ $product->name }}
                        </a>
                        <p>{{ $product->price }}</p>
                    </h4>
                </div> <!-- end caption -->
            </div> <!-- end thumbnail -->
        </div> <!-- end col-md-3 -->
        @endforeach
    </div>
    
@endsection