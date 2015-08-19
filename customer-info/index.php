<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Customer Info</title>
</head>
<body>
	
	<h1>Customer Info</h1>
	<select name="customer" id="customer">
		<option>Please select...</option>
		<?php
			
			// Connect to database
			$dbc = new mysqli('localhost', 'root', '', 'ajax_customers');

			// Prepare SQL
			$sql = "SELECT id, CONCAT(last_name, ', ', first_name) AS Customer
					FROM customers
					ORDER BY Customer";

			// Run the query
			$result = $dbc->query($sql);

			// Loop over each result
			while( $customer = $result->fetch_assoc() ) {
				echo '<option value="'.$customer['id'].'">';
				echo $customer['Customer'];
				echo '</option>';
			}


		?>
	</select>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/customer-info.js"></script>

</body>
</html>