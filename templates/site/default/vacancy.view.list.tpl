{if $return_data}
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0">
	        <tr>
	            <th colspan="2">{$smarty.const.SITE_VACANCE}</th>
	            <th class="VRRegion">{$smarty.const.SITE_REGION}</th>
	            <th class="VRDate">{$smarty.const.FORM_DATE}</th>
	            <th class="VRPayFrom">{$smarty.const.SITE_SALARY}</th>
	        </tr>
			{foreach from=$return_data item="vacancy" name="vacancy"}
		        <tr class="tr_hover openLink" title="{$smarty.const.SITE_VACANCE}, {$vacancy.company_name}, {$vacancy.title|escape}">
		            <td class="VRIcon"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/mainBodyTableVRIcon.gif"></td>
		            <td class="VRDescr">
						<strong>{$vacancy.company_name|truncate:100:'...'}</strong><br>
		                <a href="{$chpu->createChpuUrl("$link`$vacancy.tId`")}" title="{$vacancy.title|escape}, {$smarty.const.FORM_TYPE_COMPANY} - {$vacancy.company_name}, {$sections[$vacancy.id_section].name}, {$regions[$vacancy.id_region].name|escape}, {$vacancy.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$vacancy.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$vacancy.pay_from}{if $vacancy.pay_post}-{$vacancy.pay_post}{/if} {$vacancy.currency}">{$vacancy.title|truncate:110:'...'}</a>
		                <input type="hidden" class="gotoLink" value="{$chpu->createChpuUrl("$link`$vacancy.tId`")}">
		            </td>
		            <td class="VRRegion">{$regions[$vacancy.id_region].name|escape}</td>
		            <td class="VRDate">{$vacancy.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</td>
		            <td class="last VRSallary">{if $vacancy.pay_post}{$smarty.const.SITE_FROM}&nbsp;{$vacancy.pay_from}&nbsp;{$smarty.const.SITE_UNTO}&nbsp;{$vacancy.pay_post}{else}{$vacancy.pay_from}{/if}&nbsp;{$vacancy.currency}</td>
		        </tr>
			{/foreach}
	    </table>
	</div>
{/if}