@extends('layouts.template')

@section('title', 'Editar '.$capitulo->nombre)

@section('content')
    <div class="container my-5">
            <form action="{{ route('capitulos.update', $capitulo) }}" method="POST">
                
                @csrf

                @method('patch')
                
                <div class="col-md-4 mb-3">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ $capitulo->nombre }}">
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
        </form>
    </div>
@endsection
