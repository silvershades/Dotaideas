<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreepTypeRequest;
use App\Http\Requests\UpdateCreepTypeRequest;
use App\Models\CreepType;

class CreepTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreCreepTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreepTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CreepType  $creepType
     * @return \Illuminate\Http\Response
     */
    public function show(CreepType $creepType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CreepType  $creepType
     * @return \Illuminate\Http\Response
     */
    public function edit(CreepType $creepType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCreepTypeRequest  $request
     * @param  \App\Models\CreepType  $creepType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreepTypeRequest $request, CreepType $creepType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CreepType  $creepType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CreepType $creepType)
    {
        //
    }
}
