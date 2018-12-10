<?php

namespace App\Http\Controllers;

use App\Campeonato;
use App\Pontuacao;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PontuacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pontuacao::with(['atleta', 'rodada'])->get();
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

        $pontuacao = new Pontuacao;
        $pontuacao->atleta_id = $request['atleta_id'];
        $pontuacao->acao_id = $request['acao_id'];
        $pontuacao->rodada_id = $rodada_atual['id'];
        $pontuacao->quantidade = $request['quantidade'];

        $pontuacao->save();

        return ["pontuacao" => $pontuacao];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function minhaPontuacao($usuario_id){
        $user = User::find($usuario_id);

        
        
    }
}
