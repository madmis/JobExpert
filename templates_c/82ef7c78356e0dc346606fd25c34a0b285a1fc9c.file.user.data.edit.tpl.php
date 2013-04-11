<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:54:07
         compiled from "templates/site/default\user.data.edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12984fb7519fc0d2f7-25804262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82ef7c78356e0dc346606fd25c34a0b285a1fc9c' => 
    array (
      0 => 'templates/site/default\\user.data.edit.tpl',
      1 => 1336142862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12984fb7519fc0d2f7-25804262',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'arrUser' => 0,
    'chpu' => 0,
    'arrSysDict' => 0,
    'key' => 0,
    'item' => 0,
    'anc' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb751a060a27',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb751a060a27')) {function content_4fb751a060a27($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_select_date')) include 'I:\\home\\Smarty\\plugins\\function.html_select_date.php';
?>    <div class="Design_panesBGWrapper">
    <div class="Design_panesBG">
    	<ul class="Design_tabs">
        	<li><a class="active" href="#user"><?php echo @MENU_USER_DATA;?>
</a></li>
            <li class="delim"><div></div></li>
        	<?php if ($_smarty_tpl->tpl_vars['arrUser']->value['user_type']=='competitor'){?>
                <li><a href="#competitor"><?php echo @FORM_TYPE_COMPETITOR;?>
</a></li>
                <li class="delim"><div></div></li>
            <?php }?>
        	<?php if ($_smarty_tpl->tpl_vars['arrUser']->value['user_type']=='agent'||$_smarty_tpl->tpl_vars['arrUser']->value['user_type']=='company'){?>
                <li><a href="#company"><?php echo @FORM_TYPE_COMPANY;?>
</a></li>
            <?php }?>

        </ul>

        <div class="Design_panes">
            <div>
                	<form action="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.data&amp;action=edit");?>
" method="post" enctype="multipart/form-data">
                    <h3><?php echo @MENU_USER_DATA;?>
</h3>
                    <table class="Design_panesFormTable">
                        <?php if (@CONF_USER_CHANGE_NAME){?>
                        <tr>
                            <td class="name"><?php echo @SITE_USER_FIRST_NAME;?>
&nbsp;<span class="text-red">*</span></td>
                            <td class="form"><input type="text" name="first_name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['arrUser']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
" size="30" maxlength="50"></td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="name"><?php echo @SITE_USER_LAST_NAME;?>
&nbsp;<span class="text-red">*</span></td>
                            <td class="form"><input type="text" name="last_name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['arrUser']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
" size="30"></td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        <?php }?>
                        <tr>
                            <td class="name"><?php echo @SITE_USER_ALIAS;?>
&nbsp;<span class="text-red">*</span></td>
                            <td class="form">
                            	<input type="text" name="alias" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['arrUser']->value['alias'], ENT_QUOTES, 'UTF-8', true);?>
" size="30"><span class="ajaxRes"></span>
                            	<input type="hidden" id="uid" value="<?php echo $_smarty_tpl->tpl_vars['arrUser']->value['id'];?>
">
            					<span class="user_help" id="HELP_USER_ALIAS">
            						<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/info2.gif" alt="Info">
            					</span>
                            </td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="name"><?php echo @SITE_USER_MIDDLE_NAME;?>
</td>
                            <td class="form"><input type="text" name="middle_name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['arrUser']->value['middle_name'], ENT_QUOTES, 'UTF-8', true);?>
" size="30" maxlength="50"></td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="name"><?php echo @SITE_USER_ADDITIONAL_PHONE;?>
 1</td>
                            <td class="form"><input type="text" name="addition_phone_1" value="<?php echo $_smarty_tpl->tpl_vars['arrUser']->value['addition_phone_1'];?>
" size="30" maxlength="25"></td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="name"><?php echo @SITE_USER_ADDITIONAL_PHONE;?>
 2</td>
                            <td class="form"><input type="text" name="addition_phone_2" value="<?php echo $_smarty_tpl->tpl_vars['arrUser']->value['addition_phone_2'];?>
" size="30" maxlength="25"></td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="name" colspan="2">
                            	<label><?php echo @FORM_USER_MAILER_SUBSCRIBE;?>
&nbsp;<input type="checkbox" name="mailer_subscribe" <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['mailer_subscribe']){?>checked="checked"<?php }?>></label>
                            </td>
                            <td class="error">&nbsp;</td>
                        </tr>
            			<?php if ($_smarty_tpl->tpl_vars['arrUser']->value['user_type']=='company'){?>
                        <tr>
                            <td class="name" colspan="2">
                            	<label><?php echo @FORM_COMPANY_HIDE_ADDITIONAL_DATA;?>
&nbsp;<input type="checkbox" name="hide_additional_company_data" <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['hide_additional_company_data']){?>checked<?php }?>></label>
            					<span class="user_help" id="HELP_USER_HIDE_ADDITIONAL_COMPANY_DATA">
            						<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/info2.gif" alt="Info">
            					</span>
                            </td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        <?php }?>
                        </table><br><hr class="Design_panesDelimiter"><table class="Design_panesFormTable">
                        <tr>
                            <td><br>
                                  <div class="submitButtonLight" align="center">
                                      <input type="submit" class="shadow01red"  name="save" value="<?php echo @FORM_BUTTON_SAVE;?>
