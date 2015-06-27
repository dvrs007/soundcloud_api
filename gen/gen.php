<?php

require_once '../sc_credentials.php';
require_once '../Services/Soundcloud.php';

$url = 'http://api.soundcloud.com/tracks.json?';

$client = new Services_Soundcloud(
    'CLIENT_ID',
    'CLIENT_SECRET'
);

$tracks = $client->get($url, array('q' => 'buskers', 'license' => 'cc-by-sa'));

echo '<pre>';
print_r($tracks);
echo '</pre>';