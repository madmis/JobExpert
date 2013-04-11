<form id="subscr" action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=subscriptions&amp;action=payment" method="post">
<table class="dataTable100">
	<thead>
		<tr>
			<td>{$smarty.const.TABLE_COLUMN_USER_ID}</td>
			<td>{$smarty.const.TABLE_COLUMN_EMAIL}</td>
			<td>{$smarty.const.TABLE_COLUMN_TYPE}</td>
			<td>{$smarty.const.TABLE_COLUMN_SECTION}</td>
			<td>{$smarty.const.TABLE_COLUMN_PROFESSION}</td>
			<td>{$smarty.const.TABLE_COLUMN_REGION}</td>
			<td>{$smarty.const.TABLE_COLUMN_CITY}</td>
			<td>{$smarty.const.TABLE_COLUMN_END}</td>
			<td>{$smarty.const.TABLE_COLUMN_PERIOD}</td>
			<td><input type="checkbox" class="checked_all"></td>
		</tr>
	</thead>
	<tbody>
{if $arrSubscr}
	{foreach from=$arrSubscr item="subscr" name="i"}
		<tr>
			<td class="alignCenter">{$subscr.id_user}</td>
			<td class="alignCenter">{$subscr.email}</td>
			<td class="alignCenter">{if $subscr.type_subscription eq 'vacancy'}{$smarty.const.FORM_VACANCYS_HEAD}{else}{$smarty.const.FORM_RESUMES_HEAD}{/if}</td>
			<td class="alignCenter">{$sections[$subscr.id_section].name}</td>
			<td class="alignCenter">{if !$subscr.id_profession}{$smarty.const.SITE_ALL}{else}{$professions[$subscr.id_profession].name}{/if}</td>
			<td class="alignCenter">{$regions[$subscr.id_region].name|escape}</td>
			<td class="alignCenter">{if !$subscr.id_city}{$smarty.const.SITE_ALL}{else}{$citys[$subscr.id_city].name|escape}{/if}</td>
			<td class="alignCenter">{if $subscr.token_datetime neq '0000-00-00 00:00:00'}{$subscr.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}{else}-----{/if}</td>
			<td class="alignCenter">{$subscr.period}</td>
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
					<option value="activate">{$smarty.const.FORM_ACTION_ACTIVATE_SELECTED}</option>
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
