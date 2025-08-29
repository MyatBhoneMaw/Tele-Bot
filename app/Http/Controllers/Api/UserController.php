<?php

namespace App\Http\Controllers\Api;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use App\Models\User;
use Exception;
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
                    'error' => 'Something is wrong',
                    'code' => $statusCode,
                ],
                $statusCode,
            );
        }
    }

    public function packageBuyUser(Request $request)
    {
        try {
            $plan = $request->input('plan');
            $data = Purchase::query()
            ->when($plan == '15K', function($q) {
                $q->where('selected_plan', '15K Plan');
            })
            ->when($plan == '25K', function($q) {
                $q->where('selected_plan', '25K Plan');
            })
            ->where('payment_status', PaymentStatus::PENDING)->get();
            return PurchaseResource::collection($data);
        } catch (Exception $e) {
            return response()->json(
                [
                    'message' => 'Something is wrong',
                    'status' => 500,
                ],
                500,
            );
        }
    }
}
