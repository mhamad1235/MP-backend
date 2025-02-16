<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Sso;
class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {     try {
        $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
        dd($url);
        return redirect($url);
    } catch (\Throwable $th) {
        dd($th->getMessage());
    }
    }

        public function handleProviderCallback($provider)
        {
            try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            $sso = Sso::where('provider', $provider)
                ->where('provider_id', $socialUser->getId())
                ->first();

            if ($sso) {
                $user = $sso->user;
            } else {
                $user = User::where('email', $socialUser->getEmail())->first();

                if (!$user) {
                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'password' => bcrypt(uniqid()),
                    ]);
                }

                Sso::create([
                    'user_id' => $user->id,
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            }
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        }
        catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

}
