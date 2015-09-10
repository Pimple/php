<?php /* Smarty version 3.1.27, created on 2015-07-18 15:35:26
         compiled from "C:\wamp\www\TestApp\templates\article.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1110455aa561e369af7_52208124%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75b348768381a6f8cbe24abe22d13b6fbe86524b' => 
    array (
      0 => 'C:\\wamp\\www\\TestApp\\templates\\article.tpl',
      1 => 1437226525,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1110455aa561e369af7_52208124',
  'variables' => 
  array (
    'title' => 0,
    'subject' => 0,
    'publisher' => 0,
    'published' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_55aa561e3e4502_71995611',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55aa561e3e4502_71995611')) {
function content_55aa561e3e4502_71995611 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1110455aa561e369af7_52208124';
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	<meta charset="utf-8">
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>
	<link href="../../../styles/default.css" rel="stylesheet" type="text/css">
	<link href="../../../styles/navigation.css" rel="stylesheet" type="text/css">
	<link href="../../../styles/articles.css" rel="stylesheet" type="text/css">
	<?php echo '<script'; ?>
 src="../../../scripts/jquery-2.1.4.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="../../../scripts/jquery.snippet.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="../../../scripts/scripts.js" type="text/javascript"><?php echo '</script'; ?>
>
</head>
<body>
<div id="wrapper">
	<?php echo $_smarty_tpl->getSubTemplate ("modules/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0);
?>

		
	<h2><?php echo $_smarty_tpl->tpl_vars['subject']->value;?>
</h2>
	<p class="subtitle">Published by <?php echo $_smarty_tpl->tpl_vars['publisher']->value;?>
 at <?php echo $_smarty_tpl->tpl_vars['published']->value;?>
.</p>
	<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

	
	<?php echo $_smarty_tpl->getSubTemplate ("modules/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0);
?>

</div>
</body>
</html><?php }
}
?>