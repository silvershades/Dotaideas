<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserCoinsRequest;
use App\Http\Requests\UpdateUserCoinsRequest;
use App\Models\UserCoins;

class UserCoinsController extends Controller
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
     * @param  \App\Http\Requests\StoreUserCoinsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserCoinsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserCoins  $userCoins
     * @return \Illuminate\Http\Response
     */
    public function show(UserCoins $userCoins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserCoins  $userCoins
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCoins $userCoins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserCoinsRequest  $request
     * @param  \App\Models\UserCoins  $userCoins
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserCoinsRequest $request, UserCoins $userCoins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserCoins  $userCoins
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCoins $userCoins)
    {
        //
    }
}
