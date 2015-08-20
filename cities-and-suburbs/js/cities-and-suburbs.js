$(document).ready(function(){

	// Listen for a change in the select element
	$('#city').change( showSuburbs );

});

function showSuburbs() {

	// Get the ID of the city
	var cityID = $(this).val();

	// Make sure the ID is a number
	if( isNaN(cityID) ) {
		return;
	}

	// Prepare AJAX
	$.ajax({
		type: 'get',
		url: 'app/cities-and-suburbs.php?cityID='+cityID,
		success: function( dataFromServer ){

			// Preview the data in the console
			console.log(dataFromServer);

			// Clear the suburb select element
			$('#suburbs').html('');

			// Loop over each item in the result
			$(dataFromServer).each(function(i){

				// Create a new option element and append it to the select element
				$('#suburbs').append('<option>'+dataFromServer[i]+'</option>');

			});

		},
		error: function(){
			console.log('Cannot connect to server...');
		}
	});











}