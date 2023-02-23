@extends('layouts.template')

@section('title', 'Editar '.$obra->nombre)

@section('content')
    <div class="container my-5">
        <form action="{{ route('obras.update', $obra) }}" method="POST">

            @csrf

            @method('patch')

            <div class="row">
                <label for="">
                    Nombre:
                    <input type="text" name="nombre" value="{{ $obra->nombre }}" style="width: 500px">
                </label>
            </div>
            <div class="row">
                <label for="">
                    Descripción:
                    <textarea name="descripcion" id="" cols="40" rows="5">{{ $obra->descripcion }}</textarea>
                </label>
            </div>
            <div>
                <label for="">
                    Imagen:
                    <input type="text" name="imagen" value="{{ $obra->imagen }}">
                </label>
            </div>
            <div class="row">
                <button class="btn btn-primary" type="submit">Eviar</button>
            </div>
        </form>
    </div>
@endsection
