<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cities &amp; Suburbs</title>
</head>
<body>
	
	<h1>Cities and Suburbs</h1>
	<select name="city" id="city">
		<option>Please select a city...</option>
		<?php

			// Connect to database
			$dbc = new mysqli('localhost', 'root', '', 'ajax_cities_suburbs');

			// Prepare SQL
			$sql = "SELECT cityName, cityID
					FROM cities";

			// Run the SQL
			$result = $dbc->query($sql);

			// Loop through results
			while( $city = $result->fetch_assoc() ) {
				echo '<option value="'.$city['cityID'].'">';
				echo $city['cityName'];
				echo '</option>';
			}

		?>
	</select>

</body>
</html>