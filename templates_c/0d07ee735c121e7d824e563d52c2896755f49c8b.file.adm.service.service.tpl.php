<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 12:04:21
         compiled from "templates/admin\adm.service.service.tpl" */ ?>
<?php /*%%SmartyHeaderCode:80684fb754055bc019-49757939%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d07ee735c121e7d824e563d52c2896755f49c8b' => 
    array (
      0 => 'templates/admin\\adm.service.service.tpl',
      1 => 1336142866,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '80684fb754055bc019-49757939',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb754056ee1b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb754056ee1b')) {function content_4fb754056ee1b($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['errors']->value){?><?php echo $_smarty_tpl->getSubTemplate ("adm.errors.message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['action']->value['htaccess']){?>
	<?php echo $_smarty_tpl->getSubTemplate ("adm.service.service.htaccess.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }else{ ?>
	<table style="padding-left: 20px;">
		<tr style="height: 22px;">
			<td class="detail" id="deleteDBCache"><span class="detail"><?php echo @MENU_SERVICES_DELETE_DB_CACHE;?>
</span></td>
			<td class="resAction">&nbsp;</td>
		</tr>
		<tr style="height: 22px;">
			<td id="deleteTmplCache"><span class="detail"><?php echo @MENU_SERVICES_DELETE_TMPL_CACHE;?>
</span></td>
			<td class="resAction">&nbsp;</td>
		</tr>
		<tr style="height: 22px;">
			<td>
				<a href="<?php echo @CONF_ADMIN_FILE;?>
?m=service&s=service&action=htaccess"><?php echo @MENU_SERVICES_HTACCESS;?>
</a>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>

	<script type="text/javascript">
	$( function() {
		/***** Functions *****/
		$.fn.performAction = function(id) {
			$.ajax({ type: 'post', url: '/admajax.php',
				data: id + "=1",
				//data: ({ id: true }),
				success: function( response ) {
					response = $.parseJSON(response);

					if (response.success) {
						$('#' + id).next('.resAction').html('<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/yes.png" title="<?php echo @MESSAGE_CACHE_CLEAR_SUCCESS;?>
" alt="<?php echo @MESSAGE_CACHE_CLEAR_SUCCESS;?>
">');
					} else {
						$('#' + id).next('.resAction').html('<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/no.png" title="<?php echo @MESSAGE_WARNING_NOT_DELETE_CACHE_FILES;?>
" alt="<?php echo @MESSAGE_WARNING_NOT_DELETE_CACHE_FILES;?>
">');
					}
				}
			});
			return false;
		}

		$('#deleteDBCache').click( function() {
			$(this).next('.resAction').html('<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/loading.gif" alt="loading">');
			$(this).performAction('deleteDBCache');
		});

		$('#deleteTmplCache').click( function() {
			$(this).next('.resAction').html('<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/loading.gif" alt="loading">');
			$(this).performAction('deleteTmplCache');
		});


	});
	</script>
<?php }?><?php }} ?>