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



		},
		error: function(){
			console.log('Cannot connect to server...');
		}
	});











}