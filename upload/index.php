<?php

include '../views/header.php';
?>

<h1>Upload Sounds with PHP</h1>
<div class="hr"></div>

<h2>Getting Started</h2>
<p>You are assumed to have an account with SoundCloud and register for the key and the token.

<p>In order to get this application up and running you'll need:</p>
<ul>
    <li>PHP 5 or higher</li>
    <li><a href="https://github.com/mptre/ci-soundcloud" target="_blank">SoundCloud PHP API Wrapper</a></li>
    <li><a href="../home/index.php">Register Your Application</a></li>
</ul>

<p>Place the "Services" folder from the SoundCloud PHP API Wrapper download in the folder that you are working on and add the following lines of code on top of your code.</p>

<pre>
    <code class="php">
    require_once 'Services/Soundcloud.php';<br/>
    require_once 'sc_credentials.php';
    </code>
</pre>

<p>sc_credentials.php includes your app information such as Client ID, Client Secret, and Redirect URI. The information that you set when you register for your app with SoundCloud. Now let's start coding.</p>
<p>First thing is to create an object to conduct the available method in the PHP wrapper.</p>

<pre>
    <code class="php">
    $sc_connection = new Services_Soundcloud(
    CLIENT_ID, CLIENT_SECRET, CALL_BACK_URI);
    </code>
</pre>


<p>Then, generate the token for your user with the following link.</p>

<pre>
    <code class="php">
    $authURL = $sc_connection->getAuthorizeUrl();
    echo '<a href="' . $authURL . '">Connect to SoundCloud</a>';
    </code>
</pre>

<p>When your user clicks the  link, one would get the token to use your app, here, to upload one's sound file.</p>
<p>Next, store the access token.</p>

<pre>
    <code class="php">
    $accessToken = $sc_connection->accessToken($_GET['code'], array(), array(
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
    ));
    </code>
</pre>

<p>Now, let's get the user's information through '/me' end point. The reference for this resource end point is available <a href="https://developers.soundcloud.com/docs/api/reference#me" target="_blank">HERE</a>.</p>
<pre>
    <code class="php">
    $me = json_decode($sc_connection->get('me'), true);
    </code>
</pre>

<p>Finally, your user can get one's profile information by the following lines.</p>

<pre>
    <code class="php">
    $user_data = array(
        'id' => $me['id'],
        'username' => $me['username'],
        'name' => $me['full_name'],
        'avatar' => $me['avatar_url']
    );
    </code>
</pre>

<p>So, the above is for logging into the SoundCloud.</p>

<p>Next is the form to upload a file into the Soundcloud account. The zip files are available to download or you can see the DEMO.</p>
<p><a href="../jeesoo/" target="_blank">DEMO</a> | <a href='../jeesoo/sc_uploading.zip'>DOWNLOAD ZIP FILES</a></p>

<p><strong>Note:</strong></p>
<p>If you download the zip file, please change the followings for your setting. The zip file includes three files of index.php, upload.php, and sc_credentials.php</p>
<ol>
    <li>sc_credentials.php: please have your credentials for the app.</li>
    <li>upload.php: at the bottom, change "header("Location:YOUR_REDIRECT_URI_SHOULD_BE_HERE")"</li>
    <li>index.php and upload.php: change the lines for 'header' and 'footer' for both files.Currently, they are commented out.</li>
</ol>

<?php

include '../views/footer.php';
?>