<?php

namespace App\Http\Controllers;

use App\RegraPontuacao;
use Illuminate\Http\Request;

class RegraPontuacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $regras = RegraPontuacao::where('campeonato_id', $request->campeonato_id)->get();

        return $regras;
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
        $RegraPontuacao = RegraPontuacao::create($request->all());
        return ["regra_pontuacao"=>$RegraPontuacao];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegraPontuacao  $regraPontuacao
     * @return \Illuminate\Http\Response
     */
    public function show(RegraPontuacao $regraPontuacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegraPontuacao  $regraPontuacao
     * @return \Illuminate\Http\Response
     */
    public function edit(RegraPontuacao $regraPontuacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegraPontuacao  $regraPontuacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegraPontuacao $regraPontuacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegraPontuacao  $regraPontuacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegraPontuacao $regraPontuacao)
    {
        //
    }
}
