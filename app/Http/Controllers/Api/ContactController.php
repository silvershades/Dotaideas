<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function opinion(Request $request){
        $DATA = [];
        $DATA['message'] = $request->input('message');
        $validator = $this->checkValidOpinion($DATA);

        try {
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Error Validating',
                ], 201);
            } else {
                $user = null;
                if (Auth::check())
                {
                    $user = Auth::user();
                }

                try {
                    Mail::to('contact@dotaideas.com')->queue(new Contact('4',$user,$DATA['message']));
                    return response()->json([
                        'status' => 'success',
                        'msg' => 'Mail successfully sent!',
                    ], 201);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'An error ocurred. Try again later.',
                    ], 201);
                }

            }
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'msg' => 'An error ocurred. Try again later.',
            ], 201);
        }
    }

    public function contact(Request $request)
    {
        $DATA = [];
        $DATA['contact_type'] = $request->input('contact_type');
        $DATA['contact'] = (array)json_decode($request->input('contact'));
        $validator = $this->checkValid($DATA);

        try {
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Information too long or email is invalid',
                ], 201);
            } else {
                $user = null;
                if (Auth::check())
                {
                    $user = Auth::user();
                }

                try {
                    Mail::to('contact@dotaideas.com')->queue(new Contact($DATA['contact_type'],$user,$DATA['contact']));
                    return response()->json([
                        'status' => 'success',
                        'msg' => 'Mail successfully sent!',
                    ], 201);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'msg' => 'An error ocurred. Try again later.',
                    ], 201);
                }

            }
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'msg' => 'An error ocurred. Try again later.',
            ], 201);
        }
    }


    public function checkValidOpinion($DATA)
    {
        $validator = Validator::make($DATA, [
            'message' => 'required|max:3000',
        ]);
        return $validator;
    }
    public function checkValid($DATA)
    {
        $validator = Validator::make($DATA, [
            'contact_type' => 'required',
            'contact.name' => 'required|max:30',
            'contact.email' => 'required|email',
            'contact.message' => 'required|string|max:3000',
        ]);
        return $validator;
    }
}
