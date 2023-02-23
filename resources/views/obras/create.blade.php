@extends('layouts.template')

@section('title', "Nueva Obra")

@section('content')
    <div class="container my-5">
        <h1 class="font-weight-bold mb-5">Crear nueva obra</h1>
        <form action="{{ route('obras.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4 mb-3 mb-3">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror">
                <div class="invalid-feedback">
                    Por favor ingresa el nombre de la obra.
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label>Descripción:</label>    
                <textarea name="descripcion" id="" cols="30" rows="5" class="form-control"></textarea>
                
            </div>
            
            <div class="col-md-4 mb-3">
                <label>Categoria:</label>
                <select type="text" name="categoria" class="custom-select @error('categoria') is-invalid @enderror">
                    <option selected>Seleccione...</option>
                    @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    @error('categoria')
                        {{$message}}
                    @enderror
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="imageFile">Imagen:</label>
                <label class="custom-file-label" for="imageFile">Seleccionar imagen...</label>
                <input type="file" name="imagen" id="imageFile" class="custom-file-input">
            </div>

            <div class="col-md-4" style="height:200px;">
                <img src="{{ asset('storage'.'/uploads/no-image-placeholder.svg') }}" alt="" id="image" height="200">
            </div>

            <div class="col-md-4 my-3">
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
            
        </form>
        
        <script>
            document.getElementById("imageFile").addEventListener('change', 
            function(event){
                let file = event.target.files[0];
                document.querySelector(".custom-file-label").textContent = file.name;
                document.getElementById("image").src = URL.createObjectURL(file);
            });
        </script>
    </div>
@endsection