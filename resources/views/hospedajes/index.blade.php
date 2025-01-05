@extends('layouts.app')

@section('content')
<h1 class="text-center my-2">Hospedajes</h1>
<div class="row justify-content-center">
    <div class="col-auto">
        <table class="table table-responsive table-striped table-bordered mx-auto">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>tipo</th>
                    <th>ubicacion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hospedajes as $hospedaje)
                <tr>
                    <td>{{ $hospedaje->nombre }}</td>
                    <td>{{ $hospedaje->tipo }}</td>
                    <td>{{ $hospedaje->ubicacion }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection