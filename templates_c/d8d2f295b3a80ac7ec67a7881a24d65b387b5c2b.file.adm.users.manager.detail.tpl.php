<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:54:59
         compiled from "templates/admin\adm.users.manager.detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:300324fb751d3098426-33369710%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8d2f295b3a80ac7ec67a7881a24d65b387b5c2b' => 
    array (
      0 => 'templates/admin\\adm.users.manager.detail.tpl',
      1 => 1336142866,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '300324fb751d3098426-33369710',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'groups' => 0,
    'group' => 0,
    'arrUser' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb751d36577e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb751d36577e')) {function content_4fb751d36577e($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'I:\\home\\Smarty\\plugins\\modifier.date_format.php';
?><div id="tabTemplate" style="width: 98%;">
    <ul>
        <li><a href="#user"><?php echo @FORM_USERS_DATA;?>
</a></li>
        <?php if ($_smarty_tpl->tpl_vars['user']->value['user_type']=="company"||$_smarty_tpl->tpl_vars['user']->value['user_type']=="agent"){?>
        	<li><a href="#company"><?php echo @FORM_USERS_COMPANY_DATA;?>
</a></li>
        <?php }?>
        <li><a href="#actions"><?php echo @FORM_USERS_ACTIONS;?>
</a></li>
    </ul>
    <div id="user" style="width: 98%;">
		<form action="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=manager&amp;action=detail&amp;id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" method="post" enctype="multipart/form-data">
		<table style="width: 100%; border-spacing: 5px;">
			<tr>
				<td style="font-weight: bold; width: 250px;"><?php echo @FORM_USERS_DATA_TOKEN;?>
</td>
				<td>
					<?php if ($_smarty_tpl->tpl_vars['user']->value['token']=='new'){?>
						<?php echo @RECORD_WAIT_ACTIVATE;?>

					<?php }elseif($_smarty_tpl->tpl_vars['user']->value['token']=='active'){?>
						<?php echo @RECORD_ACTIVE;?>

					<?php }elseif($_smarty_tpl->tpl_vars['user']->value['token']=='moderate'){?>
						<?php echo @RECORD_MODERATE;?>

					<?php }elseif($_smarty_tpl->tpl_vars['user']->value['token']=='payment'){?>
						<?php echo @RECORD_WAIT_PAYMENT;?>

					<?php }?>
				</td>
			</tr>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_EMAIL;?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
</td>
			</tr>
			<?php if ($_smarty_tpl->tpl_vars['user']->value['token']!='new'){?>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_TYPE;?>
</td>
				<td>
					<input type="hidden" id="uID" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
">
					<select name="conf[user_type]" class="text ui-widget-content ui-corner-all">
						<option value="agent" <?php if ($_smarty_tpl->tpl_vars['user']->value['user_type']=="agent"){?>selected="selected"<?php }?>><?php echo @FORM_TYPE_AGENT;?>
</option>
						<option value="company" <?php if ($_smarty_tpl->tpl_vars['user']->value['user_type']=="company"){?>selected="selected"<?php }?>><?php echo @FORM_TYPE_COMPANY;?>
</option>
						<option value="employer" <?php if ($_smarty_tpl->tpl_vars['user']->value['user_type']=="employer"){?>selected="selected"<?php }?>><?php echo @FORM_TYPE_EMPLOYER;?>
</option>
						<option value="competitor" <?php if ($_smarty_tpl->tpl_vars['user']->value['user_type']=="competitor"){?>selected="selected"<?php }?>><?php echo @FORM_TYPE_COMPETITOR;?>
</option>
					</select>
				</td>
			</tr>
			<?php }?>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_GROUP;?>
</td>
				<td>
				<?php if ($_smarty_tpl->tpl_vars['user']->value['token']!='new'){?>
					<select name="conf[user_group]" class="text ui-widget-content ui-corner-all">
					<?php  $_smarty_tpl->tpl_vars["group"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["group"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["group"]->key => $_smarty_tpl->tpl_vars["group"]->value){
$_smarty_tpl->tpl_vars["group"]->_loop = true;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['group']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['group']->value['id']==$_smarty_tpl->tpl_vars['user']->value['user_group']){?>selected<?php }?>><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['group']->value['id'],SMARTY_RESOURCE_CHAR_SET);?>
</option>
					<?php } ?>
					</select>
				<?php }else{ ?>
					<?php echo mb_strtoupper($_smarty_tpl->tpl_vars['user']->value['user_group'],SMARTY_RESOURCE_CHAR_SET);?>

				<?php }?>
				&nbsp;(<a style="color: #CC3333;" href="<?php echo @CONF_ADMIN_FILE;?>
?m=manager&s=groups&action=edit&id=<?php echo $_smarty_tpl->tpl_vars['user']->value['user_group'];?>
" target="_blank"><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['user']->value['user_group'],SMARTY_RESOURCE_CHAR_SET);?>
</a>)
				</td>
			</tr>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_REG_DATETIME;?>
</td>
				<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['reg_datetime'],@CONF_DATE_FORMAT);?>
