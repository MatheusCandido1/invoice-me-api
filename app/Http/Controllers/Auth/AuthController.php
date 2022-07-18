<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignUpRequest;
use App\Http\Requests\Auth\SignInRequest;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['signUp', 'signIn']]);
    }

    public function signUp(SignUpRequest $request) {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;

            $user->save();

            return response()->json([
                'message' => 'User created'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function signIn(SignInRequest $request) {
        try {

            $token = auth()->attempt($request->validated());
            if (!$token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return $this->createNewToken($token);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function signOut() {
        try {
            auth()->logout();

            return response()->json([
                'message' => 'Logout'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }
}
