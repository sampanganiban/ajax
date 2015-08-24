<?php

// Connect to the database
$dbc = new mysqli('localhost', 'root', '', 'ajax_poll');

// Capture and filter the vote
$vote = $dbc->real_escape_string($_GET['vote']);

// Create an array of valid words
$validVotes = ['yes', 'no'];

// See if the user vote is in the collection of valid words
if( !in_array($vote, $validVotes) ) {

	$dataToSend = [
		'status' => false,
		'message' => 'Stop hacking, troll!'
	];

	sendMessage( $dataToSend );

}

// Get the user's IP address
$ipAddress = $_SERVER['REMOTE_ADDR'];

// Prepare SQL to find if the user has already voted
$sql = "SELECT id FROM votes WHERE ip_address = '$ipAddress' ";

// Run the SQL
$result = $dbc->query($sql);

// If there is a result
if( $result->num_rows == 1 ) {

	// User has already voted
	$dataToSend = [
		'status' => false,
		'message' => 'You have already voted!'
	];

	sendMessage( $dataToSend );

}

// Prepare the SQL
$sql = "INSERT INTO votes VALUES (NULL, '$vote', '$ipAddress')";

// Insert the vote 
$dbc->query($sql);

// Tally up the votes
$sql = "SELECT COUNT(id) AS TotalVotes,
		SUM( (CASE WHEN vote = 'yes' THEN 1 ELSE 0 END) ) AS TotalYes,
		SUM( (CASE WHEN vote = 'no' THEN 1 ELSE 0 END) ) AS TotalNo
		FROM votes";

// Run and capture result
$result = $dbc->query($sql);

// Convert into an associative array
$result = $result->fetch_assoc();

// Prepare the message
$dataToSend = [
	'status' => true,
	'message' => 'Vote successful!',
	'pollResults' => [
		'totalYes' => $result['TotalYes'],
		'totalNo' => $result['TotalNo'],
		'totalVotes' => $result['TotalVotes']
	]
];

// Send the message
sendMessage( $dataToSend );

function sendMessage($messageToSend) {

	$messageToSend = json_encode($messageToSend);

	// Prepare header
	header('Content-Type: application/json');

	echo $messageToSend;

	exit();

}





