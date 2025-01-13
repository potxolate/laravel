<!-- app/views/links/create.blade.php -->
@extends('layouts.app')

	@section('content')

	<div class="container my-4">
    <!-- Título -->
    <h1 class="text-center mb-4">Edit a Link</h1>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger w-50 mx-auto">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario -->
    <div class="card w-50 mx-auto shadow-sm">
        <div class="card-body">
            {{ Form::open(['url' => route('links.update', $link->id), 'method' => 'PUT']) }}
            @csrf
            
            <!-- Campo Producto -->
            <div class="form-group mb-4">
                {{ Form::label('product', 'Product', ['class' => 'form-label fw-bold']) }}
                {{ Form::text('search', $link->product->name, ['class' => 'form-control typeahead', 'id' => 'search', 'placeholder' => 'Search product...']) }}
                {{ Form::hidden('product_id', $link->product_id, ['id' => 'product_id']) }}
            </div>

            <!-- Campo URL -->
            <div class="form-group mb-4">
                {{ Form::label('url', 'URL', ['class' => 'form-label fw-bold']) }}
                {{ Form::url('url', $link->url, ['class' => 'form-control', 'placeholder' => 'Enter the URL...']) }}
            </div>

            <!-- Campo Precio -->
            <div class="form-group mb-4">
                {{ Form::label('price', 'Price', ['class' => 'form-label fw-bold']) }}
                {{ Form::text('price', $link->price, ['class' => 'form-control', 'placeholder' => 'Enter the price...']) }}
            </div>

            <!-- Botón de envío -->
            <div class="text-center">
                {{ Form::submit('Update the Link!', ['class' => 'btn btn-primary px-4']) }}
            </div>
            
            {{ Form::close() }}
        </div>
    </div>
</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
	<script type="text/javascript">
		var path = "{{ route('autocomplete') }}";
	
		$('#search').typeahead({
				source: function (query, process) {
					return $.get(path, {
						query: query
					}, function (data) {
						return process(data);
					});
				},
				updater: function(data) {				
					// item es el nombre seleccionado del autocompletado
					// Puedes extraer el ID correspondiente del elemento seleccionado
					var selectedId = data.id; // Esta función debe implementarse según tu estructura de datos
					$('#product_id').val(selectedId); // Asigna el ID al campo oculto
					return data; // Retorna el nombre seleccionado para que se muestre en el campo de entrada
				}
			});
	
	</script>
@endsection