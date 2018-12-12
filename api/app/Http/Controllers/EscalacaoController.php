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
        //
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
        $escalacao = Escalacao::where('invocador_id', $request['invocador_id'])->first();

        $patrimonio = $request['patrimonio'];

        $user = User::find($request['invocador_id']);
        $user->patrimonio = $patrimonio;
        $user->save();

        unset($request['patrimonio']);

        $campeonato = Campeonato::find(1);
        $rodadas = $campeonato->rodadas;

        $today = new Carbon();

        foreach($campeonato->rodadas as $rodada){
            $date_rodada = new Carbon($rodada->data);
            if($date_rodada->greaterThan($today)){
                $rodada_atual = $rodada;
                break;
            }
        }

        $requestData = $request->all();

        $requestData['rodada_id'] = $rodada_atual['id'];

        if($escalacao){
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
        $escalacao = Escalacao::with(['topo', 'meio', 'cacador', 'atirador', 'suporte'])->where('invocador_id', $invocador_id)->first();

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
