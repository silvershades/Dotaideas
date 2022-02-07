<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index(Request $request)
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
            ], 201);
        }

        try {
            return response()->json([
                'status' => 'success',
                'data' => CommentResource::collection(Comment::where('post_id', $post)->orderBy('created_at','desc')->get())
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ], 201);
        }
    }

    public function store(Request $request)
    {
        $post = $request->input('post');
        $comment = (array)json_decode($request->input('comment'));
        $DATA = [];
        $DATA['post'] = $post;
        $DATA['comment'] = $comment;

        if (Auth::check()) {

            $validator_vote = Validator::make($DATA, [
                'post' => 'required|exists:posts,id',
                'comment.message' => 'required',
            ]);

            if ($validator_vote->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                ], 201);
            }
            try {
                $comment_new = new Comment();
                $comment_new->user_id = Auth::id();
                $comment_new->post_id = $post;
                $comment_new->message = $comment['message'];
                $comment_new->likes = 0;
                $comment_new->save();
                Auth::user()->add_points(1,'COMMENTED on post');
                return response()->json([
                    'status' => 'success',
                    'msg' => 'Comment sent!'
                ], 201);

            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                ], 201);
            }

        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'Not logged in.'
            ], 201);
        }


    }

    public function reply(Request $request)
    {
        $post = $request->input('post');
        $reply = (array)json_decode($request->input('reply'));
        $DATA = [];
        $DATA['post'] = $post;
        $DATA['reply'] = $reply;


        if (Auth::check()) {

            $validator_vote = Validator::make($DATA, [
                'post' => 'required|exists:posts,id',
                'reply.message' => 'required',
            ]);

            if ($validator_vote->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                ], 201);
            }
            try {
                $reply_new = new CommentReply();
                $reply_new->user_id = Auth::id();
                $reply_new->post_id = $post;
                $reply_new->comment_id = $reply['id'];
                $reply_new->message = $reply['reply'];
                $reply_new->likes = 0;
                $reply_new->save();
                Auth::user()->add_points(1,'REPLIED on comment');
                return response()->json([
                    'status' => 'success',
                    'msg' => 'Reply sent!'
                ], 201);

            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                ], 201);
            }

        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'Not logged in.'
            ], 201);
        }


    }

}
