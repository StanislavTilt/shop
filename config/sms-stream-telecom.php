<?php

return [
    'deliver' => [
        'name' => env('STREAM_TELECOM_DELIVER_NAME', 'default_name'),
        'config' => [
            'login' => env('STREAM_TELECOM_LOGIN', ''),
            'password' => env('STREAM_TELECOM_PASSWORD', ''),
            'api_address' => env('STREAM_TELECOM_REST_API_ADDRESS', 'http://gateway.api.sc/rest/'),
        ]
    ],
];
