<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:07
         compiled from "templates/site/default\block.vacancy.list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:213694faa489788a378-63303859%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52ef7d92d47c675eb851b80701c7e03a0953be3d' => 
    array (
      0 => 'templates/site/default\\block.vacancy.list.tpl',
      1 => 1336142862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '213694faa489788a378-63303859',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'actPage' => 0,
    'regions' => 0,
    'i' => 0,
    'chpu' => 0,
    'sections' => 0,
    'section' => 0,
    'region' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa4897b3431',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa4897b3431')) {function content_4faa4897b3431($_smarty_tpl) {?>    <div class="DesignLeftSideBarBlockWrapperB">
        <h3 class="sideBlockHeader" id="vacancyList"><?php echo @MENU_ANNOUNCES_NAVIGATOR;?>
&nbsp;<?php echo @MENU_ANNOUNCES_NAVIGATOR_ON_VACANCY;?>
</h3>
        <ul>
            <?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable("1", null, 0);?>

            <?php if (((($tmp = @$_smarty_tpl->tpl_vars['actPage']->value['regions'])===null||$tmp==='' ? false : $tmp)&&(($tmp = @$_smarty_tpl->tpl_vars['regions']->value)===null||$tmp==='' ? false : $tmp))||((($tmp = @$_smarty_tpl->tpl_vars['actPage']->value['citys'])===null||$tmp==='' ? false : $tmp)&&(($tmp = @$_smarty_tpl->tpl_vars['regions']->value)===null||$tmp==='' ? false : $tmp))){?>
                <?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
            <?php }?>
            <li class="<?php if (($_smarty_tpl->tpl_vars['i']->value%2)){?>even<?php }else{ ?>odd<?php }?>">
                <a class="withIcon" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&amp;action=sections");?>
"><?php echo @FORM_SECTIONS_HEAD;?>
</a>
                <a class="icon" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=rss&amp;action=vacancy");?>
"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/sideBarMenuRss.png" alt="RSS"></a>
            </li>

			<?php if (((($tmp = @$_smarty_tpl->tpl_vars['actPage']->value['sections'])===null||$tmp==='' ? false : $tmp)&&(($tmp = @$_smarty_tpl->tpl_vars['sections']->value)===null||$tmp==='' ? false : $tmp))||((($tmp = @$_smarty_tpl->tpl_vars['actPage']->value['professions'])===null||$tmp==='' ? false : $tmp)&&(($tmp = @$_smarty_tpl->tpl_vars['sections']->value)===null||$tmp==='' ? false : $tmp))){?>
                <?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                <li class="CategoriesLists">
                <table cellpadding="0" cellspacing="0">
					<?php  $_smarty_tpl->tpl_vars["section"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["section"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sections']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["section"]->key => $_smarty_tpl->tpl_vars["section"]->value){
$_smarty_tpl->tpl_vars["section"]->_loop = true;
?>
						<tr>
							<td><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&amp;action=sections&amp;id=".($_smarty_tpl->tpl_vars['section']->value['tId']));?>
"><?php echo $_smarty_tpl->tpl_vars['section']->value['name'];?>
</a>&nbsp;</td>
							<td class="counter">&nbsp;[<strong><?php echo $_smarty_tpl->tpl_vars['section']->value['cnt_vacancy'];?>
</strong>]</td>
							<td>&nbsp;<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=rss&amp;action=vacancy&amp;subaction=section&amp;id=".($_smarty_tpl->tpl_vars['section']->value['tId']));?>
"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/sideBarMenuRss10.png" alt="RSS"></a></td>
						</tr>
					<?php } ?>
				</table><br>
                </li>
			<?php }?>
            <?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
            <li class="<?php if (($_smarty_tpl->tpl_vars['i']->value%2)){?>even<?php }else{ ?>odd<?php }?>">
                <a class="withIcon" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&amp;action=regions");?>
"><?php echo @FORM_REGIONS_HEAD;?>
</a>
                <a class="icon" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=rss&amp;action=vacancy");?>
"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/sideBarMenuRss.png" alt="RSS"></a>
            </li>
			<?php if (((($tmp = @$_smarty_tpl->tpl_vars['actPage']->value['regions'])===null||$tmp==='' ? false : $tmp)&&(($tmp = @$_smarty_tpl->tpl_vars['regions']->value)===null||$tmp==='' ? false : $tmp))||((($tmp = @$_smarty_tpl->tpl_vars['actPage']->value['citys'])===null||$tmp==='' ? false : $tmp)&&(($tmp = @$_smarty_tpl->tpl_vars['regions']->value)===null||$tmp==='' ? false : $tmp))){?>
                <li class="CategoriesLists">
                <table cellpadding="0" cellspacing="0" style="width:223px;">
					<?php  $_smarty_tpl->tpl_vars["region"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["region"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['regions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["region"]->key => $_smarty_tpl->tpl_vars["region"]->value){
$_smarty_tpl->tpl_vars["region"]->_loop = true;
?>
						<tr>
							<td><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&amp;action=regions&amp;id=".($_smarty_tpl->tpl_vars['region']->value['tId']));?>
"><?php echo $_smarty_tpl->tpl_vars['region']->value['name'];?>
</a>&nbsp;</td>
							<td class="counter">&nbsp;[<strong><?php echo $_smarty_tpl->tpl_vars['region']->value['cnt_vacancy'];?>
</strong>]</td>
							<td>&nbsp;<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=rss&amp;action=vacancy&amp;subaction=region&amp;id=".($_smarty_tpl->tpl_vars['region']->value['tId']));?>
"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/sideBarMenuRss10.png" alt="RSS"></a></td>
						</tr>
					<?php } ?>
				</table>
                </li>
			<?php }?>
        </ul>
    </div><?php }} ?>