<?php

namespace App\Http\Controllers;

use App\Liga;
use Illuminate\Http\Request;

class LigaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ligas = Liga::with(['participantes', 'campeonato', 'criador'])->get();
        return $ligas;
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
        $liga = new Liga;
        $liga->desc = $request->desc;
        $liga->brasao = $request->brasao->getClientOriginalName();
        $liga->criador_id = $request->criador_id;
        $liga->campeonato_id = $request->campeonato_id;

        if ($request->brasao->isValid()) {
            $request->brasao->storeAs('public', $request->brasao->getClientOriginalName());
            $liga->save();
            return ["message"=>"Liga criada com sucesso!", "liga"=>$liga];
        }

        return ["message"=>"Brasão inválido!", "liga"=>$liga];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Liga  $liga
     * @return \Illuminate\Http\Response
     */
    public function show(Liga $liga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Liga  $liga
     * @return \Illuminate\Http\Response
     */
    public function edit(Liga $liga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Liga  $liga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $liga = Liga::find($id);
        $liga->desc = $request->desc;
        $liga->criador_id = 1;
        $liga->campeonato_id = $request->campeonato_id;

        if (isset($request->brasao)) {
            $liga->brasao = $request->brasao->getClientOriginalName();
            $request->brasao->storeAs('public', $request->brasao->getClientOriginalName());
        }

        $liga->save();

        return ["message"=>"Liga modificada com sucesso!", "liga"=>$liga];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Liga  $liga
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $liga = Liga::find($id);

        $liga->delete();

        return ["message" => "Liga deletada com sucesso!", "liga"=>$liga];
    }
}
