<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:56:35
         compiled from "templates/admin\adm.users.companies.config.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150854fb7523354b7e5-67050312%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca4f05355d4bb873ca69f856e936bbf364e8883b' => 
    array (
      0 => 'templates/admin\\adm.users.companies.config.tpl',
      1 => 1336142862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150854fb7523354b7e5-67050312',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb7523375beb',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb7523375beb')) {function content_4fb7523375beb($_smarty_tpl) {?><form action="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=companies&amp;action=config" method="post" enctype="multipart/form-data">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td><?php echo @FORM_CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL;?>
</td>
		<td>
			<input type="text" name="admperpage" size="5" value="<?php echo @CONF_COMPANIES_STRINGS_PERPAGE_ADMIN_PANEL;?>
" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_STRINGS_PERPAGE_ADMIN_PANEL">
				<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/help_icon.png" alt="<?php echo @FORM_IMG_HELP;?>
">
			</span>
		</td>
	</tr>
	<tr>
		<td><?php echo @FORM_CONF_COMPANIES_PERPAGE;?>
</td>
		<td>
			<input type="text" name="perpage" size="5" value="<?php echo @CONF_COMPANIES_PERPAGE;?>
" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_COMPANIES_PERPAGE">
				<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/help_icon.png" alt="<?php echo @FORM_IMG_HELP;?>
">
			</span>
		</td>
	</tr>
	<tr>
		<td><?php echo @FORM_CONF_COMPANIES_SHOW_ONLY_WITH_LOGO;?>
</td>
		<td><input type="checkbox" name="with_logo" <?php if (@CONF_COMPANIES_SHOW_ONLY_WITH_LOGO){?>checked<?php }?>></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_COMPANIES_SHOW_ONLY_WITH_LOGO">
				<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/help_icon.png" alt="<?php echo @FORM_IMG_HELP;?>
">
			</span>
		</td>
	</tr>
	<tr>
		<td><?php echo @FORM_CONF_COMPANIES_DELETE_LOGO;?>
</td>
		<td><input type="checkbox" name="delete_logo" <?php if (@CONF_COMPANIES_DELETE_LOGO){?>checked<?php }?>></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_COMPANIES_DELETE_LOGO">
				<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/help_icon.png" alt="<?php echo @FORM_IMG_HELP;?>
">
			</span>
		</td>
	</tr>
	<tr>
		<td><?php echo @FORM_CONF_COMPANIES_USE_VISUAL_EDITOR;?>
</td>
		<td>
			<?php if (!@CONF_USE_VISUAL_EDITOR){?>
				<input type="checkbox" name="html" disabled>
			<?php }else{ ?>
				<input type="checkbox" name="html" <?php if (@CONF_COMPANIES_USE_VISUAL_EDITOR){?>checked<?php }?>>
			<?php }?>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_COMPANIES_USE_VISUAL_EDITOR">
				<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/help_icon.png" alt="<?php echo @FORM_IMG_HELP;?>
">
			</span>
		</td>
	</tr>
	<tr>
		<td><?php echo @FORM_CONF_COMPANIES_SHOW_MAIN_LOGO;?>
</td>
		<td>
			<input type="checkbox" name="show_main_logo" <?php if (@CONF_COMPANIES_SHOW_MAIN_LOGO){?>checked<?php }?>>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_COMPANIES_SHOW_MAIN_LOGO">
				<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/help_icon.png" alt="<?php echo @FORM_IMG_HELP;?>
">
			</span>
		</td>
	</tr>
	<tr>
		<td><?php echo @FORM_CONF_COMPANIES_SHOW_MAIN_LOGO_QTY;?>
</td>
		<td>
			<?php if (@CONF_COMPANIES_SHOW_MAIN_LOGO){?>
				<input type="text" name="logo_qty" size="5" value="<?php echo @CONF_COMPANIES_SHOW_MAIN_LOGO_QTY;?>
" class="text">
			<?php }else{ ?>
				<input type="text" name="logo_qty" size="5" value="<?php echo @CONF_COMPANIES_SHOW_MAIN_LOGO_QTY;?>
" class="text" disabled>
			<?php }?>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_COMPANIES_SHOW_MAIN_LOGO_QTY">
				<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/help_icon.png" alt="<?php echo @FORM_IMG_HELP;?>
">
			</span>
		</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="save" value="<?php echo @FORM_BUTTON_SAVE;?>
" class="button"></p>
</form><?php }} ?>