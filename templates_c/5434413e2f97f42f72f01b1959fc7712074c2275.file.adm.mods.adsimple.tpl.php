<?php /* Smarty version Smarty-3.1.5, created on 2012-05-12 23:37:39
         compiled from "I:\html\jobexpert\core\mods\adsimple\templates\adm.mods.adsimple.tpl" */ ?>
<?php /*%%SmartyHeaderCode:214844faebc03ab2c77-54732462%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5434413e2f97f42f72f01b1959fc7712074c2275' => 
    array (
      0 => 'I:\\html\\jobexpert\\core\\mods\\adsimple\\templates\\adm.mods.adsimple.tpl',
      1 => 1336142833,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214844faebc03ab2c77-54732462',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'error' => 0,
    'return_data' => 0,
    'advert' => 0,
    'key' => 0,
    'adv' => 0,
    'k' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faebc03d40b4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faebc03d40b4')) {function content_4faebc03d40b4($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'I:\\home\\Smarty\\plugins\\modifier.truncate.php';
?><p class="sub_menu">
	<span class="mods_help" id="adsimple_help"><img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/actions/help.png"></span>
<div class="open_close"><div id="mod_adsimple_help"><?php echo @MOD_ADSIMPLE_HELP;?>
</div></div>
</p>

<?php if ($_smarty_tpl->tpl_vars['errors']->value){?><div class="td_errors"><?php  $_smarty_tpl->tpl_vars["error"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["error"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["error"]->key => $_smarty_tpl->tpl_vars["error"]->value){
$_smarty_tpl->tpl_vars["error"]->_loop = true;
?><p><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</p><?php } ?></div><?php }?>

<form action="<?php echo @CONF_ADMIN_FILE;?>
?m=mods&s=adsimple" method="post" enctype="multipart/form-data">
	<table style="width: 70%; margin: 20px;">
		<tr>
			<td>
				<select name="ad_position">
					<option value=""><?php echo @MOD_ADSIMPLE_FORM_SELECT_PLACE;?>
</option>
					<option value="toper" <?php if ($_smarty_tpl->tpl_vars['return_data']->value['ad_position']=='toper'){?>selected<?php }?>><?php echo @MOD_ADSIMPLE_FORM_TOPER;?>
</option>
					<option value="advertisement_top" <?php if ($_smarty_tpl->tpl_vars['return_data']->value['ad_position']=='advertisement_top'){?>selected<?php }?>><?php echo @MOD_ADSIMPLE_FORM_ADVERTISEMENT_TOP;?>
</option>
					<option value="advertisement_bottom" <?php if ($_smarty_tpl->tpl_vars['return_data']->value['ad_position']=='advertisement_bottom'){?>selected<?php }?>><?php echo @MOD_ADSIMPLE_FORM_ADVERTISEMENT_BOTTOM;?>
</option>
					<option value="bottomer" <?php if ($_smarty_tpl->tpl_vars['return_data']->value['ad_position']=='bottomer'){?>selected<?php }?>><?php echo @MOD_ADSIMPLE_FORM_BOTTOMER;?>
</option>
					<option value="advertisement_left" <?php if ($_smarty_tpl->tpl_vars['return_data']->value['ad_position']=='advertisement_left'){?>selected<?php }?>><?php echo @MOD_ADSIMPLE_FORM_ADVERTISEMENT_LEFT;?>
</option>
					<option value="advertisement_right" <?php if ($_smarty_tpl->tpl_vars['return_data']->value['ad_position']=='advertisement_right'){?>selected<?php }?>><?php echo @MOD_ADSIMPLE_FORM_ADVERTISEMENT_RIGHT;?>
</option>
				</select>
				<input type="hidden" id="index" name="index" value="" />
			</td>
			<td>
			<?php echo @MOD_ADSIMPLE_FORM_ENABLE_SHOW;?>
 <input type="checkbox" id="token" name="token" <?php if ($_smarty_tpl->tpl_vars['return_data']->value['token']){?>checked<?php }?>>
		</td>
	</tr>
	<tr>
		<td colspan="2"><textarea cols="80" rows="10" name="advert"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['return_data']->value['advert'])===null||$tmp==='' ? false : $tmp);?>
</textarea></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="save" value="<?php echo @FORM_BUTTON_SAVE;?>
" class="button"></td>
	</tr>
</table>
</form>

<form action="<?php echo @CONF_ADMIN_FILE;?>
?m=mods&s=adsimple" method="post" enctype="multipart/form-data">
<input type="submit" name="delete" value="<?php echo @FORM_ACTION_DELETE_SELECTED;?>
" class="button">
<?php  $_smarty_tpl->tpl_vars["adv"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["adv"]->_loop = false;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['advert']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["adv"]->key => $_smarty_tpl->tpl_vars["adv"]->value){
$_smarty_tpl->tpl_vars["adv"]->_loop = true;
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["adv"]->key;
?>
	<h2 style="margin-bottom: 0px;"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</h2>
	<table style="width: 95%; margin-bottom: 40px;">
		<thead class="data_head">
			<tr>
				<td>№</td>
				<td><?php echo @MOD_ADSIMPLE_TABLE_ROW_CODE;?>
</td>
				<td><?php echo @MOD_ADSIMPLE_TABLE_ROW_STATE;?>
</td>
				<td>-</td>
			</tr>
		</thead>
		<tbody class="data_body">
			<?php  $_smarty_tpl->tpl_vars["i"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["i"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['adv']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["i"]->key => $_smarty_tpl->tpl_vars["i"]->value){
$_smarty_tpl->tpl_vars["i"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["i"]->key;
?>
			<tr>
				<td id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</td>
				<td code="<?php echo $_smarty_tpl->tpl_vars['i']->value['htmlcode'];?>
"><code><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['i']->value['htmlcode'],80," ...",true);?>
</code></td>
				<td align="center"><?php echo $_smarty_tpl->tpl_vars['i']->value['token'];?>
<input type="hidden" id="token" value="<?php echo $_smarty_tpl->tpl_vars['i']->value['token'];?>
"></td>
				<td align="center"><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
]" class="checkbox_entry"></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
<?php } ?>
</form>

<script type="text/javascript">
<!--
$( function() {
	$('.data_body').children().click( function() {
		$('#index').val($(this).find('td[id]').attr('id'));
		var tt = $(this).find('td[id]').attr('class');
		$('select option[value="' + tt + '"]').attr('selected', 'selected');
		var val = $(this).find('#token').val();
		(val == 'active') ? $("#token:checkbox").attr('checked', true) : $("#token:checkbox").attr('checked', false);
		$('textarea').text('').text($(this).find('td[code]').attr('code'));
	});
		
	$('select').change( function() {
		$('#index').val('');
	});
});
-->
</script>
<?php }} ?>