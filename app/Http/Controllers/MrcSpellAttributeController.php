<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMrcSpellAttributeRequest;
use App\Http\Requests\UpdateMrcSpellAttributeRequest;
use App\Models\MrcSpellAttribute;

class MrcSpellAttributeController extends Controller
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
     * @param  \App\Http\Requests\StoreMrcSpellAttributeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMrcSpellAttributeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MrcSpellAttribute  $mrcSpellAttribute
     * @return \Illuminate\Http\Response
     */
    public function show(MrcSpellAttribute $mrcSpellAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MrcSpellAttribute  $mrcSpellAttribute
     * @return \Illuminate\Http\Response
     */
    public function edit(MrcSpellAttribute $mrcSpellAttribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMrcSpellAttributeRequest  $request
     * @param  \App\Models\MrcSpellAttribute  $mrcSpellAttribute
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMrcSpellAttributeRequest $request, MrcSpellAttribute $mrcSpellAttribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MrcSpellAttribute  $mrcSpellAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(MrcSpellAttribute $mrcSpellAttribute)
    {
        //
    }
}
