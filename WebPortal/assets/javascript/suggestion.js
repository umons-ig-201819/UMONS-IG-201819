var inputsuggestion = $(document).select('#login.suggestion');

var suggestions = $('<datalist/>', {
    id: 'login_suggestions',
    class: 'suggestion'
});

inputsuggestion.bind( "input", function(data) {
	var elem = data.target;
	$.get('http://' + window.location.hostname+ "/index.php/search/usersuggestion/10/s", function(response) {
		console.log(response);
		console.log("done");
	});
});

$(document).select('option.suggestion').bind( "cick", function(data) {
	var elem = data.target;
	console.log("select "+elem.value);
});


console.log($(document).select('form'));
console.log($(document).select('form')[0]);

$(document).select('form')[0].innerHTML="<p>sd</p>";

console.log(suggestions);

suggestions.appendTo($(document).select('body'));

// suggestions.appendTo($(document).select('form')[0]);


/*suggestions.insertAfter(inputsuggestion.parent());
$('<option value="test" class="suggestion">').appendTo(suggestions);
*/
