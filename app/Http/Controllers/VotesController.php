<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVotesRequest;
use App\Http\Requests\UpdateVotesRequest;
use App\Models\Post;
use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VotesController extends Controller
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
    public function create(Request $request, Post $post)
    {
        $vote_option = $request->input('vote_option');
        //check if vote already exists
        $vote_exists = Votes::where('user_id', Auth::id())->where('post_id', $post->id)->count();
        if ($vote_exists) {
            return redirect()->back()->withErrors(['errors' => 'You already voted on this post.']);
        } else {
            try {
                $new_vote = new Votes();
                $new_vote->user_id = Auth::id();
                $new_vote->post_id = $post->id;
                switch ($vote_option) {
                    case '0':
                    {
                        $new_vote->vote = -1;
                        $new_vote->save();
                        break;
                    }
                    case '1':
                    {
                        $new_vote->vote = 1;
                        $new_vote->save();
                        break;
                    }
                    case '2':
                    {
                        $new_vote->vote = 2;
                        $new_vote->save();
                        break;
                    }
                    case '3':
                    {
                        $new_vote->vote = 3;
                        $new_vote->save();
                        break;
                    }
                    default:
                    {
                        return redirect()->back()->withErrors(['errors' => 'There was a problem with your vote. Please try again later.']);
                    }
                }
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['errors' => 'There was a problem with your vote. Please try again later.']);
            }
            return redirect()->back()->with('success', 'Your vote was succesfully casted.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreVotesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVotesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Votes $votes
     * @return \Illuminate\Http\Response
     */
    public function show(Votes $votes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Votes $votes
     * @return \Illuminate\Http\Response
     */
    public function edit(Votes $votes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateVotesRequest $request
     * @param \App\Models\Votes $votes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVotesRequest $request, Votes $votes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Votes $votes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Votes $votes)
    {
        //
    }
}
