<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemShopRequest;
use App\Http\Requests\UpdateItemShopRequest;
use App\Models\ItemShop;

class ItemShopController extends Controller
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
     * @param  \App\Http\Requests\StoreItemShopRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemShopRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemShop  $itemShop
     * @return \Illuminate\Http\Response
     */
    public function show(ItemShop $itemShop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemShop  $itemShop
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemShop $itemShop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemShopRequest  $request
     * @param  \App\Models\ItemShop  $itemShop
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemShopRequest $request, ItemShop $itemShop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemShop  $itemShop
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemShop $itemShop)
    {
        //
    }
}
