var inputsuggestion = $(document).select('#login.suggestion');

$('<datalist/>', {
    id: 'login_suggestions',
    class: 'suggestion'
}).insertAfter('#login.suggestion');

var suggestions = $(document).select('#login_suggestions.suggestion')[0];

inputsuggestion.attr("list", "login_suggestions");


inputsuggestion.bind( "input", function(data) {
	var elem = data.target;
	$.get('http://' + window.location.hostname+ "/index.php/search/usersuggestion/10/"+elem.value, function(response) {
		$(document).select('#login_suggestions.suggestion').html('');
		//dev suggestion.js
		for(var i=0;i<response.length;i++){
			console.log(response[i]);
			console.log(suggestions);
			//$("<option value='" + response[i] + "'></option>").appendTo('#login_suggestions.suggestion');
		}
	});
});

