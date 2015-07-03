<?php 

	require_once 'Services/Soundcloud.php';
	require_once '../jt_credentials.php';
	include '../views/header.php';

?>

<h1>Play Widget with oEmbed</h1>
<div class="hr"></div>

<p>In this tutorial, we will be using the SoundCloud play widget to stream tracks from a designated author. You can also play sounds from your application. Depending on your needs, you can embed a player widget, see the official documentation <a href="https://developers.soundcloud.com/docs/api/guide#playing" target="_blank">here</a>.</p>

<h2>Getting Started</h2>
<p>In order to get this application up and running you'll need:</p>
<ul>
	<li>PHP 5 or higher</li>
	<li><a href="https://github.com/mptre/ci-soundcloud" target="_blank">SoundCloud PHP API wrapper</a></li>
	<li><a href="../home/index.php">Register Your Application</a></li>
        <li><a href="https://developers.soundcloud.com/docs/api/guide#playing">Embedding the SoundCloud Widget</a></li>
</ul>

<p>If you have the URL of a sound or set, you can get the embed code and paste it into your website. Given a sound or set URL, you can retrieve all of the information you need to embed a player.</p>

<p><strong>Before proceeding further, ensure that your application is authenticated. In the following example, the user connect upon clicking on the "Connect to SoundCloud" button.</strong></p>

<h3>1. Enter the track url you want to showcase or play to your users</h3>
<pre>
	<code class="php">
	//get a tracks oembed data
    	$track_url = 'http://soundcloud.com/forss/flickermood';
	</code>
</pre>

<h3>2. Enter the variable previously set for the track url into a json_decode method</h3>
<pre>
	<code class="php">
	try {
	        $embed_info = json_decode($client->get('oembed', array('url' => $track_url)));

	        } catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
	            exit($e->getMessage());
	        }
	</code>
</pre>

<h3>3. Display information based on the track</h3>
<pre>
	<code class="php">
	    echo '&lt;p&gt;Track Title: ' . $embed_info-&gt;-&gt;title . '&lt;/p&gt;';
	    echo '&lt;p&gt;Author: ' . $embed_info-&gt;author_name . '&lt;/p&gt;';
	    echo '&lt;p&gt;Description: ' . $embed_info-&gt;description . '&lt;/p&gt;';
	</code>
</pre>

<h3>4. Render the html for the player widget</h3>
<pre>
	<code class="php">
    	print $embed_info->html;
	</code>
</pre>

<?php

// create client object with app credentials
$client = new Services_Soundcloud(
  $clientID, $clientSecret, 'http://johnsonta.ca/soundcloud/johnson/');

//Generate a URL used for authorization and prompt your user to visit your newly generated URL
$authURL= $client->getAuthorizeUrl();


echo '<a href="' . $authURL . '">Connect to SoundCloud</a>';


$client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));

// get a tracks oembed data
$track_url = 'http://soundcloud.com/forss/flickermood';


try {
	if(!isset($_SESSION['token'])){
		$accessToken = $client->accessToken($_GET['code'],array(),array(
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			));
		$_SESSION['token']=$accessToken['access_token'];
		
	}
	else
	{
		$client->setAccessToken($_SESSION['token']);
	}
	
	
} catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
    exit($e->getMessage());
}


try {
$embed_info = json_decode($client->get('oembed', array('url' => $track_url)));
//echo '<pre>';
//print_r($embed_info);
//echo '</pre>';

    echo '<h1>Information for: ' .$embed_info->title . '</h1>';
    echo '<img src="' . $embed_info->thumbnail_url . '" width="150px" />';
    echo '<h2>Author: '.$embed_info->author_name.'<br />';
    echo '<h2>Check out more at : <a href="'.$embed_info->author_url.'">'. $embed_info->author_url . '</a><br />';
    echo '<h2>'.$embed_info->title.'<br />';
    echo $embed_info->description.'</h2>';

} catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e) {
    exit($e->getMessage());
}

// render the html for the player widget
print $embed_info->html;

include '../views/footer.php';