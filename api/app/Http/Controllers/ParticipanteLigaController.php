<?php

namespace App\Http\Controllers;

use App\ParticipanteLiga;
use Illuminate\Http\Request;

class ParticipanteLigaController extends Controller
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
        $participanteLiga = ParticipanteLiga::create($request->all());
        return ["participante_liga"=>$participanteLiga];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ParticipanteLiga  $participanteLiga
     * @return \Illuminate\Http\Response
     */
    public function show(ParticipanteLiga $participanteLiga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ParticipanteLiga  $participanteLiga
     * @return \Illuminate\Http\Response
     */
    public function edit(ParticipanteLiga $participanteLiga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ParticipanteLiga  $participanteLiga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParticipanteLiga $participanteLiga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ParticipanteLiga  $participanteLiga
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParticipanteLiga $participanteLiga)
    {
        //
    }
}
