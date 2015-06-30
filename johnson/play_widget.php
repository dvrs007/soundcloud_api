<?php
require_once '../Services/Soundcloud.php';
require_once 'sc_credentials.php';

// create a client object with your app credentials
$client = new Services_Soundcloud($clientID, $clientSecret);
$client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));

// get a tracks oembed data
$track_url = 'http://soundcloud.com/forss/flickermood';



try {
$embed_info = json_decode($client->get('oembed', array('url' => $track_url)));
echo '<pre>';
print_r($embed_info);
echo '</pre>';
		
	//echo '<br/> My Tracks <br/>';
	//$tracks = json_decode($sc_connection->get('tracks',array('user_id' => $me['id'])), true);
	//print_r($tracks);

} catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
    exit($e->getMessage());
}

// render the html for the player widget
print $embed_info->html;


