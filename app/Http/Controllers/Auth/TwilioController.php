<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Utility\TwilioUtility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;


class TwilioController extends Controller
{
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|min:10|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $phone = $request->input('phone');

        $sent = TwilioUtility::send($phone);

        if ($sent) {
            return $this->jsonResponse(true,$message="send Otp",200);
        }
            return $this->FailResponse(['error' => 'Failed to send OTP.'],$message=['Failed'],500);
    }

    public function verify(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|max:16',
            'otp'   => 'required|string|min:4|max:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        try {
        $phone = $request->input('phone');
        $otp = $request->input('otp');

        $isVerified = TwilioUtility::check($phone, $otp);

        if ($isVerified) {
            $user = User::where('phone', $phone)->first();
            if(!$user) {
                return $this->jsonResponse(true,"successful",200,
                [
                 "verified"=> true,
                 "is_exist"=> false
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            $data=[
            'message' => 'OTP verified successfully.',
            'token' => $token,
            'user' => $user];
            return $this->jsonResponse(true,"successful",200,$data);

        }
        return $this->FailResponse(["error"=>"Invalid OTP."],"Failed",500);
    } catch (\Throwable $th) {
         return $this->FailResponse($th->getMessage(),"Failed",500);
    }
    }
}
