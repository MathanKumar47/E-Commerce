<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
class SocialController extends Controller
{
    public function redirectToGoogle()
    {
      return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $finduser = User::where('provider_id',$user->id)->first();
            
          if($finduser){
            Auth::login($finduser);
            return redirect('/');
          }
          else{
            $new_user = new User();
            $new_user->name = $user->name;
            $new_user->email = $user->email;
            $new_user->provider_id = $user->id;
            $user->avatar = $user->avatar;
            $new_user->save();

             Auth::login($new_user);
             return redirect('/');
          }
    }
}
