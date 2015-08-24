<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Poll</title>
</head>
<body>
	
	<h1>Movie Poll</h1>

	<?php

		// Find out if the user has already voted
		// Connect to the database
		$dbc = new mysqli('localhost', 'root', '', 'ajax_poll');

		// Get the users IP address
		$ipAddress = $_SERVER['REMOTE_ADDR'];

		// Prepare SQL
		$sql = "SELECT id FROM votes WHERE ip_address = '$ipAddress' ";

		// Run the query
		$result = $dbc->query($sql);

		// If there was a result
		if( $result->num_rows == 1 ) {

			// User has already voted
			// Tally up the votes
			$sql = "SELECT COUNT(id) AS TotalVotes,
					SUM( (CASE WHEN vote = 'yes' THEN 1 ELSE 0 END) ) AS TotalYes,
					SUM( (CASE WHEN vote = 'no' THEN 1 ELSE 0 END) ) AS TotalNo
					FROM votes";

			// Run the SQL
			$result = $dbc->query($sql);

			// Convert the result into an associative array
			$result = $result->fetch_assoc();

			// Convert the strings into numbers
			$result['TotalVotes'] 	= (int)$result['TotalVotes'];
			$result['TotalYes'] 	= (int)$result['TotalYes'];
			$result['TotalNo'] 		= (int)$result['TotalNo'];

			// Convert into JSON
			$result = json_encode($result);

			// Create a javascript element and call the showChart function
			$alreadyVoted =  '<script>var toShow = '.$result.'</script>';

		}



	?>


	<p>Did you like Ant Man?</p>

	<div>
		<input type="radio" name="vote" value="yes" id="vote-yes">
		<label for="vote-yes">Yes</label>
	</div>

	<div>
		<input type="radio" name="vote" value="no" id="vote-no">
		<label for="vote-no">No</label>
	</div>

	<button id="vote">Submit your vote</button>
	<span id="message"></span>

	<div id="poll-results-chart"></div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>


	<?php

		if( isset($alreadyVoted) ) {
			echo $alreadyVoted;
		}

	?>
	<script src="js/poll.js"></script>
	

</body>
</html>