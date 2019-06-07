<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\ParticipanteLiga;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'confirmacao']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {   

        $credentials = request(['email', 'password']);

        if(Auth::guard('api')->attempt($credentials)) {
            $user = Auth::guard('api')->user();
        }

        if($user->confirmado == 1){
            if (! $token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->respondWithToken($token);

        }

        return ["confirmado" => 0];
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function register(Request $request){

        $confirmation_token = str_random(25);

        $user = User::create([
            'nome' => $request['nome'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'apelido' => $request['apelido'],
            'tipo_usuario_id' => 1,
            'token' => $confirmation_token
        ]);

        $u = $request->all();
        $u['token'] = $confirmation_token;

        $participanteLiga = new ParticipanteLiga();
        $participanteLiga->liga_id = 1;
        $participanteLiga->invocador_id = $user->id;

        $participanteLiga->save();

        Mail::send('mails.confirmation', $u, function($message) use($u){
            $message->subject('Confirmação de e-mail');
            $message->to($u['email']);
        });



        return $user;
    }

    public function confirmacao($token){
        $user = User::where('token', $token)->first();

        if(!is_null($user)){
            $user->confirmado = 1;
            $user->token = '';
            $user->save();

            $jwt_token = auth()->login($user);

            return redirect("http://192.168.3.102:8080/#/?login=true&token=".$jwt_token);
        }

    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => auth()->user(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


}