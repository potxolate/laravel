@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">            
            <h5 class="m-2 p-2">
                <x-heroicon-c-link style="width: 15px;height: 15px;" class="m-0"/>
                Categoria : <a href="{{ url('/categories', [$product->category->id ?? '']) }}" class="font-semibold"> {{ $product->category->name ?? 'No category' }}</a>
            </h5>
        </div>
        <div class="col-md-6 mx-auto text-end">                       
            <a href="{{ route('product', $previous->slug ?? '') }}" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                << {{ $previous->slug ?? '' }}</a> |
            <a href="{{ route('product', $next->slug) }}" class="link-secondary link-offset-2 link-underline-none link-underline-opacity-100-hover">
                {{ $next->slug }} >></a>           
        </div>
        
        <div class="col-md-4 p-2">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-responsive img-fluid" />
            <favorite-button :product-id="{{$product->id}}" class="mt-4" />
        </div>
        <div class="col-md-8 p-2">
            <h2 class="h2">
                {{ $product->name }}
                @auth
                    <a href="{{ url('/product/edit', [$product->id]) }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">edit</a>
                @endauth
            </h2>

            <p class="text-body-secondary fs-5 p-2">{{ $product->description }}</p>
            
            <div class="col-md-12 m-2 p-2">
                @if (count($product->links)>1)
                    <h5>Compara precios :</h5> 
                @endif
                @foreach ($product->links as $link)
                    <div class="card m-1"  style="width: 20rem;">                        
                        <div class="card-body d-flex justify-content-between">
                            <div>                           
                                <x-heroicon-o-shield-check style="width: 20px;height: 20px;" class="m-0"/>
                                <a href="{{ $link->url }}" >{{ $link->getDominioAttribute() }}</a>
                            </div>
                            <div class="text-end">
                                <span class="mark">{{ $link->price }} €</span>
                            </div>
                        </div>
                    </div>                
                @endforeach
            </div>
            <counter product-slug="{{$product->slug}}"></counter>            
        </div>
    </div>    
    <div class="row">
        <div class="col mt-3">
        @if(!empty($category->products))
            <h5 class="m-2">Otros productos la misma categoría</h5>
            <product-slider product-slug="{{$product->name}}" :products="{{$category->products}}"></product-slider>        
        @endif
        </div>    
    </div>

@endsection