<?php

// Connect to the database
$dbc = new mysqli('localhost', 'root', '', 'ajax_live_validation');

// Filter the username
$username = $dbc->real_escape_string($_POST['username']);

// SQL
$sql = "SELECT username FROM users WHERE username = '$username' ";

// Run the SQL
$result = $dbc->query($sql);

// If there is a result
if( $result->num_rows == 1 ) {
	echo 'In use';
} else {
	echo 'Available';
}




