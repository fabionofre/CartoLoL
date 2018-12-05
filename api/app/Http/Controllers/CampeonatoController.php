<?php

namespace App\Http\Controllers;

use App\Campeonato;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $campeonato = new Campeonato;
        $campeonato->titulo = $request->titulo;
        $campeonato->desc = $request->desc;
        $campeonato->data_inicio = $request->data_inicio;
        $campeonato->data_fim = $request->data_fim;
        $campeonato->brasao = $request->brasao->getClientOriginalName();
        $campeonato->fl_profissional = $request->fl_profissional;
        $campeonato->fl_publico = $request->fl_publico;
        $campeonato->criador_id = 1;
        


        if ($request->brasao->isValid()) {
            $request->brasao->storeAs('public', $request->brasao->getClientOriginalName());
            $campeonato->save();
            return ["message"=>"Campeonato criado com sucesso!", "campeonato"=>$campeonato];
        }

        return ["message"=>"Brasão inválido!", "campeonato"=>$campeonato];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Campeonato  $campeonato
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $campeonato = Campeonato::find($id);
        $rodadas = $campeonato->rodadas;

        $today = new Carbon();

        foreach($campeonato->rodadas as $rodada){
            $date_rodada = new Carbon($rodada->data);
            if($date_rodada->greaterThan($today)){
                $rodada_atual = $rodada;
                break;
            }
        }

        $rodada_atual['diferenca_horas_hoje'] = $today->diffInHours($rodada_atual->data);  


        return [
            "campeonato" => $campeonato,
            "rodadas" => $rodadas,
            "rodada_atual" => $rodada_atual
        ];

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
    public function update(Request $request, $id)
    {
        $campeonato = Campeonato::find($id);

        $campeonato->criador_id = 1;
        $campeonato->data_inicio = $request->data_inicio;
        $campeonato->data_fim = $request->data_fim;
        $campeonato->desc = $request->desc;
        $campeonato->fl_profissional = $request->fl_profissional;
        $campeonato->fl_publico = $request->fl_publico;
        $campeonato->titulo = $request->titulo;

        if (isset($request->brasao)) {
            $campeonato->brasao = $request->brasao->getClientOriginalName();
            $request->brasao->storeAs('public', $request->brasao->getClientOriginalName());
        }

        $equipes = array();

        if(is_string($request->equipes))
        {
            $request->equipes = explode(",",$request->equipes);
        }


        $campeonato->equipes()->sync($request->equipes);

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
