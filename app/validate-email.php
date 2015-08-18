<?php

// Connect to the database
$dbc = new mysqli('localhost', 'root', '', 'ajax_live_validation');

// Filter the email
$email = $dbc->real_escape_string($_POST['email']);

// SQL
$sql = "SELECT email FROM users WHERE email = '$email' ";

// Run the SQL
$result = $dbc->query($sql);

// If there is a result
if( $result->num_rows == 1 ) {
	echo 'In use';
} else {
	echo 'Available';
}




