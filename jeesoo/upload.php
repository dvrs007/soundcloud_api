<?php
session_start();

//require the PHP Wrapper with soundcloud credentials
//credentials are created when the your application is registered with SoundCloud API
require_once '../php-soundcloud-master/Services/Soundcloud.php';
require_once 'upload_credentials.php';

include '../views/header.php';

// create a client object with your app credentials
// Developer's ID, i.e. developer = client
// this is the developer's object
$sc_connection = new Services_Soundcloud(
        CLIENT_ID, CLIENT_SECRET, CALL_BACK_URI);

//Make sure that this is production mode, not development mode
//TRUE: 'development' => 'sandbox-soundcloud.com',
//FALSE: 'production' => 'soundcloud.com'
$sc_connection->setDevelopment(false);
//********************************************************************//
//if there exists the post method,
//the client object will set the access token which has been posted 
//and
//the array will store the track information which has been posted by a form below.

if ($_POST) {

    $sc_connection->setAccessToken($_POST['access_token']);

    // The posted information will be set for the value of '/track'.
    $mytrack = array(
        'track[title]' => $_POST["audioname"],
        'track[asset_data]' => '@' . $_FILES["audiofile"]["tmp_name"]
    );

    // the posted information from the $mytrack array will be posted to '/tracks' under user's account 
    $track = json_decode($sc_connection->post('tracks', $mytrack));


    //Successful upload will generate the following message with a link to the page with uploaded sound file.
    echo '<p>File has been successfully uploaded to your Soundcloud account. <br/>'
    . 'Please click <b><a href="' . $track->permalink_url . '" target="_blank" >HERE</a></b> to listen to.</p>';
} else
if ($_GET['access_token']) {
    ?>



    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <!--html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sound Cloud API-Upload your AUDIO/SOUND</title>
    </head-->

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

        <!--/body>
        </html-->


        <?php
    } else {
        header("Location:http://soundcloudapi.philipjamesdevries.com/jeesoo/");
    }


    include '../views/footer.php';
    ?>   