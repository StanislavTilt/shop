<?php
/**
 * Created by PhpStorm.
 * User: stasi
 * Date: 02.02.2022
 * Time: 17:51
 */

namespace App\Services\Helpers;


class ProfileHelperService
{
    public function validateAddress($country, $city)
    {
        $codesPath = storage_path('app/public/countryCodes.json');
        $array = json_decode(file_get_contents($codesPath),true);
        $countryCode = array_search($country, $array);

        if(!$countryCode)
        {
            return __('profile.update_address_failed');
        }

        $url = 'https://integration.cdek.ru/v1/location/cities/json?country='.urlencode($country).'&countryCode='.urlencode($countryCode).'&cityName='.urlencode($city);
        $city = json_decode(file_get_contents($url),true);
        if(count($city) == 0)
        {
            return __('profile.update_address_failed');
        }
        return true;
    }

}
