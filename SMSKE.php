<?php
/**
 * Created by PhpStorm.
 * User: Gibson
 * Date: 1/14/2020
 * Time: 10:30 PM
 */


$partnerID = "128";
$apikey = "0f1a28b56d3b71d9b906a09789d5cfc3";
$shortcode = "SAFEBODA";

$mobile = "+254731192229";
//$mobile = "+254733334040"; // Bulk messages can be comma separated
$message = "This is a test message + = # special characters @ _ -";
$finalURL = "https://mysms.celcomafrica.com/api/services/sendsms/?apikey=" . urlencode
    ($apikey) . "&partnerID=" . urlencode($partnerID) . "&message=" . urlencode($message)
    . "&shortcode=$shortcode&mobile=$mobile";
echo $finalURL;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $finalURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);
echo "Response: $response";