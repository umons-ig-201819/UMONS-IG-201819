var inputsuggestion = $(document).select('#login.suggestion');

var suggestions = $('<datalist/>', {
    id: 'login_suggestions',
    class: 'suggestion'
});

inputsuggestion.attr("list", "login_suggestions");


inputsuggestion.bind( "input", function(data) {
	var elem = data.target;
	$.get('http://' + window.location.hostname+ "/index.php/search/usersuggestion/10/s", function(response) {
		suggestions.empty();
		for(var i=0;i<response.length;i++){
			suggestions.append("<option value='" + data[i] + "'></option>");
		}
	});
});
/*
$(document).select('option.suggestion').bind( "cick", function(data) {
	var elem = data.target;
	console.log("select "+elem.value);
});*/

inputsuggestion.insertAfter(inputsuggestion);

//TODO add attribute to login input list="datalist1" to ref its datalist

// suggestions.appendTo($(document).select('form')[0]);


/*suggestions.insertAfter(inputsuggestion.parent());
$('<option value="test" class="suggestion">').appendTo(suggestions);
*/
