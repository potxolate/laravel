@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h5 class="m-2 p-2">
                <x-heroicon-c-link style="width: 15px;height: 15px;" class="m-0"/>
                Categoria : <a href="{{ url('/categories', [$product->category->id ?? '']) }}" class="font-semibold"> {{ $product->category->name ?? 'No category' }}</a>
            </h5>
        </div>
        <div class="col-md-4 p-2">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-responsive img-fluid" />
        </div>
        <div class="col-md-8 p-2">
            <h2 class="h2">
                {{ $product->name }}
                @auth
                <a href="{{ url('/product/edit', [$product->id]) }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">edit</a>
                @endauth
            </h2>

            <p class="text-body-secondary">{{ $product->description }}</p>
            
            <div class="col-md-12 m-3 p-3">
                @if (count($product->links)>1)
                    <h4>Compara precios :</h4> 
                @endif
                @foreach ($product->links as $link)
                    <p class="h5 m-2">
                        <x-heroicon-o-shield-check style="width: 15px;height: 15px;" class="m-0"/>
                        <a href="{{ $link->url }}" class="small">{{ $link->getDominioAttribute() }}</a> : {{ $link->price }} €
                    </p>                
                @endforeach
            </div>
            <counter />
            <counter resource="{{  route('product', $previous->slug ?? '') }}"></counter>
        </div>
    </div>
    <div class="row text-center">
        <h5>
            <a href="{{ route('product', $previous->slug ?? '') }}" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                << {{ $previous->slug ?? '' }}</a> |
            <a href="{{ route('product', $next->slug) }}" class="link-secondary link-offset-2 link-underline-none link-underline-opacity-100-hover">
                {{ $next->slug }} >></a>
        </h5>
    </div>
    <div class="row">
    @if(!empty($category->products))
    <h4 class="m-2">Otros productos la misma categoría</h4>
        @foreach ($category->products as $more_product)
            <div class="col-2 px-md-3">
                <div class="thumbnail">
                    <div class="caption text-center">
                        <a href="{{ route('product', $more_product->slug) }}"><img src="{{ $more_product->image_url }}" alt="product" class="img-thumbnail"></a>
                        <h3 class="h6">
                            <a href="{{ route('product', $more_product->slug) }}" class="text-inherit text-decoration-none">
                                {{ $more_product->name }}
                            </a>
                            <p>{{ $more_product->price }}</p>
                        </h3>
                    </div> <!-- end caption -->
                </div> <!-- end thumbnail -->
            </div> <!-- end col-md-3 -->            
        @endforeach
    @endif
    </div>
</div>
@endsection