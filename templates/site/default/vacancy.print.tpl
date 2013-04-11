<p><a href="javascript:window.print();"><img alt="{$smarty.const.ANNOUNCE_SEND_TO_PRINT}" title="{$smarty.const.ANNOUNCE_SEND_TO_PRINT}" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/print_16.png" /></a>&nbsp;<span class="printHead">{$return_data.title}&nbsp;-&nbsp;{$return_data.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</span></p>
<table>
	<tr>
		<td style="vertical-align: top; padding-right: 20px;">
			<table>
				<tr>
					<td><strong>{$smarty.const.ANNOUNCE_SELECT_REGION}:</strong></td><td>{$regions[$return_data.id_region].name|escape}{if $return_data.id_city}&nbsp;/&nbsp;{$citys[$return_data.id_city].name|escape}{/if}</td>
				</tr>
				<tr>
					<td><strong>{$smarty.const.ANNOUNCE_SELECT_SECTION}:</strong></td><td>{$sections[$return_data.id_section].name}&nbsp;/&nbsp;{$professions[$return_data.id_profession].name}</td>
				</tr>
				<tr>
					<td colspan="2"><strong>{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}:</strong>&nbsp;{$return_data.company_name}</td>
				</tr>
				{if $return_data.url}
					<tr>
						<td colspan="2">
							<strong>{$smarty.const.ANNOUNCE_CONTACTS_URL}:</strong>&nbsp;
							{if $smarty.const.CONF_USE_REDIRECT_EXTERNAL_LINK}
								<a href="{$smarty.const.CONF_SCRIPT_URL}index.php?redirect={$return_data.url}" target="_blank" title="{$smarty.const.FORM_TYPE_COMPANY} - {$return_data.company_name}">{$return_data.url}</a>
							{else}
								<a href="{$return_data.url}" rel="nofollow" title="{$smarty.const.FORM_TYPE_COMPANY} - {$return_data.company_name}">{$return_data.url}</a>
							{/if}
						</td>
					</tr>
				{/if}
			</table>
		</td>
		<td style="vertical-align: top;">
			<table>
				<tr>
					<td>
						<strong>{$smarty.const.ANNOUNCE_PAY_HEAD}:</strong>
						{if $return_data.pay_post}
							{$smarty.const.SITE_FROM}&nbsp;{$return_data.pay_from}&nbsp;{$smarty.const.SITE_UNTO}&nbsp;{$return_data.pay_post}
						{else}
							{$return_data.pay_from}
						{/if}
						{$return_data.currency}
					</td>
				</tr>
				<tr>
					<td><strong>{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}:</strong>&nbsp;{$return_data.chart_work}</td>
				</tr>
				<tr>
					<td><strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION}:</strong>&nbsp;{$return_data.edu_work}</td>
				</tr>
				<tr>
					<td><strong>{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}:</strong>&nbsp;{$return_data.expire_work}</td>
				</tr>
				<tr>
					<td><strong>{$smarty.const.ANNOUNCE_SELECT_GENDER}:</strong>&nbsp;{$arrSysDict.Gender.values[$return_data.gender]}</td>
				</tr>
				{if $return_data.age_from or $return_data.age_post}
				<tr>
					<td><strong>{$smarty.const.ANNOUNCE_AGE}:</strong>&nbsp;
						{if $return_data.age_from}{$smarty.const.SITE_FROM}&nbsp;{$return_data.age_from}{/if}
						{if $return_data.age_post}{$smarty.const.SITE_UNTO}&nbsp;{$return_data.age_post}{/if}
					</td>
				</tr>
				{/if}
			</table>
		</td>
	</tr>
</table>
<hr style="color: #C1C1C1;" noshade="noshade" size="1">
<table>
	<tr><td><strong>{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}:</strong></td></tr>
	<tr><td style="padding: 0px 0px 20px 20px;">{$return_data.company_discription}</td></tr>

	<tr><td><strong>{$smarty.const.ANNOUNCE_TEXTAREA_REQUIREMENTS}:</strong></td></tr>
	<tr><td style="padding: 0px 0px 20px 20px;">{$return_data.requirements}</td></tr>

	<tr><td><strong>{$smarty.const.ANNOUNCE_TEXTAREA_DUTESWORK}:</strong></td></tr>
	<tr><td style="padding: 0px 0px 20px 20px;">{$return_data.duties_work}</td></tr>

	{if $return_data.conditions_work}
	<tr><td><strong>{$smarty.const.ANNOUNCE_TEXTAREA_CONDITIONS_WORK}:</strong></td></tr>
	<tr><td style="padding: 0px 0px 20px 20px;">{$return_data.conditions_work}</td></tr>
	{/if}

	{if $return_data.ext_info}
	<tr><td><strong>{$smarty.const.ANNOUNCE_TEXTAREA_EXT_INFO}:</strong></td></tr>
	<tr><td style="padding: 0px 0px 20px 20px;">{$return_data.ext_info}</td></tr>
	{/if}
</table>
<hr style="color: #C1C1C1;" noshade="noshade" size="1">
<table>
	<tr>
		<td>
			<strong>{$smarty.const.ANNOUNCE_CONTACTS_FIO}:</strong>&nbsp;{$return_data.contacts_fio}
		</td>
	</tr>
	{if $return_data.public_email}
	<tr>
		<td>
			<a href="mailto:{$return_data.email}" class="mailto" title="{$smarty.const.FORM_SEND_EMAIL}" rel="nofollow">{$return_data.email}</a>
		</td>
	</tr>
	{/if}
</table>
<table>
	<tr>
		<td>
			<strong>{$smarty.const.ANNOUNCE_CONTACTS_PHONE}:</strong>&nbsp;{$return_data.phone}&nbsp;
			{if $return_data.note_phone}(<span style="font-style: italic;">{$return_data.note_phone}</span>){/if}
		</td>
	</tr>
	{if $return_data.addition_phone_1 || $return_data.addition_phone_2}
	<tr>
		<td>
			<strong>{$smarty.const.ANNOUNCE_CONTACTS_ADDITION_PHONES}:</strong>
			<div style="margin:5px 10px;">
				{if $return_data.addition_phone_1}
					<div>
						{$return_data.addition_phone_1}
						{if $return_data.note_addition_phone_1}&nbsp;<span style="font-style: italic;">( {$return_data.note_addition_phone_1} )</span>{/if}
					</div>
				{/if}
				{if $return_data.addition_phone_2}
					<div>
						{$return_data.addition_phone_2}
						{if $return_data.note_addition_phone_2}&nbsp;<span style="font-style: italic;">( {$return_data.note_addition_phone_2} )</span>{/if}
					</div>
				{/if}
			</div>
		</td>
	</tr>
	{/if}
</table>
