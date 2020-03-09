<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param LoginFormRequest $request
     * @return JsonResponse
     */
    public function login(LoginFormRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json([
            'message' => 'You cannot sign with those credentials',
            'errors' => 'Unauthorised'
        ], 401);
    }


    /**
     * Create a User
     *
     * @param RegisterFormRequest $request
     * @return JsonResponse|void
     */
    public function register(RegisterFormRequest $request)    {

       $user = User::create(array_replace(
            $request->only('username', 'email'),
            ['password' => bcrypt($request->password)]
        ));

       $token = $this->guard()->login($user);
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User
     *
     * @return Authenticatable|JsonResponse
     */
    public function me()
    {
        return $this->guard()->user();
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return void
     */
    public function logout()
    {
        $this->guard()->logout();

    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'expires_in' => now()->addHour()->timestamp
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
