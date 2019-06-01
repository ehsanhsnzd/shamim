<?php

$application_key_id = "df408b051acb"; // Obtained from your B2 account page
$application_key = "002bd1e99256337577dde8f7345aecb0e7716bd3ad"; // Obtained from your B2 account page
$credentials = base64_encode($application_key_id . ":" . $application_key);
$url = "https://api.backblazeb2.com/b2api/v2/b2_authorize_account";

$session = curl_init($url);

// Add headers
$headers = array();
$headers[] = "Accept: application/json";
$headers[] = "Authorization: Basic " . $credentials;
curl_setopt($session, CURLOPT_HTTPHEADER, $headers);  // Add headers

curl_setopt($session, CURLOPT_HTTPGET, true);  // HTTP GET
curl_setopt($session, CURLOPT_RETURNTRANSFER, true); // Receive server response
$server_output = curl_exec($session);
curl_close ($session);
//$jsonArray = json_decode($server_output,true);
//echo ($jsonArray['authorizationToken']);

$arr=[];
if ($handle = opendir('public_html')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            array_push($arr,$entry);
        }
    }

    closedir($handle);
}