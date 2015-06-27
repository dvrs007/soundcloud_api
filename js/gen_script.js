SC.initialize({
  client_id: '4a562b1152ae828060d7bfbe66343599',
  redirect_uri: 'http://soundcloudapi.philipjamesdevries.com'
});

$(document).ready(function() {
	
  	SC.get('/tracks', { 
      	"genre": "pop"
    }, function(tracks) {

	    $(tracks).each(function(index, track) {
	    	$('#results').append($('<li></li>').html(track.title + ' - ' + track.genre));
		});
  	});
});