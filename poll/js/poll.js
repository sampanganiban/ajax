$(document).ready(function(){

	// Listen for clicks on the vote button
	$('#vote').click(function(){

		// Select the checked radio button
		var userVote = $('[name=vote]:checked').val();

		// If the vote is undefined
		// This can only happen if they click submit without choosing an option
		if( userVote == undefined ) {
			$('#message').html('Please choose your vote!');
			return;
		} else {
			$('#message').html('');
		}

		// AJAX
		$.ajax({
			type: 'get',
			url: 'app/poll.php',
			data: {
				vote: userVote
			},
			success: function( dataFromServer ) {
				console.log(dataFromServer);

				$('#message').html( dataFromServer.message );

				
				
			},	
			error: function() {
				$('#message').html('Sorry, our servers are busy...');
			}
		});









	});

});