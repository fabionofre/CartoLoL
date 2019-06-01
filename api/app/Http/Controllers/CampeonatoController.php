<?php

namespace App\Http\Controllers;

use App\Campeonato;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Rodada;

class CampeonatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Campeonato::with(['rodadas'])->get();
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

        return [
            "campeonato" => $campeonato,
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
        $campeonato->estado = $request->estado;
        if($request->rodada_atual_id != 'null'){
            $campeonato->rodada_atual_id = $request->rodada_atual_id;
        }

        if (isset($request->brasao)) {
            $campeonato->brasao = $request->brasao->getClientOriginalName();
            $request->brasao->storeAs('public', $request->brasao->getClientOriginalName());
        }

        foreach($campeonato->rodadas as $rodada) {
            $rodada->campeonato()->dissociate()->save();
        }   

        if(is_string($request->rodadas))
        {
            $request->rodadas = explode(",",$request->rodadas);
            foreach($request->rodadas as $rodada){
                $rodada_temp = Rodada::find($rodada);
                $temp = $rodada_temp->campeonato()->associate($id)->save();
            }
        }



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

    public function passarRodada($campId)
    {

        $campeonato = Campeonato::find($campId);

        $nova_rodada = Rodada::where('num_rodada', $campeonato->rodada_atual_id + 1)->first();

        $campeonato->rodada_atual_id = $nova_rodada->id;

        $campeonato->save();

        return ["message" => "Rodada passada com sucesso!", "nova_rodada"=>$nova_rodada];
    }
}
