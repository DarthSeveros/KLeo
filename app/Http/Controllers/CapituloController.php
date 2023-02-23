<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use App\Models\Obra;
use Illuminate\Http\Request;

class CapituloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($obra)
    {
        return view('capitulos.create', compact('obra'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $obra)
    {
        $request->validate([
            'nombre' => 'required',
        ]);
        $capitulo = new Capitulo();

        $capitulo->nombre = $request->nombre;
        $capitulo->obra_id = $obra;

        $capitulo->save();

        Obra::find($obra)->increment('capitulos', 1);

        return redirect()->route('capitulos.show', $capitulo);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Capitulo  $capitulo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $capitulo = Capitulo::find($id);

        return view('capitulos.show', compact('capitulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Capitulo  $capitulo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $capitulo = Capitulo::find($id);
        return view('capitulos.edit', compact('capitulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Capitulo  $capitulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $capitulo)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        $query = Capitulo::where('id', $capitulo)->update([
            'nombre' => $request->nombre,
        ]);

        if ($query)
        {
            return redirect(route('obras.show', Capitulo::find($capitulo)->obra_id));
        }
        else
        {
            return ['error' => 'Error al actualizar'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Capitulo  $capitulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capitulo $capitulo)
    {
        $query = Capitulo::destroy($capitulo->id);
        if ($query)
        {
            Obra::find($capitulo->obra_id)->decrement('capitulos', 1);
            return redirect(route('obras.show', $capitulo->obra_id));
        }
        else
        {
            return ['error' => 'Error al eliminar'];
        }
    }
}
