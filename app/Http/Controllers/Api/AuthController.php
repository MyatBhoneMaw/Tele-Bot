<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = $request->validated([
            'phone' => 'required|numeric',
            'password' => 'required|min:6'
        ]);

        return $user;
    }
}
