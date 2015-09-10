<?php /* Smarty version 3.1.27, created on 2015-07-12 22:54:36
         compiled from "C:\wamp\www\TestApp\templates\overview.tpl" */ ?>
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
  ),
  'nocache_hash' => '2446555a2d40caf59f4_04287586',
  'variables' => 
  array (
    'title' => 0,
    'welcome' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_55a2d40cb67d96_58203731',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a2d40cb67d96_58203731')) {
function content_55a2d40cb67d96_58203731 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2446555a2d40caf59f4_04287586';
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	<meta charset="utf-8"> 
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>
	<link href="styles/default.css" rel="stylesheet" type="text/css">
	<link href="styles/navigation.css" rel="stylesheet" type="text/css">
	<link href="styles/articles.css" rel="stylesheet" type="text/css">
	<?php echo '<script'; ?>
 src="scripts/jquery-2.1.4.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="scripts/jquery.snippet.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="scripts/scripts.js" type="text/javascript"><?php echo '</script'; ?>
>
</head>
<body>
<div id="wrapper">
	<?php echo $_smarty_tpl->getSubTemplate ("modules/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0);
?>

		
	<h2><?php echo $_smarty_tpl->tpl_vars['welcome']->value;?>
</h2>
	<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

	
	<?php echo $_smarty_tpl->getSubTemplate ("modules/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0);
?>

</div>
</body>
</html><?php }
}
?>