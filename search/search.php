<h1>Searching SoundCloud for Sounds</h1>

<form method="post" action=".">

	<label for="search">Enter your search keyword:</label>
	<input type="text" name="search" />
	<input type="submit" name="submit" />

</form>

<?php 

	foreach ($results_array as $r) {
		
		echo '<p>User: ' . $r->user->username . '</p>';
		echo '<p>Track Title: ' . $r->title . '</p>';
		echo '<p>Date Created: ' . $r->created_at . '</p>';
		echo '<p>Genre: ' . $r->genre . '</p>';
		echo '<p>Tags: ' . $r->tag_list . '</p><hr>';

	}

?>

<h2>Introduction</h2>
<p>Resources such as sounds, users, sets and groups can be searched using the SoundCloud API. This tutorial will show you how to build a application which returns results based on the user's search entry. For more information about SoundCloud search, see the official documentation <a href="https://developers.soundcloud.com/docs/api/guide#search" target="_blank">here</a>.</p>

<h2>Getting Started</h2>
<p>In order to get this application up and running you'll need:</p>
<ul>
	<li>PHP 5 or higher</li>
	<li><a href="https://github.com/mptre/ci-soundcloud" target="_blank">SoundCloud PHP API wrapper</a></li>
	<li>Register Your Application</li>
</ul>

<h2>2. Create a client object</h2>
<p>Create a client object with your app credentials</p>

<pre>
	<code class="html">

		require_once 'Services/Soundcloud.php';

		$client = new Services_Soundcloud(
		    'CLIENT_ID',
		    'CLIENT_SECRET'
		);
	</code>
</pre>

<h2>3. Create form with POST request</h2>
<pre>
	<code class="html">

		&lt;form method=&quot;post&quot; action=&quot;.&quot;&gt;

		&lt;input type=&quot;text&quot; name=&quot;search&quot; /&gt;
		&lt;input type=&quot;submit&quot; name=&quot;submit&quot; /&gt;
			
		&lt;/form&gt;

	</code>
</pre>

<h2>4. Generate the GET request</h2>
<pre>
	<code class="html">
		//if a query is posted
		if(isset($_POST['submit'])){

			$query = $_POST['search'];

			//url for GET request
			$url = 'http://api.soundcloud.com/tracks';

			//find sounds with query keyword, tack onto the end of url
			$results = $client->get($url, array('q' => $query, 'limit' => '10'));
		
	</code>
</pre>

<h2>5. Parse the Results into Array of Objects</h2>
<pre>
	<code class="html">

			$results_array = json_decode($results);

		}

	</code>
</pre>

<h2>6. Display results in the View</h2>
<pre>
	<code class="html">

		foreach ($results_array as $r) {
			
			echo '&lt;p&gt;User: ' . $r-&gt;user-&gt;username . '&lt;/p&gt;';
			echo '&lt;p&gt;Track Title: ' . $r-&gt;title . '&lt;/p&gt;';
			echo '&lt;p&gt;Date Created: ' . $r-&gt;created_at . '&lt;/p&gt;';
			echo '&lt;p&gt;Genre: ' . $r-&gt;genre . '&lt;/p&gt;';
			echo '&lt;p&gt;Tags: ' . $r-&gt;tag_list . '&lt;/p&gt;&lt;hr&gt;';

		}

	</code>
</pre>

<h2>7. Voilà!</h2>
<p>Your application should now be up and running.</p>

<?php include '../views/footer.php' ?>