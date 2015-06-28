<?php

require_once '../sc_credentials.php';
require_once '../Services/Soundcloud.php';

$client = new Services_Soundcloud(
    'CLIENT_ID',
    'CLIENT_SECRET'
);

$tracks='';
$tracks_array=[];

if(isset($_POST['submit'])){

	$genre = $_POST['search'];

	$url = 'http://api.soundcloud.com/tracks.json?q=';

	$tracks = $client->get($url, array('genre' => $genre, 'license' => 'cc-by-sa', 'limit' => '5'));

	$tracks_array = json_decode($tracks);

	// echo '<pre>';
	// print_r($tracks_array);
	// echo '</pre>'; 

}

include 'gen.php';