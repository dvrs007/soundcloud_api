<?php include '../views/header.php'; ?>

<h1>Search SoundCloud with PHP</h1>
<div class="hr"></div>

<h2>Introduction</h2>
<p>There are a couple ways to search sounds, users, sets, and groups using the SoundCloud API. This tutorial will show you two ways to do so; the first does not require user authenticaion while the second does. For more information about SoundCloud search, see the official documentation <a href="https://developers.soundcloud.com/docs/api/guide#search" target="_blank">here</a>.</p>

<h2>Getting Started</h2>
<p>In order to get this application up and running you'll need:</p>
<ul>
    <li>PHP 5 or higher</li>
    <li><a href="https://github.com/mptre/ci-soundcloud" target="_blank">SoundCloud PHP API Wrapper</a></li>
    <li><a href="../home/index.php">Register Your Application</a></li>
</ul>

<h2>PART I: Basic Search</h2>

<div class="demo">
<h3>DEMO | <a href="basic-search-code.zip">DOWNLOAD ZIP FILE</a></h3>
	<form method="post" action=".">

		<label for="search">Enter your search keyword:</label>
		<input type="text" name="search" />
		<input type="submit" name="submit" />

	</form>

	<p><strong>Results for... <?php echo $query; ?></strong></p>

	<?php 

		foreach ($results_array as $r) {
			
			echo '<div class="search-result">';
			echo '<p>User: ' . $r->user->username . '</p>';
			echo '<p><a href="' . $r->permalink_url . '" target="_blank">Track Title: ' . $r->title . '</a></p>';
			echo '<p>Genre: ' . $r->genre . '</p></div>';

		}

	?>

</div>

<h3>1. Create a client object</h3>
<p>After downloading the PHP API Wrapper from GitHub, place the "Services" folder inside your project folder. We need to reference the SoundCloud class inside this folder, create a client object with your app credentials like so:</p>

<pre>
	<code class="php">

	require_once 'Services/Soundcloud.php';

	$client = new Services_Soundcloud(
	    'CLIENT_ID',
	    'CLIENT_SECRET'
	);
	</code>
</pre>

<h3>2. Create a form with POST request</h3>
<p>We need to create a form will post your search request to the query to the API and return the SoundCloud results.</p>

<pre>
	<code class="html">

	&lt;form method=&quot;post&quot; action=&quot;.&quot;&gt;

	&lt;input type=&quot;text&quot; name=&quot;search&quot; /&gt;
	&lt;input type=&quot;submit&quot; name=&quot;submit&quot; /&gt;
		
	&lt;/form&gt;

	</code>
</pre>

<h3>3. Generate the GET request</h3>
<p>When the submit button is clicked, we use the $_POST superglobal array to pass the query string into the get request for the API.</p>

<p>In the code below, we use the 'q' filter which is a filter that looks for anything that matches the query string. You can restrict search results by assigning more filters, like duration and record label. See the <a href="https://developers.soundcloud.com/docs/api/reference#tracks" target="_blank">API documentation</a> for more filtering options.</p>

<pre>
	<code class="php">
	//if a query is posted
	if(isset($_POST['submit'])){

		//get the query value
		$query = $_POST['search'];

		//url for GET request
		$url = 'http://api.soundcloud.com/tracks';

		//create full get request with URL, find sounds that match query string, limit results to 10
		$results = $client->get($url, array('q' => $query, 'limit' => '10'));
		
	</code>
</pre>

<h3>4. Parse the Results into Array of Objects</h3>

<p>The queried result set is returned as single string, so we need to convert it into a JSON object for ease of displaying each result.</p>

<pre>
	<code class="php">

		$results_array = json_decode($results);

	}

	</code>
</pre>

<h3>5. Display results in the View</h3>
<p>This can be done using a <code>foreach</code> loop. We can then target the properties we want to display.</p>

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

<h2>PART II: Search featuring OAuth</h2>
<p>The downside to performing a search request as we did in the above tutorial is that some information is inaccessible to non-SoundCloud users. Certain searchable properties require, in other words, authentication in order to access. In this tutorial we'll show you how to retrieve search results as an authenticated user.</p>

<h3>1. Create a new instance of your client</h3>
<p>Start by requiring the Soundcloud class like in the first tutorial, then create a new instance of our client info. Once the code matches the tokens from the query string, we are ready to search with the API</p>

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

<p>...and there you go. You've just searched Soundcloud using the API with PHP!</p>
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
	    echo "Track url: " . $track_url . "&lt;br&gt;";

	    $embed_info = json_decode($client->get('oembed', array('url' => $track_url)));

	//render the html for the player widget
	print $embed_info->html;

     
	}
	</code>
</pre>

<p><strong>DEMO</strong>: <a href="<?php echo $authorizeUrl; ?>">Connect with SoundCloud</a></p>
<p><a href="oauth-search.zip">DOWNLOAD ZIP FILES</a></p>


<?php include '../views/footer.php'; ?>