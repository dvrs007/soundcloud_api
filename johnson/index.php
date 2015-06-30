<?php

require_once 'Services/Soundcloud.php';
require_once 'sc_credentials.php';


// create client object with app credentials
$client = new Services_Soundcloud(
  $clientID, $clientSecret, 'http://johnsonta.ca/soundcloud/play_widget.php');

//Generate a URL used for authorization and prompt your user to visit your newly generated URL
$authURL= $client->getAuthorizeUrl();


echo '<a href="' . $authURL . '">Connect to SoundCloud</a>';

echo '<pre>';

