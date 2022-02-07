<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NewAccount;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{


    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }


    public function callback()
    {
        try {
//            dd($_POST[]);
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
                return redirect('/');

            } else {
                //todo ver cuando loguea un usuario con google pero ya existia
                $find_email = User::where('email', $user->email)->first();

                if ($find_email) {
                    return redirect('/login')->withErrors(['msg', 'That email address is already registered.']);
                } else {
                    $ip = "";
                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    } else {
                        $ip = $_SERVER['REMOTE_ADDR'];
                    }
//                    $newUser = User::create([
//                        'name' => $user->name,
//                        'email' => $user->email,
//                        'google_id' => $user->id,
//                        'ip' => $ip,
//                        'password' => MD5('1234569ummy')
//                    ]);
                    $newUser = new User();
                    $newUser->name = $user->name;
                    $newUser->email = $user->email;
                    $newUser->google_id = $user->google_id;
                    $newUser->ip = $ip;
                    $newUser->password = MD5('1234569lummy');
                    $newUser->save();
                    try {
                        Mail::to($newUser)->queue(new NewAccount());
                    } catch (\Exception $e) {

                    }
                    //welcome gift
                    $newUser->add_coins(100,'Welcome gift');
                }

                Auth::login($newUser);
                return redirect('/');
            }

        } catch (Exception $e) {
//            dd($user);
            return redirect('/login')->withErrors(['msg', $e->getMessage()]);
        }
    }
}
