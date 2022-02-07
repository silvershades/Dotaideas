<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreepRequest;
use App\Http\Requests\UpdateCreepRequest;
use App\Models\Creep;

class CreepController extends Controller
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
        return view("creep.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCreepRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreepRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Creep  $creep
     * @return \Illuminate\Http\Response
     */
    public function show(Creep $creep)
    {
        return view("creep.show" ,compact('creep'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Creep  $creep
     * @return \Illuminate\Http\Response
     */
    public function edit(Creep $creep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreepRequest  $request
     * @param  \App\Models\Creep  $creep
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreepRequest $request, Creep $creep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Creep  $creep
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creep $creep)
    {
        //
    }
}
