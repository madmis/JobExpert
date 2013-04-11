<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:05
         compiled from "templates/site/default\block.main.announces.vip.tpl" */ ?>
<?php /*%%SmartyHeaderCode:156814faa4895e1c824-30916242%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c320a75a318279c6baf11a65e0b043bd06f4c8e2' => 
    array (
      0 => 'templates/site/default\\block.main.announces.vip.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '156814faa4895e1c824-30916242',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'vip' => 0,
    'vacancy' => 0,
    'chpu' => 0,
    'sections' => 0,
    'professions' => 0,
    'regions' => 0,
    'citys' => 0,
    'arrSysDict' => 0,
    'cntRecords' => 0,
    'resume' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa4896bcb1e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa4896bcb1e')) {function content_4faa4896bcb1e($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'I:\\home\\Smarty\\plugins\\modifier.truncate.php';
if (!is_callable('smarty_modifier_date_format')) include 'I:\\home\\Smarty\\plugins\\modifier.date_format.php';
?><?php if (@CONF_VACANCY_VIP_SHOW&&$_smarty_tpl->tpl_vars['vip']->value['vacancy']){?>
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th colspan="3"><?php echo @SITE_VIP_VACANCYS;?>
</th>
				<th class="VRRegion"><?php echo @SITE_CITY;?>
</th>
				<th class="VRDate"><?php echo @FORM_DATE;?>
</th>
				<th class="VRPayFrom"><?php echo @SITE_SALARY;?>
</th>
			</tr>
			<?php  $_smarty_tpl->tpl_vars["vacancy"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["vacancy"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vip']->value['vacancy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["vacancy"]->key => $_smarty_tpl->tpl_vars["vacancy"]->value){
$_smarty_tpl->tpl_vars["vacancy"]->_loop = true;
?>
				<tr class="tr_hover showVIP" title="<?php echo @SITE_VIP_VACANCY;?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vacancy']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vacancy']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
">
					<td class="VRIcon"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/mainBodyTableVRIcon.gif" alt=""></td>
					<td class="VRIcon"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/arrInCirclceDown.png" alt=""></td>
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
"><?php echo smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->tpl_vars['vacancy']->value['title'], ENT_QUOTES, 'UTF-8', true),180);?>
</a>
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
				<tr style="display: none;">
					<td class="last" colspan="6">
						<table style="width: 100%;">
							<?php if ($_smarty_tpl->tpl_vars['vacancy']->value['vip']||$_smarty_tpl->tpl_vars['vacancy']->value['hot']){?>
								<tr>
									<td colspan="2" class="noBorderRight AlignLeft" valign="top">
										<div class="paddingText5">
											<?php if ($_smarty_tpl->tpl_vars['vacancy']->value['vip']){?><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/services/vip.png" style="padding: 0px 10px;" alt="VIP" title="VIP"><?php }?>
											<?php if ($_smarty_tpl->tpl_vars['vacancy']->value['hot']){?><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/services/hot.png" style="padding: 0px 10px;" alt="HOT" title="HOT"><?php }?>
										</div>
									</td>
								</tr>
							<?php }?>
							<tr class="noBorderBottom">
								<td class="noBorderRight AlignLeft" valign="top">
									<div class="paddingTextWBottom5">
										<strong class="Header"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['vacancy']->value['act_datetime'],@CONF_DATE_FORMAT);?>
&nbsp;<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['vacancy']->value['act_datetime'],@CONF_TIME_FORMAT);?>
</strong>
										<table class="paddingTextWBottom5">
											<tr><td><strong><?php echo @ANNOUNCE_SELECT_REGION;?>
:</strong></td><td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['regions']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_region']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php if ($_smarty_tpl->tpl_vars['vacancy']->value['id_city']){?>&nbsp;/&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['citys']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_city']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?></td></tr>
											<tr><td><strong><?php echo @ANNOUNCE_SELECT_SECTION;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['sections']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_section']]['name'];?>
&nbsp;/&nbsp;<?php echo $_smarty_tpl->tpl_vars['professions']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_profession']]['name'];?>
</td></tr>
										</table>
										<table class="paddingTextWBottom5">
											<tr><td>
												<strong><?php echo @ANNOUNCE_CONTACTS_COMPANY_NAME;?>
:</strong><br>
												<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['company_name'];?>
<br><br>
												<strong><?php echo @ANNOUNCE_CONTACTS_FIO;?>
:</strong><br>
												<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['contacts_fio'];?>

											</td></tr>
										</table>
									</div>
								</td>
								<td class="noBorderLeft AlignRight" valign="top">
									<div class="paddingText5">
										<div class="InfoBlockWrapper">
											<div class="withoutHeader"></div>
											<div class="InfoBlock"><div>
												<table>
													<tr><td style="width:150px;"><strong><?php echo @ANNOUNCE_PAY_HEAD;?>
:</strong></td><td><?php if ($_smarty_tpl->tpl_vars['vacancy']->value['pay_post']){?><?php echo @SITE_FROM;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_from'];?>
&nbsp;<?php echo @SITE_UNTO;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_post'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_from'];?>
<?php }?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['currency'];?>
</td></tr>
													<tr><td><strong><?php echo @ANNOUNCE_SELECT_CHARTWORK;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['vacancy']->value['chart_work'];?>
</td></tr>
													<tr><td><strong><?php echo @ANNOUNCE_SELECT_EDUCATION;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['vacancy']->value['edu_work'];?>
</td></tr>
													<tr><td><strong><?php echo @ANNOUNCE_SELECT_EXPIREWORK;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['vacancy']->value['expire_work'];?>
</td></tr>
													<tr><td><strong><?php echo @ANNOUNCE_SELECT_GENDER;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['arrSysDict']->value['Gender']['values'][$_smarty_tpl->tpl_vars['vacancy']->value['gender']];?>
</td></tr>
													<?php if ($_smarty_tpl->tpl_vars['vacancy']->value['age_from']||$_smarty_tpl->tpl_vars['vacancy']->value['age_post']){?>
														<tr><td><strong><?php echo @ANNOUNCE_AGE;?>
:</strong></td><td><?php if ($_smarty_tpl->tpl_vars['vacancy']->value['age_from']){?><?php echo @SITE_FROM;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['age_from'];?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['vacancy']->value['age_post']){?>&nbsp;<?php echo @SITE_UNTO;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['age_post'];?>
<?php }?></td></tr>
													<?php }?>
												</table>
											</div></div>
										</div>
									</div>
								</td>
							</tr>
							<tr class="noBorderTop noBorderBottom">
								<td colspan="2"class="AlignLeft">
									<div class="paddingTextBoth5">
										<table class="paddingTextBoth5">
											<tr><td>
												<strong><?php echo @ANNOUNCE_COMPANY_DISCRIPTION;?>
:</strong><br>
												<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['company_discription'];?>
<br><br>
												<strong><?php echo @ANNOUNCE_TEXTAREA_DUTESWORK;?>
:</strong><br>
												<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['duties_work'];?>

											</td></tr>
										</table>
									</div>
								</td>
							</tr>
							<tr class="noBorderTop">
								<td class="noBorderRight" valign="bottom" style="text-align:left;">
									<div class="submitButtonLight paddingText5">
										<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&action=view&id=".($_smarty_tpl->tpl_vars['vacancy']->value['tId']));?>
" class="submitButton"><?php echo @FORM_LOOK_AT;?>
...</a>
									</div>
								</td>
								<td class="noBorderLeft" style="text-align:right;">
									<div style="margin:10px 0px;">
										<?php if (!$_smarty_tpl->tpl_vars['vacancy']->value['vip']){?><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&action=setVIP&id=".($_smarty_tpl->tpl_vars['vacancy']->value['id']));?>
"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/services/setVIP.png" style="padding: 0px 10px;" alt="<?php echo @ANNOUNCE_SET_STATUS;?>
" title="<?php echo @ANNOUNCE_SET_STATUS;?>
: <?php echo @ANNOUNCE_SET_STATUS_VIP_VACANCY;?>
"></a><?php }?>
										<?php if (!$_smarty_tpl->tpl_vars['vacancy']->value['hot']){?><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&action=setHOT&id=".($_smarty_tpl->tpl_vars['vacancy']->value['id']));?>
"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/services/setHOT.png" style="padding: 0px 10px;" alt="<?php echo @ANNOUNCE_SET_STATUS;?>
" title="<?php echo @ANNOUNCE_SET_STATUS;?>
: <?php echo @ANNOUNCE_SET_STATUS_HOT_VACANCY;?>
"></a><?php }?>
										<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&action=setRate&id=".($_smarty_tpl->tpl_vars['vacancy']->value['id']));?>
"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/services/setRate.png" style="padding: 0px 10px;" alt="<?php echo @ANNOUNCE_SET_STATUS_RATE_VACANCY;?>
" title="<?php echo @ANNOUNCE_SET_STATUS_RATE_VACANCY;?>
"></a>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<?php } ?>
			<?php if ($_smarty_tpl->tpl_vars['cntRecords']->value['vip']['vacancy']>@CONF_VACANCY_VIP_SHOW_PERPAGE){?>
				<tr>
					<td class="last AlignRight" colspan="6">
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&amp;action=vip");?>
" title="<?php echo @SITE_VIP_VACANCYS;?>
"><?php echo @SITE_ALL;?>
 <?php echo @SITE_VIP_VACANCYS;?>
...</a>
					</td>
				</tr>
			<?php }?>
		</table>
	</div>
<?php }?>
<?php if (@CONF_RESUME_VIP_SHOW&&$_smarty_tpl->tpl_vars['vip']->value['resume']){?>
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th colspan="3"><?php echo @SITE_VIP_RESUMES;?>
</th>
				<th class="VRRegion"><?php echo @SITE_CITY;?>
</th>
				<th class="VRDate"><?php echo @FORM_DATE;?>
</th>
				<th class="VRPayFrom"><?php echo @SITE_SALARY;?>
</th>
			</tr>
			<?php  $_smarty_tpl->tpl_vars["resume"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["resume"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vip']->value['resume']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["resume"]->key => $_smarty_tpl->tpl_vars["resume"]->value){
$_smarty_tpl->tpl_vars["resume"]->_loop = true;
?>
				<tr class="tr_hover showVIP" title="<?php echo @SITE_VIP_RESUMES;?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sections']->value[$_smarty_tpl->tpl_vars['resume']->value['id_section']]['name'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['resume']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
">
					<td class="VRIcon"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/mainBodyTableVRIcon.gif" alt=""></td>
					<td class="VRIcon"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/arrInCirclceDown.png" alt=""></td>
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
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['resume']->value['title'],80);?>
</a>
					</td>
					<td class="VRRegion"><?php if ($_smarty_tpl->tpl_vars['resume']->value['id_city']){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['citys']->value[$_smarty_tpl->tpl_vars['resume']->value['id_city']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?>&nbsp;<?php }?></td>
					<td class="VRDate"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['resume']->value['act_datetime'],@CONF_DATE_FORMAT);?>
</td>
					<td class="last VRSallary"><?php echo $_smarty_tpl->tpl_vars['resume']->value['pay_from'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['resume']->value['currency'];?>
</td>
				</tr>
				<tr style="display: none;">
					<td class="last" colspan="6">
						<table style="width: 100%;">
							<?php if ($_smarty_tpl->tpl_vars['resume']->value['vip']||$_smarty_tpl->tpl_vars['resume']->value['hot']){?>
								<tr>
									<td colspan="2" class="noBorderRight AlignLeft" valign="top">
										<div class="paddingText5">
											<?php if ($_smarty_tpl->tpl_vars['resume']->value['vip']){?><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/services/vip.png" style="padding: 0px 10px;" alt="VIP" title="VIP"><?php }?>
											<?php if ($_smarty_tpl->tpl_vars['resume']->value['hot']){?><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/services/hot.png" style="padding: 0px 10px;" alt="HOT" title="HOT"><?php }?>
										</div>
									</td>
								</tr>
							<?php }?>
							<tr class="noBorderBottom">
								<td class="noBorderRight AlignLeft" valign="top">
									<div class="paddingText5">
										<strong class="Header"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['resume']->value['act_datetime'],@CONF_DATE_FORMAT);?>
&nbsp;<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['resume']->value['act_datetime'],@CONF_TIME_FORMAT);?>
</strong>
										<table class="paddingText5">
											<tr><td><strong><?php echo @ANNOUNCE_SELECT_REGION;?>
:</strong></td><td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['regions']->value[$_smarty_tpl->tpl_vars['resume']->value['id_region']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php if ($_smarty_tpl->tpl_vars['resume']->value['id_city']){?>&nbsp;/&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['citys']->value[$_smarty_tpl->tpl_vars['resume']->value['id_city']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?></td></tr>
											<tr><td><strong><?php echo @ANNOUNCE_SELECT_SECTION;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['sections']->value[$_smarty_tpl->tpl_vars['resume']->value['id_section']]['name'];?>
</td></tr>
										</table>
										<strong class="Header"><?php echo @ANNOUNCE_CONTACTS_PERSON;?>
:</strong>
										<table class="paddingTextWBottom5">
											<tr><td><strong><?php echo @ANNOUNCE_CONTACTS_LASTNAME;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['resume']->value['last_name'];?>
</td></tr>
											<tr><td><strong><?php echo @ANNOUNCE_CONTACTS_FIRSTNAME;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['resume']->value['first_name'];?>
</td></tr>
											<tr><td><strong><?php echo @ANNOUNCE_CONTACTS_MIDDLENAME;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['resume']->value['middle_name'];?>
</td></tr>
										</table>
									</div>
								</td>
								<td class="noBorderLeft AlignRight" valign="top">
									<div class="paddingText5">
										<div class="InfoBlockWrapper">
											<div class="withoutHeader"></div>
											<div class="InfoBlock"><div>
												<table>
													<tr><td style="width:150px;"><strong><?php echo @ANNOUNCE_PAY_HEAD;?>
:</strong></td><td><?php echo @SITE_FROM;?>
 <?php echo $_smarty_tpl->tpl_vars['resume']->value['pay_from'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['resume']->value['currency'];?>
</td></tr>
													<tr><td><strong><?php echo @ANNOUNCE_SELECT_CHARTWORK;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['resume']->value['chart_work'];?>
</td></tr>
													<tr><td><strong><?php echo @ANNOUNCE_SELECT_EDUCATION;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['resume']->value['education'];?>
</td></tr>
													<tr><td><strong><?php echo @ANNOUNCE_SELECT_EXPIREWORK;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['resume']->value['expire_work'];?>
</td></tr>
													<tr><td><strong><?php echo @ANNOUNCE_SELECT_GENDER;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['arrSysDict']->value['Gender']['values'][$_smarty_tpl->tpl_vars['resume']->value['gender']];?>
</td></tr>
													<tr><td><strong><?php echo @ANNOUNCE_AGE;?>
:</strong></td><td><?php echo $_smarty_tpl->tpl_vars['resume']->value['age'];?>
</td></tr>
												</table>
											</div></div>
										</div>
									</div>
								</td>
							</tr>
							<?php if ($_smarty_tpl->tpl_vars['resume']->value['about_info']){?>
								<tr class="noBorderTop noBorderBottom">
									<td colspan="2"class="AlignLeft">
										<div class="paddingText5" style="margin-top:0px;">
											<strong class="Header"><?php echo @ANNOUNCE_TEXTAREA_ABOUTINFO;?>
:</strong>
											<div class="paddingText5">
												<?php echo $_smarty_tpl->tpl_vars['resume']->value['about_info'];?>

											</div>
										</div>
									</td>
								</tr>
							<?php }?>
							<tr class="noBorderTop">
								<td class="noBorderRight" valign="bottom" style="text-align:left;">
									<div class="submitButtonLight paddingText5">
										<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=resume&amp;action=view&amp;id=".($_smarty_tpl->tpl_vars['resume']->value['tId']));?>
" class="submitButton"><?php echo @FORM_LOOK_AT;?>
...</a>
									</div>
								</td>
								<td class="noBorderLeft" style="text-align:right;">
									<div style="margin:10px 0px;">
										<?php if (!$_smarty_tpl->tpl_vars['resume']->value['vip']){?><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=resume&amp;action=setVIP&amp;id=".($_smarty_tpl->tpl_vars['resume']->value['id']));?>
"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/services/setVIP.png" style="padding: 0px 10px;" alt="<?php echo @ANNOUNCE_SET_STATUS;?>
" title="<?php echo @ANNOUNCE_SET_STATUS;?>
: <?php echo @ANNOUNCE_SET_STATUS_VIP_RESUME;?>
"></a><?php }?>
										<?php if (!$_smarty_tpl->tpl_vars['resume']->value['hot']){?><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=resume&amp;action=setHOT&amp;id=".($_smarty_tpl->tpl_vars['resume']->value['id']));?>
"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/services/setHOT.png" style="padding: 0px 10px;" alt="<?php echo @ANNOUNCE_SET_STATUS;?>
" title="<?php echo @ANNOUNCE_SET_STATUS;?>
: <?php echo @ANNOUNCE_SET_STATUS_HOT_RESUME;?>
"></a><?php }?>
										<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=resume&amp;action=setRate&amp;id=".($_smarty_tpl->tpl_vars['resume']->value['id']));?>
"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/services/setRate.png" style="padding: 0px 10px;" alt="<?php echo @ANNOUNCE_SET_STATUS_RATE_RESUME;?>
" title="<?php echo @ANNOUNCE_SET_STATUS_RATE_RESUME;?>
"></a>
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<?php } ?>
			<?php if ($_smarty_tpl->tpl_vars['cntRecords']->value['vip']['resume']>@CONF_RESUME_VIP_SHOW_PERPAGE){?>
				<tr>
					<td class="last AlignRight" colspan="6">
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=resume&amp;action=vip");?>
" title="<?php echo @SITE_VIP_RESUMES;?>
"><?php echo @SITE_ALL;?>
 <?php echo @SITE_VIP_RESUMES;?>
...</a>
					</td>
				</tr>
			<?php }?>
		</table>
	</div>
<?php }?>
<script type="text/javascript">
<!--
	$(document).ready(function() {
		function showVIP() {
			$(this).next().toggle();
		}
		$('.showVIP').bind('click', showVIP);
		$('.showVIP').find('a').hover(function () {
			$('.showVIP').unbind('click', showVIP);
		}, function () {
			$('.showVIP').bind('click', showVIP);
		});
	});
-->
</script><?php }} ?>