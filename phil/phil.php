<?php

require_once '../php-soundcloud-master/Services/Soundcloud.php';

// create client object with app credentials
$client = new Services_Soundcloud(
  '4a562b1152ae828060d7bfbe66343599', '393b582e4316c78a7e1b5c7196e2badc', 'http://soundcloudapi.philipjamesdevries.com/phil/authorize.php');

// redirect user to authorize URL
$authorizeUrl = $client->getAuthorizeUrl();

?>

<a href="<?php echo $authorizeUrl; ?>">Connect with SoundCloud</a>