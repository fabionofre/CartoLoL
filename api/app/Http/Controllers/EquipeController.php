<?php

namespace App\Http\Controllers;

use App\Equipe;
use App\Atleta;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Equipe::with('atletas')->where('nome', 'like','%'.$request->s.'%')->get();
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

        $equipe = new Equipe;
        $equipe->nome = $request->nome;
        $equipe->brasao = $request->brasao->getClientOriginalName();
        $equipe->fl_profissional = $request->fl_profissional;
        $equipe->criador_id = 1;

        if ($request->brasao->isValid()) {
            $request->brasao->storeAs('public', $request->brasao->getClientOriginalName());
            $equipe->save();
            return ["message"=>"Equipe criada com sucesso!", "equipe"=>$equipe];
        }

        return ["message"=>"Brasão da equipe inválido!", "equipe"=>$equipe];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function show(Equipe $equipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipe $equipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $equipe = Equipe::find($id);

        $equipe->criador_id = 1;
        $equipe->fl_profissional = $request['fl_profissional'];
        $equipe->nome = $request['nome'];

        if (isset($request->brasao)) {
            $equipe->brasao = $request->brasao->getClientOriginalName();
            $request->brasao->storeAs('public', $request->brasao->getClientOriginalName());
        }

        // $atletas = array();

        // if(is_string($request['atletas']))
        // {
        //     $request['atletas'] = explode(",",$request['atletas']);
        // }

        // $atletas_equipe = $equipe->atletas()->get()->toArray();

        // if(is_array($atletas_equipe)){
        //     foreach($atletas_equipe as $atleta){
        //         $x = Atleta::find($atleta['id']);
        //         $x->equipe_id = null;
        //         $x->save();
        //     }
        // }

        // if(is_array($request['atletas'])){
        //     foreach($request['atletas'] as $a){
        //         $aux = Atleta::find($a);
        //         $atletas[] = $aux;
        //     }
        // }

        // $equipe->atletas()->saveMany($atletas);

        $equipe->save();

        return ["message"=>"Equipe modificada com sucesso!", "equipe"=>$equipe];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipe  $equipe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   

        $equipe = Equipe::find($id);

        $equipe->delete();

        return ["message" => "Equipe deletada com sucesso!", "equipe"=>$equipe];
    }
}
