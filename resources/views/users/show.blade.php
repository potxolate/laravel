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

                    <div class="row mb-3">
                        <div class="col-md-6 d-flex align-items-center">
                            <label for="user-name" class="form-label fw-bold me-2 mb-0">Nombre:</label>
                            <p id="user-name" class="form-control-plaintext mb-0">{{ $user->name }}</p>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <label for="user-email" class="form-label fw-bold me-2 mb-0">Email:</label>
                            <p id="user-email" class="form-control-plaintext mb-0">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 d-flex align-items-center">
                            <label for="user-phone" class="form-label fw-bold me-2 mb-0">Desde:</label>
                            <p id="user-phone" class="form-control-plaintext mb-0">{{ $user->created_at ?? 'No disponible' }}</p>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <label for="user-role" class="form-label fw-bold me-2 mb-0">Rol:</label>
                            <p class="form-control-plaintext mb-0">{{ $user->role->name ?? 'No asignado' }}</p>
                        </div>
                    </div>

                    <!-- Lista de favoritos -->
                    @if ($user->favorites->isNotEmpty())
                        <h6 class="mt-3 mb-4">{{ __('Favorite User Products') }}</h6>
                        
                        @foreach ($user->favorites as $fav)
                            <div class="list-group-item d-flex align-items-center p-3">
                                <!-- Imagen del producto -->
                                <img src="{{ $fav->product->image_url }}" 
                                        alt="{{ __('Image of') }} {{ $fav->product->name }}" 
                                        class="rounded img-thumbnail me-3"
                                        style="width: 80px; height: 80px;">
                                
                                <!-- Información del producto -->
                                <div class="flex-grow-1">
                                    <a href="{{ route('product', $fav->product->slug) }}" 
                                        class="fs-5 text-success fw-bold text-decoration-none">
                                        {{ $fav->product->name }}
                                    </a>
                                    <p class="mb-0 text-muted small">
                                        {{ count($fav->product->links) }} {{ __('links available') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        
                    @else
                        <p class="text-center text-muted my-4">{{ __('You have no favorite products yet.') }}</p>
                    @endif
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