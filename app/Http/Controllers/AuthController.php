<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
             'email'    => $request->email,
             'password' => $request->password,
             'name' => $request->name
         ]);
        $token = auth()->login($user);
        return $this->respondWithToken($token);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
    public function getAuthenticatedUser(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 401);
        }
        return response()->json($user, 200);
    }
}