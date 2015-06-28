<?php

require_once '../sc_credentials.php';
require_once '../Services/Soundcloud.php';

$client = new Services_Soundcloud(
    'CLIENT_ID',
    'CLIENT_SECRET'
);

$query='';
$results_array=[];

if(isset($_POST['submit'])){

	$query = $_POST['search'];

	$url = 'http://api.soundcloud.com/tracks';

	//find sounds with query keyword
	$results = $client->get($url, array(
		'q' => $query,
		//'order' => 'created_at', 
		'limit' => '10'
	));

	$results_array = json_decode($results);

	// echo '<pre>';
	// print_r($results_array);
	// echo '</pre>'; 

}

include 'search.php';