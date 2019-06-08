<?php

namespace App\Http\Controllers;

use App\Escalacao;
use App\Campeonato;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class EscalacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escalacoes = Escalacao::with(['topo', 'meio', 'cacador', 'atirador', 'suporte', 'invocador'])->get();

        return $escalacoes;
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
        $campeonato = Campeonato::find(1)->first();
        $escalacao = Escalacao::where('invocador_id', $request['invocador_id'])->where('rodada_id', $campeonato->rodada_atual_id)->first();

        $patrimonio = $request['patrimonio'];

        $user = User::find($request['invocador_id']);
        $user->patrimonio = $patrimonio;
        $user->save();

        unset($request['patrimonio']);

        $requestData = $request->all();

        // $requestData['rodada_id'] = $rodada_atual['id'];

        if($escalacao){
            //dd("Não pode mais kra");
            $esc = Escalacao::find($escalacao->id);

            $esc->fill($requestData);

            $esc->save();

            return $esc;
        }

        $escalacao = Escalacao::create($requestData);

        return $escalacao;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Escalacao  $escalacao
     * @return \Illuminate\Http\Response
     */
    public function show($invocador_id)
    {
        $campeonato = Campeonato::find(1)->first();
        $escalacao = Escalacao::with(['topo', 'meio', 'cacador', 'atirador', 'suporte'])->where('invocador_id', $invocador_id)->where('rodada_id', $campeonato->rodada_atual_id)->first();

        return $escalacao;
    }

    public function minhasEscalacoes($invocador_id)
    {
        $escalacao = Escalacao::with(['topo', 'meio', 'cacador', 'atirador', 'suporte'])->where('invocador_id', $invocador_id)->get();

        return $escalacao;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Escalacao  $escalacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Escalacao $escalacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Escalacao  $escalacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Escalacao $escalacao)
    {
        //dd("Não pode mais kra");
        $escalacao = Escalacao::find($id);

        $patrimonio = $request['patrimonio'];

        $user = User::find($request['invocador_id']);
        $user->patrimonio = $patrimonio;
        $user->save();

        unset($request['patrimonio']);

        $escalacao->fill($request->all());

        $escalacao->save();

        return $escalacao;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Escalacao  $escalacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Escalacao $escalacao)
    {
        //
    }
}
