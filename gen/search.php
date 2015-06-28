<!doctype html>
<html>
	<head>

		<meta charset="UTF-8"/>
		<title></title>

		<link rel="stylesheet" src="" />
		<script type="text-javascript" src=""></script>

	</head>
	<body>

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

	</body>
</html>