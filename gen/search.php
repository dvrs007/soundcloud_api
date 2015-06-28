<!doctype html>
<html>
	<head>

		<meta charset="UTF-8"/>
		<title></title>

		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/styles/atelier-cave.light.css" />

		<!-- jQuery -->
		<script src="../js/jquery-2.1.4.js"></script>

		<!-- SoundCloud API -->
		<script src="//connect.soundcloud.com/sdk-2.0.0.js"></script>
		<script src="../js/gen_script.js"></script>

		<!-- Script Highlighting -->
		<script src="../js/highlight.js"></script>
		<script>hljs.initHighlightingOnLoad();</script>

	</head>
	<body>

	<h1>Searching for Sounds</h1>

	<form method="post" action=".">

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
	</ul>

	<h2>1. Register Your Application</h2>
	<p>Head over to SoundCloud and register your new application. You'll need to save the client id, client secret.</p>

	<h2>2. Create a client object</h2>
	<p>Create a client object with your app credentials</p>

	<pre>
		<code class="html">
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

	<h2>4.</h2>
	<p></p>

	<h2>5.</h2>
	<p></p>


	</body>
</html>