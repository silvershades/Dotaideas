<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dota2HeroResource;
use App\Models\Dota2Hero;
use Illuminate\Http\Request;

class Dota2HeroController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('hero');
        $heroes = Dota2Hero::where('json_name', $name)->get();
        return Dota2HeroResource::collection($heroes);
    }


}
