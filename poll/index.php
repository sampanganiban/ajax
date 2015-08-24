<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Poll</title>
</head>
<body>
	
	<h1>Movie Poll</h1>
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
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/poll.js"></script>

</body>
</html>