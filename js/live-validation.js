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

}