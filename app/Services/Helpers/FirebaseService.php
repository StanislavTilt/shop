<?php

namespace App\Services\Helpers;

use GuzzleHttp\Client;

class FirebaseService
{
    protected $serverUrl,$apiAccessKey;

    public function __construct()
    {
        $this->apiAccessKey = config('notification.push_api_key');
        $this->serverUrl = config('notification.push_server_url');
    }

    public function sendNotification($to, $messageData, $data)
    {
        $request_body = [
            'registration_ids' => $to,
            'notification' =>  $messageData,
            'data' => $data
        ];

        if(empty($this->apiAccessKey) || $this->apiAccessKey == ''){
            exit;
        }

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'key='.$this->apiAccessKey,
            ]
        ]);

        $client->post($this->serverUrl,
            ['body' => json_encode($request_body)]
        );

    }
}
