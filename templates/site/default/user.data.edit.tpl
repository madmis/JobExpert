    <div class="Design_panesBGWrapper">
    <div class="Design_panesBG">
    	<ul class="Design_tabs">
        	<li><a class="active" href="#user">{$smarty.const.MENU_USER_DATA}</a></li>
            <li class="delim"><div></div></li>
        	{if $arrUser.user_type eq 'competitor'}
                <li><a href="#competitor">{$smarty.const.FORM_TYPE_COMPETITOR}</a></li>
                <li class="delim"><div></div></li>
            {/if}
        	{if $arrUser.user_type eq 'agent' OR $arrUser.user_type eq 'company'}
                <li><a href="#company">{$smarty.const.FORM_TYPE_COMPANY}</a></li>
            {/if}

        </ul>

        <div class="Design_panes">
            {* -------------------- Панель 1: Личные данные ---------------------------- *}
            <div>
                	<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.data&amp;action=edit")}" method="post" enctype="multipart/form-data">
                    <h3>{$smarty.const.MENU_USER_DATA}</h3>
                    <table class="Design_panesFormTable">
                        {* Разрешаем пользователю изменять имя и фамилиию только если включена соотв. настройка *}
                        {if $smarty.const.CONF_USER_CHANGE_NAME}
                        <tr>
                            <td class="name">{$smarty.const.SITE_USER_FIRST_NAME}&nbsp;<span class="text-red">*</span></td>
                            <td class="form"><input type="text" name="first_name" value="{$arrUser.first_name|escape}" size="30" maxlength="50"></td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="name">{$smarty.const.SITE_USER_LAST_NAME}&nbsp;<span class="text-red">*</span></td>
                            <td class="form"><input type="text" name="last_name" value="{$arrUser.last_name|escape}" size="30"></td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        {/if}
                        <tr>
                            <td class="name">{$smarty.const.SITE_USER_ALIAS}&nbsp;<span class="text-red">*</span></td>
                            <td class="form">
                            	<input type="text" name="alias" value="{$arrUser.alias|escape}" size="30"><span class="ajaxRes"></span>
                            	<input type="hidden" id="uid" value="{$arrUser.id}">
            					<span class="user_help" id="HELP_USER_ALIAS">
            						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info2.gif" alt="Info">
            					</span>
                            </td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="name">{$smarty.const.SITE_USER_MIDDLE_NAME}</td>
                            <td class="form"><input type="text" name="middle_name" value="{$arrUser.middle_name|escape}" size="30" maxlength="50"></td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="name">{$smarty.const.SITE_USER_ADDITIONAL_PHONE} 1</td>
                            <td class="form"><input type="text" name="addition_phone_1" value="{$arrUser.addition_phone_1}" size="30" maxlength="25"></td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="name">{$smarty.const.SITE_USER_ADDITIONAL_PHONE} 2</td>
                            <td class="form"><input type="text" name="addition_phone_2" value="{$arrUser.addition_phone_2}" size="30" maxlength="25"></td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="name" colspan="2">
                            	<label>{$smarty.const.FORM_USER_MAILER_SUBSCRIBE}&nbsp;<input type="checkbox" name="mailer_subscribe" {if $arrUser.mailer_subscribe}checked="checked"{/if}></label>
                            </td>
                            <td class="error">&nbsp;</td>
                        </tr>
            			{if $arrUser.user_type eq 'company'}
                        <tr>
                            <td class="name" colspan="2">
                            	<label>{$smarty.const.FORM_COMPANY_HIDE_ADDITIONAL_DATA}&nbsp;<input type="checkbox" name="hide_additional_company_data" {if $arrUser.hide_additional_company_data}checked{/if}></label>
            					<span class="user_help" id="HELP_USER_HIDE_ADDITIONAL_COMPANY_DATA">
            						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info2.gif" alt="Info">
            					</span>
                            </td>
                            <td class="error">&nbsp;</td>
                        </tr>
                        {/if}
                        </table><br><hr class="Design_panesDelimiter"><table class="Design_panesFormTable">
                        <tr>
                            <td><br>
                                  <div class="submitButtonLight" align="center">
                                      <input type="submit" class="shadow01red"  name="save" value="{$smarty.const.FORM_BUTTON_SAVE}">
                                  </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            {* -------------------- ^Панель 1: Личные данные^ ---------------------------- *}

            {* -------------------- Панель 2: Данные соискателя ---------------------------- *}
            {* Даем менять пол и дату рождения, только если пользователь COMPETITOR *}
            {if $arrUser.user_type eq 'competitor'}
            <div>
            	<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.data&amp;action=edit#competitor")}" method="post" enctype="multipart/form-data">
                    <h3>{$smarty.const.FORM_DATA_COMPETITOR}</h3>
                    <table class="Design_panesFormTable">
                        <tr>
                            <td class="name">{$smarty.const.ANNOUNCE_SELECT_GENDER}</td>
                            <td class="error">&nbsp;</td>
                            <td class="form" style="width:160px;">
            					{foreach from=$arrSysDict.Gender.values item="item" key="key"}
            						<label><input type="radio" name="gender" value="{$key}" {if $arrUser.gender eq $key}checked{/if}>&nbsp;{$item}</label>
            					{/foreach}
                            </td><td>
            					<span class="user_help" id="HELP_USER_GENDER">
            						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info2.gif" alt="Info">
            					</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="name">{$smarty.const.FORM_USER_BIRTHDAY}</td>
                            <td class="error">&nbsp;</td>
                            <td class="form" style="width:160px;">
            					{html_select_date time=$arrUser.birthday field_array="date" field_order="DMY" month_format="%m" start_year="-50" end_year="-14" reverse_years="true" day_empty="" month_empty="" year_empty=""}
                            </td><td>
            					<span class="user_help" id="HELP_USER_BIRTHDAY">
            						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info2.gif" alt="Info">
            					</span>
                            </td>
                        </tr>
                        </table><br><hr class="Design_panesDelimiter"><table class="Design_panesFormTable">
                        <tr>
                            <td><br>
                                  <div class="submitButtonLight" align="center">
                                      <input type="submit" class="shadow01red"  name="save_competitor" value="{$smarty.const.FORM_BUTTON_SAVE}">
                                  </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            {/if}
            {* -------------------- ^Панель 2: Данные соискателя^ ---------------------------- *}

            {* -------------------- Панель 3: Данные компании ---------------------------- *}
            {* Даем менять название компании, описание и логотип, только если пользователь AGENT (без логотипа) или COMPANY *}
            {if $arrUser.user_type eq 'agent' OR $arrUser.user_type eq 'company'}

            <div>
            	<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.data&amp;action=edit#company")}" method="post" enctype="multipart/form-data">
                    <h3>{$smarty.const.FORM_DATA_COMPANY}</h3>
                    <table class="Design_panesFormTable">
                        <tr>
                            <td class="name">{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}</td>
                            <td class="error">&nbsp;</td>
                            <td class="form">
                                <input type="text" name="company_name" value="{$arrUser.company_name|escape}" size="50">
                                <span class="user_help" id="HELP_USER_COMPANY_NAME">
                                    <img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info2.gif" alt="Info">
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="name">{$smarty.const.FORM_COMPANY_CITY}</td>
                            <td class="error">&nbsp;</td>
                            <td class="form">
                                <input type="text" name="company_city" value="{$arrUser.company_city|escape}" size="50">
                            </td>
                        </tr>
                        <tr>
                            <td class="name">{$smarty.const.FORM_COMPANY_URL}</td>
                            <td class="error">&nbsp;</td>
                            <td class="form">
            					<input type="text" name="company_url" value="{$arrUser.company_url|escape}" size="50">
                            </td>
                        </tr>
                    </table>
                    <table class="Design_panesFormTable">
                        <tr>
                            <td class="name300">
                                {$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}
            					<span class="user_help" id="HELP_USER_COMPANY_DISCRIPTION">
			            			<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info2.gif" alt="Info">
            					</span>
                            </td>
                            <td class="error">&nbsp;</td>
                            <td class="form">&nbsp;</td>
                        </tr>
                        <tr><td colspan="3">
                            <textarea cols="70" rows="10" name="company_description" {if $smarty.const.CONF_USE_VISUAL_EDITOR AND $smarty.const.CONF_COMPANIES_USE_VISUAL_EDITOR}class="tinymce"{/if}>{$arrUser.company_description}</textarea>
                        </td></tr>
                    </table>

		            {*if $arrUser.user_type eq 'company'*}
                    <hr class="Design_panesDelimiter">
                    <table class="Design_panesFormTable">
                        <tr>
                            <td class="name">{$smarty.const.FORM_COMPANY_LOGO}</td>
                            <td class="error">&nbsp;</td>
                            <td class="form">
            					<input type="file" name="logo" value="{$arrUser.logo}" size="50">
            					<span class="user_help" id="HELP_USER_COMPANY_LOGO">
            						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info2.gif" alt="Info">
            					</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td>
                				{if $arrUser.logo}
                				   <span id="ulogo"><img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/thumbs/thumb_{$arrUser.logo}" style="border: 1px solid #DDD;"></span>
                				{else}
                                    <span id="ulogo"><img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/not_logo.png" style="border: 1px solid #DDD;"></span>
                				{/if}
                                {* Удаление логотипа *}
                                {if $arrUser.logo AND $smarty.const.CONF_COMPANIES_DELETE_LOGO}
                                    <span id="dico">
                                        <img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/actions/delete.png" id="dellogo" alt="Delete Logo" title="Delete Logo" style="cursor: pointer;">
                                    </span>
                                {/if}
                            </td>
                        </tr>
                    </table>
		            {*/if*}
                    <br><hr class="Design_panesDelimiter">
                    <table class="Design_panesFormTable">
                        <tr>
                            <td><br>
                                  <div class="submitButtonLight" align="center">
                                      <input type="submit" class="shadow01red"  name="save_company" value="{$smarty.const.FORM_BUTTON_SAVE}">
                                  </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            {/if}
            {* -------------------- ^Панель 3: Данные компании^ ---------------------------- *}
        </div>
    </div>
