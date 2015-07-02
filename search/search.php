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