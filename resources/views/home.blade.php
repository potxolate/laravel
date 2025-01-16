@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center fs-5">
                    {{ __('Dashboard') }}
                </div>
                <div class="card-body">
                    <!-- Mensaje de estado -->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Lista de favoritos -->
                    @if ($user->favorites->isNotEmpty())
                        <h4 class="mt-3 mb-4">{{ __('Your Products') }}</h4>
                        <div class="list-group">
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
                        </div>
                    @else
                        <p class="text-center text-muted my-4">{{ __('You have no favorite products yet.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

