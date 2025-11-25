<?php
return [
    'app_env' => getenv('APP_ENV') ?: 'production',
    'app_debug' => getenv('APP_DEBUG') === 'true',
    'app_url' => getenv('APP_URL') ?: 'http://localhost',
    'db' => [
        'host' => getenv('DB_HOST') ?: '127.0.0.1',
        'port' => getenv('DB_PORT') ?: '3306',
        'name' => getenv('DB_NAME') ?: 'dualbrand',
        'user' => getenv('DB_USER') ?: 'root',
        'pass' => getenv('DB_PASS') ?: '',
        'charset' => 'utf8mb4',
    ],
    'razorpay' => [
        'key_id' => getenv('RAZORPAY_KEY_ID') ?: '',
        'key_secret' => getenv('RAZORPAY_KEY_SECRET') ?: '',
    ],
    'session_secret' => getenv('SESSION_SECRET') ?: 'secret',
];
