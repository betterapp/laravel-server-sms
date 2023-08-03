<?php

return [
    'username' => env('SERVER_SMS_API_USER'),
    'password' => env('SERVER_SMS_API_PASS'),
    'api_url'  => env('SERVER_SMS_API_URL', 'https://api2.serwersms.pl/'),
    'format'   => env('SERVER_SMS_API_FORMAT', 'json'),
    'sender'   => env('SERVER_SMS_SENDER', null),
];