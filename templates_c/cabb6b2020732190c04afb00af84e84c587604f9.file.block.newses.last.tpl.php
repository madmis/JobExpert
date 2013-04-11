<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:08
         compiled from "templates/site/default\block.newses.last.tpl" */ ?>
<?php /*%%SmartyHeaderCode:74554faa4897e94e33-58952337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cabb6b2020732190c04afb00af84e84c587604f9' => 
    array (
      0 => 'templates/site/default\\block.newses.last.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '74554faa4897e94e33-58952337',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last' => 0,
    'menu' => 0,
    'news' => 0,
    'chpu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa489801e5c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa489801e5c')) {function content_4faa489801e5c($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'I:\\home\\Smarty\\plugins\\modifier.date_format.php';
?><?php if ($_smarty_tpl->tpl_vars['last']->value['newses']&&'news'!=$_smarty_tpl->tpl_vars['menu']->value){?>
	<div class="DesignLeftSideBarBlockWrapper" style="padding:0px 9px 35px 2px;">
		<h3 class="NewsH3 sideBlockHeader" id="news" style="margin-left: 4px;"><?php echo @SITE_LAST_NEWS;?>
</h3>
	    <div class="DesignMainPageBody">
		    <?php  $_smarty_tpl->tpl_vars["news"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["news"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last']->value['newses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["news"]->key => $_smarty_tpl->tpl_vars["news"]->value){
$_smarty_tpl->tpl_vars["news"]->_loop = true;
?>
		        <div class="newsBlock<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['News']['last']){?>Last<?php }?>">
		            <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=news&amp;action=view&amp;id=".($_smarty_tpl->tpl_vars['news']->value['tId']));?>
" title="<?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
</a>
		            <div class="newsDate"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['news']->value['datetime'],@CONF_DATE_FORMAT);?>
 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['news']->value['datetime'],@CONF_TIME_FORMAT);?>
</div>
		        </div>
  			<?php } ?>
			<div class="AlignRight">
				<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=news");?>
"><?php echo @SITE_ALL;?>
 <?php echo @SITE_NEWS;?>
...</a>
			</div>
	    </div>
	</div>
<?php }?><?php }} ?>