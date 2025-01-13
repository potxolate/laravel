@extends('layouts.app')

@section('content')
@if (session()->has('message'))

<p class="alert alert-success">{{ session('message') }}</p>


@endif
<div class="container my-4">
	<!-- Título -->
	<h1 class="text-center my-3">All the Links</h1>

	<!-- Formulario de búsqueda -->
	<div class="row justify-content-center mb-4">
		<div class="col-md-6">
			<form action="{{ route('links.search') }}" method="GET" class="input-group">
				<input type="text" name="search" placeholder="Search" class="form-control" />
				<button type="submit" class="btn btn-info">Search</button>
			</form>
		</div>
	</div>

	<!-- Botón para crear un enlace -->
	<div class="text-end mb-3">
		<a href="{{ URL::to('links/create') }}" class="btn btn-success">Create a Link</a>
	</div>

	<!-- Mensaje de sesión -->
	@if (Session::has('message'))
	<div class="alert alert-info text-center">{{ Session::get('message') }}</div>
	@endif

	<!-- Tabla de enlaces -->
	<div class="table-responsive">
		<table class="table table-striped table-bordered text-center">
			<thead class="table-dark">
				<tr>
					<th>ID</th>
					<th>Product</th>
					<th>Price</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($links as $key => $value)
				<tr>
					<td>{{ $value->id }}</td>
					<td class="py-2">
						{{ $value->product->name }}<br />
						<a href="{{ $value->url }}" class="text-decoration-none">{{ $value->getDominioAttribute() }}</a>
					</td>
					<td>{{ $value->price }} €</td>
					<td>
						<div class="d-flex justify-content-center">
							<!-- Botón de editar -->
							<a href="{{ URL::to('links/' . $value->id . '/edit') }}" class="btn btn-info btn-sm mx-1">Edit</a>
							<!-- Botón de eliminar -->
							{{ Form::open(['url' => 'links/' . $value->id, 'method' => 'DELETE', 'class' => 'd-inline']) }}
							{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm mx-1']) }}
							{{ Form::close() }}
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<!-- Paginación -->
	@isset($links)
	<div class="d-flex justify-content-center my-4">
		{{ $links->links() }}
	</div>
	@endisset
</div>

@endsection