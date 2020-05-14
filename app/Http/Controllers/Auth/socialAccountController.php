<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\UserAccount;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\socialAcountService;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\User;

class socialAccountController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();

        }catch (\Exception $e)
        {
            return redirect()->route('login');
        }
        $authUser=$this->createOrFind($provider,$user);
        auth()->login($authUser, true);
        return redirect()->to('home');


    }
    private  function createOrFind($provider,ProviderUser $userProvider)
    {
        $user=UserAccount::where('provider_id',$userProvider->getId())->where('provider_name',$provider)->first();
        if($user)
        {
            return $user->user;
        }
        else
        {
            $user = User::where('email', $userProvider->getEmail())->first();
            if (!$user) {
                $user = User::create([
                    'email' => $userProvider->getEmail(),
                    'name' => $userProvider->getNickname()
                ]);
            }
            $user->accounts()->create([
                'provider_name' => $provider,
                'provider_id' => $userProvider->getId()
            ]);
            return $user;
        }
    }
}
