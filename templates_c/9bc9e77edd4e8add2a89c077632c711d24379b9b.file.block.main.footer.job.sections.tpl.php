<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:08
         compiled from "templates/site/default\block.main.footer.job.sections.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21564faa489802ce89-72671426%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9bc9e77edd4e8add2a89c077632c711d24379b9b' => 
    array (
      0 => 'templates/site/default\\block.main.footer.job.sections.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21564faa489802ce89-72671426',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user_type' => 0,
    'sections' => 0,
    'section' => 0,
    'chpu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa48980e9c0',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa48980e9c0')) {function content_4faa48980e9c0($_smarty_tpl) {?><div class="DesignFooterHR"></div>
<?php if ($_smarty_tpl->tpl_vars['user_type']->value=='agent'||$_smarty_tpl->tpl_vars['user_type']->value=='competitor'){?>
	<?php $_smarty_tpl->tpl_vars["type"] = new Smarty_variable("vacancy", null, 0);?>
<?php }else{ ?>
	<?php $_smarty_tpl->tpl_vars["type"] = new Smarty_variable("resume", null, 0);?>
<?php }?>

<table style="width: 100%;">
	<tr>
	<?php  $_smarty_tpl->tpl_vars["section"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["section"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sections']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["section"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["section"]->iteration=0;
 $_smarty_tpl->tpl_vars["section"]->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["i"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars["section"]->key => $_smarty_tpl->tpl_vars["section"]->value){
$_smarty_tpl->tpl_vars["section"]->_loop = true;
 $_smarty_tpl->tpl_vars["section"]->iteration++;
 $_smarty_tpl->tpl_vars["section"]->index++;
 $_smarty_tpl->tpl_vars["section"]->first = $_smarty_tpl->tpl_vars["section"]->index === 0;
 $_smarty_tpl->tpl_vars["section"]->last = $_smarty_tpl->tpl_vars["section"]->iteration === $_smarty_tpl->tpl_vars["section"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["i"]['first'] = $_smarty_tpl->tpl_vars["section"]->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["i"]['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["i"]['last'] = $_smarty_tpl->tpl_vars["section"]->last;
?>
		<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['first']||(!(($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['iteration']-1) % 6))){?>
		<td style="white-space: nowrap; vertical-align: top;">
			<div class="footerBlock">
		<?php }?>
				<p><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=".($_smarty_tpl->tpl_vars['type']->value)."&amp;action=sections&amp;id=".($_smarty_tpl->tpl_vars['section']->value['tId']));?>
" title="<?php echo $_smarty_tpl->tpl_vars['section']->value['name'];?>
">
					<?php echo $_smarty_tpl->tpl_vars['section']->value['name'];?>

				</a></p>
		<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['last']||(!($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['iteration'] % 6))){?>
			</div>
		</td>
		<?php }?>
	<?php } ?>
	</tr>
</table><?php }} ?>