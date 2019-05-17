<?php

namespace App\Http\Controllers;

use App\Atleta;
use Illuminate\Http\Request;

class AtletaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Atleta::with(['equipe', 'funcao'])->where('nome', 'like','%'.$request->s.'%')->orWhere('apelido', 'like','%'.$request->s.'%')->orWhere('sobrenome', 'like','%'.$request->s.'%')->get();
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
        $atleta = new Atleta;
        $atleta->nome = $request['nome'];
        $atleta->sobrenome = $request['sobrenome'];
        $atleta->apelido = $request['apelido'];
        $atleta->criador_id = 1;
        $atleta->equipe_id = $request['equipe_id'];
        $atleta->data_nascimento = $request['data_nascimento'];
        $atleta->funcao_id = $request['funcao_id'];
        $atleta->foto = $request->foto->getClientOriginalName();

        if ($request->foto->isValid()) {
            $request->foto->storeAs('public', $request->foto->getClientOriginalName());
            $atleta->save();
            return ["message"=>"Atleta criado com sucesso!", "atleta"=>$atleta];
        }

        return ["message"=>"Foto inválida!", "atleta"=>$atleta];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atleta  $atleta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $atleta = Atleta::find($id);
        
        return $atleta;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atleta  $atleta
     * @return \Illuminate\Http\Response
     */
    public function edit(Atleta $atleta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Atleta  $atleta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $atleta = Atleta::find($id);
        $atleta->nome = $request['nome'];
        $atleta->sobrenome = $request['sobrenome'];
        $atleta->apelido = $request['apelido'];
        $atleta->criador_id = 1;
        $atleta->equipe_id = $request['equipe_id'];
        $atleta->data_nascimento = $request['data_nascimento'];

        if (isset($request->foto)) {
            $atleta->foto = $request->foto->getClientOriginalName();
            $request->foto->storeAs('public', $request->foto->getClientOriginalName());
        }

        $atleta->save();
        return ["message"=>"Atleta editado com sucesso!", "atleta"=>$atleta];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atleta  $atleta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $atleta = Atleta::find($id);

        $atleta->delete();

        return ["message" => "Atleta deletado com sucesso!", "atleta"=>$atleta];
    }
}
