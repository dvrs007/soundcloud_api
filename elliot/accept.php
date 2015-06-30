<?php

require_once 'Services/Soundcloud.php';
include_once 'models/UserClass.php';
include_once 'models/RefreshClass.php';

session_start();

$code = $_GET['code']; 

//first, get around any potential errors and verify the user for the first time
if (empty($_SESSION["username"]))
{
    if (isset($code))
    {
        try
        {
            // create client object with app credentials
            $client = new Services_Soundcloud('1b2612646f4a81d8260b5215c031684f', '23971902bdbcab933ec7a7d39dc042d1', 'http://www.moosenado.com/soundcloudapi/accept.php');

            $access = $client->accessToken($code);

            $accesstoken = $access['access_token'];
            $refreshtoken = $access['refresh_token'];
            $expiresin = $access['expires_in'];
            $scope = $access['scope'];

            // make an authenticated call
            $current_user = json_decode($client->get('me'));
            $username = $current_user->username;

            //set name in session for later
            $_SESSION["username"] = $username;

            //save info to database
            $userClass = new User($username, $accesstoken, $refreshtoken, $expiresin, $scope);
            $userClass->insertUser();

            //Commenting

            // get the latest track from authenticated user
            $track = array_pop(json_decode($client->get('me/tracks', array('limit' => 1))));

			// create a new timed comment
            $comment = json_decode($client->post('tracks/' . $track->id . '/comments', array(
            	'comment[body]' => 'This is a timed comment',
            	'comment[timestamp]' => 1500
            	)));
            
        }
        catch (exception $e) //this is to stop error from bookmarked page launch or expired session/token
        {
            // create client object with app credentials
            $client = new Services_Soundcloud('1b2612646f4a81d8260b5215c031684f', '23971902bdbcab933ec7a7d39dc042d1', 'http://www.moosenado.com/soundcloudapi/accept.php');

            // redirect user to authorize URL
            header("Location: " . $client->getAuthorizeUrl());
        }
    }
    else
    {
        // create client object with app credentials
        $client = new Services_Soundcloud('1b2612646f4a81d8260b5215c031684f', '23971902bdbcab933ec7a7d39dc042d1', 'http://www.moosenado.com/soundcloudapi/accept.php');

        // redirect user to authorize URL
        header("Location: " . $client->getAuthorizeUrl());
    }
}
else //second, if user wishes to continue to use application, load saved info to generate access token without having to log in again (this is how session comes in handy)
{
    // create client object
    $clientCheck = new Services_Soundcloud('1b2612646f4a81d8260b5215c031684f', '23971902bdbcab933ec7a7d39dc042d1');

    //check access token
    $checkUser = new Refresh();
    $userCredentials = $checkUser->refreshUser($_SESSION["username"]);

    //set access token
    $clientCheck->setAccessToken($userCredentials['accesstoken']);

    //make an authenticated call
    $current_user = json_decode($clientCheck->get('me'));
    $username = $current_user->username;

    //Commenting

    // get the latest track from authenticated user
    $track = array_pop(json_decode($clientCheck->get('me/tracks', array('limit' => 1))));

	// create a new timed comment
    $comment = json_decode($clientCheck->post('tracks/' . $track->id . '/comments', array(
    	'comment[body]' => 'This is a timed comment',
    	'comment[timestamp]' => 1500
    	)));
}

?>
