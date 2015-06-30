<?php
require_once 'Services/Soundcloud.php';
require_once 'sc_credentials.php';

// create a client object with your app credentials
$client = new Services_Soundcloud($clientID, $clientSecret);
$client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));

// get a tracks oembed data
$track_url = 'http://soundcloud.com/forss/flickermood';
$embed_info = json_decode($client->get('oembed', array('url' => $track_url)));

// render the html for the player widget
print $embed_info->html;