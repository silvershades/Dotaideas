<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('layout');
//});
require __DIR__ . '/auth.php';

Route::post('/auth/google', 'App\Http\Controllers\Auth\GoogleController@redirect')->name('google.redirect');
Route::post('/auth/google/callback', 'App\Http\Controllers\Auth\GoogleController@callback')->name('google.callback');
Route::get('/auth/steam', 'App\Http\Controllers\Auth\SteamController@redirectToSteam')->name('auth.steam');
Route::get('/auth/steam/handle', 'App\Http\Controllers\Auth\SteamController@handle')->name('auth.steam.handle');


Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');
Route::get('/shop', 'App\Http\Controllers\ShopController@index')->name('shop.index');
Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact.index');
//Route::get('/articles', 'App\Http\Controllers\ArticleController@index')->name('article.index');
//Route::get('/mega_guide', 'App\Http\Controllers\ArticleController@mega_guide')->name('article.mega_guide');
//Route::get('/articles/{article}', 'App\Http\Controllers\ArticleController@show')->name('article.show');

Route::get('/mrcs', 'App\Http\Controllers\MrcController@index')->name('mrc.index');
Route::get('/mrcs-entries', 'App\Http\Controllers\MrcController@dir')->name('mrc.dir');
Route::get('/mrcs-entries/{mrc}', 'App\Http\Controllers\MrcController@show')->name('mrc.show');

//POSTS
Route::get('/post/create', 'App\Http\Controllers\PostController@create')->name('post.create');
Route::get('/post/hero/{hero}', 'App\Http\Controllers\HeroController@show')->name('hero.show');
Route::get('/post/item/{item}', 'App\Http\Controllers\ItemController@show')->name('item.show');
Route::get('/post/other/{other}', 'App\Http\Controllers\OtherController@show')->name('other.show');
//Route::get('/post/creep/{creep}', 'App\Http\Controllers\CreepController@show')->name('creep.show');

//USERS
Route::get('/user/{user}', 'App\Http\Controllers\UserController@show')->name('user.show');

Route::middleware(['auth', 'web','can:isMortal'])->group(function () {
    //POSTS
    Route::get('/post/create/hero', 'App\Http\Controllers\HeroController@create')->name('hero.create');
    Route::get('/post/edit/hero/{hero}', 'App\Http\Controllers\HeroController@edit')->name('hero.edit');
    Route::get('/post/create/item', 'App\Http\Controllers\ItemController@create')->name('item.create');
    Route::get('/post/edit/item/{item}', 'App\Http\Controllers\ItemController@edit')->name('item.edit');
    Route::get('/post/create/other', 'App\Http\Controllers\OtherController@create')->name('other.create');
    Route::get('/post/edit/other/{other}', 'App\Http\Controllers\OtherController@edit')->name('other.edit');
    //VOTES
    Route::post('/post/vote/{post}', 'App\Http\Controllers\VotesController@create')->name('vote.create');
    //USER
    Route::post('/user/change_avatar/{shop_item}', 'App\Http\Controllers\UserController@change_avatar')->name('user.change_avatar');
});


//Route::group(['prefix' => 'prospero', 'middleware' => 'can:isAdmin'], function () {
//    /** users */
//    Route::post('/users/change_role/{user}', 'App\Http\Controllers\AdminController@change_user_role')->name('prospero.user.change_role');
//
//});



Route::get('/mailable', function () {
//    $invoice = App\Models\Invoice::find(1);

    return new App\Mail\NewAccount();
});
