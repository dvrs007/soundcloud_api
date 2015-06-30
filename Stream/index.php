<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Soundcloud API Tutorials</title>

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <link rel="stylesheet" type="text/css" href="../css/styles/atelier-cave.light.css" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <!-- jQuery -->
        <script src="/soundcloud_api/js/jquery-2.1.4.js"></script>





    
<script src="//connect.soundcloud.com/sdk.js">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    
        <script>
            //initialize your cilent with your own client_id
            //you could also put in your redirect url
            //but in this example we will not be using the redirect url 
  SC.initialize({
    client_id: "78dd9e3098e27384c19f53b320d994bc"
  });
  
  //when the document is loaded this function will be
  //ready/available to be used
  
    $(document).ready(function() {
// to use the SDK , the streaming function is powered by
//soundmanager2 library, this will auto load by the SDK


// this part is where you use the SoundCloud stream for a track
// for this example we will be using a given track by soundcloud
// so we will call the soundcloud SDK stream
// what it does is converts the track to an object
// we will call the SC.stream and then pass a path to a track
// and then a callback function, the callback function
//will take one argument called sound
SC.stream('/tracks/293', function(sound) {
// this is where we will make two buttonz which will have the id play and stop
//we will create a function that when the buttons are clicked it will play or stop the sound

//when the button with the id is clicked the function will have an event

$('#play').click(function(e) {
//when the the function is click the event will prevent default which this method will not accept any arguments
    e.preventDefault();
//the argument sound will then play
    sound.play();
  });

  $('#stop').click(function(e) {
    e.preventDefault();
//the arguemnt sound will then stop
    sound.stop();
  }); 
});
});
    
   
    
</script>
        </head>
    <body>

 <header> 
        <div id="navbar">
            <nav>
            	<div class="home-btn">
					<a href="../index.php"><i class="fa fa-home"></i></a>
				</div>
            	<ul>
	                <li class="tutorials"><i class="fa fa-caret-down"></i> API Tutorials
	                	<div class="secondary">
	                		<ul>
		                			<li><a href="../soundcloud_api/search/index.php" title="Search Tutorial">Search SoundCloud</a></li>
		                		<li><a href="../soundcloud_api/upload/" title="Upload Tutorial">Upload your sound</a></li>
		                		<li><a href="../soundcloud_api/Stream/" title="">Stream Tutorial</a></li>
		                		<li><a href="#" title="">Track Widget Tutorial</a></li>
	                		</ul>
	                	</div>
	                </li>
	                <li class="sc-link"><a href="https://developers.soundcloud.com/" target="_blank"><i class="fa fa-soundcloud"></i> SoundCloud</a></li>
                </ul>
             </nav>
        </div>
    </header>

    <div class="container"> 

   
<h1>Streaming with JavaScript</h1>
<div class="hr"></div>
<div>
<p>How to stream music from SoundCloud with JavaScript. This will have explain the simple concept on how to stream
music from SoundCloud with basic play and stop button.</p>
</div>
<h2>
Tutorial 
</h2>
<div class="hr"></div>

<p>This is where we will make two buttons, in which will have the id play and stop, we will create a function that when the buttons are clicked it will play or stop the sound.
</p>
<p>
 < button id="play"> Play< /button>
 <br/>
 < button id="stop">Stop< /button>
</p>

<p>Now will will begin by initialize your cilent with your own client_id
<br/>
  SC.initialize({
    client_id: "YOUR CILENT ID"
  });</p>
<p>you could also put in your redirect url, but in this example we will not be using the redirect url </p>

<p>We will then start to make a function that will be available when the document loads
<br/>  $(document).ready(function() </p>

<p>Within that function will will call the soundcloud stream SDK, this will pass through a track and then the function will have an argument name sound 
<br/>SC.stream('/tracks/293', function(sound)
<br/>
the streaming functionality is powered by soundmanager2 library, this will autoload by the SDK
</p>


<p>We will now create a function that whenthe buttons are clicked it will play the track.
when the the function is click the event will prevent default which this method will not accept any arguments the argument sound will then play

<br/>
$('#play').click(function(e) {
<br/>
    e.preventDefault();
    <br/>

    sound.play();
    <br/>
    }
</p>

<p>
We will now create the function for stop
<br/>
$('#play').click(function(e) {
<br/>
    e.preventDefault();
    <br/>

    sound.play();
    <br/>
    }
</p>

<p>Now we close the function off, and now we can click on the buttons and it will play and stop the music stream</p>
<h2>Example</h2>
<div class="hr"></div>


<button id="play"> Play</button>
<button id="stop">Stop</button>



<h2>Download</h2>
<div class="hr"></div>
<p>You can download the documentation here.</p>
<p><a href="streamjavascript.zip">Download</a></p>
        
    
        
        <?php include '../views/footer.php'; ?>