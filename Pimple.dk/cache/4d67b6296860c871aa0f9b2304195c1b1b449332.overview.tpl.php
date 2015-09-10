<?php
/*%%SmartyHeaderCode:2446555a2d40caf59f4_04287586%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d67b6296860c871aa0f9b2304195c1b1b449332' => 
    array (
      0 => 'C:\\wamp\\www\\TestApp\\templates\\overview.tpl',
      1 => 1436734475,
      2 => 'file',
    ),
    'd754d6861eea2f0c2d53f1241889b8af8b0e421b' => 
    array (
      0 => 'C:\\wamp\\www\\TestApp\\templates\\modules\\header.tpl',
      1 => 1436479909,
      2 => 'file',
    ),
    '12281b6c16b9701f382654d8989c56f679722e0e' => 
    array (
      0 => 'C:\\wamp\\www\\TestApp\\templates\\modules\\navigation.tpl',
      1 => 1437233783,
      2 => 'file',
    ),
    '0ac956c859c97e6ea63d3b1748156863c0551d7a' => 
    array (
      0 => 'C:\\wamp\\www\\TestApp\\templates\\modules\\footer.tpl',
      1 => 1436483109,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2446555a2d40caf59f4_04287586',
  'tpl_function' => 
  array (
  ),
  'version' => '3.1.27',
  'unifunc' => 'content_55eadc69f2cfa6_78964678',
  'has_nocache_code' => false,
  'cache_lifetime' => 3600,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55eadc69f2cfa6_78964678')) {
function content_55eadc69f2cfa6_78964678 ($_smarty_tpl) {
?>

<!DOCTYPE html>
<html>
<head>
	<title>HenrikBN.dk</title>
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
	
	<div id="header">
		<h1>HenrikBN.dk</h1>
		<div id="navigation-bar">
			
			<ul id="navigation">
				<li><a href="http://localhost/testapp/">Home</a></li>
				<li><a href="http://localhost/testapp/articles/2015-07-18/This-is-an-article/">Article</a></li>
				<li><a href="http://localhost/testapp/">Herp</a></li>
				<li><a href="http://localhost/testapp/">Derp</a></li>
			</ul>
		</div>
	</div>
		
	<h2>Front page title</h2>
	<p>Welcome message, including markup.</p>
	
	
	<div id="footer">
		Henrik B. Nørgaard &lt;kontakt@henrikbn.dk&gt;
	</div>
</div>
</body>
</html><?php }
}
?>