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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    /*'google' => [
        'client_id' => 'your client id',
        'client_secret' => 'your client secret key',
        'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
],
*/

'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT'),
],

/*'google' => [
    'client_id' => env('328258278442-77jv3cq4jbje1p25lvfk88drl6gjq56j.apps.googleusercontent.com'),
    'client_secret' => env('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'),
    'redirect' => env('http://127.0.0.1:8000/auth/google/callback'),
],
*/
'google' => [
    'client_id' => '328258278442-77jv3cq4jbje1p25lvfk88drl6gjq56j.apps.googleusercontent.com',
    'client_secret' => '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',
    'redirect' => 'http://127.0.0.1:8000/auth/google/callback',
],

];
