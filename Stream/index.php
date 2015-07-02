<?php 

include "../views/header.php";
?>
    
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
  // will take one argument called sound
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

   
<h1>Streaming with JavaScript</h1>
<div class="hr"></div>

<div>
  <p>How to stream music from SoundCloud with JavaScript. This will have explain the simple concept on how to stream
  music from SoundCloud with basic play and stop button.</p>
</div>

<h2>Tutorial</h2>
<div class="hr"></div>

<p>This is where we will make two buttons, in which will have the id play and stop, we will create a function that when the buttons are clicked it will play or stop the sound.
</p>

<pre>
  <code class="html">
  &#x3C;button id=&#x22;play&#x22;&#x3E; Play&#x3C;/button&#x3E;

  &#x3C;button id=&#x22;stop&#x22;&#x3E;Stop&#x3C;/button&#x3E;
  </code>
</pre>

<p>Now will will begin by initialize your cilent with your own client_id
<br/>
<pre>
    <code class="javascript">
  SC.initialize({
    client_id: "YOUR CILENT ID"
  });
    </code>
</pre>
<p>you could also put in your redirect url, but in this example we will not be using the redirect url </p>

<p>We will then start to make a function that will be available when the document loads</p>

<pre>
  <code class="javascript">
  $(document).ready(function()
  </code>
</pre>

<p>Within that function will will call the soundcloud stream SDK, this will pass through a track and then the function will have an argument name sound 

</p>
<pre>
  <code class="javascript">
  SC.stream('/tracks/293', function(sound)
  </code>
</pre>
<p>
the streaming functionality is powered by soundmanager2 library, this will autoload by the SDK
</p>


<p>We will now create a function that whenthe buttons are clicked it will play the track.
when the the function is click the event will prevent default which this method will not accept any arguments the argument sound will then play
</p>
<pre>
  <code class="javascript">
  $('#play').click(function(e) {

    e.preventDefault();
    sound.play();

  }
  </code>
</pre>

<p>
We will now create the function for stop</p>
<pre>
  <code class="javascript">
  $('#play').click(function(e) {

    e.preventDefault();
    sound.play();

  }
  </code>
</pre>

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