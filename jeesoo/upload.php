<?php
session_start();
require_once '../Services/Soundcloud.php';
require_once 'sc_credentials.php';

// create a client object with your app credentials
$sc_connection = new Services_Soundcloud(
	CLIENT_ID, 
	CLIENT_SECRET, 
	CALL_BACK_URI);
	
$sc_connection->setDevelopment(false);


// create a client object with your app credentials
$sc_connection = new Services_Soundcloud(
	CLIENT_ID, 
	CLIENT_SECRET, 
	CALL_BACK_URI);
	
$sc_connection->setDevelopment(false);

if($_POST){
 
  
  
  $sc_connection->setAccessToken($_POST['access_token']);
 
  $mytrack = array(
    'track[title]' => $_POST["audioname"],
    'track[asset_data]' => '@'.$_FILES["audiofile"]["tmp_name"] 
     );
 
  $track = json_decode($sc_connection->post('tracks', $mytrack));
  echo '<p><b>File successfully uploaded to <a href="'.$track->permalink_url.'" target="_blank" >'.$track->permalink_url.'</a>';
}
else 
if($_GET['access_token']){
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sound Cloud API-Upload your AUDIO/SOUND</title>
</head>

<body>



<form action="" method="post" enctype="multipart/form-data">
  <input type="hidden" name="access_token" value="<?php echo $_GET['access_token']; ?>" />
  <br />
  Audio Name:
  <input type="text" name="audioname" placeholder="My audio" />
  <br />
  <br />
  Audio File:
  <input type="file" name="audiofile" id="audiofile" />
  <br />
  <br />
  <input type="submit" />
</form>

</body>
</html>



<?php
}
else{
 header("Location:http://soundcloudapi.philipjamesdevries.com/jeesoo/");
}
?>   