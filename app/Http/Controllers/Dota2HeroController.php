<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDota2HeroRequest;
use App\Http\Requests\UpdateDota2HeroRequest;
use App\Models\Dota2Hero;

class Dota2HeroController extends Controller
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
     * @param  \App\Http\Requests\StoreDota2HeroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDota2HeroRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dota2Hero  $dota2Hero
     * @return \Illuminate\Http\Response
     */
    public function show(Dota2Hero $dota2Hero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dota2Hero  $dota2Hero
     * @return \Illuminate\Http\Response
     */
    public function edit(Dota2Hero $dota2Hero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDota2HeroRequest  $request
     * @param  \App\Models\Dota2Hero  $dota2Hero
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDota2HeroRequest $request, Dota2Hero $dota2Hero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dota2Hero  $dota2Hero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dota2Hero $dota2Hero)
    {
        //
    }
}
