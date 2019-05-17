$( document ).ready(function() {

	var inputsuggestion = $(document).select('#login.suggestion');
	
	
	$('<datalist/>', {
	    id: 'login_suggestions',
	    class: 'suggestion'
	}).insertAfter('#login.suggestion');
	
	var suggestions = $(document).select('#login_suggestions.suggestion');
	
	inputsuggestion.attr("list", "login_suggestions");
	
	
	inputsuggestion.bind( "input", function(data) {
		var elem = data.target;
		$.get('http://' + window.location.hostname+ "/index.php/search/usersuggestion/10/"+elem.value, function(response) {
			//dev suggestion.js
			var content = "";
			for(var i=0;i<response.length;i++){
				content += "<option value='" + response[i] + "'></option>\n";
			}
			console.log(content);
			suggestions.append(content);
			//document.getElementById('login_suggestions').innerHTML = content;
		});
	});

});
