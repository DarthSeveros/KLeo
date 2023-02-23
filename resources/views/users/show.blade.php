@extends('layouts.template')

@section('title', $user->name)

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col">
                <img src="{{ asset('storage'.'/uploads/no-image-placeholder.svg') }}" alt="" width="500px">
            </div>
            <div class="col">
                <h1 class="font-weight-bold">{{ $user->name }}</h1>
                <h4>{{ $user->name }}</h4>
            </div>
        </div>
        
        
    </div>
    <div class="container">
        <a href="{{ route('obras.index') }}">Volver</a>
    </div>
    <div class="container">
        <h4>Obras</h4>
        @if (Route::has('login'))
                <div>
                    @auth
                    <a href="{{ route('obras.create') }}">Agregar obra</a>
                    @endauth
                </div>
                @endif
        <div class="row col d-flex justify-content-center">
            @foreach ($user->obra as $obra)
            <div class="card my-5 mx-3" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('storage').'/'.$obra->imagen }}" alt="Card image cap">
                <div class="card-body">
                    <a href="{{ route('obras.show', $obra->id) }}">
                        <h5 class="card-title">{{  $obra->nombre  }}</h5>
                    </a>
                    <p class="card-text d-flex flex-row align-items-center">
                        <div class="d-block">
                            <a href="{{ route('users.show', $obra->user) }}" >{{  $obra->user->name  }}</a>
                        </div>
                        <button class="btn">
                            <div class="d-flex flex-row align-items-center">
                                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                </svg>
                                {{  $obra->likes  }}
                            </div>
                        </button>
                        <button class="btn">
                            <div class="d-flex flex-row align-items-center">
                                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg>
                                {{ $obra->capitulos  }}
                            </div>
                        </button>
                    </p>
                    <div class="alert alert-dark d-inline-block mb-0" role="alert">
                        {{ $obra->categorias[0]->nombre }}
                    </div>
                    
                </div>
            </div>    
            @endforeach
        </div>
    </div>
    <div>
        
    </div>
@endsection