<?php
session_start();
require_once '../Services/Soundcloud.php';
require_once 'sc_credentials.php';

// create a client object with your app credentials
$sc_connection = new Services_Soundcloud(
	CLIENT_ID, 
	CLIENT_SECRET, 
	CALL_BACK_URI);
	
$sc_connection->setDevelopment(false);

//Generate a URL used for authorization and prompt your user to visit your newly generated URL
$authURL= $sc_connection->getAuthorizeUrl();


echo '<a href="' . $authURL . '">Connect to SoundCloud</a>';

try {
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


try {
    $me = json_decode($sc_connection->get('me'), true);
	//print_r($me);
	//echo '<br/> ID:' . $me['id'];
		
	//echo '<br/> My Tracks <br/>';
	//$tracks = json_decode($sc_connection->get('tracks',array('user_id' => $me['id'])), true);
	//print_r($tracks);
	
	
} catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
    exit($e->getMessage());
}


     
    $user_data = array(
                    'access_token' => $accessToken['access_token'],
                    'id' => $me['id'],
                    'username' => $me['username'],
                    'name' => $me['full_name'],
                    'avatar' => $me['avatar_url']
                );
     
    header("Location:upload.php?access_token=".$user_data['access_token']);