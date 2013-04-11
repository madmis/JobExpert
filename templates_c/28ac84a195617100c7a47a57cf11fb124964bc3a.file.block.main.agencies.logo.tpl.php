<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:06
         compiled from "templates/site/default\block.main.agencies.logo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:205194faa4896e9c204-55455295%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '28ac84a195617100c7a47a57cf11fb124964bc3a' => 
    array (
      0 => 'templates/site/default\\block.main.agencies.logo.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205194faa4896e9c204-55455295',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mainAgnLogo' => 0,
    'mLogo' => 0,
    'chpu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa48970a27b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa48970a27b')) {function content_4faa48970a27b($_smarty_tpl) {?><table class="mainBodyTable" cellspacing="0">
	<tr>
		<th colspan="<?php echo @CONF_AGENCIES_SHOW_MAIN_LOGO_QTY;?>
"><?php echo @SITE_RECRUITMENT_AGENCIES;?>
</th>
	</tr>
	<?php  $_smarty_tpl->tpl_vars["mLogo"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["mLogo"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mainAgnLogo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["mLogo"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["mLogo"]->iteration=0;
 $_smarty_tpl->tpl_vars["mLogo"]->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["i"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars["mLogo"]->key => $_smarty_tpl->tpl_vars["mLogo"]->value){
$_smarty_tpl->tpl_vars["mLogo"]->_loop = true;
 $_smarty_tpl->tpl_vars["mLogo"]->iteration++;
 $_smarty_tpl->tpl_vars["mLogo"]->index++;
 $_smarty_tpl->tpl_vars["mLogo"]->first = $_smarty_tpl->tpl_vars["mLogo"]->index === 0;
 $_smarty_tpl->tpl_vars["mLogo"]->last = $_smarty_tpl->tpl_vars["mLogo"]->iteration === $_smarty_tpl->tpl_vars["mLogo"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["i"]['first'] = $_smarty_tpl->tpl_vars["mLogo"]->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["i"]['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["i"]['last'] = $_smarty_tpl->tpl_vars["mLogo"]->last;
?>
	<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['first']||(!(($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['iteration']-1) % @CONF_AGENCIES_SHOW_MAIN_LOGO_QTY))){?><tr><?php }?>
		<td style="width: <?php echo @CONF_FILEMANAGER_THUMBNAIL_WIDTH+20;?>
px; height: <?php echo @CONF_FILEMANAGER_THUMBNAIL_HEIGHT+20;?>
px;" <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['last']||(!($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['iteration'] % @CONF_AGENCIES_SHOW_MAIN_LOGO_QTY))){?>class="last"<?php }?>>
			<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=agencies&amp;action=detail&amp;id=".($_smarty_tpl->tpl_vars['mLogo']->value['tId']));?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mLogo']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
<?php if ($_smarty_tpl->tpl_vars['mLogo']->value['company_city']){?> (<?php echo $_smarty_tpl->tpl_vars['mLogo']->value['company_city'];?>
)<?php }?>">
				<img src="<?php echo @CONF_SCRIPT_URL;?>
uploads/images/logo/thumbs/thumb_<?php echo $_smarty_tpl->tpl_vars['mLogo']->value['logo'];?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mLogo']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
" class="mainLogo">
			</a>
		</td>
	<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['last']||(!($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['iteration'] % @CONF_AGENCIES_SHOW_MAIN_LOGO_QTY))){?></tr><?php }?>
	<?php } ?>
	<tr>
		<td class="last AlignRight" colspan="<?php echo @CONF_AGENCIES_SHOW_MAIN_LOGO_QTY;?>
">
			<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=agencies");?>
"><?php echo @SITE_ALL_AGENCIES;?>
...</a>
		</td>
	</tr>
</table>
<?php }} ?>