$("#login .suggestion").bind( "input", function(data) {
	console.log(data);
});
$("#login .suggestion").bind( "keypress", function(data) {
	console.log(data);
});

console.log($("#login .suggestion"));