<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Api\Auth\LoginFormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(LoginFormRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->guard('web')->attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }

        $token = auth()->guard('web')->user()->createToken(config('app.name'));
        dd($token);
        /*  $token->token->expires_at = $request->remember_me ?
              Carbon::now()->addMonth() :
              Carbon::now()->addDay();*/

        $user = auth()->guard('web')->user();
        $token->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'user' => $user,
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
        ], 200);
    }
}
