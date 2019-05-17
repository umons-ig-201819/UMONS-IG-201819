
$(document).select('#login.suggestion').bind( "input", function(data) {
	console.log(data)
	$.get('http://' + window.location.hostname+ "/index.php/search/usersuggestion/10/s", function(response) {
		console.log(response);
		console.log("done");
	});
});
