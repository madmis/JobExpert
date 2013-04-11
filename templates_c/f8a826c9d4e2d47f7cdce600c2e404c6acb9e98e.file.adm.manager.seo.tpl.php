<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:57:55
         compiled from "templates/admin\adm.manager.seo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:188924fb75283c53882-81864082%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8a826c9d4e2d47f7cdce600c2e404c6acb9e98e' => 
    array (
      0 => 'templates/admin\\adm.manager.seo.tpl',
      1 => 1336142866,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '188924fb75283c53882-81864082',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'seoUrl' => 0,
    'langs' => 0,
    'lang' => 0,
    'currLang' => 0,
    'seo' => 0,
    'key' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb75283d9f81',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb75283d9f81')) {function content_4fb75283d9f81($_smarty_tpl) {?><div class="sub_menu">
	<div style="float: left;">
		<form action="<?php echo @CONF_ADMIN_FILE;?>
<?php echo $_smarty_tpl->tpl_vars['seoUrl']->value;?>
" method="post" enctype="multipart/form-data">
			&nbsp;<?php echo @FORM_SELECT_LANGUAGE;?>
:&nbsp;
			<select name="currLocaliz" class="langSelect">
				<?php  $_smarty_tpl->tpl_vars["lang"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["lang"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["lang"]->key => $_smarty_tpl->tpl_vars["lang"]->value){
$_smarty_tpl->tpl_vars["lang"]->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['lang']->value==$_smarty_tpl->tpl_vars['currLang']->value){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
</option>
				<?php } ?>
			</select>
		</form>
	</div>
	<div class="colorbox_help" id="HELP_ADMIN_SEO_FILES">
		<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/actions/help.png" alt="<?php echo @FORM_IMG_HELP;?>
">
	</div>
</div>

<?php if ($_smarty_tpl->tpl_vars['seo']->value){?>
<form action="<?php echo @CONF_ADMIN_FILE;?>
<?php echo $_smarty_tpl->tpl_vars['seoUrl']->value;?>
" method="post" enctype="multipart/form-data">
<?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['seo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value){
$_smarty_tpl->tpl_vars["item"]->_loop = true;
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["item"]->key;
?>
<table style="width: 100%; border: 0px;" cellspacing="10" cellpadding="5">
	<thead class="data_head" style="cursor: pointer;">
		<tr>
			<td class="toggleList"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</td>
		</tr>
	</thead>
	<tbody class="data_body">
		<tr>
			<td>
				<textarea name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" cols="100" rows="3" style="padding: 5px;"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</textarea>
			</td>
		</tr>
	</tbody>
</table>
<?php } ?>
<table style="width: 100%; border: 0px;" cellspacing="10" cellpadding="5">
	<tfoot class="data_foot">
		<tr>
			<td><input type="submit" name="save" value="<?php echo @FORM_BUTTON_SAVE;?>
" class="button"></td>
		</tr>
	</tfoot>
</table>
</form>
<?php }?>
	

<script type="text/javascript">
<!--
$(function() {
    $('.langSelect').change(function() {
		$(this).parent('form').submit();
	});
	$('.toggleList').click(function() {
		$(this).parents('thead').next().toggle();
	});
});
-->
</script>
<?php }} ?>