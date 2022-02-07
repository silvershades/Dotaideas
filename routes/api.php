<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('hero/{hero}', 'App\Http\Controllers\Api\HeroController@index');
Route::get('hero-spells/{hero}', 'App\Http\Controllers\Api\HeroController@spells');
Route::get('item-spells/{item}', 'App\Http\Controllers\Api\ItemController@spells');
Route::get('dota-hero', 'App\Http\Controllers\Api\Dota2HeroController@index');
Route::post('post-comments', 'App\Http\Controllers\Api\CommentController@index');

Route::get('shop-items', 'App\Http\Controllers\Api\ShopController@index');
Route::post('shop-item', 'App\Http\Controllers\Api\ShopController@purchase');
Route::get('user-balance', 'App\Http\Controllers\Api\ShopController@balance');

Route::get('get-hero/{hero}', 'App\Http\Controllers\Api\HeroController@gethero');
Route::get('get-item/{item}', 'App\Http\Controllers\Api\ItemController@getitem');
Route::get('get-other/{other}', 'App\Http\Controllers\Api\OtherController@getother');


Route::post('check-auth', 'App\Http\Controllers\Api\CheckAuthController@index');
//Route::post('check-google', 'App\Http\Controllers\Api\CheckAuthController@google');


Route::post('user-avatar', 'App\Http\Controllers\Api\UserController@avatar');
Route::post('user-stash', 'App\Http\Controllers\Api\UserController@stash');
Route::post('user-posts', 'App\Http\Controllers\Api\UserController@posts');
Route::post('user-achievements', 'App\Http\Controllers\Api\UserController@achievements');
Route::post('user-name', 'App\Http\Controllers\Api\UserController@name');


Route::post('load-mrc', 'App\Http\Controllers\Api\MrcController@load');
Route::post('load-mrc-spells', 'App\Http\Controllers\Api\MrcController@spells');


Route::post('send-contact', 'App\Http\Controllers\Api\ContactController@contact');
Route::post('send-opinion', 'App\Http\Controllers\Api\ContactController@opinion');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('hero-store', 'App\Http\Controllers\Api\HeroController@store');
    Route::post('hero-update', 'App\Http\Controllers\Api\HeroController@update');
    Route::post('item-store', 'App\Http\Controllers\Api\ItemController@store');
    Route::post('item-update', 'App\Http\Controllers\Api\ItemController@update');
    Route::post('other-store', 'App\Http\Controllers\Api\OtherController@store');
    Route::post('other-update', 'App\Http\Controllers\Api\OtherController@update');


    Route::post('user-post-visibility', 'App\Http\Controllers\Api\UserController@visibility');
    Route::post('user-equip-avatar', 'App\Http\Controllers\Api\UserController@change_avatar');
    Route::post('user-make-post-pro', 'App\Http\Controllers\Api\UserController@make_pro');
    Route::post('user-rename', 'App\Http\Controllers\Api\UserController@rename');

    Route::post('vote_post', 'App\Http\Controllers\Api\VoteController@store');
    Route::post('has_voted', 'App\Http\Controllers\Api\VoteController@has_voted');
    Route::post('send-comment', 'App\Http\Controllers\Api\CommentController@store');
    Route::post('send-reply', 'App\Http\Controllers\Api\CommentController@reply');

    Route::post('mrc-entry', 'App\Http\Controllers\Api\MrcController@store');
    Route::post('mrc-vote', 'App\Http\Controllers\Api\MrcController@vote');


});

