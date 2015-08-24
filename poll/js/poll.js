google.load("visualization", "1", {packages:["corechart"]});

$(document).ready(function(){

	// If there is a variable called toShow on the page
	if( toShow != undefined ) {
		showChart(toShow);
	}


	// Listen for clicks on the vote button
	$('#vote').click(function(){

		// Select the checked radio button
		var userVote = $('[name=vote]:checked').val();

		// If the vote is undefined
		// This can only happen if they click submit without choosing an option
		if( userVote == undefined ) {
			$('#message').html('Please choose your vote!');
			return;
		} else {
			$('#message').html('');
		}

		// AJAX
		$.ajax({
			type: 'get',
			url: 'app/poll.php',
			data: {
				vote: userVote
			},
			success: function( dataFromServer ) {
				console.log(dataFromServer);

				$('#message').html( dataFromServer.message );

				// If the vote was successful
				if( dataFromServer.status == true ) {

					showChart( dataFromServer.pollResults );

				}

				
				
			},	
			error: function() {
				$('#message').html('Sorry, our servers are busy...');
			}
		});









	});

});

function showChart( pollResults ) {

	console.log(pollResults);

	var data = google.visualization.arrayToDataTable([
		// Column names
	  	['Vote', 'Count'],

	    // Data
	    ['Yes',     pollResults.totalYes],
	    ['No',     pollResults.totalNo]
	   
	]);

	var options = {
		title: 'Poll Results'
	};

	// Create the chart
	var chart = new google.visualization.PieChart(document.getElementById('poll-results-chart'));

	// Display the chart
	chart.draw(data, options);

}













