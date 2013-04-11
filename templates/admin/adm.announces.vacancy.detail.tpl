{*Детальный просмотр Вакансии*}
<table style="width: 100%; padding: 10px;" class="table_announce">
	<tr>
		<td style="width: 60%;">
			<p class="p_head" style="text-align: left;">{$vacancy.title}</p>
			<p class="p_name">
				<span style="font-weight: normal;">{$smarty.const.ANNOUNCE_SELECT_ACTPERIOD}&nbsp;{$smarty.const.SITE_WITH}:&nbsp;</span>
				{$vacancy.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;
				{$vacancy.act_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}&nbsp;
				<span style="font-weight: normal;">{$smarty.const.SITE_UPON}:&nbsp;</span>
				{$vacancy.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;
				{$vacancy.token_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}&nbsp;
				[{$vacancy.act_period}]
			</p>
			<p class="p_name">
				<span style="font-weight: normal;">{$smarty.const.ANNOUNCE_SELECT_REGION}:</span>&nbsp;
				{$regions[$vacancy.id_region].name|escape}{if $vacancy.id_city}&nbsp;/&nbsp;{$citys[$vacancy.id_city].name|escape}{/if}
			</p>
			<p class="p_name">
				<span style="font-weight: normal;">{$smarty.const.ANNOUNCE_SELECT_SECTION}:</span>&nbsp;
				{$sections[$vacancy.id_section].name}&nbsp;/&nbsp;{$professions[$vacancy.id_profession].name}
			</p>
		</td>
		<td style="width: 40%;" class="short_info">
			<p>
				{$smarty.const.ANNOUNCE_SUBCRIPTION}:&nbsp;
				{if $vacancy.subscription}
					<span style="font-weight: bold;">{$smarty.const.SITE_ISSET}</span>
				{else}
					<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
				{/if}
			</p>
			<p class="pVIP{$vacancy.id}">
				{$smarty.const.ANNOUNCE_STATUS_VIP}:&nbsp;
				{if $vacancy.vip && '0000-00-00 00:00:00' neq $vacancy.vip_unset_datetime}
					{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{$vacancy.vip_unset_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$vacancy.vip_unset_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetVIP.png" name="{$vacancy.id}" class="resetVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}">
				{elseif $vacancy.vip}
					<span style="font-weight: bold;">{$smarty.const.RECORD_PERMANENT}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetVIP.png" name="{$vacancy.id}" class="resetVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}">
				{else}
					<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setVIP.png" name="{$vacancy.id}" class="setVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}">
				{/if}
			</p>
			<p class="pHOT{$vacancy.id}">
				{$smarty.const.ANNOUNCE_STATUS_HOT}:&nbsp;
				{if $vacancy.hot && '0000-00-00 00:00:00' neq $vacancy.hot_unset_datetime}
					{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{$vacancy.hot_unset_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$vacancy.hot_unset_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetHOT.png" name="{$vacancy.id}" class="resetHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}">
				{elseif $vacancy.hot}
					<span style="font-weight: bold;">{$smarty.const.RECORD_PERMANENT}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetHOT.png" name="{$vacancy.id}" class="resetHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}">
				{else}
					<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setHOT.png" name="{$vacancy.id}" class="setHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}">
				{/if}
			</p>
			<p class="pRate{$vacancy.id}">
				{$smarty.const.ANNOUNCE_STATUS_RATE}:&nbsp;
				{if $vacancy.rate neq '0000-00-00 00:00:00'}
					{$smarty.const.ANNOUNCE_RATE_DATETIME}&nbsp;
					<span style="font-weight: bold;">{$vacancy.rate|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$vacancy.rate|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetRate.png" name="{$vacancy.id}" class="resetRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS_RATE_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS_RATE_VACANCY}">
				{else}
					<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
				{/if}
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setRate.png" name="{$vacancy.id}" class="setRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_VACANCY}" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_VACANCY}">
			</p>
			<p>{$smarty.const.ANNOUNCE_COUNT_VIEWS}:&nbsp;<span style="font-weight: bold;">{$vacancy.cnt_views_total}</span></p>
		</td>
	</tr>
	<tr>
		<td class="contacts_announce" colspan="2">
			<p class="p_name">
				<span style="font-weight: normal;">{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}:</span>&nbsp;
				{$vacancy.company_name}
			</p>
			<p class="p_head" style="text-align: left;">{$smarty.const.ANNOUNCE_CONTACTS_HEAD}</p>
			<div class="ext_subinfo">
				<p class="p_5">
					{$smarty.const.ANNOUNCE_CONTACTS_EMAIL}:
					<a href="mailto:{$vacancy.email}" class="mail_to">{$vacancy.email}</a>
					{if $vacancy.id_user}
						<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=detail&amp;id={$vacancy.id_user}" target="_blank">
							<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/user_info.png" style="margin-left: 10px;" alt="{$smarty.const.MENU_ACTION_VIEW}" title="{$smarty.const.ANNOUNCE_ACTION_USER_VIEW}">
						</a>
					{/if}
				</p>
				{if $vacancy.user_type eq 'agent'}
					<p class="p_5">
						{$smarty.const.ANNOUNCE_RADIOBOX_USER_TYPE_AGENT}:&nbsp;
						<span style="font-weight: bold;">{$vacancy.agent_name}</span>
					</p>
				{/if}
				<div class="p_5">
					{$smarty.const.ANNOUNCE_CONTACTS_PHONE}:&nbsp;<span style="font-weight: bold;">{$vacancy.phone}</span>&nbsp;
					{if $vacancy.note_phone}({$vacancy.note_phone}){/if}
					{if $vacancy.addition_phone_1 || $vacancy.addition_phone_2}
						<div class="ext_subinfo">
							<span style="font-weight: bold;">{$smarty.const.ANNOUNCE_CONTACTS_ADDITION_PHONES}</span>
							{if $vacancy.addition_phone_1}
								<div>
									{$vacancy.addition_phone_1}{if $vacancy.note_addition_phone_1}&nbsp;({$vacancy.note_addition_phone_1}){/if}
								</div>
							{/if}
							{if $vacancy.addition_phone_2}
								<div>
									{$vacancy.addition_phone_2}{if $vacancy.note_addition_phone_2}&nbsp;({$vacancy.note_addition_phone_2}){/if}
								</div>
							{/if}
						</div>
					{/if}
				</div>
				{if $vacancy.url}
					<p class="p_5">{$smarty.const.ANNOUNCE_CONTACTS_URL}:&nbsp;
						<a href="{$vacancy.url}" style="font-weight: bold;">{$vacancy.url}</a>
					</p>
				{/if}
				<p class="p_name">{$smarty.const.ANNOUNCE_CONTACTS_FIO}:&nbsp;
					{$vacancy.contacts_fio}
				</p>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p class="p_name">{$smarty.const.ANNOUNCE_PARAMS_TAB}&nbsp;{$smarty.const.FORM_VACANCYS_HEAD}</p>
			<div class="ext_subinfo">
				<p class="p_5">{$smarty.const.ANNOUNCE_PAY_HEAD}:&nbsp;{if $vacancy.pay_post}{$smarty.const.SITE_FROM}&nbsp;<span style="font-weight: bold;">{$vacancy.pay_from}</span>&nbsp;{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{$vacancy.pay_post}</span>{else}<span style="font-weight: bold;">{$vacancy.pay_from}</span>{/if}&nbsp;<span style="font-weight: bold;">{$vacancy.currency}</span></p>
				<p class="p_5">{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}:&nbsp;<span style="font-weight: bold;">{$vacancy.chart_work}</span></p>
				<p class="p_5">{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}:&nbsp;<span style="font-weight: bold;">{$vacancy.expire_work}</span></p>
				<p class="p_5">{$smarty.const.ANNOUNCE_SELECT_EDUCATION}:&nbsp;<span style="font-weight: bold;">{$vacancy.edu_work}</span></p>
				<p class="p_5">{$smarty.const.ANNOUNCE_SELECT_GENDER}:&nbsp;<span style="font-weight: bold;">{$arrSysDict.Gender.values[$vacancy.gender]}</span></p>
				{if $vacancy.age_from or $vacancy.age_post}
					<p class="p_5">{$smarty.const.ANNOUNCE_AGE}:{if $vacancy.age_from}&nbsp;{$smarty.const.SITE_FROM}&nbsp;<span style="font-weight: bold;">{$vacancy.age_from}</span>{/if}{if $vacancy.age_post}&nbsp;{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{$vacancy.age_post}</span>{/if}
					</p>
				{/if}
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p class="p_name">{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}</p>
			<div class="ext_subinfo">{$vacancy.company_discription}</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p class="p_name">{$smarty.const.ANNOUNCE_TEXTAREA_REQUIREMENTS}</p>
			<div class="ext_subinfo">{$vacancy.requirements}</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p class="p_name">{$smarty.const.ANNOUNCE_TEXTAREA_DUTESWORK}</p>
			<div class="ext_subinfo">{$vacancy.duties_work}</div>
		</td>
	</tr>
	{if $vacancy.conditions_work}
	<tr>
		<td colspan="2">
			<p class="p_name">{$smarty.const.ANNOUNCE_TEXTAREA_CONDITIONS_WORK}</p>
			<div class="ext_subinfo">{$vacancy.conditions_work}</div>
		</td>
	</tr>
	{/if}
	{if $vacancy.ext_info}
	<tr>
		<td colspan="2">
			<p class="p_name">{$smarty.const.ANNOUNCE_TEXTAREA_EXT_INFO}</p>
			<div class="ext_subinfo">{$vacancy.ext_info}</div>
		</td>
	</tr>
	{/if}
	{if $vacancy.meta_keywords}
		<tr>
			<td colspan="2">
				<p class="p_name">{$smarty.const.ANNOUNCE_META_KEYWORDS}</p>
				<div class="ext_subinfo">{$vacancy.meta_keywords}</div>
			</td>
		</tr>
	{/if}
	{if $vacancy.meta_description}
		<tr>
			<td colspan="2">
				<p class="p_name">{$smarty.const.ANNOUNCE_META_DESCRIPTION}</p>
				<div class="ext_subinfo">{$vacancy.meta_description}</div>
			</td>
		</tr>
	{/if}
</table>