{if $errors}{include file="errors.message.tpl"}{/if}

<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=register")}" method="post" enctype="multipart/form-data">

    <div class="DesignMainPageBody">
        <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
            <tr>
                <th>{$namePage[0].name}</th>
            </tr>
            <tr>
                <td class="last AlignLeft">
                    <div class="paddingText5">
                        <table cellspacing="0" cellpadding="0">
                            <tr>
                                <td rowspan="5" align="left" width="120">
<!--                                    <img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/user.png" align="top" alt="">-->
									&nbsp;
                                </td>
                                <td colspan="2">
                                    <strong>{$smarty.const.FORM_EMAIL}&nbsp;<span class="text-red">*</span></strong><br>
                                    <input type="text" name="arrBindFields[email]" size="50" value="{$return_data.email}">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <strong>{$smarty.const.FORM_PASSWORD}&nbsp;<span class="text-red">*</span></strong><br>
                                    <input type="password" name="arrBindFields[password]" size="50" value="">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <strong>{$smarty.const.FORM_CONFIRM_PASSWORD}&nbsp;<span class="text-red">*</span></strong><br>
                                    <input type="password" name="confirm_password" size="50" value="">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div id="agreement" style="-moz-box-shadow:0 0 0px #000000;background-color:#FFFFFF;border:1px solid #DDDDDD;color:#000000;font-size:11px;height:200px;overflow-x:hidden;overflow-y:auto;padding:10px;margin:0px;width:500px;"></div>
                                     <div style="float:left;"><input type="checkbox" name="agreement" value="agree"> {$smarty.const.FORM_USER_AGREEMENT}&nbsp;<span class="text-red">*</span></div>
                                    <div style="float:right;">{$smarty.const.SITE_OPEN_NEW_WINDOW}&nbsp;<img class="agreement" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/actions/rotait.png" alt=""></div>
                                </td>
                            </tr>
                            {if $smarty.const.SECURE_CAPTCHA}
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td align="right">
                                                <p class="p_name">{include file="securimage.tpl"}</p>
                                            </td>
                                            <td align="left">
                                                <p class="p_name"><input type="text" name="keystring" class="text"></p>
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                </td>
                            </tr>
                            {/if}
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2">
                                    <div class="submitButtonLight">
                                        <input type="submit" class="shadow01red" name="send" value="{$smarty.const.FORM_BUTTON_SEND}">
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
