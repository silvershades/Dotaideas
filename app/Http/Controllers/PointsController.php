<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePointsRequest;
use App\Http\Requests\UpdatePointsRequest;
use App\Models\Points;

class PointsController extends Controller
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
     * @param  \App\Http\Requests\StorePointsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePointsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Points  $points
     * @return \Illuminate\Http\Response
     */
    public function show(Points $points)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Points  $points
     * @return \Illuminate\Http\Response
     */
    public function edit(Points $points)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePointsRequest  $request
     * @param  \App\Models\Points  $points
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePointsRequest $request, Points $points)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Points  $points
     * @return \Illuminate\Http\Response
     */
    public function destroy(Points $points)
    {
        //
    }
}
