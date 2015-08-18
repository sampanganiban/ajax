$('document').ready(function(){

	// Listen to the username input field
	$('#username').blur( checkUsername );

});

function checkUsername() {

	// Obtain the username
	var username = $(this).val();

	// Leave if the username is blank
	if( username.length < 5 ) {
		$('#username-message').html('Needs to be at least 5 characters');
		return;
	} else {
		$('#username-message').html('');
	}

	// Send the username to the server
	$.ajax({
		type: 'post',
		url: 'app/validate-username.php',
		data: {
			username: username
		},
		success: function(dataFromServer) {
			$('#username-message').html(dataFromServer);
		},
		error: function(){
			console.log('cannot find the php file');
		}
	});









}