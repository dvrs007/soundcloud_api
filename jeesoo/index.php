<?php
session_start();

//require the PHP Wrapper with soundcloud credentials
//credentials are created when the your application is registered with SoundCloud API
require_once '../php-soundcloud-master/Services/Soundcloud.php';
require_once 'upload_credentials.php';

include '../views/header.php';

// create a client object with your app credentials
// Developer's ID, i.e. developer = client
// this is the developer's object
$sc_connection = new Services_Soundcloud(
        CLIENT_ID, CLIENT_SECRET, CALL_BACK_URI);

//Make sure that this is production mode, not development mode
//TRUE: 'development' => 'sandbox-soundcloud.com',
//FALSE: 'production' => 'soundcloud.com'
$sc_connection->setDevelopment(false);
//********************************************************************//
//Generate a URL used for authorization and prompt your user to visit your newly generated URL
//developer's object will create URL for authorizing users.
$authURL = $sc_connection->getAuthorizeUrl();

//This links will generate a TOKEN for your user
// When a user clicks this link, the access token for the user will be given to the user.
echo '<a href="' . $authURL . '">Connect to SoundCloud</a>';

try {
    //If Session called 'token' has not been set, the client object will get the array, 'code' 
    //the index,'access_token', of the array, 'code', has a value of TOKEN for your user.
    //that token will be set for the value of the session called 'token'
    if (!isset($_SESSION['token'])) {
        $accessToken = $sc_connection->accessToken($_GET['code'], array(), array(
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));
        $_SESSION['token'] = $accessToken['access_token'];
    }
    //Once the session has been set, the token will be set as the value of the session already created
    else {
        $sc_connection->setAccessToken($_SESSION['token']);
    }
} catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
    //this will generate an error message in case the above try is not successful.
    //exit($e->getMessage());
    exit();
}


try {

    //Decode the json which has information of logged-in user ('me')'s profile
    $me = json_decode($sc_connection->get('me'), true);
    //print_r($me);
    //echo '<br/> ID:' . $me['id'];
    //echo '<br/> My Tracks <br/>';
    //$tracks = json_decode($sc_connection->get('tracks',array('user_id' => $me['id'])), true);
    //print_r($tracks);
} catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
    //this will catch an error and show the details of the error.
    //exit($e->getMessage());
    exit();
}


//this array will store the information of the logged-in user as following.
$user_data = array(
    'access_token' => $accessToken['access_token'],
    'id' => $me['id'],
    'username' => $me['username'],
    'name' => $me['full_name'],
    'avatar' => $me['avatar_url']
);
//Finally, the http wil be headed to the location, uploadAudio.php with the access token from the user data.
header("Location:upload.php?access_token=" . $user_data['access_token']);

include '../views/footer.php';
