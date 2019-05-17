$("#login .suggestion").bind( "input", function(data) {
	console.log(data);
});
$("#login .suggestion").bind( "keypress", function(data) {
	console.log(data);
});

console.log($("#login").length);

console.log($(".suggestion").length);

console.log($(".suggestion#login").length);

console.log($(".suggestion#login").length);

console.log($("input").length);

console.log(document.getElementById('login'));
console.log(document.getElementsByClassName('suggestion').length);
console.log(document.getElementsByTagName('input').length);

console.log($(".suggestion"));
