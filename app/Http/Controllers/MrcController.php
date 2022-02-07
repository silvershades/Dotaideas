<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMrcRequest;
use App\Http\Requests\UpdateMrcRequest;
use App\Models\Mrc;

class MrcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mrc = Mrc::where('is_active',1)->first();
        return view("mrc.index", compact('mrc'));
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
     * @param \App\Http\Requests\StoreMrcRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMrcRequest $request)
    {
        //
    }

    public function dir()
    {
        $mrcs = Mrc::where('start_date','<=',date('Y-m-d'))->orderBy('end_date','desc')->get();
        return view("mrc.dir", compact('mrcs'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Mrc $mrc
     * @return \Illuminate\Http\Response
     */
    public function show(Mrc $mrc)
    {
        $mrcs = Mrc::all();
        return view("mrc.show", compact('mrcs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Mrc $mrc
     * @return \Illuminate\Http\Response
     */
    public function edit(Mrc $mrc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateMrcRequest $request
     * @param \App\Models\Mrc $mrc
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMrcRequest $request, Mrc $mrc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Mrc $mrc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mrc $mrc)
    {
        //
    }
}