</div>

{if $smarty.const.CONF_USE_VISUAL_EDITOR AND $smarty.const.CONF_COMPANIES_USE_VISUAL_EDITOR}
<!-- TinyMCE -->
<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/modules/tinymce/userdata_config.js"></script>
<!-- TinyMCE -->
{/if}

<script type="text/javascript">
<!--
(function($) {
    if (!$.browser.msie) {
	    $('ul.Design_tabs').tabs('div.Design_panes > div', {
			effect: 'fade',
		    fadeInSpeed: 'normal',
			initialIndex: {$anc}
		}).history();
	}
})(jQuery);

$(function() {
    if ($.browser.msie) {
	    $('ul.Design_tabs').tabs('div.Design_panes > div', {
		    effect: 'fade',
			fadeInSpeed: 'normal',
			initialIndex: {$anc}
		}).history();
	}
});
-->
</script>

{if $smarty.const.CONF_COMPANIES_DELETE_LOGO}
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
					$('#ulogo').html('<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/not_logo.png" style="border: 1px solid #DDD;">');
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
			ajaxRes.html('<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/loading.gif"');
			$.ajax({ type: 'post', url: '/ajax.php', data: 'checkAlias=' + alias + '&uID=' + id,
					success: function( msg ) {
						ajaxRes.html('');
						( msg == 'false' ) ? ajaxRes.html('<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/yes.png" title="{$smarty.const.MESSAGE_ALIAS_FREE}"') : ajaxRes.html('<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/no.png" title="{$smarty.const.ERROR_USER_ALIAS_EXISTS}">');
					}
			});
		}
	}).focusout();

    
});
-->
</script>
{/if}