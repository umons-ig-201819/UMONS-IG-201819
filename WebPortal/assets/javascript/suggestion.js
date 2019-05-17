var suggestions;
var inputsuggestion;
$( document ).ready(function() {

	inputsuggestion = $(document).select('#login.suggestion');
	suggestions = $(document).select('#login_suggestions.suggestion');	
	
	inputsuggestion.bind( "input", function(data) {
		var elem = data.target;
		$.get('http://' + window.location.hostname+ "/index.php/search/usersuggestion/10/"+elem.value, function(response) {
			//dev suggestion.js
			var content = "";
			for(var i=0;i<response.length;i++){
				content += "<option value='" + response[i] + "'></option>\n";
			}
			document.getElementById('login_suggestions').innerHTML=content;
		});
	});

});
