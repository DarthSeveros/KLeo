<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Capitulo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Categoria $categoria = null)
    {
        if($categoria === null)
        {
            $obras = Obra::orderBy('fecha_publicacion', 'desc')->with('user')->paginate(12);
            $paginate = true;
        }
        else
        {
            $obras = $categoria->obras;
            $paginate = false;
        }
        Paginator::useBootstrap();

        return view('obras.index', compact('obras', 'paginate', 'categoria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('obras.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'categoria' => [function ($attribute, $value, $fail) {
                $check = Categoria::where('id', $value)->first();
                if (!$check) {
                    $fail(':attribute no encontrada: '.$value); // error massage
                }
              }],
        ]);
        $obra = new Obra();

        $obra->nombre = $request->nombre;
        $obra->descripcion = $request->descripcion;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen')->store('uploads', 'public');
        } else {
            $imagen = 'uploads/no-image-placeholder.svg';
        }

        $obra->imagen = $imagen;
        $obra->user_id = Auth::id();

        $obra->save();
        $obra->categorias()->attach($request->categoria);

        return redirect()->route('obras.show', $obra->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obra = Obra::where('id', $id)->with('user')->first();
        return view('obras.show', compact('obra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obra = Obra::find($id);
        return view('obras.edit', compact('obra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $obra)
    {
        $response = Gate::inspect('update', $obra);
        
        $request->validate([
            'nombre' => 'required',
            'categoria' => [function ($attribute, $value, $fail) {
                $check = Categoria::where('id', $value)->first();
                if (!$check) {
                    $fail(':attribute no encontrada: '.$value); // error massage
                }
              }],
        ]);

        $query = Obra::where('id', $obra)->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
        ]);
        if ($query)
        {
            return redirect(route('obras.show', $obra));
        }
        else
        {
            return ['error' => 'Error al actualizar'];
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function destroy($obra)
    {
        $query = Obra::destroy($obra);
        if ($query)
        {
            return redirect(route('obras.index'));
        }
        else
        {
            return ['error' => 'Error al eliminar'];
        }
    }

    public function follow(Obra $obra)
    {
        $user = Auth::user();

        if ($user->seguidos->contains($obra->id))
        {
            $obra->seguidores()->detach($user->id);
            $obra->decrement('likes',1);
        }
        else
        {
            $obra->seguidores()->attach($user->id);
            $obra->increment('likes',1);
        }
        return back();
    }

    public function following()
    {
        $obras = Auth::user()->seguidos;
        return view('obras.follow', compact('obras'));
    }
}
