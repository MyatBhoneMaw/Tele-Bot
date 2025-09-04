<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request)
    {
       $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('my-api-token')->plainTextToken;

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {   
        $user = User::find($request->id);
        $user->currentAccessToken()?->delete();
        return response()->json([
            'message' => 'success'
        ], 200);
    }
}
