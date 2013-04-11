<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:07
         compiled from "templates/site/default\block.main.newses.last.tpl" */ ?>
<?php /*%%SmartyHeaderCode:277734faa489758fed1-95585448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f5991663c9af67f18f8dd9e81c0b50bedbd88da' => 
    array (
      0 => 'templates/site/default\\block.main.newses.last.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '277734faa489758fed1-95585448',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last' => 0,
    'news' => 0,
    'chpu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa489766b3e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa489766b3e')) {function content_4faa489766b3e($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'I:\\home\\Smarty\\plugins\\modifier.date_format.php';
?><?php if (@CONF_NEWSES_LAST_SHOW&&$_smarty_tpl->tpl_vars['last']->value['newses']){?>
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th><?php echo @SITE_LAST_NEWS;?>
</th>
			</tr>
			<?php  $_smarty_tpl->tpl_vars["news"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["news"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last']->value['newses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["news"]->key => $_smarty_tpl->tpl_vars["news"]->value){
$_smarty_tpl->tpl_vars["news"]->_loop = true;
?>
				<tr>
					<td class="last">
						<div class="DesignCenterSideBarBlockWrapper">
					        <div class="newsBlockLast">
								<div class="newsDate"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['news']->value['datetime'],@CONF_DATE_FORMAT);?>
 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['news']->value['datetime'],@CONF_TIME_FORMAT);?>
</div>
								<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=news&amp;action=view&amp;id=".($_smarty_tpl->tpl_vars['news']->value['tId']));?>
" title="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
</a>
					            <div class="paddingText5"><?php echo $_smarty_tpl->tpl_vars['news']->value['small_text'];?>
</div>
					        </div>
						</div>
					</td>
				</tr>
			<?php } ?>
			<tr>
				<td class="last AlignRight">
					<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=news");?>
"><?php echo @SITE_ALL;?>
 <?php echo @SITE_NEWS;?>
...</a>
				</td>
			</tr>
		</table>
	</div>
<?php }?><?php }} ?>