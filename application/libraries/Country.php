<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Country
{
	function getCountry()

    {
    	$url = "https://countriesnow.space/api/v0.1/countries/currency";
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = json_decode(curl_exec($ch));
        curl_close($ch);
        return $result;

    }
}

?>