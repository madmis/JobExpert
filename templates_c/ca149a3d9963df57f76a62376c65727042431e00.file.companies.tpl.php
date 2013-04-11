<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:52:18
         compiled from "templates/site/default\companies.tpl" */ ?>
<?php /*%%SmartyHeaderCode:167914fb75132d69831-15126777%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca149a3d9963df57f76a62376c65727042431e00' => 
    array (
      0 => 'templates/site/default\\companies.tpl',
      1 => 1336142862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167914fb75132d69831-15126777',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'arrActions' => 0,
    'uData' => 0,
    'arrCompanies' => 0,
    'company' => 0,
    'chpu' => 0,
    'string_page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb751332b559',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb751332b559')) {function content_4fb751332b559($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['errors']->value){?><?php echo $_smarty_tpl->getSubTemplate ("errors.message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>

<div class="DesignMainPageBody">
<?php if ($_smarty_tpl->tpl_vars['arrActions']->value['detail']){?>
	<?php if ($_smarty_tpl->tpl_vars['uData']->value){?>
		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th class="CompanyName"><?php echo $_smarty_tpl->tpl_vars['uData']->value['company_name'];?>
 <?php if ($_smarty_tpl->tpl_vars['uData']->value['company_city']){?>[<?php echo $_smarty_tpl->tpl_vars['uData']->value['company_city'];?>
]<?php }?></th>
			</tr>
			<tr>
            	<td class="last" style="vertical-align: top;">
					<table style="width: 100%;">
                    	<tr>
                        	<td>
								<?php if (!$_smarty_tpl->tpl_vars['uData']->value['hide_additional_company_data']){?>
									<p class="p_2"><strong><?php echo @SITE_USER_LAST_NAME;?>
:</strong>&nbsp;<?php echo $_smarty_tpl->tpl_vars['uData']->value['last_name'];?>
</p>
									<p class="p_2"><strong><?php echo @SITE_USER_FIRST_NAME;?>
:</strong>&nbsp;<?php echo $_smarty_tpl->tpl_vars['uData']->value['first_name'];?>
</p>
									<?php if ($_smarty_tpl->tpl_vars['uData']->value['middle_name']){?><p class="p_2"><strong><?php echo @SITE_USER_MIDDLE_NAME;?>
:</strong>&nbsp;<?php echo $_smarty_tpl->tpl_vars['uData']->value['middle_name'];?>
</p><?php }?>
									<p class="p_2"><strong><?php echo @SITE_USER_PHONE;?>
:</strong>&nbsp;<?php echo $_smarty_tpl->tpl_vars['uData']->value['phone'];?>
</p>
									<?php if ($_smarty_tpl->tpl_vars['uData']->value['addition_phone_1']){?><p class="p_2"><strong><?php echo @SITE_USER_ADDITIONAL_PHONE;?>
:</strong>&nbsp;<?php echo $_smarty_tpl->tpl_vars['uData']->value['addition_phone_1'];?>
</p><?php }?>
									<?php if ($_smarty_tpl->tpl_vars['uData']->value['addition_phone_2']){?><p class="p_2"><strong><?php echo @SITE_USER_ADDITIONAL_PHONE;?>
:</strong>&nbsp;<?php echo $_smarty_tpl->tpl_vars['uData']->value['addition_phone_2'];?>
</p><?php }?>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['uData']->value['company_url']){?>
                                    <?php if (@CONF_USE_REDIRECT_EXTERNAL_LINK){?>
                                        <p class="p_2">
                                            <strong><?php echo @FORM_COMPANY_URL;?>
:</strong>&nbsp;
                                            <a href="<?php echo @CONF_SCRIPT_URL;?>
index.php?redirect=<?php echo $_smarty_tpl->tpl_vars['uData']->value['company_url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['uData']->value['company_url'];?>
</a>
                                        </p>
                                    <?php }else{ ?>
                                        <p class="p_2">
                                            <strong><?php echo @FORM_COMPANY_URL;?>
:</strong>&nbsp;
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['uData']->value['company_url'];?>
" rel="nofollow" target="_blank"><?php echo $_smarty_tpl->tpl_vars['uData']->value['company_url'];?>
</a>
                                        </p>
                                    <?php }?>
                                <?php }?>
							</td>
							<td class="AlignRight">
								<?php if ($_smarty_tpl->tpl_vars['uData']->value['logo']){?>
									<img src="<?php echo @CONF_SCRIPT_URL;?>
uploads/images/logo/thumbs/thumb_<?php echo $_smarty_tpl->tpl_vars['uData']->value['logo'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['uData']->value['company_name'];?>
">
								<?php }else{ ?>
									<img src="<?php echo @CONF_SCRIPT_URL;?>
uploads/images/logo/not_logo.png" alt="<?php echo $_smarty_tpl->tpl_vars['uData']->value['company_name'];?>
">
								<?php }?>
							</td>
						</tr>
					</table>
                </td>
            </tr>
			<tr>
				<td class="last AlignLeft" style="padding: 10px;">
					<?php if (@CONF_USE_VISUAL_EDITOR&&@CONF_COMPANIES_USE_VISUAL_EDITOR){?>
						<?php echo $_smarty_tpl->tpl_vars['uData']->value['company_description'];?>

					<?php }else{ ?>
						<?php echo nl2br($_smarty_tpl->tpl_vars['uData']->value['company_description']);?>

					<?php }?>
				</td>
			</tr>
		</table>
		<?php echo $_smarty_tpl->getSubTemplate ("companies.vacancy.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php }?>
<?php }else{ ?>
	<?php if ($_smarty_tpl->tpl_vars['arrCompanies']->value){?>
		<?php  $_smarty_tpl->tpl_vars['company'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['company']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arrCompanies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['company']->key => $_smarty_tpl->tpl_vars['company']->value){
$_smarty_tpl->tpl_vars['company']->_loop = true;
?>
		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th colspan="2" class="CompanyName">
						<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=companies&amp;action=detail&amp;id=".($_smarty_tpl->tpl_vars['company']->value['tId']));?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
">
							<?php echo $_smarty_tpl->tpl_vars['company']->value['company_name'];?>
 <?php if ($_smarty_tpl->tpl_vars['company']->value['company_city']){?>[<?php echo $_smarty_tpl->tpl_vars['company']->value['company_city'];?>
]<?php }?>
						</a>
				</th>
			</tr>
			<tr>
				<td class="CompanyLogo">
					<br>
					<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=companies&amp;action=detail&amp;id=".($_smarty_tpl->tpl_vars['company']->value['tId']));?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
">
						<?php if ($_smarty_tpl->tpl_vars['company']->value['logo']){?>
							<img src="<?php echo @CONF_SCRIPT_URL;?>
uploads/images/logo/thumbs/thumb_<?php echo $_smarty_tpl->tpl_vars['company']->value['logo'];?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
">
						<?php }else{ ?>
							<img src="<?php echo @CONF_SCRIPT_URL;?>
uploads/images/logo/not_logo.png" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
">
						<?php }?>
					</a>				
				</td>
				<td class="last AlignLeft" style="padding: 10px;">
					<?php if (@CONF_USE_VISUAL_EDITOR&&@CONF_COMPANIES_USE_VISUAL_EDITOR){?>
						<?php echo $_smarty_tpl->tpl_vars['company']->value['company_description'];?>

					<?php }else{ ?>
						<?php echo nl2br($_smarty_tpl->tpl_vars['company']->value['company_description']);?>

					<?php }?>
				</td>
			</tr>
			<tr>
				<td class="last AlignRight" colspan="2">
					<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=companies&amp;action=detail&amp;id=".($_smarty_tpl->tpl_vars['company']->value['tId']));?>
" title="<?php echo @SITE_COMPANY_VACANCY;?>
&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo @SITE_COMPANY_VACANCY;?>
...</a>
				</td>
			</tr>
		</table>
		<?php } ?>
		<p class="TextAlignCenter"><?php echo $_smarty_tpl->tpl_vars['string_page']->value;?>
</p>
	<?php }?>
<?php }?>
</div><?php }} ?>