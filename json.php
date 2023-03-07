<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 06/03/2023
 * Time: 11:11 AM
 */
$cityId = '';
$location = strtolower($_GET['city']);

if (strpos($location, 'orlando') !== false) {
    $cityId = 4167147;
}
elseif (strpos($location, 'new york') !== false) {
    $cityId = 5128638;
}
elseif (strpos($location, 'miami') !== false) {
    $cityId = 4164138;
}

//4164138 Miami
//4167147 Orlando
//5128581 New York City, US
//5128638 New York, US

$apiKey = "b17d222b3f223b119c6fdb7609a07a01";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=".$cityId ."&lang=es&units=metric&APPID=".$apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
print_r($data);