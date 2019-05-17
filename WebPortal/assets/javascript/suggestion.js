
var inputsuggestion = $(document).select('#login.suggestion');

var suggestions = document.createElement('datalist');
suggestions.setAttribute("id", "login_suggestions");
suggestions.setAttribute("class", "suggestion");

console.log(inputsuggestion);
console.log(inputsuggestion[0]);
inputsuggestion[0].insertAdjacentElement('afterend', suggestions)

/*
$('<datalist/>', {
    id: 'login_suggestions',
    class: 'suggestion'
}).insertAfter('#login.suggestion');

var suggestions = $(document).select('#login_suggestions.suggestion');
*/

inputsuggestion.attr("list", "login_suggestions");


inputsuggestion.bind( "input", function(data) {
	var elem = data.target;
	$.get('http://' + window.location.hostname+ "/index.php/search/usersuggestion/10/"+elem.value, function(response) {
		//dev suggestion.js
		var content = "";
		for(var i=0;i<response.length;i++){
			content += "<option value='" + response[i] + "'></option>\n";
		}
		document.getElementById('login_suggestions').innerHTML = content;
	});
});

