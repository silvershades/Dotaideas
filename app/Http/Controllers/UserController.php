<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Coins;
use App\Models\Post;
use App\Models\User;
use App\Models\UserAchievement;
use App\Models\UserCoins;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return view('home.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $current_date =  date('F, Y');
        $user_posts = Post::where('user_id',$user->id)->get();
        $achievements = Achievement::all();
        $user_achievements = UserAchievement::where('user_id',$user->id)->get();
        $user_achievements_completed = UserAchievement::where('user_id',$user->id)->where('is_completed',1)->get();
        $user_achievements_completed_points = UserAchievement::leftJoin('achievements', 'user_achievements.achievement_id', '=', 'achievements.id')
            ->where('user_achievements.user_id',$user->id)
            ->where('user_achievements.is_completed',1)
            ->sum('achievements.completion_points');
//        $user_points = Points::where('user_id',$user->id)->sum('amount');
//        $user_coins =  Coins::where('user_id',$user->id)->sum('amount');

        return view('user.show',compact(
            'user',
            'current_date',
            'user_posts',
//            'user_points',
//            'user_coins',
            'achievements',
            'user_achievements',
            'user_achievements_completed',
            'user_achievements_completed_points',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
