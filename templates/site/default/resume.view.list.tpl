{if $return_data}
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0">
        	<tr>
	            <th colspan="2">{$smarty.const.SITE_RESUME}</th>
	            <th class="VRRegion">{$smarty.const.SITE_REGION}</th>
	            <th class="VRDate">{$smarty.const.FORM_DATE}</th>
	            <th class="VRPayFrom">{$smarty.const.SITE_SALARY}</th>
        	</tr>
			{foreach from=$return_data item="resume" name="resume"}
        		<tr class="tr_hover openLink" title="{$smarty.const.SITE_RESUME}, {$sections[$resume.id_section].name}, {$resume.title|escape}">
		            <td class="VRIcon"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/mainBodyTableVRIcon.gif"></td>
		            <td class="VRDescr">
						<strong>{$sections[$resume.id_section].name|truncate:100:'...'}</strong><br>
						<a href="{$chpu->createChpuUrl("$link`$resume.tId`")}" title="{$resume.title|escape}, {$sections[$resume.id_section].name}, {$regions[$resume.id_region].name|escape}, {$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$resume.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$resume.pay_from} {$resume.currency}">{$resume.title|truncate:110:'...'}</a>
		                <input type="hidden" class="gotoLink" value="{$chpu->createChpuUrl("$link`$resume.tId`")}">
		            </td>
		            <td class="VRRegion">{$regions[$resume.id_region].name|escape}</td>
		            <td class="VRDate">{$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</td>
		            <td class="last VRSallary">{$resume.pay_from}&nbsp;{$resume.currency}</td>
        		</tr>
			{/foreach}
		</table>
	</div>
{/if}