<?php

namespace App\Http\Controllers;

use App\Rodada;
use Illuminate\Http\Request;

class RodadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Rodada::with('partidas')->where('descricao', 'like','%'.$request->s.'%')->
        where('estado', 'em_criacao')->get();
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
        $rodada = new Rodada;
        $rodada->num_rodada = $request->num_rodada;
        $rodada->descricao = $request->descricao;
        $rodada->campeonato_id = $request->campeonato_id;
        $rodada->estado = 1;

        $rodada->save();
        return ["message"=>"Equipe criada com sucesso!", "equipe"=>$equipe];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rodada  $rodada
     * @return \Illuminate\Http\Response
     */
    public function show(Rodada $rodada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rodada  $rodada
     * @return \Illuminate\Http\Response
     */
    public function edit(Rodada $rodada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rodada  $rodada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rodada $rodada)
    {
        $rodada = Rodada::find($id);

        $rodada->descricao = $request['descricao'];
        $rodada->campeonato_id = $request['campeonato_id'];
        $rodada->estado = $request['estado'] ?? 1;

        $rodada->save();

        return ["message"=>"Rodada modificada com sucesso!", "rodada"=>$rodada];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rodada  $rodada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rodada $rodada)
    {
        $rodada = Rodada::find($id);

        $rodada->delete();

        return ["message" => "Rodada deletada com sucesso!", "rodada"=>$rodada];
    }
}