">
                                  </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['user_type']=='competitor'){?>
            <div>
            	<form action="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.data&amp;action=edit#competitor");?>
" method="post" enctype="multipart/form-data">
                    <h3><?php echo @FORM_DATA_COMPETITOR;?>
</h3>
                    <table class="Design_panesFormTable">
                        <tr>
                            <td class="name"><?php echo @ANNOUNCE_SELECT_GENDER;?>
</td>
                            <td class="error">&nbsp;</td>
                            <td class="form" style="width:160px;">
            					<?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['arrSysDict']->value['Gender']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value){
$_smarty_tpl->tpl_vars["item"]->_loop = true;
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["item"]->key;
?>
            						<label><input type="radio" name="gender" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['gender']==$_smarty_tpl->tpl_vars['key']->value){?>checked<?php }?>>&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</label>
            					<?php } ?>
                            </td><td>
            					<span class="user_help" id="HELP_USER_GENDER">
            						<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/info2.gif" alt="Info">
            					</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="name"><?php echo @FORM_USER_BIRTHDAY;?>
</td>
                            <td class="error">&nbsp;</td>
                            <td class="form" style="width:160px;">
            					<?php echo smarty_function_html_select_date(array('time'=>$_smarty_tpl->tpl_vars['arrUser']->value['birthday'],'field_array'=>"date",'field_order'=>"DMY",'month_format'=>"%m",'start_year'=>"-50",'end_year'=>"-14",'reverse_years'=>"true",'day_empty'=>'','month_empty'=>'','year_empty'=>''),$_smarty_tpl);?>

                            </td><td>
            					<span class="user_help" id="HELP_USER_BIRTHDAY">
            						<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/info2.gif" alt="Info">
            					</span>
                            </td>
                        </tr>
                        </table><br><hr class="Design_panesDelimiter"><table class="Design_panesFormTable">
                        <tr>
                            <td><br>
                                  <div class="submitButtonLight" align="center">
                                      <input type="submit" class="shadow01red"  name="save_competitor" value="<?php echo @FORM_BUTTON_SAVE;?>
">
                                  </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['user_type']=='agent'||$_smarty_tpl->tpl_vars['arrUser']->value['user_type']=='company'){?>

            <div>
            	<form action="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.data&amp;action=edit#company");?>
" method="post" enctype="multipart/form-data">
                    <h3><?php echo @FORM_DATA_COMPANY;?>
</h3>
                    <table class="Design_panesFormTable">
                        <tr>
                            <td class="name"><?php echo @ANNOUNCE_CONTACTS_COMPANY_NAME;?>
</td>
                            <td class="error">&nbsp;</td>
                            <td class="form">
                                <input type="text" name="company_name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['arrUser']->value['company_name'], ENT_QUOTES, 'UTF-8', true);?>
" size="50">
                                <span class="user_help" id="HELP_USER_COMPANY_NAME">
                                    <img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/info2.gif" alt="Info">
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="name"><?php echo @FORM_COMPANY_CITY;?>
</td>
                            <td class="error">&nbsp;</td>
                            <td class="form">
                                <input type="text" name="company_city" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['arrUser']->value['company_city'], ENT_QUOTES, 'UTF-8', true);?>
" size="50">
                            </td>
                        </tr>
                        <tr>
                            <td class="name"><?php echo @FORM_COMPANY_URL;?>
</td>
                            <td class="error">&nbsp;</td>
                            <td class="form">
            					<input type="text" name="company_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['arrUser']->value['company_url'], ENT_QUOTES, 'UTF-8', true);?>
" size="50">
                            </td>
                        </tr>
                    </table>
                    <table class="Design_panesFormTable">
                        <tr>
                            <td class="name300">
                                <?php echo @ANNOUNCE_COMPANY_DISCRIPTION;?>

            					<span class="user_help" id="HELP_USER_COMPANY_DISCRIPTION">
			            			<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/info2.gif" alt="Info">
            					</span>
                            </td>
                            <td class="error">&nbsp;</td>
                            <td class="form">&nbsp;</td>
                        </tr>
                        <tr><td colspan="3">
                            <textarea cols="70" rows="10" name="company_description" <?php if (@CONF_USE_VISUAL_EDITOR&&@CONF_COMPANIES_USE_VISUAL_EDITOR){?>class="tinymce"<?php }?>><?php echo $_smarty_tpl->tpl_vars['arrUser']->value['company_description'];?>
