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
			<example-component></example-component>			
		</div>

		<div class="form-group p-4">
			{{ Form::label('url', 'URL') }}
			{{ Form::url('url', 'url',  array('class' => 'form-control')) }}
		</div>	

		{{ Form::submit('Create the Link!', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

	</div>
	
	
@endsection