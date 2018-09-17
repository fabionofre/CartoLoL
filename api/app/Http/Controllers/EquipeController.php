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
    public function index()
    {
        return Equipe::with('atletas')->get();
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
        $equipe = Equipe::create($request->all());
        return ["message"=>"Equipe criada com sucesso!", "equipe"=>$equipe];
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

        // dd($request['atletas']);

        $equipe->brasao = $request['brasao'];
        $equipe->criador_id = $request['criador_id'];
        $equipe->fl_profissional = $request['fl_profissional'];
        $equipe->nome = $request['nome'];

        $atletas = Atleta::where('equipe_id', $id)->get()->toArray();

        $zerar_relacionamentos = array_map(function($atleta) {
            $a = Atleta::find($atleta['id']);
            $a->equipe_id = null; 
            $a->save();
            return $a;
        }, $atletas);


        $atletas_relacionar = array_map(function ($atleta) {
            $a = Atleta::find($atleta);
            return $a; 
        }, $request['atletas']);


        $equipe->atletas()->saveMany($atletas_relacionar);

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
