<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    // Specify the paths for which CORS headers will be applied
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Specify the allowed HTTP methods in CORS requests
    'allowed_methods' => ['*'],

    // Specify the allowed origins for CORS requests
    'allowed_origins' => ['http://localhost:3000'],

    // Specify patterns for allowed origins (if any)
    'allowed_origins_patterns' => [],

    // Specify the allowed headers in CORS requests
    'allowed_headers' => ['*'],

    // Specify the headers that can be exposed to the browser in CORS responses
    'exposed_headers' => [],

    // Specify the maximum age (in seconds) for which the CORS preflight response should be cached
    'max_age' => 0,

    // Specify whether the API supports credentials (such as cookies or HTTP authentication) in CORS requests
    'supports_credentials' => false,

];
