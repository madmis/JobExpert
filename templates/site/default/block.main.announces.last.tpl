{if $smarty.const.CONF_VACANCY_LAST_SHOW && $last.vacancy}
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th colspan="2">{$smarty.const.SITE_BLOCK_LAST_VACANCYS}</th>
				<th class="VRRegion">{$smarty.const.SITE_CITY}</th>
				<th class="VRDate">{$smarty.const.FORM_DATE}</th>
				<th class="VRSallary">{$smarty.const.SITE_SALARY}</th>
			</tr>
			{foreach from=$last.vacancy item="vacancy"}
				<tr class="tr_hover openLink" title="{$smarty.const.SITE_BLOCK_LAST_VACANCYS}: {$vacancy.company_name|escape}, {$vacancy.title|escape}">
					<td class="VRIcon"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/mainBodyTableVRIcon.gif" alt=""></td>
					<td class="VRDescr">
						<strong>{$vacancy.company_name|truncate:80}</strong><br>
						<a style="text-decoration: none;" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&amp;action=view&amp;id=`$vacancy.tId`")}" title="{$vacancy.title|escape}, {$smarty.const.FORM_TYPE_COMPANY} - {$vacancy.company_name|escape}, {$sections[$vacancy.id_section].name|escape} - {$professions[$vacancy.id_profession].name|escape}, {$regions[$vacancy.id_region].name|escape}{if $vacancy.id_city} - {$citys[$vacancy.id_city].name|escape}{/if}, {$vacancy.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$vacancy.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$vacancy.pay_from}{if $vacancy.pay_post}-{$vacancy.pay_post}{/if} {$vacancy.currency}">{$vacancy.title|truncate:180}</a>
						<input type="hidden" class="gotoLink" value="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&amp;action=view&amp;id=`$vacancy.tId`")}">
					</td>
					<td class="VRRegion">{if $vacancy.id_city}{$citys[$vacancy.id_city].name|escape}{else}&nbsp;{/if}</td>
					<td class="VRDate">{$vacancy.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</td>
					<td class="last VRSallary">{if $vacancy.pay_post}{$smarty.const.SITE_FROM}&nbsp;{$vacancy.pay_from}&nbsp;{$smarty.const.SITE_UNTO}&nbsp;{$vacancy.pay_post}{else}{$vacancy.pay_from}{/if}&nbsp;{$vacancy.currency}</td>
				</tr>
			{/foreach}
			<tr>
				<td class="last AlignRight" colspan="5">
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy")}" title="{$smarty.const.SITE_BLOCK_LAST_VACANCYS}">{$smarty.const.SITE_ALL} {$smarty.const.SITE_VACANCY}...</a>
				</td>
			</tr>
		</table>
	</div>
{/if}
{if $smarty.const.CONF_RESUME_LAST_SHOW && $last.resume}
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th colspan="2">{$smarty.const.SITE_BLOCK_LAST_RESUMES}</th>
				<th class="VRRegion">{$smarty.const.SITE_CITY}</th>
				<th class="VRDate">{$smarty.const.FORM_DATE}</th>
				<th class="VRSallary">{$smarty.const.SITE_SALARY}</th>
			</tr>
			{foreach from=$last.resume item="resume"}
				<tr class="tr_hover openLink" title="{$smarty.const.SITE_BLOCK_LAST_RESUMES}: {$sections[$resume.id_section].name|escape}, {$resume.title|escape}">
					<td class="VRIcon"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/mainBodyTableVRIcon.gif"></td>
					<td class="VRDescr">
						<strong>{$sections[$resume.id_section].name}</strong><br>
						<a style="text-decoration: none" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=view&amp;id=`$resume.tId`")}" title="{$resume.title|escape}, {$sections[$resume.id_section].name|escape} - {$professions[$resume.id_profession].name|escape}{if $resume.id_profession_1} / {$professions[$resume.id_profession_1].name|escape}{/if}{if $resume.id_profession_2} / {$professions[$resume.id_profession_2].name|escape}{/if}, {$regions[$resume.id_region].name|escape}{if $resume.id_city} - {$citys[$resume.id_city].name|escape}{/if}, {$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$resume.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$resume.pay_from} {$resume.currency}">{$resume.title|escape|truncate:80}</a>
						<input type="hidden" class="gotoLink" value="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=view&amp;id=`$resume.tId`")}">
					</td>
					<td>{if $resume.id_city}{$citys[$resume.id_city].name|escape}{else}&nbsp;{/if}</td>
					<td class="VRDate">{$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</td>
					<td class="last VRSallary">{$resume.pay_from}&nbsp;{$resume.currency}</td>
				</tr>
			{/foreach}
			<tr>
				<td class="last AlignRight" colspan="5">
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume")}" title="{$smarty.const.SITE_BLOCK_LAST_RESUMES}">{$smarty.const.SITE_ALL} {$smarty.const.SITE_RESUME}...</a>
				</td>
			</tr>
		</table>
	</div>
{/if}