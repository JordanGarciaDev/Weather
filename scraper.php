<?php
//get the city name
$city=$_GET['city'];
$city=str_replace(" ","",$city);
//get the city weather from the website
$contents=file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
//find the paragraph wish take just the weather
preg_match('/<span class="phrase">(.*?)</s',$contents,$matches);
//print the weather
echo($matches[1]);

?>