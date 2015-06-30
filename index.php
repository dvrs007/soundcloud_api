<?php 

include 'views/header.php'; 

?>

<h1>Introduction to the SoundCloud API</h1>
<div class="hr"></div>
<p>
    (Please feel free to change the following)<br/>
    SoundCloud is the perfect place to share musical sound with your friends. You can search for the sound you want to listen to, and upload the audio file to share what you produced with your friends.
    Also, for the uploaded and shared sound, visitors and friends can make a comment.<br/>
</p>

<h1>Create an Account</h1>
<p>In order to register your App, you need an account with Soundclolud. Please go to the signup page by clicking <a href="https://soundcloud.com/signup">here</a>.</p>

<h1>Registering for an Application</h1>
<div class="hr"></div>
<p>Please go to the page to register for the keys and tokens by clicking <a href=" http://soundcloud.com/you/apps/new ">here</a>.
You need to enter "Title", "Website", and "Redirect URI" of your app. Please keep "Client ID" and "Client Secret" in a separate file, e.g. "sc_credentials.php", to include later in your app.

<h1>Examples</h1>
<ul>
    <li><a href=""><h2>Search with php</h2></a></li>
    <li><a href="upload/"><h2>Upload with php</h2></a></li>
    <li><a href=""><h2>Streaming with JavaScript</h2></a></li>
    <li><a href=""><h2>the play track widget</h2></a></li>
</ul>

<?php include 'views/footer.php'; ?>