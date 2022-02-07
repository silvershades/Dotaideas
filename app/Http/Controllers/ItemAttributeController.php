<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemAttributeRequest;
use App\Http\Requests\UpdateItemAttributeRequest;
use App\Models\ItemAttribute;

class ItemAttributeController extends Controller
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
     * @param  \App\Http\Requests\StoreItemAttributeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemAttributeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemAttribute  $itemAttribute
     * @return \Illuminate\Http\Response
     */
    public function show(ItemAttribute $itemAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemAttribute  $itemAttribute
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemAttribute $itemAttribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemAttributeRequest  $request
     * @param  \App\Models\ItemAttribute  $itemAttribute
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemAttributeRequest $request, ItemAttribute $itemAttribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemAttribute  $itemAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemAttribute $itemAttribute)
    {
        //
    }
}
