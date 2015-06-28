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

		foreach ($tracks_array as $t) {
			
			echo '<p>' . $t->title . '</p>';

		}

	?>

	</body>
</html>