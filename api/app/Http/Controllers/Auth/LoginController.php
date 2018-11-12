<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function redirectToProvider()
    {   
        return Socialite::driver('github')->stateless()->redirect();
    }


    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->stateless()->user();

        return new JsonResponse([
            'name' => $user->getName()
        ]);
    }

    public function redirectToProviderFacebook()
    {   
        return response()->json([
            'redirectUrl' => Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl()
        ]);
    }

    public function handleFacebookProviderCallback(){
        $facebookUser = Socialite::driver('facebook')->stateless()->user();

        $user = User::where('provider_id', $facebookUser->getId())->first();

        if(!$user){

            $user = User::create([
                'email' => $facebookUser->getEmail(),
                'provider_id' => $facebookUser->getId(),
                'tipo_usuario_id' => 1,
                'foto' => $facebookUser->getAvatar(),
            ]);

        }

        $token = auth()->login($user);

        return redirect("http://localhost:8080/#/?login=true&token=".$token);
    }

}
