<?php

namespace App\Http\Controllers;

use App\Campeonato;
use Illuminate\Http\Request;

class CampeonatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Campeonato::with('equipes.atletas')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $campeonato = Campeonato::create($request->all());
        return ["message"=>"Campeonato criado com sucesso!", "campeonato"=>$campeonato];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campeonato  $campeonato
     * @return \Illuminate\Http\Response
     */
    public function show(Campeonato $campeonato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Campeonato  $campeonato
     * @return \Illuminate\Http\Response
     */
    public function edit(Campeonato $campeonato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Campeonato  $campeonato
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $campeonato = Campeonato::find($id);

        $campeonato->brasao = $request['brasao'];
        $campeonato->criador_id = $request['criador_id'];
        $campeonato->data_inicio = $request['data_inicio'];
        $campeonato->data_fim = $request['data_fim'];
        $campeonato->desc = $request['desc'];
        $campeonato->fl_profissional = $request['fl_profissional'];
        $campeonato->fl_publico = $request['fl_publico'];
        $campeonato->titulo = $request['titulo'];

        $campeonato->equipes()->sync($request['equipes']);

        $campeonato->save();

        return ["message"=>"Campeonato modificado com sucesso!", "campeonato"=>$campeonato];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Campeonato  $campeonato
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campeonato = Campeonato::find($id);

        $campeonato->delete();

        return ["message" => "Campeonato deletado com sucesso!", "campeonato"=>$campeonato];
    }
}
