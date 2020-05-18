<?php
//--------------------------------------------------//
//--------------------------------------------------//
//-----------------Functions Page-------------------//
//--------------------------------------------------//
//--------------------------------------------------//

function get_Location_and_CounryGif($ip){
    
    //The function gets the IP of the user
    //using cURL gets the json's file of the API
    //return Array of 2 strings: user's location and country GIF
    
    if ($ip != null) //Avoid showing blank users (without IP)
    {
        $url = 'http://appslabs.net/mobile-brain-test/cudade.php';

        $post_data = array('ip' => $ip);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        $output = curl_exec($ch);

        $json_data_array = json_decode($output, true);


        $city_location = $json_data_array['theCity'];
        $country_location = $json_data_array['theCountry'];
        $country_code = strtoupper($json_data_array['countryCode']);

       
        $final_location = $city_location . ", " . $country_location;
        $country_gif_url = get_Flag($country_code);

        $table_array = [$final_location, $country_gif_url];

        return($table_array);
    }
}


function get_Flag($country_code){
    
    //The function gets the country code
    //return the GIF of the country in HTML code
    
    $url = 'http://appslabs.net/mobile-brain-test/images/flags/' . $country_code . '.gif';
    $img = "<img src=$url>";
    
    return($img);
}

function get_Rand_Token($num_bytes=16) {
    
    //Return a random token of 32 bytes
    
  return bin2hex(openssl_random_pseudo_bytes($num_bytes));
}
?>