var inputsuggestion = $(document).select('#login.suggestion');

inputsuggestion.bind( "input", function(data) {
	var elem = data.target;
	$.get('http://' + window.location.hostname+ "/index.php/search/usersuggestion/10/s", function(response) {
		console.log(response);
		console.log("done");
	});
});

var suggestions = $('<datalist/>', {
    id: 'login_suggestions',
    class: 'suggestion'
}).insertAfter(inputsuggestion.parent());

console.log($('<datalist/>'));

/*
<datalist id="suggestions">
<option value="Black">
<option value="Red">
<option value="Green">
<option value="Blue">
<option value="White">
</datalist>
*/