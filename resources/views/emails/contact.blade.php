@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center fs-4">
                    {{ __('Contact Us') }}
                </div>
                <div class="card-body">
                    <!-- Mensaje de éxito -->
                    @if(session('success'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Formulario de contacto -->
                    <form action="{{ route('contact.submit') }}" method="POST" class="p-3">
                        @csrf
                        <!-- Campo Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input type="text" id="name" name="name" 
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="{{ __('Enter your name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Correo Electrónico -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input type="email" id="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="{{ __('Enter your email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Mensaje -->
                        <div class="mb-3">
                            <label for="message" class="form-label">{{ __('Message') }}</label>
                            <textarea id="message" name="message" 
                                      class="form-control @error('message') is-invalid @enderror" 
                                      rows="5" placeholder="{{ __('Write your message') }}">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botón Enviar -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-4">
                                {{ __('Send Message') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
