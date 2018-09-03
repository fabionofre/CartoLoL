<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campeonatos;
use Validator;

class CampeonatosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campeonato = campeonatos::all();
        return response()->json($campeonato);
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
        $validator = validator::make($request->all(), [
            'text' => 'required'
        ]);

        if($validator->falls()){
            $response = array('response' => $validator->messages(), 'Sucesso' =>false);
            return $response;
        }else {
            $campeonato = new Campeonato;
            $campeonato = $request->input('text');
            $campeonato->body = $request->input('body');
            $campeonato->save();

            return response()->json($campeonato);
        }
        //$this->validate($request), [
        //    'text' => 'required'
       // ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campeonato = Campeonatos::find($id);
        return response()->json($campeonato);
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
}
