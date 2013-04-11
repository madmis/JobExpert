<?php /* Smarty version Smarty-3.1.5, created on 2012-05-12 22:44:18
         compiled from "templates/admin\adm.mods.mods.tpl" */ ?>
<?php /*%%SmartyHeaderCode:281704fad4d78ebd798-58078071%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '444aa85d1a243daf9e48fe2a10eea1e0a6d3bfaa' => 
    array (
      0 => 'templates/admin\\adm.mods.mods.tpl',
      1 => 1336848257,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '281704fad4d78ebd798-58078071',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fad4d7929c64',
  'variables' => 
  array (
    'errors' => 0,
    'dbEnable' => 0,
    'mods' => 0,
    'mod' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad4d7929c64')) {function content_4fad4d7929c64($_smarty_tpl) {?><p class="sub_menu">
	<span class="colorbox_help" id="HELP_ADMIN_MODS_MODS"><img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/actions/help.png"></span>
</p>

<?php if ($_smarty_tpl->tpl_vars['errors']->value){?><?php echo $_smarty_tpl->getSubTemplate ("adm.errors.message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['dbEnable']->value){?>
	<p>
		<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/database_add.png" 
			 title="<?php echo @SITE_SWITCH_TO_WORK_WITH_DB;?>
">&nbsp;
		<a href="<?php echo @CONF_ADMIN_FILE;?>
?m=mods&amp;s=mods&dbEnable">
			<?php echo @SITE_SWITCH_TO_WORK_WITH_DB;?>

		</a>
	</p>
<?php }?>


<form action="<?php echo @CONF_ADMIN_FILE;?>
?m=mods&amp;s=mods" method="post" enctype="multipart/form-data">
<table class="dataTable100">
	<thead>
		<tr>
			<td><?php echo @TABLE_COLUMN_NAME;?>
</td>
			<td><?php echo @TABLE_COLUMN_DESCRIPTION;?>
</td>
			<td><?php echo @TABLE_COLUMN_TOKEN;?>
</td>
			<td><input type="checkbox" class="checked_all"></td>
		</tr>
	</thead>
	<tbody>
	<?php if ($_smarty_tpl->tpl_vars['mods']->value){?>
		<?php  $_smarty_tpl->tpl_vars["mod"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["mod"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["mod"]->key => $_smarty_tpl->tpl_vars["mod"]->value){
$_smarty_tpl->tpl_vars["mod"]->_loop = true;
?>
			<tr>
				<td><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['mod']->value['name'],SMARTY_RESOURCE_CHAR_SET);?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['mod']->value['description'];?>
</td>
				<td class="alignCenter">
					<?php if ($_smarty_tpl->tpl_vars['mod']->value['token']=='active'){?>
						<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/actions/on.png" title="<?php echo @FORM_MOD_ON;?>
">
					<?php }else{ ?>
						<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/actions/off.png" title="<?php echo @FORM_MOD_OFF;?>
">
					<?php }?>
				</td>
				<td class="alignCenter"><input type="checkbox" name="mods[<?php echo $_smarty_tpl->tpl_vars['mod']->value['name'];?>
]" class="checkbox_entry"></td>
			</tr>
		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="10" class="alignRight">
				<select name="action" class="select">
					<option value=""><?php echo @FORM_ACTION_SELECT;?>
</option>
					<option value="active"><?php echo @FORM_ACTION_ENABLE_SELECTED;?>
</option>
					<option value="disable"><?php echo @FORM_ACTION_DISABLE_SELECTED;?>
</option>
				</select>
				<input type="submit" value="<?php echo @FORM_BUTTON_EXECUTE;?>
" class="button">
			</td>
		</tr>
	</tfoot>
	<?php }else{ ?>
		<tr>
			<td class="alignCenter" colspan="10"><?php echo @TABLE_NOT_DATA;?>
</td>
		</tr>
		</tbody>
	<?php }?>
</table>
</form>

<script type="text/javascript">
$( function() {
	//включаем все переключатели в таблице	
	$('.checked_all').click(function() {
		(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
	});

	// проверяем выбранное действие
	$("form:last").submit( function() {
		if (!$('select[name="action"] option:selected').val()) {
			$.alert('<?php echo @ERROR_NOT_SELECT_ACTION;?>
');
			return false;
		} else {
			if (!$('form:last input:checked').size()) {
				$.alert('<?php echo @MESSAGE_WARNING_NOT_SELECT_RECORDS;?>
');
				return false;
			}

			return ( $("select[name='action'] option:selected").val() === 'del' ) ? confirm('<?php echo @MESSAGE_DELETE_RECORDS;?>
') : true;
		}
	});
});
</script><?php }} ?>