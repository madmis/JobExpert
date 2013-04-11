<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:07
         compiled from "templates/site/default\block.main.announces.last.tpl" */ ?>
<?php /*%%SmartyHeaderCode:130124faa48970ae2a8-36893037%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89738d74d6101af4c09e1415ec7db1fd56779e4d' => 
    array (
      0 => 'templates/site/default\\block.main.announces.last.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '130124faa48970ae2a8-36893037',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last' => 0,
    'vacancy' => 0,
    'chpu' => 0,
    'sections' => 0,
    'professions' => 0,
    'regions' => 0,
    'citys' => 0,
    'resume' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa489754270',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa489754270')) {function content_4faa489754270($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'I:\\home\\Smarty\\plugins\\modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) include 'I:\\home\\Smarty\\plugins\\modifier.date_format.php';
?><?php if (@CONF_VACANCY_LAST_SHOW&&$_smarty_tpl->tpl_vars['last']->value['vacancy']){?>
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th colspan="2"><?php echo @SITE_BLOCK_LAST_VACANCYS;?>
</th>
				<th class="VRRegion"><?php echo @SITE_CITY;?>
</th>
				<th class="VRDate"><?php echo @FORM_DATE;?>
</th>
				<th class="VRSallary"><?php echo @SITE_SALARY;?>
</th>
			</tr>
			<?php  $_smarty_tpl->tpl_vars["vacancy"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["vacancy"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last']->value['vacancy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["vacancy"]->key => $_smarty_tpl->tpl_vars["vacancy"]->value){
$_smarty_tpl->tpl_vars["vacancy"]->_loop = true;
?>
				<tr class="tr_hover openLink" title="<?php echo @SITE_BLOCK_LAST_VACANCYS;?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vacancy']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vacancy']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
">
					<td class="VRIcon"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/mainBodyTableVRIcon.gif" alt=""></td>
					<td class="VRDescr">
						<strong><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['vacancy']->value['company_name'],80);?>
</strong><br>
						<a style="text-decoration: none;" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&amp;action=view&amp;id=".($_smarty_tpl->tpl_vars['vacancy']->value['tId']));?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vacancy']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo @FORM_TYPE_COMPANY;?>
 - <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vacancy']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sections']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_section']]['name'], ENT_QUOTES, 'UTF-8', true);?>
 - <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['professions']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_profession']]['name'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['regions']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_region']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php if ($_smarty_tpl->tpl_vars['vacancy']->value['id_city']){?> - <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['citys']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_city']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>, <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['vacancy']->value['act_datetime'],@CONF_DATE_FORMAT);?>
 - <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['vacancy']->value['token_datetime'],@CONF_DATE_FORMAT);?>
, <?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_from'];?>
<?php if ($_smarty_tpl->tpl_vars['vacancy']->value['pay_post']){?>-<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_post'];?>
<?php }?> <?php echo $_smarty_tpl->tpl_vars['vacancy']->value['currency'];?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['vacancy']->value['title'],180);?>
</a>
						<input type="hidden" class="gotoLink" value="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&amp;action=view&amp;id=".($_smarty_tpl->tpl_vars['vacancy']->value['tId']));?>
">
					</td>
					<td class="VRRegion"><?php if ($_smarty_tpl->tpl_vars['vacancy']->value['id_city']){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['citys']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_city']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?>&nbsp;<?php }?></td>
					<td class="VRDate"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['vacancy']->value['act_datetime'],@CONF_DATE_FORMAT);?>
</td>
					<td class="last VRSallary"><?php if ($_smarty_tpl->tpl_vars['vacancy']->value['pay_post']){?><?php echo @SITE_FROM;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_from'];?>
&nbsp;<?php echo @SITE_UNTO;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_post'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_from'];?>
<?php }?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['currency'];?>
</td>
				</tr>
			<?php } ?>
			<tr>
				<td class="last AlignRight" colspan="5">
					<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy");?>
" title="<?php echo @SITE_BLOCK_LAST_VACANCYS;?>
"><?php echo @SITE_ALL;?>
 <?php echo @SITE_VACANCY;?>
...</a>
				</td>
			</tr>
		</table>
	</div>
<?php }?>
<?php if (@CONF_RESUME_LAST_SHOW&&$_smarty_tpl->tpl_vars['last']->value['resume']){?>
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th colspan="2"><?php echo @SITE_BLOCK_LAST_RESUMES;?>
</th>
				<th class="VRRegion"><?php echo @SITE_CITY;?>
</th>
				<th class="VRDate"><?php echo @FORM_DATE;?>
</th>
				<th class="VRSallary"><?php echo @SITE_SALARY;?>
</th>
			</tr>
			<?php  $_smarty_tpl->tpl_vars["resume"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["resume"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last']->value['resume']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["resume"]->key => $_smarty_tpl->tpl_vars["resume"]->value){
$_smarty_tpl->tpl_vars["resume"]->_loop = true;
?>
				<tr class="tr_hover openLink" title="<?php echo @SITE_BLOCK_LAST_RESUMES;?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sections']->value[$_smarty_tpl->tpl_vars['resume']->value['id_section']]['name'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['resume']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
">
					<td class="VRIcon"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/mainBodyTableVRIcon.gif"></td>
					<td class="VRDescr">
						<strong><?php echo $_smarty_tpl->tpl_vars['sections']->value[$_smarty_tpl->tpl_vars['resume']->value['id_section']]['name'];?>
</strong><br>
						<a style="text-decoration: none" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=resume&amp;action=view&amp;id=".($_smarty_tpl->tpl_vars['resume']->value['tId']));?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['resume']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sections']->value[$_smarty_tpl->tpl_vars['resume']->value['id_section']]['name'], ENT_QUOTES, 'UTF-8', true);?>
 - <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['professions']->value[$_smarty_tpl->tpl_vars['resume']->value['id_profession']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php if ($_smarty_tpl->tpl_vars['resume']->value['id_profession_1']){?> / <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['professions']->value[$_smarty_tpl->tpl_vars['resume']->value['id_profession_1']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['resume']->value['id_profession_2']){?> / <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['professions']->value[$_smarty_tpl->tpl_vars['resume']->value['id_profession_2']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['regions']->value[$_smarty_tpl->tpl_vars['resume']->value['id_region']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php if ($_smarty_tpl->tpl_vars['resume']->value['id_city']){?> - <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['citys']->value[$_smarty_tpl->tpl_vars['resume']->value['id_city']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>, <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['resume']->value['act_datetime'],@CONF_DATE_FORMAT);?>
 - <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['resume']->value['token_datetime'],@CONF_DATE_FORMAT);?>
, <?php echo $_smarty_tpl->tpl_vars['resume']->value['pay_from'];?>
 <?php echo $_smarty_tpl->tpl_vars['resume']->value['currency'];?>
"><?php echo smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->tpl_vars['resume']->value['title'], ENT_QUOTES, 'UTF-8', true),80);?>
</a>
						<input type="hidden" class="gotoLink" value="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=resume&amp;action=view&amp;id=".($_smarty_tpl->tpl_vars['resume']->value['tId']));?>
">
					</td>
					<td><?php if ($_smarty_tpl->tpl_vars['resume']->value['id_city']){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['citys']->value[$_smarty_tpl->tpl_vars['resume']->value['id_city']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?>&nbsp;<?php }?></td>
					<td class="VRDate"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['resume']->value['act_datetime'],@CONF_DATE_FORMAT);?>
</td>
					<td class="last VRSallary"><?php echo $_smarty_tpl->tpl_vars['resume']->value['pay_from'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['resume']->value['currency'];?>
</td>
				</tr>
			<?php } ?>
			<tr>
				<td class="last AlignRight" colspan="5">
					<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=resume");?>
" title="<?php echo @SITE_BLOCK_LAST_RESUMES;?>
"><?php echo @SITE_ALL;?>
 <?php echo @SITE_RESUME;?>
...</a>
				</td>
			</tr>
		</table>
	</div>
<?php }?><?php }} ?>