</td>
			</tr>
			<?php if ($_smarty_tpl->tpl_vars['user']->value['alias']){?>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_ALIAS;?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['user']->value['alias'];?>
</td>
			</tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value['first_name']){?>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_FIRST_NAME;?>
</td>
				<td><input type="text" name="user[first_name]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value['last_name']){?>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_LAST_NAME;?>
</td>
				<td><input type="text" name="user[last_name]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value['middle_name']){?>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_MIDDLE_NAME;?>
</td>
				<td><input type="text" name="user[middle_name]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value['middle_name'], ENT_QUOTES, 'UTF-8', true);?>
" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value['gender']!='none'){?>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_GENDER;?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['user']->value['gender'];?>
</td>
			</tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value['birthday']!='0000-00-00'){?>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_BIRTHDAY;?>
</td>
				<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['birthday'],@CONF_DATE_FORMAT);?>
</td>
			</tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value['phone']){?>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_PHONE;?>
</td>
				<td><input type="text" name="user[phone]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value['phone'], ENT_QUOTES, 'UTF-8', true);?>
" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value['addition_phone_1']){?>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_ADDITION_PHONE;?>
 1</td>
				<td><input type="text" name="conf[addition_phone_1]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value['addition_phone_1'], ENT_QUOTES, 'UTF-8', true);?>
" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value['addition_phone_2']){?>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_ADDITION_PHONE;?>
 2</td>
				<td><input type="text" name="conf[addition_phone_2]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value['addition_phone_2'], ENT_QUOTES, 'UTF-8', true);?>
" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			<?php }?>
		</table>
			<div><input type="submit" name="saveUserData" value="<?php echo @FORM_BUTTON_SAVE;?>
" class="button"></div>
		</form>
    </div>
	<?php if ($_smarty_tpl->tpl_vars['user']->value['user_type']=="company"||$_smarty_tpl->tpl_vars['user']->value['user_type']=="agent"){?>
    <div id="company" style="width: 98%;">
		<form action="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=manager&amp;action=detail&amp;id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" method="post" enctype="multipart/form-data">
		<table style="width: 100%; border-spacing: 5px;" cellpadding="3">
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_COMPANY_NAME;?>
</td>
				<td><input type="text" name="conf[company_name]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
" size="80" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_COMPANY_CITY;?>
</td>
				<td><input type="text" name="conf[company_city]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value['company_city'], ENT_QUOTES, 'UTF-8', true);?>
" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_COMPANY_URL;?>
</td>
				<td>
					<input type="text" name="conf[company_url]" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['company_url'];?>
" size="50" class="text ui-widget-content ui-corner-all">
					<a href="<?php echo $_smarty_tpl->tpl_vars['user']->value['company_url'];?>
" target="_blank">
						<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/regions.png" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value['company_url'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value['company_url'], ENT_QUOTES, 'UTF-8', true);?>
">
					</a>
				</td>
			</tr>
			<tr>
				<td style="font-weight: bold;"><?php echo @FORM_USERS_DATA_COMPANY_LOGO;?>
</td>
				<td>
					<?php if ($_smarty_tpl->tpl_vars['user']->value['logo']){?>
						<img src="<?php echo @CONF_SCRIPT_URL;?>
uploads/images/logo/thumbs/thumb_<?php echo $_smarty_tpl->tpl_vars['user']->value['logo'];?>
">
					<?php }else{ ?>
						<img src="<?php echo @CONF_SCRIPT_URL;?>
uploads/images/logo/not_logo.png">
					<?php }?>
					<input type="file" name="cLogo" id="cLogo" value="<?php echo $_smarty_tpl->tpl_vars['arrUser']->value['logo'];?>
" size="50" class="text ui-widget-content ui-corner-all">
					<span id="newLogo"></span>
				</td>
			</tr>
			<tr>
				<td style="font-weight: bold;" colspan="2"><?php echo @FORM_USERS_DATA_COMPANY_DESCRIPTION;?>
</td>
			</tr>
			<tr>
				<td colspan="2">
					<?php if (@CONF_USE_VISUAL_EDITOR&&@CONF_COMPANIES_USE_VISUAL_EDITOR){?>
						<textarea name="conf[company_description]" rows="10" cols="80" class="tinymce"><?php echo $_smarty_tpl->tpl_vars['user']->value['company_description'];?>
</textarea>
					<?php }else{ ?>
						<textarea name="conf[company_description]" rows="10" cols="80"><?php echo nl2br($_smarty_tpl->tpl_vars['user']->value['company_description']);?>
</textarea>
					<?php }?>
				</td>
			</tr>
		</table>
			<div><input type="submit" name="saveCompanyData" value="<?php echo @FORM_BUTTON_SAVE;?>
" class="button"></div>
		</form>
    </div>
    <?php }?>
    <div id="actions" style="width: 98%;">
		<?php if ($_smarty_tpl->tpl_vars['user']->value['token']!='new'){?>
		<form action="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=manager&amp;action=detail&amp;id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" method="post" enctype="multipart/form-data">
			<p><label><input type="checkbox" name="articles"><?php echo @FORM_USERS_DATA_DELETE_USER_ARTICLES;?>
</label></p>
			<p><label><input type="checkbox" name="news"><?php echo @FORM_USERS_DATA_DELETE_USER_NEWS;?>
</label></p>
			<p><input type="submit" class="button" name="delete" value="<?php echo @FORM_BUTTON_DELETE_USER;?>
"></p>
		</form>
		<?php }?>
    </div>
</div>

<script type="text/javascript">
<!--
(function($) {
    $.getScript('/core/js/jquery/ui/jquery.ui.tabs.js', function() {
        $('#tabTemplate').tabs({
        	cookie: { expires: 1 }
		});
    });
})(jQuery);

$( function() {
});
-->
</script><?php }} ?>