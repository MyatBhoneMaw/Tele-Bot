<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class UserController extends Controller
{
    public function createUser(UserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(
                [
                    'data' => $user,
                ],
                200,
            );
        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();
            $statusCode = $th instanceof HttpException ? $th->getStatusCode() : 500;

            return response()->json(
                [
                    'error' => $errorMessage,
                    'code' => $statusCode,
                ],
                $statusCode,
            );
        }
    }
}
