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
    public function index()
    {
        return Atleta::with('equipe')->get();
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
        $atleta = Atleta::create($request->all());
        return ["message"=>"Atleta criado com sucesso!", "atleta"=>$atleta];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Atleta  $atleta
     * @return \Illuminate\Http\Response
     */
    public function show(Atleta $atleta)
    {
        //
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
    public function update(Request $request, Atleta $atleta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Atleta  $atleta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atleta $atleta)
    {
        //
    }
}
