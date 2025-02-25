<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
        try {
        $validated = $request->validated();
        if ($validated["credential_type"] == 'email') {
            $user = User::where('email', $validated["email_or_phone"])->first();
        } else {
            $user = User::where('phone', $validated["email_or_phone"])->first();
        }
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return $this->jsonResponse(false,"Wrong password or email", Response::HTTP_UNAUTHORIZED);
        }
        if(!$user->hasVerifiedEmail()){
            return $this->jsonResponse(false,"Please Verify Your email", Response::HTTP_UNAUTHORIZED);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        $user["user_token"] = $token;
        return $this->jsonResponse(true,"successful", Response::HTTP_OK, $user);
    } catch (\Throwable $th) {
        return response()->json([
            "success" => false,
            "message" => "An error occurred",
            "error" => $th->getMessage()
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    }

}
