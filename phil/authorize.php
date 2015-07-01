<?php

require_once '../php-soundcloud-master/Services/Soundcloud.php';

include '../views/header.php';

// create client object with app credentials
$client = new Services_Soundcloud('4a562b1152ae828060d7bfbe66343599', '393b582e4316c78a7e1b5c7196e2badc', 'http://soundcloudapi.philipjamesdevries.com/phil/authorize.php');


// exchange authorization code for access token
$code = $_GET['code'];
$access_token = $client->accessToken($code);

// make an authenticated call
$current_user = json_decode($client->get('me'));
$scUser = $current_user->username;

?>
<h1>Authenticated Page with Search and Embedded Output</h1>
<h2>Currently Logged Into Soundcloud as: <span style="color:blue;"><?php echo $scUser; ?></span></h2>

<?php 

$tracks = $client->get('tracks', array('q' => 'Stephan Bodzin'));


$decodedtracks = json_decode($tracks);


$client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));

foreach($decodedtracks as $s){
    $track_url = $s->permalink_url;
    echo "Track url: " . $track_url . "<br>";

    $embed_info = json_decode($client->get('oembed', array('url' => $track_url)));

// render the html for the player widget
print $embed_info->html;

     
}


include '../views/footer.php';
?>

