<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMrcVoteRequest;
use App\Http\Requests\UpdateMrcVoteRequest;
use App\Models\MrcVote;

class MrcVoteController extends Controller
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
     * @param  \App\Http\Requests\StoreMrcVoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMrcVoteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MrcVote  $mrcVote
     * @return \Illuminate\Http\Response
     */
    public function show(MrcVote $mrcVote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MrcVote  $mrcVote
     * @return \Illuminate\Http\Response
     */
    public function edit(MrcVote $mrcVote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMrcVoteRequest  $request
     * @param  \App\Models\MrcVote  $mrcVote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMrcVoteRequest $request, MrcVote $mrcVote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MrcVote  $mrcVote
     * @return \Illuminate\Http\Response
     */
    public function destroy(MrcVote $mrcVote)
    {
        //
    }
}
