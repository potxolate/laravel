@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    @if (count($user->favorites)>0)
                        <h4 class="m-2">Tus productos :</h4> 
                    @endif
                    @foreach ($user->favorites as $fav)
                        <p class="h5 m-2">                            
                            <a href="{{ route('product', $fav->product->slug) }}" class="small">{{ $fav->product->name }}</a> 
                        </p>                
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
