<?php
namespace App\Services;
use App\Radio;
use App\Country;
class Helper
{
    public function get_client_country_model(){
       /*
       //for testing in localhost my ip is hard coded
       $ip = '112.135.34.99';
       //$ip = $request->ip();
       // Use JSON encoded string and converts 
       // it into a PHP variable 
       $ipdat = json_decode(file_get_contents( 
       "http://www.geoplugin.net/json.gp?ip=" . $ip)); 
       $client_country = $ipdat->geoplugin_countryName;
       */
       //get the country collection with the user ip
       $client_country_model = Country::where('name','Sri lanka')->first();
       return  $client_country_model;      
    }
}
