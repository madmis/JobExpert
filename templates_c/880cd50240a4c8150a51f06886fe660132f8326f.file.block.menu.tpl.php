<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:05
         compiled from "templates/site/default\block.menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:188854faa48955e5ef2-47400505%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '880cd50240a4c8150a51f06886fe660132f8326f' => 
    array (
      0 => 'templates/site/default\\block.menu.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '188854faa48955e5ef2-47400505',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu' => 0,
    'action' => 0,
    'chpu' => 0,
    'dop_pages' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa489573d83',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa489573d83')) {function content_4faa489573d83($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include 'I:\\home\\Smarty\\plugins\\function.counter.php';
?>    <div class="DesignLeftSideBarBlockWrapper">
        <h3 class="sideBlockHeader" id="menu"><?php echo @MENU;?>
</h3>
        <ul>
            <?php echo smarty_function_counter(array('start'=>0,'print'=>false),$_smarty_tpl);?>

            <li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if (($_tmp1%2)){?>even<?php }else{ ?>odd<?php }?>">
   				<?php if ($_smarty_tpl->tpl_vars['menu']->value=='news'&&(!$_smarty_tpl->tpl_vars['action']->value['archive']||$_smarty_tpl->tpl_vars['action']->value['view'])){?>
                    <div class="withIcon"><strong><?php echo @MENU_NEWS;?>
</strong></div>
                <?php }else{ ?>
                    <a class="withIcon" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=news");?>
"><?php echo @MENU_NEWS;?>
</a>
                <?php }?>
                <a class="icon" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=rss&amp;action=news");?>
"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/sideBarMenuRss.png" alt="RSS"></a>
            </li>
            <li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if (($_tmp2%2)){?>even<?php }else{ ?>odd<?php }?>">
                <?php if ($_smarty_tpl->tpl_vars['menu']->value=='feedback'){?>
                    <div class="withIcon"><strong><?php echo @MENU_FEEDBACK;?>
</strong></div>
                <?php }else{ ?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=feedback");?>
"><?php echo @MENU_FEEDBACK;?>
</a>
                <?php }?>
            </li>
			<?php if ($_smarty_tpl->tpl_vars['dop_pages']->value){?>
			<?php  $_smarty_tpl->tpl_vars["page"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["page"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dop_pages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["page"]->key => $_smarty_tpl->tpl_vars["page"]->value){
$_smarty_tpl->tpl_vars["page"]->_loop = true;
?>
				<li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php if (($_tmp3%2)){?>even<?php }else{ ?>odd<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['menu']->value==$_smarty_tpl->tpl_vars['page']->value['id']){?>
						<div class="withIcon"><strong><?php echo $_smarty_tpl->tpl_vars['page']->value['title'];?>
</strong></div>
					<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=pages&amp;action=view&amp;id=".($_smarty_tpl->tpl_vars['page']->value['id']));?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value['title'];?>
</a>
					<?php }?>
				</li>
			<?php } ?>
			<?php }?>
        </ul>
    </div><?php }} ?>