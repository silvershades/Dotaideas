<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VoteController extends Controller
{


    public function store(Request $request)
    {
        $post = $request->input('post');
        $vote = $request->input('vote');

        $DATA = [];
        $DATA['post'] = $post;
        $DATA['vote'] = $vote;

        $validator_vote = Validator::make($DATA, [
            'post' => 'required|exists:posts,id',
            'vote' => 'required|numeric|between:-1,3',
        ]);

        if ($validator_vote->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Validating',
                'errors' => $validator_vote->errors(),
            ], 201);
        } else {
            DB::beginTransaction();
            try {
                if (!Auth::check()) {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'You must log in to vote!',
                    ], 201);
                }
                //check if vote exists
                $old_vote_exists = Votes::where('user_id', Auth::id())->where('post_id', $post)->get();
                if ($old_vote_exists->count() > 0) {
                    //delete old vote
                    foreach ($old_vote_exists as $v) {
                        $v->delete();
                    }
                }
                //create vote
                $vote_new = new Votes();
                $vote_new->user_id = Auth::id();
                $vote_new->post_id = $post;
                $find_owner = Post::where('id', $post)->first();
                $vote_new->post_owner_id = $find_owner->user->id;
                $vote_new->vote = $vote * 10;
                $vote_new->save();
                if ($vote == 3) {
                    $find_owner->user->add_points(10, 'Received an AWARD');
                }
                Auth::user()->add_points(8, 'VOTED on a post');
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'msg' => 'VOTED!',
                ], 201);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Throwable',
                    'errors' => $e->getMessage()

                ], 201);
            }
        }
    }

    public function has_voted(Request $request)
    {
        $post = $request->input('post');

        $DATA = [];
        $DATA['post'] = $post;

        $validator_vote = Validator::make($DATA, [
            'post' => 'required|exists:posts,id',
        ]);

        if ($validator_vote->fails()) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Error Validating',
                'errors' => $validator_vote->errors(),
            ], 201);
        } else {
            try {
                if (!Auth::check()) {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'You must log in to vote!',
                    ], 201);
                }
                //check if vote exists
                $old_vote_exists = Votes::where('user_id', Auth::id())->where('post_id', $post)->first();
                if ($old_vote_exists != null) {
                    return response()->json([
                        'status' => 'success',
                        'msg' => $old_vote_exists->vote,
                    ], 201);
                } else {
                    return response()->json([
                        'status' => 'success',
                        'msg' => '0',
                    ], 201);
                }


            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Throwable',
                    'errors' => $e->getMessage()

                ], 201);
            }
        }
    }
}
