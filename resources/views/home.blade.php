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

                    @if (count($user->favorites)>0)
                        <h4 class="m-2">{{ __('Your products') }}</h4> 
                    @endif
                    @foreach ($user->favorites as $fav)
                        <div class="d-flex mt-2 p-2">                           
                            <img src="{{ $fav->product->image_url }}" alt="{{ $fav->product->name }}" class="img-fluid img-thumbnail" style="width: 80px; height: 80px"/>
                            <div>
                                <a href="{{ route('product', $fav->product->slug) }}" class="fs-4 p-3 text-success link-underline link-underline-opacity-0">{{ $fav->product->name }}</a>                                                            
                                <div class="px-3">{{ count($fav->product->links) }} enlaces</div>
                            </div>
                        </div>                
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
