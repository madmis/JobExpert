<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:05
         compiled from "templates/site/default\block.user.news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:62044faa489540f575-97256886%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6320214429e9431fea8aa974d044981d7b08383e' => 
    array (
      0 => 'templates/site/default\\block.user.news.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62044faa489540f575-97256886',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user_email' => 0,
    'codex' => 0,
    'menu' => 0,
    'chpu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa489558566',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa489558566')) {function content_4faa489558566($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include 'I:\\home\\Smarty\\plugins\\function.counter.php';
?><?php if ($_smarty_tpl->tpl_vars['user_email']->value&&$_smarty_tpl->tpl_vars['codex']->value['rights']['add_news']&&$_smarty_tpl->tpl_vars['menu']->value=='user.news'){?>
	<?php echo smarty_function_counter(array('start'=>0,'print'=>false),$_smarty_tpl);?>


		<div class="DesignLeftSideBarBlockWrapper">
			<h3 class="sideBlockHeader" id="myNews"><?php echo @MENU_MY_NEWS;?>
</h3>
			<ul class="sideBlockContent">
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if (($_tmp1%2)){?>even<?php }else{ ?>odd<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.news&amp;action=add");?>
"><?php echo @MENU_ACTION_ADD;?>
</a></li>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if (($_tmp2%2)){?>even<?php }else{ ?>odd<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.news&amp;action=active");?>
"><?php echo @MENU_ACTION_ACTIVE;?>
</a></li>
			<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['arc_news']){?>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php if (($_tmp3%2)){?>even<?php }else{ ?>odd<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.news&amp;action=archived");?>
"><?php echo @MENU_ACTION_ARCHIVED;?>
</a></li>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['codex']->value['resp']['moder_news']){?>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp4=ob_get_clean();?><?php if (($_tmp4%2)){?>even<?php }else{ ?>odd<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.news&amp;action=moderate");?>
"><?php echo @MENU_ACTION_MODERATE;?>
</a></li>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp5=ob_get_clean();?><?php if (($_tmp5%2)){?>even<?php }else{ ?>odd<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.news&amp;action=correction");?>
"><?php echo @MENU_ACTION_CORRECTION;?>
</a></li>
			<?php }?>
			</ul>
		</div>
<?php }?><?php }} ?>