<?php include '../views/header.php'; ?>

<script>
  SC.initialize({
    client_id: "78dd9e3098e27384c19f53b320d994bc"
  });
    $(document).ready(function() {

SC.stream('/tracks/293', function(sound) {
  $('#play').click(function(e) {
    e.preventDefault();
    sound.start();
  });
  $('#stop').click(function(e) {
    e.preventDefault();
    sound.stop();
  }); 
});
});  
</script>
   
<h1>Streaming with JavaScript</h1>
<p>How to stream music from SoundCloud with JavaScript. This will have explain the simple concept on how to stream
music from SoundCloud with basic play and stop button.</p>

<h2>Example</h2>
<p>This example will play a song from SoundCloud</p>

<button id="play"> Play</button>
<button id="stop">Stop</button>
        
<?php include '../views/footer.php'; ?>