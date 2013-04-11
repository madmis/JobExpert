<?php /* Smarty version Smarty-3.1.5, created on 2012-05-11 21:33:39
         compiled from "templates/admin\adm.menu.top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:90554fad4d73a6ee99-48492995%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '24765e4098fc27f3bbcb6079ce80f462ff379f43' => 
    array (
      0 => 'templates/admin\\adm.menu.top.tpl',
      1 => 1336142866,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90554fad4d73a6ee99-48492995',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fad4d73b1c33',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad4d73b1c33')) {function content_4fad4d73b1c33($_smarty_tpl) {?><table style="width: 100%; border: 0px;" cellpadding="0" cellspacing="0">
	<tr class="top_menu">
		<td style="padding-right: 15px;">
			<a href="<?php echo @CONF_ADMIN_FILE;?>
?do=change.password" class="white"><?php echo @MENU_CHANGE_PASSWORD;?>
</a> | 
			<a href="<?php echo @CONF_ADMIN_FILE;?>
" class="white"><?php echo @MENU_MAIN_ADMIN;?>
</a> | 
			<a href="<?php echo @CONF_SCRIPT_URL;?>
" class="white" target="_blank"><?php echo @MENU_MAIN_SITE;?>
</a> | 
			<a href="<?php echo @CONF_ADMIN_FILE;?>
?logout" class="white"><?php echo @MENU_LOGOUT_SITE;?>
</a>
		</td>
	</tr>
</table><?php }} ?>