<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:04
         compiled from "templates/site/default\block.user.announces.tpl" */ ?>
<?php /*%%SmartyHeaderCode:41104faa4894df1243-51932958%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c814441f9038c15995910fc9097b11c88418727' => 
    array (
      0 => 'templates/site/default\\block.user.announces.tpl',
      1 => 1336142862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '41104faa4894df1243-51932958',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu' => 0,
    'action' => 0,
    'user_type' => 0,
    'token' => 0,
    'chpu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa489528290',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa489528290')) {function content_4faa489528290($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include 'I:\\home\\Smarty\\plugins\\function.counter.php';
?><?php if ($_smarty_tpl->tpl_vars['menu']->value=='user.announces'){?>
	<?php if ($_smarty_tpl->tpl_vars['action']->value=='vacancy'&&($_smarty_tpl->tpl_vars['user_type']->value=='employer'||$_smarty_tpl->tpl_vars['user_type']->value=='company'||$_smarty_tpl->tpl_vars['user_type']->value=='agent')){?>
		<?php echo smarty_function_counter(array('start'=>0,'print'=>false),$_smarty_tpl);?>

		<div class="DesignLeftSideBarBlockWrapper">
			<h3 class="sideBlockHeader" id="vacancy"><?php echo @MENU_MY_VACANCYS;?>
</h3>
			<ul class="sideBlockContent">
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if (($_tmp1%2)){?>even<?php }else{ ?>odd<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['token']->value=='active'){?>
						<a class="active"><?php echo @ANNOUNCE_TOKEN_ACTIVE;?>
 <?php echo @FORM_VACANCYS_HEAD;?>
</a>
					<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=".($_smarty_tpl->tpl_vars['menu']->value)."&amp;action=".($_smarty_tpl->tpl_vars['action']->value)."&amp;token=active");?>
"><?php echo @ANNOUNCE_TOKEN_ACTIVE;?>
 <?php echo @FORM_VACANCYS_HEAD;?>
</a>
					<?php }?>
				</li>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if (($_tmp2%2)){?>even<?php }else{ ?>odd<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['token']->value=='moderate'){?>
						<a class="active"><?php echo @ANNOUNCE_TOKEN_MODERATE;?>
</a>
					<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=".($_smarty_tpl->tpl_vars['menu']->value)."&amp;action=".($_smarty_tpl->tpl_vars['action']->value)."&amp;token=moderate");?>
"><?php echo @ANNOUNCE_TOKEN_MODERATE;?>
</a>
					<?php }?>
				</li>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php if (($_tmp3%2)){?>even<?php }else{ ?>odd<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['token']->value=='correction'){?>
						<a class="active"><?php echo @ANNOUNCE_TOKEN_CORRECTION;?>
</a>
					<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=".($_smarty_tpl->tpl_vars['menu']->value)."&amp;action=".($_smarty_tpl->tpl_vars['action']->value)."&amp;token=correction");?>
"><?php echo @ANNOUNCE_TOKEN_CORRECTION;?>
</a>
					<?php }?>
				</li>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp4=ob_get_clean();?><?php if (($_tmp4%2)){?>even<?php }else{ ?>odd<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['token']->value=='payment'){?>
						<a class="active"><?php echo @ANNOUNCE_TOKEN_PAYMENT;?>
</a>
					<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=".($_smarty_tpl->tpl_vars['menu']->value)."&amp;action=".($_smarty_tpl->tpl_vars['action']->value)."&amp;token=payment");?>
"><?php echo @ANNOUNCE_TOKEN_PAYMENT;?>
</a>
					<?php }?>
				</li>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp5=ob_get_clean();?><?php if (($_tmp5%2)){?>even<?php }else{ ?>odd<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['token']->value=='archived'){?>
						<a class="active"><?php echo @ANNOUNCE_TOKEN_ARCHIVED;?>
</a>
					<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=".($_smarty_tpl->tpl_vars['menu']->value)."&amp;action=".($_smarty_tpl->tpl_vars['action']->value)."&amp;token=archived");?>
"><?php echo @ANNOUNCE_TOKEN_ARCHIVED;?>
</a>
					<?php }?>
				</li>
			</ul>
		</div>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['action']->value=='resume'&&($_smarty_tpl->tpl_vars['user_type']->value=='competitor'||$_smarty_tpl->tpl_vars['user_type']->value=='agent')){?>
		<?php echo smarty_function_counter(array('start'=>0,'print'=>false),$_smarty_tpl);?>

		<div class="DesignLeftSideBarBlockWrapper">
			<h3 class="sideBlockHeader" id="resume"><?php echo @MENU_MY_RESUMES;?>
</h3>
			<ul class="sideBlockContent">
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp6=ob_get_clean();?><?php if (($_tmp6%2)){?>even<?php }else{ ?>odd<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['token']->value=='active'){?>
						<a class="active"><?php echo @ANNOUNCE_TOKEN_ACTIVE;?>
 <?php echo @FORM_RESUMES_HEAD;?>
</a>
					<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=".($_smarty_tpl->tpl_vars['menu']->value)."&amp;action=".($_smarty_tpl->tpl_vars['action']->value)."&amp;token=active");?>
"><?php echo @ANNOUNCE_TOKEN_ACTIVE;?>
 <?php echo @FORM_RESUMES_HEAD;?>
</a>
					<?php }?>
				</li>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp7=ob_get_clean();?><?php if (($_tmp7%2)){?>even<?php }else{ ?>odd<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['token']->value=='moderate'){?>
						<a class="active"><?php echo @ANNOUNCE_TOKEN_MODERATE;?>
</a>
					<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=".($_smarty_tpl->tpl_vars['menu']->value)."&amp;action=".($_smarty_tpl->tpl_vars['action']->value)."&amp;token=moderate");?>
"><?php echo @ANNOUNCE_TOKEN_MODERATE;?>
</a>
					<?php }?>
				</li>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp8=ob_get_clean();?><?php if (($_tmp8%2)){?>even<?php }else{ ?>odd<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['token']->value=='correction'){?>
						<a class="active"><?php echo @ANNOUNCE_TOKEN_CORRECTION;?>
</a>
					<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=".($_smarty_tpl->tpl_vars['menu']->value)."&amp;action=".($_smarty_tpl->tpl_vars['action']->value)."&amp;token=correction");?>
"><?php echo @ANNOUNCE_TOKEN_CORRECTION;?>
</a>
					<?php }?>
				</li>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp9=ob_get_clean();?><?php if (($_tmp9%2)){?>even<?php }else{ ?>odd<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['token']->value=='payment'){?>
						<a class="active"><?php echo @ANNOUNCE_TOKEN_PAYMENT;?>
</a>
					<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=".($_smarty_tpl->tpl_vars['menu']->value)."&amp;action=".($_smarty_tpl->tpl_vars['action']->value)."&amp;token=payment");?>
"><?php echo @ANNOUNCE_TOKEN_PAYMENT;?>
</a>
					<?php }?>
				</li>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp10=ob_get_clean();?><?php if (($_tmp10%2)){?>even<?php }else{ ?>odd<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['token']->value=='archived'){?>
						<a class="active"><?php echo @ANNOUNCE_TOKEN_ARCHIVED;?>
</a>
					<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=".($_smarty_tpl->tpl_vars['menu']->value)."&amp;action=".($_smarty_tpl->tpl_vars['action']->value)."&amp;token=archived");?>
"><?php echo @ANNOUNCE_TOKEN_ARCHIVED;?>
</a>
					<?php }?>
				</li>
			</ul>
		</div>
	<?php }?>
<?php }?><?php }} ?>