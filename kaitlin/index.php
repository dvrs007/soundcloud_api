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
		                		<li><a href="#" title="">Lorem Ipsum</a></li>
		                		<li><a href="#" title="">Lorem Ipsum</a></li>
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
<p>How to stream music from SoundCloud with JavaScript. This will have explain the simple concept on how to stream
music from SoundCloud with basic play and stop button.</p>

<h2>Example</h2>
<p>This example will play a song from SoundCloud</p>

<button id="play"> Play</button>
<button id="stop">Stop</button>


<h2></h2>
        
    
        
        <?php include '../views/footer.php'; ?>