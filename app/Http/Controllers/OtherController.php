<?php

namespace App\Http\Controllers;

use App\Models\Other;
use App\Models\OtherFlags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OtherController extends Controller
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
        $flags = OtherFlags::all();
        return view("other.create", compact('flags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Other $other
     * @return \Illuminate\Http\Response
     */
    public function show(Other $other)
    {
        return view("other.show", compact('other'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Other $other
     * @return \Illuminate\Http\Response
     */
    public function edit(Other $other)
    {
        if (!Gate::allows('update-post', $other->post)) {
            abort(403);
        }
        $flags = OtherFlags::all();
        return view("other.edit", compact('flags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Other $other
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Other $other)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Other $other
     * @return \Illuminate\Http\Response
     */
    public function destroy(Other $other)
    {
        //
    }
}
