<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:56:35
         compiled from "templates/admin\adm.users.companies.tpl" */ ?>
<?php /*%%SmartyHeaderCode:299564fb7523326b5f9-36711932%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5f773119150bfb737dac402f4f8decabbe6377a' => 
    array (
      0 => 'templates/admin\\adm.users.companies.tpl',
      1 => 1336142866,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '299564fb7523326b5f9-36711932',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'action' => 0,
    'arrCompanies' => 0,
    'company' => 0,
    'allRecords' => 0,
    'strPages' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb7523354001',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb7523354001')) {function content_4fb7523354001($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['errors']->value){?><?php echo $_smarty_tpl->getSubTemplate ("adm.errors.message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['action']->value['config']){?>
	<?php echo $_smarty_tpl->getSubTemplate ("adm.users.companies.config.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif($_smarty_tpl->tpl_vars['action']->value['seo']){?>
	<?php echo $_smarty_tpl->getSubTemplate ("adm.manager.seo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }else{ ?>
	<p class="sub_menu"><span class="colorbox_help" id="HELP_ADMIN_USERS_COMPANIES"><img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/actions/help.png" alt="<?php echo @FORM_IMG_HELP;?>
"></span></p>

	<form action="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=companies" method="post" enctype="multipart/form-data">
	<table style="width: 100%; padding: 3px; border-spacing: 5;">
		<thead class="data_head">
			<tr>
				<td><?php echo @FORM_USERS_DATA_COMPANY_LOGO;?>
</td>
				<td><?php echo @FORM_USERS_DATA_COMPANY_NAME;?>
</td>
				<td><?php echo @TABLE_COLUMN_SHOW_MAIN;?>
</td>
				<td><?php echo @TABLE_COLUMN_SORT;?>
</td>
				<td><input type="checkbox" class="checked_all"></td>
			</tr>
		</thead>
		<tbody class="data_body">
	<?php if ($_smarty_tpl->tpl_vars['arrCompanies']->value){?>
		<?php  $_smarty_tpl->tpl_vars["company"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["company"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arrCompanies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["company"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["i"]['total'] = $_smarty_tpl->tpl_vars["company"]->total;
foreach ($_from as $_smarty_tpl->tpl_vars["company"]->key => $_smarty_tpl->tpl_vars["company"]->value){
$_smarty_tpl->tpl_vars["company"]->_loop = true;
?>
			<tr>
				<td style="text-align: center;">
					<a href="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=manager&amp;action=detail&amp;id=<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
" target="_blank">
					<?php if ($_smarty_tpl->tpl_vars['company']->value['logo']){?>
						<img src="<?php echo @CONF_SCRIPT_URL;?>
uploads/images/logo/thumbs/thumb_<?php echo $_smarty_tpl->tpl_vars['company']->value['logo'];?>
" style="border: 1px solid #DDD;">
					<?php }else{ ?>
						<img src="<?php echo @CONF_SCRIPT_URL;?>
uploads/images/logo/not_logo.png" style="border: 1px solid #DDD;">
					<?php }?>
					</a>
				</td>
				<td style="text-align: center;"><a href="<?php echo @CONF_ADMIN_FILE;?>
?m=users&amp;s=manager&amp;action=detail&amp;id=<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
" target="_blank"><?php if ($_smarty_tpl->tpl_vars['company']->value['company_name']){?><?php echo $_smarty_tpl->tpl_vars['company']->value['company_name'];?>
<?php }else{ ?>-<?php }?></a></td>
				<td style="text-align: center;">
					<?php if ($_smarty_tpl->tpl_vars['company']->value['main_logo']){?>
						<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/yes.png" title="<?php echo @SITE_YES;?>
">
					<?php }elseif(!$_smarty_tpl->tpl_vars['company']->value['main_logo']&&!$_smarty_tpl->tpl_vars['company']->value['logo']){?>
						<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/forbidden.png" title="<?php echo @FORM_USERS_DATA_COMPANY_NOLOGO;?>
">
					<?php }else{ ?>
						<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/no.png" title="<?php echo @SITE_NO;?>
">
					<?php }?>
				</td>
				<td style="text-align: center;">
					<input type="text" name="sort[<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['company']->value['sort_logo'];?>
" size="5" class="text" <?php if (!$_smarty_tpl->tpl_vars['company']->value['logo']){?>disabled<?php }?>>
				</td>
				<td style="text-align: center;"><?php if (!$_smarty_tpl->tpl_vars['company']->value['logo']){?>-<?php }else{ ?><input type="checkbox" name="companies[<?php echo $_smarty_tpl->tpl_vars['company']->value['id'];?>
]" class="checkbox_entry"><?php }?></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot class="data_foot">
			<tr>
				<td style="text-align: center;">
					<?php echo @TABLE_RECORDS;?>
 <?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['i']['total'];?>
/<?php echo $_smarty_tpl->tpl_vars['allRecords']->value;?>

				</td>
				<td colspan="4" style="text-align: right;">
					<select name="action" class="select">
						<option value=""><?php echo @FORM_ACTION_SELECT;?>
</option>
						<option value="show"><?php echo @FORM_ACTION_DISPLAY_ON_MAIN;?>
</option>
						<option value="remove"><?php echo @FORM_ACTION_REMOVE_FROM_MAIN;?>
</option>
						<option value="sorting"><?php echo @FORM_ACTION_SAVE_SORT;?>
</option>
					</select>
					<input type="submit" value="<?php echo @FORM_BUTTON_EXECUTE;?>
" class="button">
				</td>
			</tr>
		</tfoot>
	<?php }else{ ?>
			<tr>
				<td style="text-align: center;" colspan="6">
					<?php echo @TABLE_NOT_DATA;?>

				</td>
			</tr>
		</tbody>
	<?php }?>
	</table>
	</form>

	<p style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['strPages']->value;?>
</p>

<script type="text/javascript">
<!--
$(document).ready( function()
{
	//включаем все переключатели в таблице	
	$('.checked_all').click(function() {
		(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
	});

	// проверяем выбранное действие
	$("form").submit( function() {
		if (!$('select[name="action"] option:selected').val()) {
			$.alert('<?php echo @ERROR_NOT_SELECT_ACTION;?>
');
			return false;
		} else {
			if ($('select[name="action"] option:selected').val() !== 'sorting' && !$('form input:checked').size()) {
				$.alert('<?php echo @MESSAGE_WARNING_NOT_SELECT_RECORDS;?>
');
				return false;
			}
		}
	});
});
-->
</script>
<?php }?>


<?php }} ?>