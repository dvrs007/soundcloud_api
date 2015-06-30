<?php

require_once 'Services/Soundcloud.php';
require_once 'sc_credentials.php';


// create client object with app credentials
$client = new Services_Soundcloud(
  $clientID, $clientSecret, 'http://johnsonta.ca/soundcloud/');

//Generate a URL used for authorization and prompt your user to visit your newly generated URL
$authURL= $client->getAuthorizeUrl();


echo '<a href="' . $authURL . '">Connect to SoundCloud</a>';

echo '<pre>';

$client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));

// get a tracks oembed data
$track_url = 'http://soundcloud.com/forss/flickermood';


try {
	if(!isset($_SESSION['token'])){
		$accessToken = $client->accessToken($_GET['code'],array(),array(
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			));
		$_SESSION['token']=$accessToken['access_token'];
		
	}
	else
	{
		$client->setAccessToken($_SESSION['token']);
	}
	
	
} catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
    exit($e->getMessage());
}


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


