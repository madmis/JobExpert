<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:05
         compiled from "templates/site/default\block.news.archive.tpl" */ ?>
<?php /*%%SmartyHeaderCode:79624faa4895747448-40317578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd649c65b595b290760cf81ec111e9d0ffcba4620' => 
    array (
      0 => 'templates/site/default\\block.news.archive.tpl',
      1 => 1336142862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '79624faa4895747448-40317578',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'archive' => 0,
    'i' => 0,
    'selectedYear' => 0,
    'year' => 0,
    'chpu' => 0,
    'menu' => 0,
    'action' => 0,
    'arrAddDict' => 0,
    'currMonth' => 0,
    'selectedMonth' => 0,
    'key' => 0,
    'month' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa489596dca',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa489596dca')) {function content_4faa489596dca($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['archive']->value['news']){?>
	<?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable("0", null, 0);?>

	<div class="DesignLeftSideBarBlockWrapper">
		<h3 class="sideBlockHeader" id="blockNewsArchive" style="margin-left: 4px;"><?php echo @MENU_NEWS_ARCHIVE;?>
</h3>
	    <div class="DesignMainPageBody">
			<ul>
			<?php  $_smarty_tpl->tpl_vars["year"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["year"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['archive']->value['news']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["year"]->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars["year"]->key => $_smarty_tpl->tpl_vars["year"]->value){
$_smarty_tpl->tpl_vars["year"]->_loop = true;
 $_smarty_tpl->tpl_vars["year"]->index++;
 $_smarty_tpl->tpl_vars["year"]->first = $_smarty_tpl->tpl_vars["year"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["year"]['first'] = $_smarty_tpl->tpl_vars["year"]->first;
?>
				<?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
				<li class="<?php if (($_smarty_tpl->tpl_vars['i']->value%2)){?>even<?php }else{ ?>odd<?php }?>">
					<?php if ($_smarty_tpl->tpl_vars['selectedYear']->value==$_smarty_tpl->tpl_vars['year']->value){?>
						<div class="withIcon"><strong><?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</strong></div>
					<?php }else{ ?>
						<a class="withIcon" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=news&amp;action=archive&amp;year=".($_smarty_tpl->tpl_vars['year']->value));?>
"><?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</a>
					<?php }?>
				</li>
				<?php if ($_smarty_tpl->tpl_vars['selectedYear']->value){?>
					<?php if ($_smarty_tpl->tpl_vars['menu']->value=="news"&&$_smarty_tpl->tpl_vars['action']->value['archive']&&$_smarty_tpl->tpl_vars['selectedYear']->value==$_smarty_tpl->tpl_vars['year']->value){?>
						<li class="CategoriesLists">
							<?php  $_smarty_tpl->tpl_vars["month"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["month"]->_loop = false;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arrAddDict']->value['Month']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["month"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars["month"]->key => $_smarty_tpl->tpl_vars["month"]->value){
$_smarty_tpl->tpl_vars["month"]->_loop = true;
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["month"]->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["month"]['iteration']++;
?>
								<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['year']['first']){?>
									<?php if ($_smarty_tpl->tpl_vars['currMonth']->value>=$_smarty_tpl->getVariable('smarty')->value['foreach']['month']['iteration']){?>
										<?php if ($_smarty_tpl->tpl_vars['selectedMonth']->value==$_smarty_tpl->tpl_vars['key']->value){?>
                                            <div style="margin-left: 20px; font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['month']->value;?>
</div>
                                        <?php }else{ ?>
                                            <div style="margin-left: 20px;">
											    <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=news&amp;action=archive&amp;year=".($_smarty_tpl->tpl_vars['year']->value)."&month=".($_smarty_tpl->tpl_vars['key']->value));?>
"><?php echo $_smarty_tpl->tpl_vars['month']->value;?>
</a>
										    </div>
                                        <?php }?>
									<?php }?>
								<?php }else{ ?>
                                    <?php if ($_smarty_tpl->tpl_vars['selectedMonth']->value==$_smarty_tpl->tpl_vars['key']->value){?>
                                        <div style="margin-left: 20px; font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['month']->value;?>
</div>
                                    <?php }else{ ?>
									    <div style="margin-left: 20px;">
										    <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=news&amp;action=archive&amp;year=".($_smarty_tpl->tpl_vars['year']->value)."&month=".($_smarty_tpl->tpl_vars['key']->value));?>
"><?php echo $_smarty_tpl->tpl_vars['month']->value;?>
</a>
									    </div>
                                    <?php }?>
								<?php }?>
							<?php } ?>
						</li>
					<?php }?>
				<?php }?>
			<?php } ?>
			</ul>
	    </div>
	</div>
<?php }?>
<?php }} ?>