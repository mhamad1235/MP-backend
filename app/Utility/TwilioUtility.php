<?php

namespace App\Utility;

use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class TwilioUtility
{

    private static function getTwilioConfig(): array
    {
        return [
            'sid' => config('services.twilio.sid'),
            'token' => config('services.twilio.token'),
            'serviceSid' => config('services.twilio.service_sid'),
        ];
    }

    public static function send(string $to): bool
    {
        $twilioConfig = self::getTwilioConfig();
        $to = "+" . $to;
        $channel = 'sms'; 
        try {
            $client = new Client($twilioConfig['sid'], $twilioConfig['token']);
            $verification = $client->verify->v2->services($twilioConfig['serviceSid'])
                ->verifications
                ->create($to, $channel,);
            Log::info("verification");
            Log::info($verification);
            return true;
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            abort(500, $e->getMessage());
        }
    }

    public static function check(string $to, string $otp): string|bool
    {
        $twilioConfig = self::getTwilioConfig();
        $to = "+" . $to;

        try {
            $client = new Client($twilioConfig['sid'], $twilioConfig['token']);
            $verificationCheck = $client->verify->v2->services($twilioConfig['serviceSid'])
                ->verificationChecks
                ->create([
                    "to" => $to,
                    "code" => $otp
                ]);

            Log::info("verificationCheck");
            Log::info($verificationCheck);

            if ($verificationCheck->status !== 'approved') {
                return false;
            }
            return true;
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            abort(500, $e->getMessage());
        }
    }
}
