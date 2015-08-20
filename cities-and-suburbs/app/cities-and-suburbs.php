<?php

// Connect to the database
$dbc = new mysqli('localhost', 'root', '', 'ajax_cities_suburbs');

// Obtain and filter the cityID
$cityID = $dbc->real_escape_string($_GET['cityID']);

// Prepare SQL
$sql = "SELECT suburbName FROM suburbs WHERE cityID = $cityID";

// Run the SQL
$resultDB = $dbc->query($sql);

// If there was a result
if( $resultDB->num_rows > 0 ) {

	// Prepare an array that will contain all the results
	$suburbs = [];

	// Loop over each result from the database
	while($suburb = $resultDB->fetch_assoc()) {

		// Put the name of this suburb into the collection
		$suburbs[] = $suburb['suburbName'];

	}

	// Convert into json
	$suburbsJSON = json_encode($suburbs);

	// Prepare the header
	header('Content-Type: application/json');

	// Send the data
	echo $suburbsJSON;

}