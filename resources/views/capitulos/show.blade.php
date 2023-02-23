@extends('layouts.template')

@section('title')

@section('content')
    <div class="container">
        <h1 class="font-weight-bold my-5">{{ $capitulo->nombre }}</h1>
        @if (Route::has('login'))
                <div class="row col-md-4">
                    @auth
                    <a class="btn btn-primary mr-3" href="{{ route('capitulos.edit', $capitulo) }}">Editar</a>
                    <form action="{{ route('capitulos.delete', $capitulo) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-outline-danger" type="submit">Eliminar</button>
                    </form>
                    @endauth
                </div>
        @endif
        <a class="btn btn-outline-primary my-5" href="{{ route('obras.show', $capitulo->obra_id) }}">Volver</a>
    </div>
@endsection