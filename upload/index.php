<?php

include '../views/header.php';
?>

<p>
<h2>Tutorial for Uploading your music file with the PHP wrapper.</h2>
<br/>
You are assumed to have an account with SoundCloud and register for the key and the token.
<br/>
(1)Download the PHP Wrapper from <a href="https://github.com/mptre/php-soundcloud" target="_blank">HERE</a> (Github repository).<br/>
Click "Download ZIP" on the page above.<br/>
What you need is the "Services" folder with all files in it.<br/>
Place the "Services" folder in the folder that you are working on.<br/><br/>
(2)Please have the following lines of code on top of your code.<br/>
<code class="php">
    require_once 'Services/Soundcloud.php';<br/>
    require_once 'sc_credentials.php';
</code>
sc_credentials.php includes your app information such as <br/>
Client ID, Client Secret, and Redirect URI.<br/>
The information that you set when you register for your app with SoundCloud.<br/>
<br/>

Then, all set.Now let's start coding.<br/>
First thing is to create an object to conduct the available method in the PHP wrapper.

<code class="php">
    $sc_connection = new Services_Soundcloud(
    CLIENT_ID, CLIENT_SECRET, CALL_BACK_URI);
</code>

<br/>
Then,generate the token for your user with the following link.
<code class="php">
    $authURL = $sc_connection->getAuthorizeUrl();
    echo '<a href="' . $authURL . '">Connect to SoundCloud</a>';
</code>
<br/>When your user clicks the  link, one would get the token to use your app, here, to upload one's sound file.<br/>

<br/>
Next, store the access token.<br/>
<code class="php">
    $accessToken = $sc_connection->accessToken($_GET['code'], array(), array(
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    ));
</code>
<br/>
Now, let's get the user's information through '/me' end point. The reference for this resource end point is available <a href="https://developers.soundcloud.com/docs/api/reference#me" target="_blank">HERE</a>.
<code class="php">
    $me = json_decode($sc_connection->get('me'), true);
</code>

<br/>
Finally, your user can get one's profile information by the following lines.<br/>
<code class="php">
    $user_data = array(<br/>
    'id' => $me['id'],<br/>
    'username' => $me['username'],<br/>
    'name' => $me['full_name'],<br/>.
    'avatar' => $me['avatar_url']<br/>
    );
</code>
<br/>
So, the above is for logging into the SoundCloud.<br/>

<br/>
Next is the form to upload a file into the Soundcloud account.<br/>
The zip files are available to download or you can see the DEMO.<br/>
<a href='../jeesoo/sc_uploading.zip'>Zip files to download</a><br/>
<a href="../jeesoo/" target="_blank">DEMO</a>

<br/><br/>
Note:<br/>
If you download the zip file, please change the followings for your setting.<br/>
The zip file includes three files of index.php, upload.php, and sc_credentials.php<br/>
(1) sc_credentials.php: please have your credentials for the app.<br/>
(2) upload.php: at the bottom, change "header("Location:YOUR_REDIRECT_URI_SHOULD_BE_HERE")" <br/>
(3) index.php and upload.php: change the lines for 'header' and 'footer' for both files.Currently, they are commented out.

</p>
<br/>


<?php

include '../views/footer.php';
?>