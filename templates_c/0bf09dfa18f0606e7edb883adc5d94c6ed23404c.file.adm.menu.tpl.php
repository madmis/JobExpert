<?php /* Smarty version Smarty-3.1.5, created on 2012-05-11 21:33:39
         compiled from "templates/admin\adm.menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127164fad4d73b258b7-96376738%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0bf09dfa18f0606e7edb883adc5d94c6ed23404c' => 
    array (
      0 => 'templates/admin\\adm.menu.tpl',
      1 => 1336142862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127164fad4d73b258b7-96376738',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'admMenu' => 0,
    'menu' => 0,
    'menu_content' => 0,
    'submenu_content' => 0,
    'year' => 0,
    'currMenu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fad4d73e53f0',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad4d73e53f0')) {function content_4fad4d73e53f0($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'I:\\home\\Smarty\\plugins\\modifier.date_format.php';
?><table cellpadding="0" cellspacing="0" style="width: 100%;">
	<tr>
		<td class="menu_pane">
			<?php  $_smarty_tpl->tpl_vars["menu"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["menu"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['admMenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["menu"]->key => $_smarty_tpl->tpl_vars["menu"]->value){
$_smarty_tpl->tpl_vars["menu"]->_loop = true;
?>
				<div class="menu_title" <?php echo $_smarty_tpl->tpl_vars['menu']->value['attr'];?>
>
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr>
							<td>
								<img class="menu_ico" src="<?php echo $_smarty_tpl->tpl_vars['menu']->value['ico'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>

							</td>
						</tr>
					</table>
				</div>
				<div class="menu_content">
					<?php  $_smarty_tpl->tpl_vars["menu_content"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["menu_content"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value['content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["menu_content"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["menu_content"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["menu_content"]->key => $_smarty_tpl->tpl_vars["menu_content"]->value){
$_smarty_tpl->tpl_vars["menu_content"]->_loop = true;
 $_smarty_tpl->tpl_vars["menu_content"]->iteration++;
 $_smarty_tpl->tpl_vars["menu_content"]->last = $_smarty_tpl->tpl_vars["menu_content"]->iteration === $_smarty_tpl->tpl_vars["menu_content"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["menu_content"]['last'] = $_smarty_tpl->tpl_vars["menu_content"]->last;
?>
						<?php if (!$_smarty_tpl->tpl_vars['menu_content']->value['subMenu']){?>
							<table cellpadding="0" cellspacing="0" style="width: 100%;">
								<tr>
									<td class="menu_dots<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['menu_content']['last']){?>l<?php }?>"></td>
									<td>
										<img class="menu_ico" src="<?php echo $_smarty_tpl->tpl_vars['menu_content']->value['ico'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['menu_content']->value['name'];?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['menu_content']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['menu_content']->value['name'];?>
</a>
									</td>
								</tr>
							</table>
						<?php }else{ ?>
							<div class="submenu_title" <?php echo $_smarty_tpl->tpl_vars['menu_content']->value['attr'];?>
>
								<table cellpadding="0" cellspacing="0" style="width: 100%;">
									<tr style="white-space: nowrap;">
										<td class="menu_dots<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['menu_content']['last']){?>l<?php }?>"></td>
										<td>
											<img class="menu_ico" src="<?php echo $_smarty_tpl->tpl_vars['menu_content']->value['ico'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['menu_content']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['menu_content']->value['name'];?>

										</td>
									</tr>
								</table>
							</div>
							<div class="submenu_content">
								<table cellpadding="0" cellspacing="0" style="width: 100%;">
									<?php  $_smarty_tpl->tpl_vars["submenu_content"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["submenu_content"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu_content']->value['content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["submenu_content"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["submenu_content"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["submenu_content"]->key => $_smarty_tpl->tpl_vars["submenu_content"]->value){
$_smarty_tpl->tpl_vars["submenu_content"]->_loop = true;
 $_smarty_tpl->tpl_vars["submenu_content"]->iteration++;
 $_smarty_tpl->tpl_vars["submenu_content"]->last = $_smarty_tpl->tpl_vars["submenu_content"]->iteration === $_smarty_tpl->tpl_vars["submenu_content"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["submenu_content"]['last'] = $_smarty_tpl->tpl_vars["submenu_content"]->last;
?>
										<tr>
											<td class="menu_<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['menu_content']['last']){?>no<?php }?>dot"></td>
											<td class="menu_dots<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['submenu_content']['last']){?>l<?php }?>"></td>
											<td>
												<img class="menu_ico" src="<?php echo $_smarty_tpl->tpl_vars['submenu_content']->value['ico'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['submenu_content']->value['name'];?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['submenu_content']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['submenu_content']->value['name'];?>
</a>
											</td>
										</tr>
									<?php } ?>
								</table>
							</div>
						<?php }?>
					<?php } ?>
				</div>
			<?php } ?>
		</td>
	</tr>
</table>
<table class="copyright">
	<tr>
		<td>
			<?php $_smarty_tpl->tpl_vars["year"] = new Smarty_variable(smarty_modifier_date_format(time(),"%Y"), null, 0);?>
			Works on the engine <a href="http://sd-group.org.ua/" class="white"><b>Expert</b></a><br>
			<span class="lastQuerys">&copy;</span>&nbsp;<a href="http://sd-group.org.ua/" class="white"><b>SD-Group</b></a>&nbsp;<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['year']->value+5;?>

		</td>
	</tr>
</table>
<script type="text/javascript">
<!--
	// проверяем кукисы меню
	if (currCookie = $.cookie('openAdmMenu')) {
		for (var i in arrlist = currCookie.split(',')) {
			$('#' + arrlist[i]).toggleClass('open').next().show();
		}
	}
	// раскрываем текущий раздел меню
	$('#<?php echo $_smarty_tpl->tpl_vars['currMenu']->value;?>
').removeClass('hide').next().show('fast');
-->
</script><?php }} ?>