</textarea>
                        </td></tr>
                    </table>
                    <hr class="Design_panesDelimiter">
                    <table class="Design_panesFormTable">
                        <tr>
                            <td class="name"><?php echo @FORM_COMPANY_LOGO;?>
</td>
                            <td class="error">&nbsp;</td>
                            <td class="form">
            					<input type="file" name="logo" value="<?php echo $_smarty_tpl->tpl_vars['arrUser']->value['logo'];?>
" size="50">
            					<span class="user_help" id="HELP_USER_COMPANY_LOGO">
            						<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/info2.gif" alt="Info">
            					</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td>
                				<?php if ($_smarty_tpl->tpl_vars['arrUser']->value['logo']){?>
                				   <span id="ulogo"><img src="<?php echo @CONF_SCRIPT_URL;?>
uploads/images/logo/thumbs/thumb_<?php echo $_smarty_tpl->tpl_vars['arrUser']->value['logo'];?>
" style="border: 1px solid #DDD;"></span>
                				<?php }else{ ?>
                                    <span id="ulogo"><img src="<?php echo @CONF_SCRIPT_URL;?>
uploads/images/logo/not_logo.png" style="border: 1px solid #DDD;"></span>
                				<?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['arrUser']->value['logo']&&@CONF_COMPANIES_DELETE_LOGO){?>
                                    <span id="dico">
                                        <img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/actions/delete.png" id="dellogo" alt="Delete Logo" title="Delete Logo" style="cursor: pointer;">
                                    </span>
                                <?php }?>
                            </td>
                        </tr>
                    </table>
                    <br><hr class="Design_panesDelimiter">
                    <table class="Design_panesFormTable">
                        <tr>
                            <td><br>
                                  <div class="submitButtonLight" align="center">
                                      <input type="submit" class="shadow01red"  name="save_company" value="<?php echo @FORM_BUTTON_SAVE;?>
">
                                  </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php }?>
        </div>
    </div>
</div>

<?php if (@CONF_USE_VISUAL_EDITOR&&@CONF_COMPANIES_USE_VISUAL_EDITOR){?>
<!-- TinyMCE -->
<script type="text/javascript" src="<?php echo @CONF_SCRIPT_URL;?>
core/modules/tinymce/userdata_config.js"></script>
<!-- TinyMCE -->
<?php }?>

<script type="text/javascript">
<!--
(function($) {
    if (!$.browser.msie) {
	    $('ul.Design_tabs').tabs('div.Design_panes > div', {
			effect: 'fade',
		    fadeInSpeed: 'normal',
			initialIndex: <?php echo $_smarty_tpl->tpl_vars['anc']->value;?>

		}).history();
	}
})(jQuery);

$(function() {
    if ($.browser.msie) {
	    $('ul.Design_tabs').tabs('div.Design_panes > div', {
		    effect: 'fade',
			fadeInSpeed: 'normal',
			initialIndex: <?php echo $_smarty_tpl->tpl_vars['anc']->value;?>

		}).history();
	}
});
-->
</script>

<?php if (@CONF_COMPANIES_DELETE_LOGO){?>
<script type="text/javascript">
<!--
$(function() {
    /*** Удаление логотипа ***/
    $('#dellogo').click( function() {
        $('#overlay, #dialog').show();

        $.ajax({ type: 'post', url: '/ajax.php', data: 'dl=' + $('#uid').val(),
			success: function(msg) {
				if ('ok' == msg) {
					$('#dico').html('');
					$('#ulogo').html('<img src="<?php echo @CONF_SCRIPT_URL;?>
uploads/images/logo/not_logo.png" style="border: 1px solid #DDD;">');
				} else {
					alert( msg );
				}
				$('#overlay, #dialog').hide();
			}
		});
    });
    
	// Проверяем alias
	//$('input[name="alias"]').focusout( function() {
	$('input[name="alias"]').change( function() {
		var alias = $(this).val();
		var id = $('#uid').val();
		if ( alias && id ) {
			var ajaxRes = $(this).next('.ajaxRes');
			ajaxRes.html('<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/loading.gif"');
			$.ajax({ type: 'post', url: '/ajax.php', data: 'checkAlias=' + alias + '&uID=' + id,
					success: function( msg ) {
						ajaxRes.html('');
						( msg == 'false' ) ? ajaxRes.html('<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/yes.png" title="<?php echo @MESSAGE_ALIAS_FREE;?>
"') : ajaxRes.html('<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/no.png" title="<?php echo @ERROR_USER_ALIAS_EXISTS;?>
">');
					}
			});
		}
	}).focusout();

    
});
-->
</script>
<?php }?><?php }} ?>