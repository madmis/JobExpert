<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:07
         compiled from "templates/site/default\block.announces.hot.tpl" */ ?>
<?php /*%%SmartyHeaderCode:63344faa4897b86005-15819982%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17e0325077d970d9748d4706d81812824017d42a' => 
    array (
      0 => 'templates/site/default\\block.announces.hot.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '63344faa4897b86005-15819982',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'hot' => 0,
    'menu' => 0,
    'actPage' => 0,
    'vacancy' => 0,
    'sections' => 0,
    'regions' => 0,
    'chpu' => 0,
    'cntRecords' => 0,
    'resume' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa4897e7f7c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa4897e7f7c')) {function content_4faa4897e7f7c($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'I:\\home\\Smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_modifier_truncate')) include 'I:\\home\\Smarty\\plugins\\modifier.truncate.php';
?><?php if ($_smarty_tpl->tpl_vars['hot']->value['vacancy']&&'vacancy'!=$_smarty_tpl->tpl_vars['menu']->value&&'hot'!=$_smarty_tpl->tpl_vars['actPage']->value){?>
	<div class="DesignLeftSideBarBlockWrapperB" style="padding:0px 9px 35px 2px;">
		<h3 class="sideBlockHeader" id="hotVacancys" style="margin-left: 4px;"><?php echo @SITE_HOT_VACANCYS;?>
</h3>
		<div class="DesignMainPageBody">
			<?php  $_smarty_tpl->tpl_vars["vacancy"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["vacancy"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hot']->value['vacancy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["vacancy"]->key => $_smarty_tpl->tpl_vars["vacancy"]->value){
$_smarty_tpl->tpl_vars["vacancy"]->_loop = true;
?>
        		<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vacancy']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo @FORM_TYPE_COMPANY;?>
 - <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vacancy']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sections']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_section']]['name'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['regions']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_region']]['name'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['vacancy']->value['act_datetime'],@CONF_DATE_FORMAT);?>
 - <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['vacancy']->value['token_datetime'],@CONF_DATE_FORMAT);?>
, <?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_from'];?>
<?php if ($_smarty_tpl->tpl_vars['vacancy']->value['pay_post']){?>-<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_post'];?>
<?php }?> <?php echo $_smarty_tpl->tpl_vars['vacancy']->value['currency'];?>
">
					<tr>
						<th><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&amp;action=view&amp;id=".($_smarty_tpl->tpl_vars['vacancy']->value['tId']));?>
" style="display:block;" class="light"><?php echo smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->tpl_vars['vacancy']->value['title'], ENT_QUOTES, 'UTF-8', true),55,'...');?>
</a></th>
			        </tr>
			        <tr>
		        		<td class="last">
		            		<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['regions']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_region']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<br>
			                <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['vacancy']->value['act_datetime'],@CONF_DATE_FORMAT);?>
<br>
			                <strong><?php if ($_smarty_tpl->tpl_vars['vacancy']->value['pay_post']){?><?php echo @SITE_FROM;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_from'];?>
&nbsp;<?php echo @SITE_UNTO;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_post'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_from'];?>
<?php }?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['currency'];?>
</strong>
			            </td>
			        </tr>
				</table>
			<?php } ?>
			<?php if ($_smarty_tpl->tpl_vars['cntRecords']->value['hot']['vacancy']>@CONF_VACANCY_HOT_SHOW_PERPAGE){?>
				<div class="AlignRight">
					<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&amp;action=hot");?>
"><?php echo @SITE_ALL;?>
 <?php echo @SITE_HOT_VACANCYS;?>
...</a>
				</div>
			<?php }?>
	    </div>
    </div>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['hot']->value['resume']&&'resume'!=$_smarty_tpl->tpl_vars['menu']->value&&'hot'!=$_smarty_tpl->tpl_vars['actPage']->value){?>
	<div class="DesignLeftSideBarBlockWrapperB" style="padding:0px 9px 35px 2px;">
		<h3 class="sideBlockHeader" id="hotResumes" style="margin-left: 4px;"><?php echo @SITE_HOT_RESUMES;?>
</h3>
		<div class="DesignMainPageBody">
			<?php  $_smarty_tpl->tpl_vars["resume"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["resume"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hot']->value['resume']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["resume"]->key => $_smarty_tpl->tpl_vars["resume"]->value){
$_smarty_tpl->tpl_vars["resume"]->_loop = true;
?>
				<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['resume']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sections']->value[$_smarty_tpl->tpl_vars['resume']->value['id_section']]['name'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['regions']->value[$_smarty_tpl->tpl_vars['resume']->value['id_region']]['name'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['resume']->value['act_datetime'],@CONF_DATE_FORMAT);?>
 - <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['resume']->value['token_datetime'],@CONF_DATE_FORMAT);?>
, <?php echo $_smarty_tpl->tpl_vars['resume']->value['pay_from'];?>
 <?php echo $_smarty_tpl->tpl_vars['resume']->value['currency'];?>
">
					<tr>
	                	<th><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=resume&amp;action=view&amp;id=".($_smarty_tpl->tpl_vars['resume']->value['tId']));?>
" style="display:block;" class="light"><?php echo smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->tpl_vars['resume']->value['title'], ENT_QUOTES, 'UTF-8', true),55,'...');?>
</a></th>
	                </tr>
	                <tr>
	                	<td class="last">
	                    	<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['regions']->value[$_smarty_tpl->tpl_vars['resume']->value['id_region']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<br>
	                        <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['resume']->value['act_datetime'],@CONF_DATE_FORMAT);?>
<br>
	                        <strong><?php echo $_smarty_tpl->tpl_vars['resume']->value['pay_from'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['resume']->value['currency'];?>
</strong>
	                    </td>
	                </tr>
	        	</table>
			<?php } ?>
			<?php if ($_smarty_tpl->tpl_vars['cntRecords']->value['hot']['resume']>@CONF_RESUME_HOT_SHOW_PERPAGE){?>
				<div class="AlignRight">
					<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=resume&amp;action=hot");?>
"><?php echo @SITE_ALL;?>
 <?php echo @SITE_HOT_RESUMES;?>
...</a>
				</div>
			<?php }?>
	    </div>
    </div>
<?php }?><?php }} ?>