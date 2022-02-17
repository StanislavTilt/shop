<?php

namespace App\Services;

use App\Models\User;

class ShipmentService
{

    public function getDeliveryPoints(User $user)
    {
        $cityUuid = $this->getUserCityUuidData($user);
        $url = 'http://integration.cdek.ru/pvzlist/v1/xml?cityid='.urlencode($cityUuid);
        $points = $this->Parse($url);
        return json_decode($points,true);
    }

    public function getUserCityUuidData($user)
    {
        $country = $user->address->country;
        $city = $user->address->city;
        $codesPath = storage_path('app/public/countryCodes.json');
        $array = json_decode(file_get_contents($codesPath),true);
        $countryCode = array_search($country, $array);
        $url = 'https://integration.cdek.ru/v1/location/cities/json?country='.urlencode($country).'&countryCode='.urlencode($countryCode).'&cityName='.urlencode($city);
        $city = json_decode(file_get_contents($url),true);
        return $city[0]['cityCode'];
    }

    public function Parse ($url) {
        $fileContents= file_get_contents($url);
        $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $simpleXml = simplexml_load_string($fileContents);
        $json = json_encode($simpleXml);
        return $json;
    }
}
