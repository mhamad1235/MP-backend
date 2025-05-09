<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'google' => [
        'client_id'      =>  '451811744113-2bt13rs1tfa36tcf9fvmkpe60un21o4u.apps.googleusercontent.com',
        'client_secret'  =>  "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",
        'redirect'       => "http://127.0.0.1:8000/api/auth/google/callback",
    ],

    "twilio" => [
        "sid"         => "mhamad salim",
        "token"       => env('TWILIO_TOKEN'),
        "from"        => env('TWILIO_FROM'),
        "service_sid" => env('TWILIO_SERVICE_SID'),
    ],
];
