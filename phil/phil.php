<?php

require_once '../php-soundcloud-master/Services/Soundcloud.php';

include '../views/header.php';

// create client object with app credentials
$client = new Services_Soundcloud(
  '4a562b1152ae828060d7bfbe66343599', '393b582e4316c78a7e1b5c7196e2badc', 'http://soundcloudapi.philipjamesdevries.com/phil/authorize.php');

// redirect user to authorize URL
$authorizeUrl = $client->getAuthorizeUrl();

?>
<h1>Soundcloud API - Search (PHP)</h1>
<p>Searching with the Soundcloud API is fairly simple. The following steps assume you've already registered your Soundcloud app and have your client id, key, and redirect URL, though for searching authentication isn't required.</p>
<p>We'll start by requiring the Soundcloud class (which you can download  from GitHub <a href="https://github.com/mptre/php-soundcloud">here</a>), then creating a new instance of our client info. Once the code matches the tokens from the query string, we are ready to search with the API</p>
    <pre><code>


require_once 'php-soundcloud-master/Services/Soundcloud.php';

// create client object with app credentials
$client = new Services_Soundcloud('YOUR_CLIENT_ID', 'YOUR_CLIENT_SECRET', 'YOUR_REDIRECT_URL');


// exchange authorization code for access token
$code = $_GET['code'];
$access_token = $client->accessToken($code);

// make an authenticated call
$current_user = json_decode($client->get('me'));
$scUser = $current_user->username;


</code></pre>
<p>Above we are simply outputting the logged in user's username on the same page as the search results.</p>
<p>We can continue by executing the search itself. Here we are just hard-coding the search parameters but these can be easily replaced by variables. In this case, we're searching for all the "tracks" that include the artist "Stephan Bodzin".</p>
<pre>
    <code>
$tracks = $client->get('tracks', array('q' => 'Stephan Bodzin'));

$decodedtracks = json_decode($tracks);
</code>
</pre>
<p>The data here in <code>$tracks</code> is being returned as a JSON object. If you looped through this data it would simply list all of the results the API returns from your search query. In the second line, we are decoding the JSON data in PHP to be able to input some of the JSON parameters into a loop that embeds the results into the Soundcloud player widget. We are taking the <code>track_url</code> property from the JSON data to do so.</p>
<pre>
    <code>
$client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));

foreach($decodedtracks as $s){
    $track_url = $s->permalink_url;
    echo "Track url: " . $track_url;

    $embed_info = json_decode($client->get('oembed', array('url' => $track_url)));

// render the html for the player widget
print $embed_info->html;

     
}
        </code>
</pre>
<p>...and there you go. You've just searched Soundcloud using the API with PHP</p>
<p>Here's the complete script with authentication required:</p>
<pre>
    <code>


require_once '../php-soundcloud-master/Services/Soundcloud.php';

// create client object with app credentials
$client = new Services_Soundcloud('YOUR_CLIENT_ID', 'YOUR_CLIENT_SECRET', 'YOUR_REDIRECT_URL');

// exchange authorization code for access token
$code = $_GET['code'];
$access_token = $client->accessToken($code);

// make an authenticated call
$current_user = json_decode($client->get('me'));
$scUser = $current_user->username;

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
</code>
</pre>
<h2>To view a working sample of this code, click the link below to authenticate your Soundcloud account and get started</h2>
<a href="<?php echo $authorizeUrl; ?>">Connect with SoundCloud</a>

<?php include 'views/footer.php';