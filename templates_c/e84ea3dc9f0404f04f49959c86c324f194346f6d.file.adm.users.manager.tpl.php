<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:54:55
         compiled from "templates/admin\adm.users.manager.tpl" */ ?>
<?php /*%%SmartyHeaderCode:243394fb751cf0ba2d3-41462026%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e84ea3dc9f0404f04f49959c86c324f194346f6d' => 
    array (
      0 => 'templates/admin\\adm.users.manager.tpl',
      1 => 1336142866,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '243394fb751cf0ba2d3-41462026',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'action' => 0,
    'order' => 0,
    'users' => 0,
    'user' => 0,
    'allRecords' => 0,
    'strPages' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb751cf5f8a8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb751cf5f8a8')) {function content_4fb751cf5f8a8($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'I:\\home\\Smarty\\plugins\\modifier.date_format.php';
?><p class="sub_menu">
	<span class="colorbox_help" id="HELP_ADMIN_MANAGER_USERS">
		<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/actions/help.png" alt="<?php echo @FORM_IMG_HELP;?>
" title="<?php echo @FORM_IMG_HELP;?>
">
	</span>
</p>

<?php if ($_smarty_tpl->tpl_vars['errors']->value){?>
	<?php echo $_smarty_tpl->getSubTemplate ("adm.errors.message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['action']->value['add']){?>
	<?php echo $_smarty_tpl->getSubTemplate ("adm.users.manager.add.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif($_smarty_tpl->tpl_vars['action']->value['filter']){?>
	<?php echo $_smarty_tpl->getSubTemplate ("adm.users.manager.filter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif($_smarty_tpl->tpl_vars['action']->value['activate']){?>
	<?php echo $_smarty_tpl->getSubTemplate ("adm.users.manager.activate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif($_smarty_tpl->tpl_vars['action']->value['moderate']){?>
	<?php echo $_smarty_tpl->getSubTemplate ("adm.users.manager.moderate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif($_smarty_tpl->tpl_vars['action']->value['payment']){?>
	<?php echo $_smarty_tpl->getSubTemplate ("adm.users.manager.payment.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif($_smarty_tpl->tpl_vars['action']->value['config']){?>
	<?php echo $_smarty_tpl->getSubTemplate ("adm.users.manager.config.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif($_smarty_tpl->tpl_vars['action']->value['detail']){?>
	<?php echo $_smarty_tpl->getSubTemplate ("adm.users.manager.detail.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }else{ ?>
	<?php if (!@CONF_USER_REGISTER){?>
	<div class="warning"><?php echo @WARNING_CONF_USER_REGISTER_DISABLED;?>
</div>
	<?php }?>

	<form action="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=manager" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
		<thead class="data_head">
			<tr>
				<td>
					<a href="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=manager&amp;order=users.email&amp;by=<?php if ($_smarty_tpl->tpl_vars['order']->value['users.email']=='ASC'){?>DESC<?php }else{ ?>ASC<?php }?>" class="white">
					<?php echo @TABLE_COLUMN_EMAIL;?>
<?php if ($_smarty_tpl->tpl_vars['order']->value['users.email']=='DESC'){?>&nbsp;<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/sort_up.gif" class="middle"><?php }elseif($_smarty_tpl->tpl_vars['order']->value['users.email']=='ASC'){?>&nbsp;<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/sort_down.gif" class="middle"><?php }?>
					</a>
				</td>
				<td>
					<a href="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=manager&amp;order=conf_users.user_type&amp;by=<?php if ($_smarty_tpl->tpl_vars['order']->value['conf_users.user_type']=='ASC'){?>DESC<?php }else{ ?>ASC<?php }?>" class="white">
					<?php echo @TABLE_COLUMN_TYPE;?>
<?php if ($_smarty_tpl->tpl_vars['order']->value['conf_users.user_type']=='DESC'){?>&nbsp;<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/sort_up.gif" class="middle"><?php }elseif($_smarty_tpl->tpl_vars['order']->value['conf_users.user_type']=='ASC'){?>&nbsp;<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/sort_down.gif" class="middle"><?php }?>
					</a>
				</td>
				<td>
					<a href="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=manager&amp;order=conf_users.user_group&amp;by=<?php if ($_smarty_tpl->tpl_vars['order']->value['conf_users.user_group']=='ASC'){?>DESC<?php }else{ ?>ASC<?php }?>" class="white">
					<?php echo @TABLE_COLUMN_GROUP;?>
<?php if ($_smarty_tpl->tpl_vars['order']->value['conf_users.user_group']=='DESC'){?>&nbsp;<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/sort_up.gif" class="middle"><?php }elseif($_smarty_tpl->tpl_vars['order']->value['conf_users.user_group']=='ASC'){?>&nbsp;<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/sort_down.gif" class="middle"><?php }?>
					</a>
				</td>
				<td>
					<a href="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=manager&amp;order=users.reg_datetime&amp;by=<?php if ($_smarty_tpl->tpl_vars['order']->value['users.reg_datetime']=='ASC'){?>DESC<?php }else{ ?>ASC<?php }?>" class="white">
					<?php echo @TABLE_COLUMN_REG_DATETIME;?>
<?php if ($_smarty_tpl->tpl_vars['order']->value['users.reg_datetime']=='DESC'){?>&nbsp;<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/sort_up.gif" class="middle"><?php }elseif($_smarty_tpl->tpl_vars['order']->value['users.reg_datetime']=='ASC'){?>&nbsp;<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/sort_down.gif" class="middle"><?php }?>
					</a>
				</td>
				<td><input type="checkbox" class="checked_all"></td>
			</tr>
		</thead>
		<tbody class="data_body">
	<?php if ($_smarty_tpl->tpl_vars['users']->value){?>
		<?php  $_smarty_tpl->tpl_vars["user"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["user"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["user"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["i"]['total'] = $_smarty_tpl->tpl_vars["user"]->total;
foreach ($_from as $_smarty_tpl->tpl_vars["user"]->key => $_smarty_tpl->tpl_vars["user"]->value){
$_smarty_tpl->tpl_vars["user"]->_loop = true;
?>
			<tr>
				<td><a href="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=manager&amp;action=detail&amp;id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
</a></td>
				<td align="center">
					<?php if ($_smarty_tpl->tpl_vars['user']->value['user_type']=="agent"){?>
						<?php echo @FORM_TYPE_AGENT;?>

					<?php }elseif($_smarty_tpl->tpl_vars['user']->value['user_type']=="company"){?>
						<?php echo @FORM_TYPE_COMPANY;?>

					<?php }elseif($_smarty_tpl->tpl_vars['user']->value['user_type']=="employer"){?>
						<?php echo @FORM_TYPE_EMPLOYER;?>

					<?php }elseif($_smarty_tpl->tpl_vars['user']->value['user_type']=="competitor"){?>
						<?php echo @FORM_TYPE_COMPETITOR;?>

					<?php }?>
				</td>
				<td align="center"><a href="<?php echo @CONF_ADMIN_FILE;?>
?m=manager&s=groups&action=edit&id=<?php echo $_smarty_tpl->tpl_vars['user']->value['user_group'];?>
" target="_blank"><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['user']->value['user_group'],SMARTY_RESOURCE_CHAR_SET);?>
</a></td>
				<td align="center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['reg_datetime'],@CONF_DATE_FORMAT);?>
</td>
				<td align="center"><input type="checkbox" name="users[<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
]" class="checkbox_entry"></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot class="data_foot">
			<tr>
				<td colspan="3" align="center">
					<?php echo @TABLE_RECORDS;?>
 <?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['i']['total'];?>
/<?php echo $_smarty_tpl->tpl_vars['allRecords']->value;?>

				</td>
				<td colspan="3" align="right">
					<select name="action" class="select">
						<option value=""><?php echo @FORM_ACTION_SELECT;?>
</option>
						<option value="del"><?php echo @FORM_ACTION_DELETE_SELECTED;?>
</option>
					</select>
					<input type="submit" value="<?php echo @FORM_BUTTON_EXECUTE;?>
" class="button">
				</td>
			</tr>
		</tfoot>
	<?php }else{ ?>
			<tr>
				<td align="center" colspan="5">
					<?php echo @TABLE_NOT_DATA;?>

				</td>
			</tr>
		</tbody>
	<?php }?>
	</table>
	</form>

	<p align="center"><?php echo $_smarty_tpl->tpl_vars['strPages']->value;?>
</p>

<script type="text/javascript">
<!--
$(document).ready( function() {
	//включаем все переключатели в таблице
	$('.checked_all').click(function() {
		(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
	});

	// проверяем выбранное действие
	$("form:last").submit( function() {
		if (!$('select[name="action"] option:selected').val())
		{
			$.alert('<?php echo @ERROR_NOT_SELECT_ACTION;?>
');
			return false;
		}
		else
		{
			if (!$('form:last input:checked').size())
			{
				$.alert('<?php echo @MESSAGE_WARNING_NOT_SELECT_RECORDS;?>
');
				return false;
			}

			return ( $("select[name='action'] option:selected").val() === 'del' ) ? confirm('<?php echo @MESSAGE_DELETE_RECORDS;?>
') : true;
		}
	});
});
-->
</script>
<?php }?><?php }} ?>