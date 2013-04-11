{* Список Регионов *}
{if $action.regions}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=regions" method="post" enctype="multipart/form-data">
		<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
			<tbody class="data_body">
				{if $arrRegions}
					{foreach from=$arrRegions item="regions" name="regions"}
						<tr class="data_head">
							<td style="width: 80%;">{$smarty.const.TABLE_COLUMN_NAME}</td>
							<td>{$smarty.const.TABLE_COLUMN_SORT}</td>
						</tr>
						<tr>
							<td style="width: 80%;">
								<input type="text" name="region[{$regions.id}][arrBindFields][name]" size="100" value="{$regions.name}">
							</td>
							<td align="center">
								<input type="text" name="region[{$regions.id}][arrNoBindFields][sort]" value="{$regions.sort}" size="5" maxlength="3">
							</td>
						</tr>
						<tr>
							<td><input type="checkbox" class="addNewNoMajorRegion" name="region[{$regions.id}][arrNoBindFields][add_city_allowed]"{if $regions.major} disabled="disabled"{/if}{if $regions.add_city_allowed} checked="checked"{/if}>&nbsp;<strong>Разрешить пользователям сайта добавлять города</strong></td>
							<td><input type="checkbox" class="addNewMajorRegion" name="region[{$regions.id}][arrNoBindFields][major]"{if $regions.add_city_allowed} disabled="disabled"{/if}{if $regions.major} checked="checked"{/if}>&nbsp;<strong>Регион-Город</strong></td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.SITE_PAGE_TITLE}:</strong><br><br>
								<input type="text" name="region[{$regions.id}][arrNoBindFields][title]" value="{$regions.title}" size="150" maxlength="255">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.SITE_PAGE_META_KEYWORDS}:</strong><br><br>
								<input type="text" name="region[{$regions.id}][arrNoBindFields][meta_keywords]" value="{$regions.meta_keywords}" size="150" maxlength="255">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.SITE_PAGE_META_DESCRIPTION}:</strong><br><br>
								<textarea name="region[{$regions.id}][arrNoBindFields][meta_description]" rows="3" cols="100">{$regions.meta_description}</textarea>
							</td>
						</tr>
					{/foreach}
					</tbody>
					<tfoot class="data_foot">
						<tr>
							<td colspan="2" style="text-align: center;">
								<input type="hidden" name="action" value="edit">
								<input type="submit" name="save_regions" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button" style="margin: 5px; float: left;">
								<span style="vertical-align: bottom;">{$smarty.const.TABLE_RECORDS}&nbsp;{$smarty.foreach.regions.total}</span>
							</td>
						</tr>
					</tfoot>
				{else}
						<tr>
							<td align="center" colspan="2">
								{$smarty.const.TABLE_NOT_DATA}
							</td>
						</tr>
					</tbody>
				{/if}
		</table>
	</form>

<script type="text/javascript">
<!--
$(document).ready(function() {
    $('.addNewMajorRegion').click(function() {
        if ($(this).attr('checked')) {
            $(this).parent().prev().children().removeAttr('checked').attr('disabled', 'disabled');
        } else {
            $(this).parent().prev().children().removeAttr('disabled');
        }
    });
    $('.addNewNoMajorRegion').click(function() {
        if ($(this).attr('checked')) {
            $(this).parent().next().children().removeAttr('checked').attr('disabled', 'disabled');
        } else {
            $(this).parent().next().children().removeAttr('disabled');
        }
    });
});
-->
</script>

{* Список Городов *}
{elseif $action.citys}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=regions&amp;action=citys&amp;pid={$pid}" method="post" enctype="multipart/form-data">
		<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
			<tbody class="data_body">
				{if $arrCitys}
					{foreach from=$arrCitys item="citys" name="citys"}
						<tr class="data_head">
							<td style="width: 80%;">{$smarty.const.TABLE_COLUMN_NAME}</td>
							<td>{$smarty.const.TABLE_FORM_CAPITAL}</td>
						</tr>
						<tr>
							<td style="width: 80%;">
								<input type="text" name="city[{$citys.id}][arrBindFields][name]" size="150" value="{$citys.name}">
							</td>
							<td align="center">
								<input type="radio" name="capital_city" value="{$citys.id}"{if $citys.capital} checked="checked"{/if}>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.SITE_PAGE_TITLE}:</strong><br><br>
								<input type="text" name="city[{$citys.id}][arrNoBindFields][title]" value="{$citys.title}" size="200" maxlength="255">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.SITE_PAGE_META_KEYWORDS}:</strong><br><br>
								<input type="text" name="city[{$citys.id}][arrNoBindFields][meta_keywords]" value="{$citys.meta_keywords}" size="200" maxlength="255">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.SITE_PAGE_META_DESCRIPTION}:</strong><br><br>
								<textarea name="city[{$citys.id}][arrNoBindFields][meta_description]" rows="3" cols="150">{$citys.meta_description}</textarea>
							</td>
						</tr>
					{/foreach}
					</tbody>
					<tfoot class="data_foot">
						<tr>
							<td colspan="2" style="text-align: center;">
								<input type="hidden" name="action" value="edit">
								<input type="submit" name="save_citys" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button" style="margin: 5px; float: left;">
								<span style="vertical-align: bottom;">{$smarty.const.TABLE_RECORDS}&nbsp;{$smarty.foreach.citys.total}</span>
							</td>
						</tr>
					</tfoot>
				{else}
						<tr>
							<td align="center" colspan="2">
								{$smarty.const.TABLE_NOT_DATA}
							</td>
						</tr>
					</tbody>
				{/if}
		</table>
	</form>
{/if}