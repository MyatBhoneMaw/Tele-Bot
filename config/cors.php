<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | ဒီနေရာမှာ CORS ပြဿနာတွေ ဖြေရှင်းဖို့အတွက် settings တွေ ထားတဲ့နေရာပါ။
    | SPA frontend ကနေ Laravel backend ကို API ခေါ်တဲ့အခါ လိုအပ်ပါတယ်။
    |
    */

    'paths' => [
        'api/*',                // API routes
        'login',                // Fortify login route
        'logout',               // Fortify logout route
        'sanctum/csrf-cookie',  // Sanctum CSRF setup route
        'register',             // (optional) Fortify register route
        'user',                 // get current user info
    ],

    /*
    |--------------------------------------------------------------------------
    | Allowed Methods
    |--------------------------------------------------------------------------
    |
    | API endpoint တောင်းဆိုမှုမှာ အသုံးပြုနိုင်တဲ့ HTTP method များ။
    | '*': All methods (GET, POST, PUT, DELETE, etc.)
    |
    */

    'allowed_methods' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Allowed Origins
    |--------------------------------------------------------------------------
    |
    | ဘယ် website/domain မှ တောင်းဆိုမှု လက်ခံမလဲ။
    | Vue/React frontend တည်နေတဲ့ domain ထည့်ရမယ်။
    | eg: http://localhost:3000, http://127.0.0.1:5173
    |
    */

    'allowed_origins' => [
        'http://localhost:8000', // Vue/React dev server
        'http://127.0.0.1:3000',
        'http://localhost:5173', // Vite dev server
        'http://127.0.0.1:5173',
    ],

    /*
    |--------------------------------------------------------------------------
    | Allowed Origins Patterns
    |--------------------------------------------------------------------------
    |
    | အထက်က `allowed_origins` မသုံးပဲ pattern နဲ့ စစ်ချင်ရင် ဒီမှာရေး။
    |
    */

    'allowed_origins_patterns' => [],

    /*
    |--------------------------------------------------------------------------
    | Allowed Headers
    |--------------------------------------------------------------------------
    |
    | ဘယ် headers တွေ frontend က ထည့်ခွင့်ရှိမလဲ။
    |
    */

    'allowed_headers' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Exposed Headers
    |--------------------------------------------------------------------------
    |
    | Response header ထဲက ဘယ် headers တွေကို JavaScript ကဖတ်ခွင့်ပေးမလဲ။
    |
    */

    'exposed_headers' => [],

    /*
    |--------------------------------------------------------------------------
    | Max Age
    |--------------------------------------------------------------------------
    |
    | Preflight request (OPTIONS) ကို browser မှာ မိမိ ဘယ်နှစ်စက္ကန့် cache ထားမလဲ။
    | Default: 0 (no cache)
    |
    */

    'max_age' => 0,

    /*
    |--------------------------------------------------------------------------
    | Supports Credentials
    |--------------------------------------------------------------------------
    |
    | Cookie-based authentication (Sanctum) အတွက် ဒီကောင်ကို `true` ထားရမယ်။
    | မထားရင် cookie မပြန်။
    |
    */

    'supports_credentials' => true,

];
