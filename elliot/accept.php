<?php

require_once 'Services/Soundcloud.php';
include_once 'models/UserClass.php';
include_once 'models/RefreshClass.php';

session_start();

$code = $_GET['code']; 

//first, get around any potential errors and verify the user for the first time
if (empty($_SESSION["username"])) {
    if (isset($code)) {
        try {
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

            // echo 'User Name: ';
            // print $current_user->username;
            // echo '<br />';
            // echo 'User Token: ';
            // print $access['access_token'];

            //set name in session for later
            $_SESSION["username"] = $username;

            //save info to database
            $userClass = new User($username, $accesstoken, $refreshtoken, $expiresin, $scope);
            $userClass->insertUser();

            //Posting
            if(isset($_POST['submit']))
            {
				//upload track
            	$track = json_decode($client->post('tracks', array(
            		'track[title]' => 'Test',
            		'track[asset_data]' => '@freshprints.mp3',
            		'track[sharing]'=> 'public'
            		)));
			} 
            
        } catch (exception $e) { //this is to stop error from bookmarked page launch or expired session/token
            // create client object with app credentials
            $client = new Services_Soundcloud('1b2612646f4a81d8260b5215c031684f', '23971902bdbcab933ec7a7d39dc042d1', 'http://www.moosenado.com/soundcloudapi/accept.php');

            // redirect user to authorize URL
            header("Location: " . $client->getAuthorizeUrl());
        }
    } else {
        // create client object with app credentials
        $client = new Services_Soundcloud('1b2612646f4a81d8260b5215c031684f', '23971902bdbcab933ec7a7d39dc042d1', 'http://www.moosenado.com/soundcloudapi/accept.php');

        // redirect user to authorize URL
        header("Location: " . $client->getAuthorizeUrl());
    }
} else { //second, if user wishes to continue to use application, load saved info to generate access token without having to log in again (this is how session comes in handy)
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

    //Posting
    if(isset($_POST['submit']))
    {
		//upload track
		$track = json_decode($client->post('tracks', array(
			'track[title]' => 'Test',
			'track[asset_data]' => '@freshprints.mp3',
			'track[sharing]'=> 'public'
			)));
    } 
}

?>

<html>
	<head>
	</head>

	<body>
		<h2>Hello <?php echo $username; ?></h2>
		<form action="" name="upload" action="POST">
			File name: <input type="text" name='filename' value='freshprints.mp3' placeholder="freshprints.mp3"/>
			<br/>
			Title: <input type="text" name='title' value='test2'/>
			<br/>
			Sharing: <input type="text" name='share' value='public' placeholder="public" />
			<br/><br/>
			<input type="submit" value="Submit" />
		</form>
	</body>
</html>
