<?php

return [

    /*
     * The view id of which you want to display data.
     */
    'view_id' => env('ANALYTICS_VIEW_ID'),

    /*
     * Path to the client secret json file. Take a look at the README of this package
     * to learn how to get this file. You can also pass the credentials as an array
     * instead of a file path.
     */
    'service_account_credentials_json' => [ // storage_path('app/analytics/simplified-budget-0a58b9983cce.json'),
        "type"=> "service_account",
        "project_id"=> "simplified-budget",
        "private_key_id"=> env('ANALYTICS_PRIV_KEY_ID'),
        "private_key"=> env('ANALYTICS_PRIV_KEY'),
        "client_email"=> env('ANALYTICS_CLIENT_EMAIL'),
        "client_id"=> env('ANALYTICS_CLIENT_ID'),
        "client_x509_cert_url"=> env('ANAYTLICS_CLIENT_URL'),
        "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
        "token_uri"=> "https://oauth2.googleapis.com/token",
        "auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs",
    ],

    /*
     * The amount of minutes the Google API responses will be cached.
     * If you set this to zero, the responses won't be cached at all.
     */
    'cache_lifetime_in_minutes' => 60 * 24,

    /*
     * Here you may configure the "store" that the underlying Google_Client will
     * use to store it's data.  You may also add extra parameters that will
     * be passed on setCacheConfig (see docs for google-api-php-client).
     *
     * Optional parameters: "lifetime", "prefix"
     */
    'cache' => [
        'store' => 'file',
    ],
];
