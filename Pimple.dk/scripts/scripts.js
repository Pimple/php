// http://www.steamdev.com/snippet/

$(document).ready(function()
{
	$("pre.html").snippet("html", {style: "peachpuff"});
	$("pre.css").snippet("css", {style: "peachpuff"});
	$("pre.js").snippet("javascript", {style: "peachpuff"});
	$("pre.php").snippet("php", {style: "peachpuff"});
	$("pre.java").snippet("java", {style: "peachpuff"});
	$("pre.cpp").snippet("cpp", {style: "peachpuff"});
	
	$("pre.htmlColl").snippet("html", {style: "peachpuff, collapse: true"});
	$("pre.cssColl").snippet("css", {style: "peachpuff", collapse: true});
	$("pre.jsColl").snippet("javascript", {style: "peachpuff", collapse: true});
	$("pre.phpColl").snippet("php", {style: "peachpuff", collapse: true});
	$("pre.javaColl").snippet("java", {style: "peachpuff", collapse: true});
	$("pre.cppColl").snippet("cpp", {style: "peachpuff", collapse: true});
});