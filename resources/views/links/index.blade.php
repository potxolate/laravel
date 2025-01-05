@extends('layouts.app')

	@section('content')
	@if (session()->has('message'))

	<p class="alert alert-success">{{ session('message') }}</p>


	@endif
		<h1 class="text-center my-2">All the links</h1>
		<div class="row">
			<div class="d-flex justify-content-center">
				<form action="{{ route('links.search') }}" method="GET" >
					<input type="text" name="search" placeholder="Search">
					<button type="submit" class="btn btn-small btn-info m-2 p-1">Search</button>
				</form>						
			</div>			
		</div>
		
		<div class="d-flex flex-row-reverse m-3"><a href="{{ URL::to('links/create') }}">Create a Link</a></div>
		<!-- will be used to show any messages -->
		@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
		@endif
		
		<table class="table table-striped table-bordered mx-auto w-75">
			<thead>
				<tr>
					<td class="text-center">ID</td>
					<td class="text-center">Product</td>
					<td class="text-center">Price</td>
					<td class="text-center">Actions</td>
				</tr>
			</thead>
			<tbody>
				@foreach($links as $key => $value)
				<tr>
					<td class="text-center">{{ $value->id }}</td>
					<td class="py-2">
						{{ $value->product->name }}<br />
						<a href="{{ $value->url }}">{{ $value->getDominioAttribute() }}</a>
					</td>
					<td class="text-center">{{ $value->price }}</td>
					<!-- we will also add show, edit, and delete buttons -->
					<td>
						<div class="d-flex justify-content-end">
							<!-- edit this nerd (uses the edit method found at GET /links/{id}/edit -->
							<a class="btn btn-small btn-info m-2" href="{{ URL::to('links/' . $value->id . '/edit') }}">Edit</a>
							
							<!-- delete the nerd (uses the destroy method DESTROY /links/{id} -->
							<!-- we will add this later since its a little more complicated than the first two buttons -->
							{{ Form::open(array('url' => 'links/' . $value->id, 'class' => 'pull-left')) }}
							{{ Form::hidden('_method', 'DELETE') }}
							{{ Form::submit('Delete', array('class' => 'btn btn-danger m-2 ')) }}
							{{ Form::close() }}							
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@isset($links)
			<div class="d-flex my-2 justify-content-center">{{ $links->links() }}</div>
		@endisset		
	@endsection

