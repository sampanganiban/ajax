<?php

// Connect to the database
$dbc = new mysqli('localhost', 'root', '', 'ajax_customers');

// Filter the ID
$customerID = $dbc->real_escape_string( $_GET['customerID'] );

// Prepare the SQL
$sql = "SELECT phone, email
		FROM customers
		WHERE id = $customerID";

// Run the query
$resultDB = $dbc->query($sql);

// If there was a result
if( $resultDB->num_rows == 1 ) {

	// Convert the result into an associative array
	$resultASSOC = $resultDB->fetch_assoc();

	// Convert the result into JSON
	$resultJSON = json_encode($resultASSOC);

	// Set up the header so JavaScript knows that we are sending JSON
	header('Content-Type: application/json');

	// Send the data back to JavaScript
	echo $resultJSON;

} else {



}







