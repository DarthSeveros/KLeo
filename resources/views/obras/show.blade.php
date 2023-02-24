@extends('layouts.template')

@section('title', $obra->nombre)

@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col">
                <img src="{{ asset('storage'.'/'.$obra->imagen) }}" alt="" width="500px">
            </div>
            <div class="col">
                <h1 class="font-weight-bold">{{ $obra->nombre }}</h1>
                <h3>{{ $obra->descripcion }}</h3>
                <h4>{{ $obra->user->name }}</h4>
                <div class="d-flex flex-row align-items-center">
                    <h4>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                        </svg>
                        {{ explode(' ',$obra->fecha_publicacion)[0] }}
                    </h4>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <h4>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>
                        {{  $obra->likes  }}
                    </h4>
                </div>
                <div class="alert alert-dark d-inline-block mb-0" role="alert">
                    {{ $obra->categorias[0]->nombre }}
                </div>
                @if (Route::has('login'))
                <div class="row my-3 ml-1">
                    @auth
                    <a class="btn btn-primary mr-3" href="{{ route('obras.edit', $obra) }}">Editar</a>
                    <form action="{{ route('obras.delete', $obra) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-outline-danger" type="submit">Eliminar</button>
                    </form>
                    @endauth
                </div>
                @endif
                

            </div>
        </div>
        
        
    </div>
    <div class="container">
        <a class="btn btn-outline-primary" href="{{ route('obras.index') }}">Volver</a>
    </div>
    <div class="container">
        <h4>Capítulos</h4>
        @if (Route::has('login'))
                <div>
                    @auth
                    <a href="{{ route('capitulos.create', $obra) }}">Agregar capítulo</a>
                    @endauth
                </div>
                @endif
        <ul class="list-group flex-column my-5">
            @for ($i = 0; $i < count($obra->capitulo); $i++)
            <li class="list-group-item">
                <a href="{{ route('capitulos.show', $obra->capitulo[$i]->id) }}">Capítulo {{ $i + 1 }} {{ $obra->capitulo[$i]->nombre }}</a>    
            </li>    
            @endfor
        </ul>
    </div>
    <div>
        
    </div>
@endsection