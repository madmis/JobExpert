<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:54:04
         compiled from "templates/site/default\user.data.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149604fb7519c1d12e1-59134956%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6b21893b090eb8ea5d3e48aabf1fd8698494653' => 
    array (
      0 => 'templates/site/default\\user.data.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149604fb7519c1d12e1-59134956',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'action' => 0,
    'arrUser' => 0,
    'chpu' => 0,
    'codex' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb7519c8d4ef',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb7519c8d4ef')) {function content_4fb7519c8d4ef($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'I:\\home\\Smarty\\plugins\\modifier.date_format.php';
?><?php if ($_smarty_tpl->tpl_vars['errors']->value){?>
	<?php echo $_smarty_tpl->getSubTemplate ("errors.message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['action']->value['edit']){?>
	<?php echo $_smarty_tpl->getSubTemplate ("user.data.edit.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }else{ ?>
 <div class="Design_panesBGWrapper">
    <div class="Design_panesBG">
        <table style="width:100%;" cellpadding="0" cellspacing="0">
            <tr><td style="width:50%;">
            	<ul class="Design_tabs">
                	<li><a class="active current" style="font-size:11px;"><?php echo @MENU_USER_DATA;?>
</a></li>
                </ul>
            </td><td style="width:50%;" valign="top" class="DesignUserDataTopDataCellDelim">
            	<ul class="Design_tabs" style="height:23px;">
                	<li style="height:23px;">&nbsp;</li>
                </ul>
            </td></tr>

            <tr><td class="DesignUserDataTopData" style="width:50%;" valign="top">
            	<strong class="shadow01"><?php echo @SITE_MAIN_DATA;?>
</strong>
                    <table class="DesignSMainData">
                        <tr>
                            <td class="MDheader"><?php echo @SITE_USER_EMAIL;?>
</td>
                            <td class="MDdata"><?php echo $_smarty_tpl->tpl_vars['arrUser']->value['email'];?>
</td>
                        </tr>
                        <tr>
                            <td class="MDheader"><?php echo @SITE_USER_TYPE;?>
</td>
                            <td class="MDdata">
            					<?php if ($_smarty_tpl->tpl_vars['arrUser']->value['user_type']=="agent"){?>
            						<?php echo @FORM_TYPE_AGENT;?>

            					<?php }elseif($_smarty_tpl->tpl_vars['arrUser']->value['user_type']=="company"){?>
            						<?php echo @FORM_TYPE_COMPANY;?>

            					<?php }elseif($_smarty_tpl->tpl_vars['arrUser']->value['user_type']=="employer"){?>
            						<?php echo @FORM_TYPE_EMPLOYER;?>

            					<?php }elseif($_smarty_tpl->tpl_vars['arrUser']->value['user_type']=="competitor"){?>
            						<?php echo @FORM_TYPE_COMPETITOR;?>

            					<?php }?>
                            </td>
                        </tr>
                        <tr>
                            <td class="MDheader"><?php echo @SITE_USER_REG_DATE;?>
</td>
                            <td class="MDdata"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['arrUser']->value['reg_datetime'],@CONF_DATE_FORMAT);?>
</td>
                        </tr>
                        <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['alias']){?>
                        <tr>
                            <td class="MDheader"><?php echo @SITE_USER_ALIAS;?>
</td>
                            <td class="MDdata"><?php echo $_smarty_tpl->tpl_vars['arrUser']->value['alias'];?>
</td>
                        </tr>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['pre_ip']){?>
                        <tr>
                            <td class="MDheader"><?php echo @SITE_USER_PRE_IP;?>
</td>
                            <td class="MDdata">
                            	<?php echo $_smarty_tpl->tpl_vars['arrUser']->value['pre_ip'];?>

            					<span class="user_help" id="HELP_USER_PRE_IP">
            						<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/info2.gif" alt="Info">
            					</span>
                            </td>
                        </tr>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['curr_ip']){?>
                        <tr>
                            <td class="MDheader"><?php echo @SITE_USER_CURRENT_IP;?>
</td>
                            <td class="MDdata"><?php echo $_smarty_tpl->tpl_vars['arrUser']->value['curr_ip'];?>
</td>
                        </tr>
                        <?php }?>

                    </table>
            </td><td class="DesignUserDataTopData DesignUserDataTopDataCellDelim" style="width:50%;" valign="top">
                	<strong class="shadow01"><?php echo @SITE_ADDITIONAL_DATA;?>
</strong>
                    <table class="DesignSMainData">
                        <tr>
                            <td class="MDheader"><?php echo @SITE_USER_FIRST_NAME;?>
</td>
                            <td class="MDdata"><?php echo $_smarty_tpl->tpl_vars['arrUser']->value['first_name'];?>
</td>
                        </tr>
                        <tr>
                            <td class="MDheader"><?php echo @SITE_USER_LAST_NAME;?>
</td>
                            <td class="MDdata"><?php echo $_smarty_tpl->tpl_vars['arrUser']->value['last_name'];?>
</td>
                        </tr>
                        <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['middle_name']){?>
                        <tr>
                            <td class="MDheader"><?php echo @SITE_USER_MIDDLE_NAME;?>
</td>
                            <td class="MDdata"><?php echo $_smarty_tpl->tpl_vars['arrUser']->value['middle_name'];?>
</td>
                        </tr>
                        <?php }?>
                        <tr>
                            <td class="MDheader"><?php echo @SITE_USER_PHONE;?>
</td>
                            <td class="MDdata"><?php echo $_smarty_tpl->tpl_vars['arrUser']->value['phone'];?>
</td>
                        </tr>
                        <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['addition_phone_1']){?>
                        <tr>
                            <td class="MDheader"><?php echo @SITE_USER_ADDITIONAL_PHONE;?>
</td>
                            <td class="MDdata"><?php echo $_smarty_tpl->tpl_vars['arrUser']->value['addition_phone_1'];?>
</td>
                        </tr>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['addition_phone_2']){?>
                        <tr>
                            <td class="MDheader"><?php echo @SITE_USER_ADDITIONAL_PHONE;?>
</td>
                            <td class="MDdata"><?php echo $_smarty_tpl->tpl_vars['arrUser']->value['addition_phone_2'];?>
</td>
                        </tr>
                        <?php }?>
                    </table>
            </td></tr>
        </table>
    </div>
  </div>

<div style="margin:10px 0px; font-size:11px; text-align:left;">
    <img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/actions/edit.png" style="vertical-align: middle;" />
    <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.data&amp;action=edit");?>
" style="font-weight:bold;"><?php echo @MENU_EDIT_USER_DATA;?>
</a>
</div>
        <div class="DesignMainPageBody" style="margin-left:-5px; margin-right:5px;">
          <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
                  <tr>
                      <th colspan="2"> <?php echo @SITE_USER_RIGHTS;?>
</th>
                  </tr>
                  <tr>
                      <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['user_type']=="agent"||$_smarty_tpl->tpl_vars['arrUser']->value['user_type']=="company"||$_smarty_tpl->tpl_vars['arrUser']->value['user_type']=="employer"){?>
                      <td class="AlignLeft" style="vertical-align: top; width: 50%;">
                          <div class="paddingText5">
                              <strong><?php echo @SITE_VACANCY;?>
</strong>
                              <table>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_ADD_VACANCY;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['add_vacancy']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_EDIT_VACANCY;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['edit_vacancy']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_DEL_VACANCY;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['del_vacancy']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                              </table>
                          </div>
                      </td>
                      <?php }?>

         			  <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['user_type']=="agent"||$_smarty_tpl->tpl_vars['arrUser']->value['user_type']=="competitor"){?>
                      <td class="AlignLeft <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['user_type']=='agent'){?>last<?php }?>" style="vertical-align: top; width: 50%;">
                          <div class="paddingText5">
                              <strong><?php echo @SITE_RESUME;?>
</strong>
                              <table>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_ADD_RESUME;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['add_resume']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_EDIT_RESUME;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['edit_resume']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_DEL_RESUME;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['del_resume']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                              </table>
                          </div>
                      </td>
        			  <?php }?>

                      <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['user_type']!="agent"){?>
                        <td class="last">&nbsp;</td>
                      <?php }?>
                 </tr>
                  <tr>
                      <td class="AlignLeft" style="vertical-align: top; width: 50%;">
                          <div class="paddingText5">
                              <strong><?php echo @SITE_ARTICLES;?>
</strong>
                              <table>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_ADD_ARTICLES;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['add_articles']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_EDIT_ARTICLES;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['edit_articles']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_ARC_ARTICLES;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['arc_articles']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_DEL_ARTICLES;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['del_articles']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                              </table>
                          </div>
                      </td>
                      <td class="last AlignLeft" style="vertical-align: top; width: 50%;">
                          <div class="paddingText5">
                              <strong><?php echo @SITE_NEWS;?>
</strong>
                              <table>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_ADD_NEWS;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['add_news']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_EDIT_NEWS;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['edit_news']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_ARC_NEWS;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['edit_news']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                                <tr>
                                    <td><?php echo @TABLE_COLUMN_DEL_NEWS;?>
</td>
                                    <td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['del_news']){?>yes<?php }else{ ?>no<?php }?>.png" /></td>
                                </tr>
                              </table>
                          </div>
                      </td>
				  </tr>
          </table>
        </div>
<?php }?><?php }} ?>