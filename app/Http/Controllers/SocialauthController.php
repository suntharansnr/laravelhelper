<?php

namespace App\Http\Controllers;
use Socialite;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class SocialauthController extends Controller
{
  public function redirect($provider)
  {
   return Socialite::driver($provider)->redirect();
  }
  public function Callback($provider)
  {
    {
      $userSocial =   Socialite::driver($provider)->stateless()->user();
      $users       =   User::where(['email' => $userSocial->getEmail()])->first();
      if($users)
      {
          Auth::login($users);
          return redirect()->route('dashboard');
      }
      else
      {
        $user = User::create([
              'name' => $userSocial->getName(),
              'email' => $userSocial->getEmail(),
              'profile_photo_path' => $userSocial->getAvatar(),
              'provider_id' => $userSocial->getId(),
              'provider' => $provider,
          ]);

          $user->assignRole('User');

          auth()->login($user);
          return redirect()->route('dashboard');
      }
    }
  }
}
