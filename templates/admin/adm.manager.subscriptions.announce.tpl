{* ФОРМА ОТБОРА *}
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=subscriptions&amp;action=announce" method="get">
<input type="hidden" name="m" value="manager">
<input type="hidden" name="s" value="subscriptions">
<input type="hidden" name="action" value="announce">
<input type="hidden" name="do" value="filter">
<table style="width: 100%;" cellspacing="0" class="otbor_table">
	<thead class="otbor_head" id="subscr_ann">
		<tr><td>{$smarty.const.TABLE_FORM_SELECTION}</td></tr>
	</thead>
	<tbody>
		<tr>
			<td align="left" style="width: 100%;">
				<table style="width: 100%;" cellpadding="5" class="hidden_table" id="subscr_ann_otbor">
					<tbody class="otbor_body">
						<tr>
							<td>
								{$smarty.const.TABLE_COLUMN_ANNOUNCE_ID} <input type="text" name="id_announce" size="5" value="{$return_data.id_announce}">
							</td>
							<td>
								{$smarty.const.TABLE_COLUMN_USER_ID} <input type="text" name="id_user" size="5" value="{$return_data.id_user}">
							</td>
							<td>
								{$smarty.const.TABLE_COLUMN_TYPE}:  
								<input type="radio" name="type_subscription" value="vacancy" {if $return_data.type_subscription eq 'vacancy'}checked{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
								<input type="radio" name="type_subscription" value="resume" {if $return_data.type_subscription eq 'resume'}checked{/if}> {$smarty.const.FORM_RESUMES_HEAD}
								<input type="radio" name="type_subscription" value="all" {if $return_data.type_subscription neq 'vacancy' AND $return_data.type_subscription neq 'resume'}checked{/if}> {$smarty.const.FORM_IMP}
							</td>
						</tr>
						<tr>
							<td colspan="2">
								{$smarty.const.TABLE_COLUMN_SECTION}
								<select name="id_section" id="section">
									<option value="">{$smarty.const.SITE_ALL}</option>
									{foreach from=$sections item="section"}
									<option value="{$section.id}" {if $return_data.id_section eq $section.id}selected{/if}>{$section.name}</option>
									{/foreach}
								</select>
							</td>
							<td>
								{$smarty.const.TABLE_COLUMN_PROFESSION}
								<select name="id_profession" id="profession">
									<option value="">{$smarty.const.SITE_ALL}</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								{$smarty.const.TABLE_COLUMN_REGION}
								<select name="id_region" id="region">
									<option value="">{$smarty.const.SITE_ALL}</option>
									{foreach from=$regions item="region"}
									<option value="{$region.id}" {if $return_data.id_region eq $region.id}selected{/if}>{$region.name}</option>
									{/foreach}
								</select>
							</td>
							<td>
								{$smarty.const.TABLE_COLUMN_CITY}
								<select name="id_city" id="city">
									<option value="">{$smarty.const.SITE_ALL}</option>
								</select>
							</td>
						</tr>
					</tbody>
					<tfoot class="otbor_foot">
						<tr>
							<td colspan="3"><input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></td>
							<input type="hidden" id="selector" value="">
							<input type="hidden" id="hcity" value="{$return_data.id_city}">
							<input type="hidden" id="hprofession" value="{$return_data.id_profession}">
						</tr>
					</tfoot>
				</table>
			</td>
		</tr>
	</tbody>
</table>
</form>

{* СПИСОК ПОДПИСОК *}
<form id="subscr" action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=subscriptions&amp;action=announce" method="post">
<table class="dataTable100">
	<thead>
		<tr>
			<td>{$smarty.const.TABLE_COLUMN_ANNOUNCE_ID}</td>
			<td>{$smarty.const.TABLE_COLUMN_USER_ID}</td>
			<td>{$smarty.const.TABLE_COLUMN_EMAIL}</td>
			<td>{$smarty.const.TABLE_COLUMN_TYPE}</td>
			<td>{$smarty.const.TABLE_COLUMN_SECTION}</td>
			<td>{$smarty.const.TABLE_COLUMN_PROFESSION}</td>
			<td>{$smarty.const.TABLE_COLUMN_REGION}</td>
			<td>{$smarty.const.TABLE_COLUMN_CITY}</td>
			<td>{$smarty.const.TABLE_COLUMN_END}</td>
			<td>{$smarty.const.TABLE_COLUMN_DATE_LASTSEND}</td>
			<td><input type="checkbox" class="checked_all"></td>
		</tr>
	</thead>
	<tbody>
{if $arrSubscr}
	{foreach from=$arrSubscr item="subscr" name="i"}
		<tr>
			<td class="alignCenter">{$subscr.id_announce}</td>
			<td class="alignCenter">{$subscr.id_user}</td>
			<td class="alignCenter">{$subscr.email}</td>
			<td class="alignCenter">{if $subscr.type_subscription eq 'vacancy'}{$smarty.const.FORM_VACANCYS_HEAD}{else}{$smarty.const.FORM_RESUMES_HEAD}{/if}</td>
			<td class="alignCenter">{if $subscr.id_section}{$sections[$subscr.id_section].name}{/if}</td>
			<td class="alignCenter">
				{if !$subscr.id_profession}{$smarty.const.SITE_ALL}{else}
					<p>{$professions[$subscr.id_profession].name}</p>
					{if $subscr.id_profession_1}<p>{$professions[$subscr.id_profession_1].name}</p>{/if}
					{if $subscr.id_profession_2}<p>{$professions[$subscr.id_profession_2].name}</p>{/if}
				{/if}					
			</td>
			<td class="alignCenter">{if $subscr.id_region}{$regions[$subscr.id_region].name|escape}{/if}</td>
			<td class="alignCenter">{if !$subscr.id_city}{$smarty.const.SITE_ALL}{else}{$citys[$subscr.id_city].name|escape}{/if}</td>
			<td class="alignCenter">{if $subscr.token_datetime neq '0000-00-00 00:00:00'}{$subscr.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}{else}-----{/if}</td>
			<td class="alignCenter">{if $subscr.date_lastsend neq '0000-00-00'}{$subscr.date_lastsend|date_format:$smarty.const.CONF_DATE_FORMAT}{else}-----{/if}</td>
			<td class="alignCenter"><input type="checkbox" name="subscr[{$subscr.id}]" class="checkbox_entry"></td>
		</tr>
	{/foreach}
	</tbody>
	<tfoot>
		<tr>
			<td colspan="15" class="alignCenter">
				{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}/{$allRecords}
				<span style="float: right;">
				<select name="action" class="select">
					<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
					<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
				</select>
				<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
				</span>
			</td>
		</tr>
	</tfoot>
{else}
		<tr>
			<td class="alignCenter" colspan="15">{$smarty.const.TABLE_NOT_DATA}</td>
		</tr>
	</tbody>
{/if}
</table>
</form>

<p class="alignCenter">{$strPages}</p>