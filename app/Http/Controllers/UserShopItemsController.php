<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserShopItemsRequest;
use App\Http\Requests\UpdateUserShopItemsRequest;
use App\Models\UserShopItems;

class UserShopItemsController extends Controller
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
     * @param  \App\Http\Requests\StoreUserShopItemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserShopItemsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserShopItems  $userShopItems
     * @return \Illuminate\Http\Response
     */
    public function show(UserShopItems $userShopItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserShopItems  $userShopItems
     * @return \Illuminate\Http\Response
     */
    public function edit(UserShopItems $userShopItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserShopItemsRequest  $request
     * @param  \App\Models\UserShopItems  $userShopItems
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserShopItemsRequest $request, UserShopItems $userShopItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserShopItems  $userShopItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserShopItems $userShopItems)
    {
        //
    }
}
