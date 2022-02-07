<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopItemRequest;
use App\Http\Requests\UpdateShopItemRequest;
use App\Models\ShopItem;

class ShopItemController extends Controller
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
     * @param  \App\Http\Requests\StoreShopItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopItem  $shopItem
     * @return \Illuminate\Http\Response
     */
    public function show(ShopItem $shopItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopItem  $shopItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopItem $shopItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShopItemRequest  $request
     * @param  \App\Models\ShopItem  $shopItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopItemRequest $request, ShopItem $shopItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopItem  $shopItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopItem $shopItem)
    {
        //
    }
}
