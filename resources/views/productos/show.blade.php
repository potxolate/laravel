@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">            
            <h5 class="m-2 p-2">
                <x-heroicon-c-link style="width: 15px;height: 15px;" class="m-0"/>
                Categoria : <a href="{{ url('/categories', [$product->category->id ?? '']) }}" class="font-semibold"> {{ $product->category->name ?? 'No category' }}</a>
            </h5>
            
        </div>
        <div class="col-md-4 p-2">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-responsive img-fluid" />
            <favorite-button :product-id="{{$product->id}}" />
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
            <counter product-slug="{{$product->slug}}"></counter>            
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
        <div class="col">
        @if(!empty($category->products))
            <h4 class="m-2">Otros productos la misma categoría</h4>
            <product-slider product-slug="{{$product->name}}" :products="{{$category->products}}"></product-slider>        
        @endif
        </div>    
    </div>

@endsection