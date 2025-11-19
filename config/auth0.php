<?php
return [
    'Auth0' => [
        'domain' => env('AUTH0_DOMAIN'),
        'client_id' => env('AUTH0_CLIENT_ID'),
        'client_secret' => env('AUTH0_CLIENT_SECRET'),
        'redirect_uri' => env('AUTH0_REDIRECT_URI'),
    ],
];
