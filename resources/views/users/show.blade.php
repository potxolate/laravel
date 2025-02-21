@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-secundary text-success text-center fs-4">
                    <h5 class="mb-0">Detalles del Usuario</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="mb-3">
                        <label for="user-name" class="form-label fw-bold">Nombre:</label>
                        <p id="user-name" class="form-control-plaintext">{{ $user->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="user-email" class="form-label fw-bold">Email:</label>
                        <p id="user-email" class="form-control-plaintext">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

