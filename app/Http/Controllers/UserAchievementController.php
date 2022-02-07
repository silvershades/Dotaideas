<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserAchievementRequest;
use App\Http\Requests\UpdateUserAchievementRequest;
use App\Models\UserAchievement;

class UserAchievementController extends Controller
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
     * @param  \App\Http\Requests\StoreUserAchievementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserAchievementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAchievement  $userAchievement
     * @return \Illuminate\Http\Response
     */
    public function show(UserAchievement $userAchievement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAchievement  $userAchievement
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAchievement $userAchievement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserAchievementRequest  $request
     * @param  \App\Models\UserAchievement  $userAchievement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserAchievementRequest $request, UserAchievement $userAchievement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAchievement  $userAchievement
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAchievement $userAchievement)
    {
        //
    }
}
