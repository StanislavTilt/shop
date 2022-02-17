<?php

return [
    // "sms.ru", "array"
    'driver' => env('SMS_DRIVER', 'sms_ru'),

    'drivers' => [
        'sms_ru' => [
            'app_id' => env('SMS_RU_APP_ID'),
            'url' => env('SMS_RU_URL'),
        ],
    ],
];
