$(document).ready(function(){

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
                
                if(dataFromServer.status == true) { 
                    drawChart(dataFromServer);  
                }

			},	
			error: function() {
				$('#message').html('Sorry, our servers are busy...');
			}
		});

	});


});

// Load the Visualization API and the piechart package
google.load("visualization", "1", {packages:["corechart"]});

// Populate the data
function drawChart(dataFromServer) {

    var data = google.visualization.arrayToDataTable([
    // All charts: Columns names must go first, the rest is data
      ['Vote Type', 'Vote Amount'],
      ['Yes I liked it',dataFromServer.pollResults.totalYes],
      ['No I did not like it',dataFromServer.pollResults.totalNo]
    ]);

    var options = {
      title: 'Total Votes'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);

}


