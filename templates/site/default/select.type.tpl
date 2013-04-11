{if $errors}{include file="errors.message.tpl"}{/if}

<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=select.type")}" method="post" enctype="multipart/form-data">
    <div class="DesignMainPageBody">
        <table class="mainBodyTable" cellspacing="0">
            <tr>
                <th>&nbsp;</th>
            </tr>
            <tr>
                <td class="last">
                    <div class="paddingText5">
                        {$smarty.const.MESSAGE_SELECT_TYPE}
                    </div>
                </td>
            </tr>
            <tr class="noBorderBottom">
                <td class="last padding10">
                    {foreach from=$arrTypes item="type"}
                        <input type="radio" name="type" value="{$type}" {if $return_data.type eq $type}checked{/if}> 
                        {if $type eq "agent"}
				            {$smarty.const.FORM_TYPE_AGENT}{if $arrPayments.register_agent}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/money_dollar.png"  class="middle" alt="{$smarty.const.SITE_PAYMENT_SERVICE}" title="{$smarty.const.SITE_PAYMENT_SERVICE}">{/if}
			            {elseif $type eq "company"}
				            {$smarty.const.FORM_TYPE_COMPANY}{if $arrPayments.register_company}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/money_dollar.png"  class="middle" alt="{$smarty.const.SITE_PAYMENT_SERVICE}" title="{$smarty.const.SITE_PAYMENT_SERVICE}">{/if}
			            {elseif $type eq "employer"}
				            {$smarty.const.FORM_TYPE_EMPLOYER}{if $arrPayments.register_employer}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/money_dollar.png"  class="middle" alt="{$smarty.const.SITE_PAYMENT_SERVICE}" title="{$smarty.const.SITE_PAYMENT_SERVICE}">{/if}
			            {elseif $type eq "competitor"}
				            {$smarty.const.FORM_TYPE_COMPETITOR}{if $arrPayments.register_competitor}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/money_dollar.png"  class="middle" alt="{$smarty.const.SITE_PAYMENT_SERVICE}" title="{$smarty.const.SITE_PAYMENT_SERVICE}">{/if}
			            {/if}
		            {/foreach}
		        </td>
	        </tr>
	        <tr class="noBorderBottom">
		        <td class="last padding10">
			        <span class="st_text">
				        {$smarty.const.FORM_FIRST_NAME}<span class="text-red">*</span>
			        </span>
                    <span class="st_input">
                        <input type="text" name="first_name" value="{$return_data.first_name}" class="text" maxlength="32" size="50">
			        </span>
		        </td>
	        </tr>
	        <tr class="noBorderBottom">
		        <td class="last padding10">
			        <span  class="st_text">
				        {$smarty.const.FORM_LAST_NAME}<span class="text-red">*</span>
			        </span>
			        <span class="st_input">
				        <input type="text" name="last_name" value="{$return_data.last_name}" class="text" maxlength="32" size="50">
			        </span>
		        </td>
	        </tr>
	        <tr>
		        <td class="last padding10">
			        <span  class="st_text">
				        {$smarty.const.FORM_PHONE}<span class="text-red">*</span>
			        </span>
			        <span class="st_input">
				        <input type="text" name="phone" value="{$return_data.phone}" class="text" maxlength="25" size="50">
			        </span>
		        </td>
	        </tr>
	<tr>
		<td class="padding10">
            <div style="margin: 0 auto;" class="submitButtonLight">
                <input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_SAVE}">
            </div>
		</td>
	</tr>
</table>
    </div>
</form>