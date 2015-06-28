<?php

require_once '../sc_credentials.php';
require_once '../Services/Soundcloud.php';

//create a client object with your app credentials
$client = new Services_Soundcloud(
    'CLIENT_ID',
    'CLIENT_SECRET'
);

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
		//'order' => 'created_at', 
		'limit' => '5'
	));

	$results_array = json_decode($results);

	// echo '<pre>';
	// print_r($results_array);
	// echo '</pre>'; 

}

include 'search.php';