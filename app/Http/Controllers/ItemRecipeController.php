<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRecipeRequest;
use App\Http\Requests\UpdateItemRecipeRequest;
use App\Models\ItemRecipe;

class ItemRecipeController extends Controller
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
     * @param  \App\Http\Requests\StoreItemRecipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRecipeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemRecipe  $itemRecipe
     * @return \Illuminate\Http\Response
     */
    public function show(ItemRecipe $itemRecipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemRecipe  $itemRecipe
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemRecipe $itemRecipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRecipeRequest  $request
     * @param  \App\Models\ItemRecipe  $itemRecipe
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRecipeRequest $request, ItemRecipe $itemRecipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemRecipe  $itemRecipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemRecipe $itemRecipe)
    {
        //
    }
}
