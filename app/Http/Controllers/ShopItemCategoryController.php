<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopItemCategoryRequest;
use App\Http\Requests\UpdateShopItemCategoryRequest;
use App\Models\ShopItemCategory;

class ShopItemCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreShopItemCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopItemCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShopItemCategory  $shopItemCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ShopItemCategory $shopItemCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShopItemCategory  $shopItemCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopItemCategory $shopItemCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShopItemCategoryRequest  $request
     * @param  \App\Models\ShopItemCategory  $shopItemCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopItemCategoryRequest $request, ShopItemCategory $shopItemCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShopItemCategory  $shopItemCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopItemCategory $shopItemCategory)
    {
        //
    }
}
