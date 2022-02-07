<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return response()->json([
                'status' => 'success',
                'msg' => 'Authenticated',
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'NOT Authenticated',
            ], 201);
        }
    }

    public function google(Request $request)
    {
        $id_token = $request->input('idtoken');
        $client = new Google_Client(['client_id' => '24038801474-8438smgdoc9g13ar1vlbpg1t8q6r7kjm.apps.googleusercontent.com']);  // Specify the CLIENT_ID of the app that accesses the backend
        $payload = $client->verifyIdToken($id_token);
        if ($payload) {
            try {
                $user_new = new User();
                $user_new->google_id = $payload['sub'];
                $user_new->name = $payload['name'];
                $user_new->email = $payload['email'];
                $user_new->avatar = $payload['picture'];
                $user_new->save();

            }catch (\Exception $e){
                return response()->json([
                    'status' => 'error',
                    'msg' => 'FAILED',
                ], 201);
            }

            return response()->json([
                'status' => 'success',
                'msg' => 'LOGIN',
            ], 201);
        } else {
            return response()->json([
                'status' => 'success',
                'msg' => 'FAILED',
            ], 201);
        }



    }


}
