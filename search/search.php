<?php include '../views/header.php'; ?>

<h1>Search SoundCloud with PHP</h1>
<div class="hr"></div>

<div class="demo">

	<form method="post" action=".">

		<label for="search">Enter your search keyword:</label>
		<input type="text" name="search" />
		<input type="submit" name="submit" />

	</form>

	<?php 

		foreach ($results_array as $r) {
			
			echo '<div class="search-result">';
			echo '<p>User: ' . $r->user->username . '</p>';
			echo '<p>Track Title: ' . $r->title . '</p>';
			echo '<p>Genre: ' . $r->genre . '</p></div>';

		}

	?>

</div>

<h2>Introduction</h2>
<p>There are a couple ways to search sounds, users, sets, and groups using the SoundCloud API. This tutorial will show you two ways to do so; the first does not require user authenticaion while the second does. For more information about SoundCloud search, see the official documentation <a href="https://developers.soundcloud.com/docs/api/guide#search" target="_blank">here</a>.</p>

<h2>Getting Started</h2>
<p>In order to get this application up and running you'll need:</p>
<ul>
	<li>PHP 5 or higher</li>
	<li><a href="https://github.com/mptre/ci-soundcloud" target="_blank">SoundCloud PHP API wrapper</a></li>
	<li><a href="../index.php">Register Your Application</a></li>
</ul>

<h2>PART I: Basic Search</h2>

<h3>1. Create a client object</h3>
<p>Create a client object with your app credentials</p>

<pre>
	<code class="php">

	require_once 'Services/Soundcloud.php';

	$client = new Services_Soundcloud(
	    'CLIENT_ID',
	    'CLIENT_SECRET'
	);
	</code>
</pre>

<h3>2. Create form with POST request</h3>
<pre>
	<code class="html">

	&lt;form method=&quot;post&quot; action=&quot;.&quot;&gt;

	&lt;input type=&quot;text&quot; name=&quot;search&quot; /&gt;
	&lt;input type=&quot;submit&quot; name=&quot;submit&quot; /&gt;
		
	&lt;/form&gt;

	</code>
</pre>

<h3>3. Generate the GET request</h3>
<pre>
	<code class="php">
	//if a query is posted
	if(isset($_POST['submit'])){

		$query = $_POST['search'];

		//url for GET request
		$url = 'http://api.soundcloud.com/tracks';

		//find sounds with query keyword, tack onto the end of url
		$results = $client->get($url, array('q' => $query, 'limit' => '10'));
		
	</code>
</pre>

<h3>4. Parse the Results into Array of Objects</h3>
<pre>
	<code class="php">

		$results_array = json_decode($results);

	}

	</code>
</pre>

<h3>5. Display results in the View</h3>
<pre>
	<code class="php">

	foreach ($results_array as $r) {
		
		echo '&lt;p&gt;User: ' . $r-&gt;user-&gt;username . '&lt;/p&gt;';
		echo '&lt;p&gt;Track Title: ' . $r-&gt;title . '&lt;/p&gt;';
		echo '&lt;p&gt;Date Created: ' . $r-&gt;created_at . '&lt;/p&gt;';
		echo '&lt;p&gt;Genre: ' . $r-&gt;genre . '&lt;/p&gt;';
		echo '&lt;p&gt;Tags: ' . $r-&gt;tag_list . '&lt;/p&gt;&lt;hr&gt;';

	}

	</code>
</pre>

<h3>6. Voilà!</h3>
<p>Your application should now be up and running.</p>

<h2>PART II: Search with OAuth</h2>

<h3>1. Create a new instance of your client</h3>
<p>We'll start by requiring the Soundcloud class (which you can download  from GitHub <a href="https://github.com/mptre/php-soundcloud">here</a>), then creating a new instance of our client info. Once the code matches the tokens from the query string, we are ready to search with the API</p>

<pre>
	<code>

	require_once 'php-soundcloud-master/Services/Soundcloud.php';

	// create client object with app credentials
	$client = new Services_Soundcloud(
		'YOUR_CLIENT_ID', 
		'YOUR_CLIENT_SECRET', 
		'YOUR_REDIRECT_URL'
	);

	// exchange authorization code for access token
	$code = $_GET['code'];
	$access_token = $client->accessToken($code);

	// make an authenticated call
	$current_user = json_decode($client->get('me'));
	$scUser = $current_user->username;

	</code>
</pre>

<h3>2. </h3>
<p>Above we are simply outputting the logged-in user's username on the same page as the search results.</p>
<p>We can continue by executing the search itself. Here we are just hard-coding the search parameters but these can be easily replaced by variables. In this case, we're searching for all the "tracks" that include the artist "Stephan Bodzin".</p>

<pre>
    <code>
	$tracks = $client->get('tracks', array('q' => 'Stephan Bodzin'));

	$decodedtracks = json_decode($tracks);
	</code>
</pre>

<h3>3.</h3>

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
	$client = new Services_Soundcloud(
		'YOUR_CLIENT_ID', 
		'YOUR_CLIENT_SECRET', 
		'YOUR_REDIRECT_URL'
	);

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

<?php include '../views/footer.php'; ?>