var inputsuggestion = $(document).select('#login.suggestion');

$('<datalist/>', {
    id: 'login_suggestions',
    class: 'suggestion'
}).insertAfter('#login.suggestion');

var suggestions = $(document).select('#login_suggestions.suggestion');

inputsuggestion.attr("list", "login_suggestions");


inputsuggestion.bind( "input", function(data) {
	var elem = data.target;
	console.log('elem');
	console.log(elem);
	$.get('http://' + window.location.hostname+ "/index.php/search/usersuggestion/10/s", function(response) {
		$(document).select('#login_suggestions.suggestion').html('');
		//dev suggestion.js
		for(var i=0;i<response.length;i++){
			console.log(response[i]);
			console.log(suggestions);
			//$("<option value='" + response[i] + "'></option>").appendTo('#login_suggestions.suggestion');
		}
	});
});

console.log(suggestions);

/*
$(document).select('option.suggestion').bind( "cick", function(data) {
	var elem = data.target;
	console.log("select "+elem.value);
});*/



//TODO add attribute to login input list="datalist1" to ref its datalist

// suggestions.appendTo($(document).select('form')[0]);


/*suggestions.insertAfter(inputsuggestion.parent());
$('<option value="test" class="suggestion">').appendTo(suggestions);
*/
