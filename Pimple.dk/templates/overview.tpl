{****************************************************************
  Template for an overview of contents, like a front page
  
  Requires:
  
  $title		Title of Window
  $welcome		Title of welcome message
  $message		Content of welcome message
 ****************************************************************}
<!DOCTYPE html>
<html>
<head>
	<title>{$title}</title>
	<meta charset="utf-8"> 
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>
	<link href="styles/default.css" rel="stylesheet" type="text/css">
	<link href="styles/navigation.css" rel="stylesheet" type="text/css">
	<link href="styles/articles.css" rel="stylesheet" type="text/css">
	<script src="scripts/jquery-2.1.4.js" type="text/javascript"></script>
	<script src="scripts/jquery.snippet.js" type="text/javascript"></script>
	<script src="scripts/scripts.js" type="text/javascript"></script>
</head>
<body>
<div id="wrapper">
	{include file="modules/header.tpl"}
		
	<h2>{$welcome}</h2>
	{$message}
	
	{include file="modules/footer.tpl"}
</div>
</body>
</html>