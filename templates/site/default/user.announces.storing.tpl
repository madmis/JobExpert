<div id="openStoringAnn_{$return_data.id}">
	<h2 style="margin-left: 10px;">
		"{$return_data.title|escape}" - {$sections[$return_data.id_section].name} - {$regions[$return_data.id_region].name|escape}{if $return_data.id_city} - {$citys[$return_data.id_city].name|escape}{/if}
	</h2>
	<h3 style="margin-left: 10px;">
		{$smarty.const.ANNOUNCE_STORING_VIEWS_DETAIL_HEAD}:
	</h3>
	{foreach from=$return_data.storing item="storngData" name="storngData"}
		<div class="DesignMainPageBody">
			<table class="mainBodyTable" cellspacing="0">
				<tr>
					<th colspan="2" class="CompanyName">
						<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=companies&amp;action=detail&amp;id=`$storngData.tId`")}" title="{$storngData.company_name|escape}">
							{$storngData.company_name} {if $storngData.company_city}[{$storngData.company_city}]{/if}
						</a>
						<span style="float: right;">{$smarty.const.ANNOUNCE_STORING_VIEWS_DETAIL_DATE}:&nbsp;{$storngData.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$storngData.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
					</th>
				</tr>
				<tr>
					<td class="CompanyLogo">
						<br>
						<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=companies&amp;action=detail&amp;id=`$storngData.tId`")}" title="{$storngData.company_name|escape}">
							{if $storngData.logo}
								<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/thumbs/thumb_{$storngData.logo}" alt="{$storngData.company_name|escape}">
							{else}
								<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/not_logo.png" alt="{$storngData.company_name|escape}">
							{/if}
						</a>
					</td>
					<td class="last AlignLeft" style="padding: 10px;">
						{* Если включено использование виз. редактора, вставляем без изменений *}
						{if $smarty.const.CONF_USE_VISUAL_EDITOR AND $smarty.const.CONF_COMPANIES_USE_VISUAL_EDITOR}
							{$storngData.company_description}
						{else}
							{$storngData.company_description|nl2br}
						{/if}
					</td>
				</tr>
				<tr>
					<td class="last AlignRight" colspan="2">
						<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=companies&amp;action=detail&amp;id=`$storngData.tId`")}" title="{$smarty.const.SITE_COMPANY_VACANCY}&nbsp;{$storngData.company_name|escape}">{$smarty.const.SITE_COMPANY_VACANCY}...</a>
					</td>
				</tr>
			</table>
		</div>
	{/foreach}
</div>