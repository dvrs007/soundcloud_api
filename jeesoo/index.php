<?php
session_start();

require_once '../Services/Soundcloud.php';
require_once 'sc_credentials.php';
include '../views/header.php';
//Ref: https://github.com/mptre/php-soundcloud/wiki/OAuth-2

// create a client object with your app credentials
$sc_connection = new Services_Soundcloud(
	CLIENT_ID, 
	CLIENT_SECRET, 
	CALL_BACK_URI);
	
$sc_connection->setDevelopment(false);

//Generate a URL used for authorization and prompt your user to visit your newly generated URL
$authURL= $sc_connection->getAuthorizeUrl();


echo '<a href="' . $authURL . '">Connect to SoundCloud</a>';

echo '<pre>';



//Attept to get token from Session First
//Set the token otherwise
//Ref: http://stackoverflow.com/questions/18919021/soundcloud-the-requested-url-responded-with-http-code-0
try {
	//$accessToken=$sc_connection->setCurlOptions();
		
	if(!isset($_SESSION['token'])){
		$accessToken = $sc_connection->accessToken($_GET['code'],array(),array(
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			));
		$_SESSION['token']=$accessToken['access_token'];
	}
	else
	{
		$sc_connection->setAccessToken($_SESSION['token']);
	}
	
	
} catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
    exit($e->getMessage());
}

/*
try {
    $me = json_decode($sc_connection->get('me'), true);
	print_r($me);
	echo '<br/> ID:' . $me['id'];
		
	echo '<br/> My Tracks <br/>';
	$tracks = json_decode($sc_connection->get('tracks',array('user_id' => $me['id'])), true);
	print_r($tracks);
	
	
} catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
    exit($e->getMessage());
}*/

try{
	
	$track= $sc_connection->post('tracks', array(
		'track[asset_data]'=> '@bwv866_06272015.wav',
		'track[title]'=> 'TEST: BWV866',
		'track[sharing]'=> 'public'
	
	));
	
}catch(Services_Soundcloud_Invalid_Http_Response_Code_Exception $e){
	echo $e->getMessage();
}



echo '</pre>';



?>
