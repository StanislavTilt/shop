<?php

namespace App\Services\Sms;

/**
 * Class StreamTelecom
 * @package App\Services\Sms
 */
class StreamTelecom
{
    /**
     * @param $number
     * @param $message
     *
     */
    public function send($number, $message): void
    {
        $login = config('sms-stream-telecom.deliver.config.login');
        $password = config('sms-stream-telecom.deliver.config.password');
        $deliverName = config('sms-stream-telecom.deliver.name');
        $server = config('sms-stream-telecom.deliver.config.api_address');

        $sessionId = $this->GetSessionId_Get($server, $login, $password);
        $res = $this->SendSms($server, $sessionId, $deliverName, $number->phone, $message->content);
    }

    /**
     * @param $href
     * @return mixed
     */
    function GetConnect($href){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$href);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    /**
     * @param $src
     * @param string $href
     * @return mixed
     */
    function PostConnect($src, $href = 'http://gateway.api.sc/rest/'){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_CRLF, true);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $src);

        curl_setopt($ch, CURLOPT_URL, $href);

        $result = curl_exec($ch);

        return $result;

        curl_close($ch);
    }

    /**
     * @param $server
     * @param $login
     * @param $password
     * @return mixed
     */
    function GetSessionId_Get($server, $login, $password){
        $href = $server.'Session/?login='.$login.'&password='.$password;
        $result = $this->GetConnect($href);
        return json_decode($result,true);
    }


    /**
     * @param $server
     * @param $session
     * @param $sourceAddress
     * @param $destinationAddress
     * @param $data
     * @param string $sendDate
     * @return mixed
     */
    function SendSms($server, $session, $sourceAddress, $destinationAddress, $data, $sendDate = ' '){

        $href = $server.'Send/SendSms/';

        if($sendDate != ' ')

            $sendDate = '&sendDate='.$sendDate;

        $src = 'sessionId='.$session.'&sourceAddress='.$sourceAddress.'&destinationAddress='.

            $destinationAddress.'&data='.$data.$sendDate;

        $result = $this->PostConnect($src,$href);

        return json_decode($result,true);

    }
}
