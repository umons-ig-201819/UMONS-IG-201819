var suggestions;
var inputsuggestion;
$( document ).ready(function() {

	inputsuggestion = $(document).select('#login.suggestion');
	suggestions = $(document).select('#loginsuggestions.suggestion');	
	
	inputsuggestion.bind( "input", function(data) {
		var elem = data.target;
		$.get('http://' + window.location.hostname+ "/index.php/search/usersuggestion/10/"+elem.value, function(response) {
			var content = "";
			for(var i=0;i<response.length;i++){
				content += "<option value='" + response[i] + "'></option>\n";
			}
			document.getElementById('loginsuggestions').innerHTML=content;
		});
	});

});
