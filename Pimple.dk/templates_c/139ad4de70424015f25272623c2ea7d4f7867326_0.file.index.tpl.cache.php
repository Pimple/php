<?php /* Smarty version 3.1.27, created on 2015-07-09 15:12:19
         compiled from "C:\wamp\www\TestApp\templates\index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:356559e7333dbebd3_73226904%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '139ad4de70424015f25272623c2ea7d4f7867326' => 
    array (
      0 => 'C:\\wamp\\www\\TestApp\\templates\\index.tpl',
      1 => 1436446872,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '356559e7333dbebd3_73226904',
  'variables' => 
  array (
    'app_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_559e7333e032e6_79410738',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_559e7333e032e6_79410738')) {
function content_559e7333e032e6_79410738 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '356559e7333dbebd3_73226904';
?>


Hello. This is <?php echo $_smarty_tpl->tpl_vars['app_name']->value;?>
 using Smarty.<?php }
}
?>