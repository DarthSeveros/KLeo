@extends('layouts.template')

@section('title', "Nuevo capítulo")

@section('content')
    <div class="container">
        <h1 class="font-weight-bold my-5">Crear nuevo capítulo</h1>
        <form action="{{ route('capitulos.store', $obra) }}" method="POST">
            @csrf
            <div class="col-md-4 mb-3">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror">
                @error('nombre')
                <div class="invalid-feedback">
                    Por favor ingresa un nombre.
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
        </form>
    </div>
@endsection