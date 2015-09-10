<?php /* Smarty version 3.1.27, created on 2015-07-10 00:12:18
         compiled from "C:\wamp\www\TestApp\templates\modules\header.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:19229559ef1c232c1a8_03888623%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd754d6861eea2f0c2d53f1241889b8af8b0e421b' => 
    array (
      0 => 'C:\\wamp\\www\\TestApp\\templates\\modules\\header.tpl',
      1 => 1436479909,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19229559ef1c232c1a8_03888623',
  'variables' => 
  array (
    'header' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_559ef1c233d2d4_83206831',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_559ef1c233d2d4_83206831')) {
function content_559ef1c233d2d4_83206831 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '19229559ef1c232c1a8_03888623';
?>

	<div id="header">
		<h1><?php echo $_smarty_tpl->tpl_vars['header']->value;?>
</h1>
		<div id="navigation-bar">
			<?php echo $_smarty_tpl->getSubTemplate ("modules/navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0);
?>

		</div>
	</div><?php }
}
?>