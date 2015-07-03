<?php

//require_once '../sc_credentials.php';
require_once '../php-soundcloud-master/Services/Soundcloud.php';

//create a client object with your app credentials
$client = new Services_Soundcloud(
    // 'CLIENT_ID',
    // 'CLIENT_SECRET',
    // 'REDIRECT_URI'

    '4a562b1152ae828060d7bfbe66343599', '393b582e4316c78a7e1b5c7196e2badc', 'http://soundcloudapi.philipjamesdevries.com/phil/authorize.php'
);

//redirect user to authorize URL
$authorizeUrl = $client->getAuthorizeUrl();

//variables
$query='';
$results_array=[];

//if a query is posted
if(isset($_POST['submit'])){

	$query = $_POST['search'];

	//url for GET request
	$url = 'http://api.soundcloud.com/tracks';

	//find sounds with query keyword, tack onto the end of url
	$results = $client->get($url, array(
		'q' => $query,
		'limit' => '3'
	));

	$results_array = json_decode($results);

	// echo '<pre>';
	// print_r($results_array);
	// echo '</pre>'; 

}

include 'search.php';