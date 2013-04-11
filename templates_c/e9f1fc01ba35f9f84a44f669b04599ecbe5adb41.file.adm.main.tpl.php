<?php /* Smarty version Smarty-3.1.5, created on 2012-05-11 21:33:39
         compiled from "templates/admin\adm.main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159894fad4d73e6f379-32022132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9f1fc01ba35f9f84a44f669b04599ecbe5adb41' => 
    array (
      0 => 'templates/admin\\adm.main.tpl',
      1 => 1336142866,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159894fad4d73e6f379-32022132',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'avUpdates' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fad4d7422dbc',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad4d7422dbc')) {function content_4fad4d7422dbc($_smarty_tpl) {?><table class="mainTable" cellspacing="10">
	<tr>
		<td>
			<table class="infoTable" cellpadding="0" cellspacing="0">
				<thead class="infoHead">
					<tr><td><?php echo @MENU_INFO_PRODUCT;?>
</td></tr>
				</thead>
				<tbody>
					<tr><td><?php echo @SITE_PRODUCT;?>
: <?php echo @CONF_INFO_PRODUCT_NAME;?>
</td></tr>
					<tr><td><?php echo @SITE_VERSION;?>
: <?php echo @CONF_INFO_PRODUCT_VERSION;?>
</td></tr>
					<tr><td><?php echo @SITE_REVISION;?>
: <?php echo @CONF_INFO_SCRIPT_REVISION;?>
</td></tr>
				</tbody>
			</table>
		</td>
		<td>
			<table class="infoTable" cellpadding="0" cellspacing="0">
				<thead class="infoHead">
					<tr><td><?php echo @MENU_UPDATES;?>
</td></tr>
				</thead>
				<tbody>
					<tr>
						<td style="text-align: center; font-weight: bold; font-size: 13px; padding: 20px 0px;">
							<?php if (!$_smarty_tpl->tpl_vars['avUpdates']->value['error']&&$_smarty_tpl->tpl_vars['avUpdates']->value['result']>0){?>
								<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/icons/updates.png">
								<a href="<?php echo @CONF_ADMIN_FILE;?>
?m=system&amp;s=updates"><?php echo @SITE_AVAILABLE_UPDATES;?>
: <?php echo $_smarty_tpl->tpl_vars['avUpdates']->value['result'];?>
</a>
							<?php }elseif(!$_smarty_tpl->tpl_vars['avUpdates']->value['error']&&$_smarty_tpl->tpl_vars['avUpdates']->value['result']==0){?>
								<?php echo @SITE_NOT_AVAILABLE_UPDATES;?>

							<?php }else{ ?>
								<?php echo $_smarty_tpl->tpl_vars['avUpdates']->value['result'];?>

							<?php }?>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table class="infoTable" cellpadding="0" cellspacing="0">
				<thead class="infoHead">
					<tr><td colspan="3"><?php echo @MENU_MAINTENANCE;?>
</td></tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo @FORM_CONF_ADMINISTRATION_MAINTENANCE;?>
</td>
						<td style="text-align: center; width: 10%;">
							<input type="checkbox" id="maintenance"<?php if (@CONF_SERVICE_ADMINISTRATION_MAINTENANCE){?> checked="checked"<?php }?>>
							<span id="load">&nbsp;</span>
						</td>
						<td style="text-align: center; width: 10%;">
							<span class="colorbox_help" id="HELP_ADMIN_CONF_ADMINISTRATION_MAINTENANCE">
								<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/help_icon.png" alt="<?php echo @FORM_IMG_HELP;?>
" title="<?php echo @FORM_IMG_HELP;?>
">
							</span>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
</table>

<script type="text/javascript">
<!--
$(function() {
	$('#maintenance').click(function () {
		var obj = $(this);
		var state = (obj.is(':checked')) ? 'on' : 'off';
		obj.hide();
		$('#load').html('<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/loading.gif">');
		$.ajax({ type: 'post', url: '/admajax.php', data: 'maintenance=' + state,
			success: function( msg ) {
				$('#load').html('');
				if (msg == 'true') {
					(state == 'on') ? obj.attr('checked', true) : obj.attr('checked', false);
				} else {
					(state == 'on') ? obj.attr('checked', false) : obj.attr('checked', true);
				}
				obj.show();
			}
		});
	});
});
-->
</script>
<?php }} ?>