<?php /* Smarty version 3.1.27, created on 2015-07-18 18:13:29
         compiled from "C:\wamp\www\TestApp\templates\modules\navigation.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2428955aa7b29a23a90_86314865%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '12281b6c16b9701f382654d8989c56f679722e0e' => 
    array (
      0 => 'C:\\wamp\\www\\TestApp\\templates\\modules\\navigation.tpl',
      1 => 1437233783,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2428955aa7b29a23a90_86314865',
  'variables' => 
  array (
    'rootDir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_55aa7b29a8dc67_25770589',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55aa7b29a8dc67_25770589')) {
function content_55aa7b29a8dc67_25770589 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2428955aa7b29a23a90_86314865';
?>

			<ul id="navigation">
				<li><a href="<?php echo $_smarty_tpl->tpl_vars['rootDir']->value;?>
/">Home</a></li>
				<li><a href="<?php echo $_smarty_tpl->tpl_vars['rootDir']->value;?>
/articles/2015-07-18/This-is-an-article/">Article</a></li>
				<li><a href="<?php echo $_smarty_tpl->tpl_vars['rootDir']->value;?>
/">Herp</a></li>
				<li><a href="<?php echo $_smarty_tpl->tpl_vars['rootDir']->value;?>
/">Derp</a></li>
			</ul><?php }
}
?>