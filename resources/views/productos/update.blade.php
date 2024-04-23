@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-4">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-responsive img-fluid">
    </div>
    <div class="col-md-8">
    {{ Form::open(array('url' => 'product/update/'.$product->id)) }}
       
        <h3>{{ $product->price }} 1 €</h3>
        

        <div class="form-group">
            {{ Form::label('name', 'name') }}            
            {{ Form::text('name', $product->name, array('class' => 'form-control')) }}            
        </div>

        <div class="form-group">
            {{ Form::label('description', 'description') }}            
            {{ Form::textarea('description', $product->description,  array('class' => 'form-control')) }}
        </div>	

        <div class="form-group m-2">
            {{ Form::label('category', 'category') }}            
            {{ Form::select('category_id', $categories, $product->category_id, array('class' => 'form-control')) }}
        </div>
        
        <div class="form-group p-3">
            {{ Form::submit('Actualizar Producto', array('class' => 'btn btn-primary')) }}
        </div>
    
        <div class="col-md-12">           
        <h3>Enlaces</h3>
            <ul>
            @foreach ($links as $link)
            <li>
                <a href="{{ $link->url }}">{{ $link->getDominioAttribute() }}</a> : {{ $link->price }} €
                <a href="{{ route('products.removeLink', ['product' => $product->id, 'link' => $link->id]) }}" class="remove-link"><x-heroicon-m-minus-circle style="width: 25px;height: 25px;" class="m-0"/></a>
            </li>
            @endforeach
            </ul>

            <div class="m-auto">
                <label for="link">Añadir Enlace:</label>
                <input type="text" name="link" id="link">
                <button type="submit">Agregar Enlace</button>
            </div>
        </div>
    {{ Form::close() }}
    </div>    
</div>
<div class="row text-center m-2">
    <h5>
        <a href="{{ route('product', $previous->slug ?? '') }}">
            << Previous</a> |
                <a href="{{ route('product', $next->slug ?? '') }}">Next >></a>
    </h5>
</div>
@endsection