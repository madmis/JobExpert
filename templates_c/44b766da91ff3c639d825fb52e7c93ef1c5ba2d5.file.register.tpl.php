<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:52:33
         compiled from "templates/site/default\register.tpl" */ ?>
<?php /*%%SmartyHeaderCode:75744fb7514105bea0-18165750%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44b766da91ff3c639d825fb52e7c93ef1c5ba2d5' => 
    array (
      0 => 'templates/site/default\\register.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '75744fb7514105bea0-18165750',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'chpu' => 0,
    'namePage' => 0,
    'return_data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb75141207a2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb75141207a2')) {function content_4fb75141207a2($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['errors']->value){?><?php echo $_smarty_tpl->getSubTemplate ("errors.message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>

<form action="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=register");?>
" method="post" enctype="multipart/form-data">

    <div class="DesignMainPageBody">
        <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
            <tr>
                <th><?php echo $_smarty_tpl->tpl_vars['namePage']->value[0]['name'];?>
</th>
            </tr>
            <tr>
                <td class="last AlignLeft">
                    <div class="paddingText5">
                        <table cellspacing="0" cellpadding="0">
                            <tr>
                                <td rowspan="5" align="left" width="120">
<!--                                    <img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/user.png" align="top" alt="">-->
									&nbsp;
                                </td>
                                <td colspan="2">
                                    <strong><?php echo @FORM_EMAIL;?>
&nbsp;<span class="text-red">*</span></strong><br>
                                    <input type="text" name="arrBindFields[email]" size="50" value="<?php echo $_smarty_tpl->tpl_vars['return_data']->value['email'];?>
">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <strong><?php echo @FORM_PASSWORD;?>
&nbsp;<span class="text-red">*</span></strong><br>
                                    <input type="password" name="arrBindFields[password]" size="50" value="">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <strong><?php echo @FORM_CONFIRM_PASSWORD;?>
&nbsp;<span class="text-red">*</span></strong><br>
                                    <input type="password" name="confirm_password" size="50" value="">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div id="agreement" style="-moz-box-shadow:0 0 0px #000000;background-color:#FFFFFF;border:1px solid #DDDDDD;color:#000000;font-size:11px;height:200px;overflow-x:hidden;overflow-y:auto;padding:10px;margin:0px;width:500px;"></div>
                                     <div style="float:left;"><input type="checkbox" name="agreement" value="agree"> <?php echo @FORM_USER_AGREEMENT;?>
&nbsp;<span class="text-red">*</span></div>
                                    <div style="float:right;"><?php echo @SITE_OPEN_NEW_WINDOW;?>
&nbsp;<img class="agreement" src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/actions/rotait.png" alt=""></div>
                                </td>
                            </tr>
                            <?php if (@SECURE_CAPTCHA){?>
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td align="right">
                                                <p class="p_name"><?php echo $_smarty_tpl->getSubTemplate ("securimage.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</p>
                                            </td>
                                            <td align="left">
                                                <p class="p_name"><input type="text" name="keystring" class="text"></p>
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                </td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2">
                                    <div class="submitButtonLight">
                                        <input type="submit" class="shadow01red" name="send" value="<?php echo @FORM_BUTTON_SEND;?>
">
                                    </div><br>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>




<script type="text/javascript">
<!--
$(document).ready(function() {
	//Просмотр Пользовательского соглашения
	$.get("/index.php?do=agreement", function(data){
		$('#agreement').append(data);
	});
	$('.agreement').click(function() {
		var targ = $('#agreement').html();
		$.fn.colorbox({ html: targ, preloading: true, width: '70%', height: '100%', opacity: 0, open: true, scrolling: true });
		// отключаем горизонтальный скролл в окне colorbox (IE)
		$(targ).parent().css('overflow-x','hidden');
	});
});
-->
</script>
<?php }} ?>