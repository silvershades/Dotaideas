<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoinsRequest;
use App\Http\Requests\UpdateCoinsRequest;
use App\Models\Coins;

class CoinsController extends Controller
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
     * @param  \App\Http\Requests\StoreCoinsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoinsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coins  $coins
     * @return \Illuminate\Http\Response
     */
    public function show(Coins $coins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coins  $coins
     * @return \Illuminate\Http\Response
     */
    public function edit(Coins $coins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCoinsRequest  $request
     * @param  \App\Models\Coins  $coins
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoinsRequest $request, Coins $coins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coins  $coins
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coins $coins)
    {
        //
    }
}
