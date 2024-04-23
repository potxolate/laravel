<!-- app/views/links/create.blade.php -->
@extends('layouts.app')

	@section('content')

	<h1 class="text-center m-2">Create a Link</h1>
	<div class="w-50 text-center mx-auto">
	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all() )}}

	{{ Form::open(array('url' => 'links')) }}

		<div class="form-group p-4">
			{{ Form::label('product', 'Product') }}
			{{ Form::text('search', 'Type something', array('class' => 'typeahead form-control', 'id' => 'search')) }}
			{{ Form::hidden('product_id', '1', array('class' => 'typeahead form-control', 'id' => 'product_id')) }}
		</div>

		<div class="form-group p-4">
			{{ Form::label('url', 'URL') }}
			{{ Form::url('url', 'url',  array('class' => 'form-control')) }}
		</div>	

		{{ Form::submit('Create the Link!', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

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