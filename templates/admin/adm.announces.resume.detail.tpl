<table style="width: 100%; padding: 10px;" class="table_announce">
	<tr>
        {if $resume.image}
            <td style="vertical-align: middle; padding: 5px;">
                <img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/photos/{$resume.image}" alt="" title="">
            </td>
        {/if}
		<td style="width: 60%;">
			<p class="p_head" style="text-align: left;">{$resume.title}</p>
			<p class="p_name">
				<span style="font-weight: normal;">{$smarty.const.ANNOUNCE_SELECT_REGION}:</span>&nbsp;
				{$regions[$resume.id_region].name|escape}{if $resume.id_city}&nbsp;/&nbsp;{$citys[$resume.id_city].name|escape}{/if}
			</p>
			<p class="p_name">
				<span style="font-weight: normal;">{$smarty.const.ANNOUNCE_SELECT_SECTION}:</span>&nbsp;
				{$sections[$resume.id_section].name}
			</p>
			<p class="p_name">
				<span style="font-weight: normal;">{$smarty.const.ANNOUNCE_SELECT_PROFESSION}:</span>&nbsp;
				{$professions[$resume.id_profession].name}
				{if $resume.id_profession_1}&nbsp;-&nbsp;{$professions[$resume.id_profession_1].name}{/if}
				{if $resume.id_profession_2}&nbsp;-&nbsp;{$professions[$resume.id_profession_2].name}{/if}
			</p>
		</td>
		<td style="width: 40%;" class="short_info">
			<p>
				{$smarty.const.ANNOUNCE_SUBCRIPTION}:&nbsp;
				{if $resume.subscription}
					<span style="font-weight: bold;">{$smarty.const.SITE_ISSET}</span>
				{else}
					<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
				{/if}
			</p>
			<p class="pVIP{$resume.id}">
				{$smarty.const.ANNOUNCE_STATUS_VIP}:&nbsp;
				{if $resume.vip && '0000-00-00 00:00:00' neq $resume.vip_unset_datetime}
					{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{$resume.vip_unset_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$resume.vip_unset_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetVIP.png" name="{$resume.id}" class="resetVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}">
				{elseif $resume.vip}
					<span style="font-weight: bold;">{$smarty.const.RECORD_PERMANENT}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetVIP.png" name="{$resume.id}" class="resetVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}">
				{else}
					<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setVIP.png" name="{$resume.id}" class="setVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}">
				{/if}
			</p>
			<p class="pHOT{$resume.id}">
				{$smarty.const.ANNOUNCE_STATUS_HOT}:&nbsp;
				{if $resume.hot && '0000-00-00 00:00:00' neq $resume.hot_unset_datetime}
					{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{$resume.hot_unset_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$resume.hot_unset_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetHOT.png" name="{$resume.id}" class="resetHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}">
				{elseif $resume.hot}
					<span style="font-weight: bold;">{$smarty.const.RECORD_PERMANENT}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetHOT.png" name="{$resume.id}" class="resetHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}">
				{else}
					<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setHOT.png" name="{$resume.id}" class="setHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}">
				{/if}
			</p>
			<p class="pRate{$resume.id}">
				{$smarty.const.ANNOUNCE_STATUS_RATE}:&nbsp;
				{if $resume.rate neq '0000-00-00 00:00:00'}
					{$smarty.const.ANNOUNCE_RATE_DATETIME}&nbsp;
					<span style="font-weight: bold;">{$resume.rate|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$resume.rate|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetRate.png" name="{$resume.id}" class="resetRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS_RATE_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS_RATE_RESUME}">
				{else}
					<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
				{/if}
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setRate.png" name="{$resume.id}" class="setRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}">
			</p>
			<p>{$smarty.const.ANNOUNCE_COUNT_VIEWS}:&nbsp;<span style="font-weight: bold;">{$resume.cnt_views_total}</span></p>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<p class="p_name">
				<span style="font-weight: normal;">{$smarty.const.ANNOUNCE_SELECT_ACTPERIOD}&nbsp;{$smarty.const.SITE_WITH}:&nbsp;</span>
				{$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;
				{$resume.act_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}&nbsp;
				<span style="font-weight: normal;">{$smarty.const.SITE_UPON}:&nbsp;</span>
				{$resume.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;
				{$resume.token_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}&nbsp;
				[{$resume.act_period}]
			</p>
		</td>
	</tr>
	<tr>
		<td class="contacts_announce" colspan="3">
			<p class="p_head" style="text-align: left;">{$smarty.const.ANNOUNCE_CONTACTS_HEAD}</p>
			<div class="ext_subinfo">
				<p class="p_5">
					{$smarty.const.ANNOUNCE_CONTACTS_EMAIL}:
					<a href="mailto:{$resume.email}" class="mail_to">{$resume.email}</a>
					{if $resume.id_user}
						<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=detail&amp;id={$resume.id_user}" target="_blank">
							<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/user_info.png" style="margin-left: 10px;" alt="{$smarty.const.MENU_ACTION_VIEW}" title="{$smarty.const.ANNOUNCE_ACTION_USER_VIEW}">
						</a>
					{/if}
				</p>
				{if $resume.user_type eq 'agent'}
					<p class="p_5">
						{$smarty.const.ANNOUNCE_RADIOBOX_USER_TYPE_AGENT}:&nbsp;
						<span style="font-weight: bold;">{$resume.agent_name}</span>
					</p>
				{/if}
				<div class="p_5">
					{$smarty.const.ANNOUNCE_CONTACTS_PHONE}:&nbsp;<span style="font-weight: bold;">{$resume.phone}</span>&nbsp;
					{if $resume.note_phone}({$resume.note_phone}){/if}
					{if $resume.addition_phone_1 || $resume.addition_phone_2}
						<div class="ext_subinfo">
							<span style="font-weight: bold;">{$smarty.const.ANNOUNCE_CONTACTS_ADDITION_PHONES}</span>
							{if $resume.addition_phone_1}
								<div>
									{$resume.addition_phone_1}{if $resume.note_addition_phone_1}&nbsp;({$resume.note_addition_phone_1}){/if}
								</div>
							{/if}
							{if $resume.addition_phone_2}
								<div>
									{$resume.addition_phone_2}{if $resume.note_addition_phone_2}&nbsp;({$resume.note_addition_phone_2}){/if}
								</div>
							{/if}
						</div>
					{/if}
				</div>
				<p class="p_name">{$smarty.const.ANNOUNCE_CONTACTS_FIO}:&nbsp;
					{$resume.first_name}&nbsp;{$resume.last_name}&nbsp;{$resume.middle_name}
				</p>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<p class="p_name">{$smarty.const.ANNOUNCE_PARAMS_TAB}&nbsp;{$smarty.const.FORM_RESUMES_HEAD}</p>
			<div class="ext_subinfo">
				<p class="p_5">{$smarty.const.ANNOUNCE_PAY_HEAD}:&nbsp;<span style="font-weight: bold;">{$resume.pay_from}</span></p>
				<p class="p_5">{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}:&nbsp;<span style="font-weight: bold;">{$resume.chart_work}</span></p>
				<p class="p_5">{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}:&nbsp;<span style="font-weight: bold;">{$resume.expire_work}</span></p>
				<p class="p_5">{$smarty.const.ANNOUNCE_SELECT_EDUCATION}:&nbsp;<span style="font-weight: bold;">{$resume.education}</span></p>
				<p class="p_5">{$smarty.const.ANNOUNCE_SELECT_GENDER}:&nbsp;<span style="font-weight: bold;">{$arrSysDict.Gender.values[$resume.gender]}</span></p>
				<p class="p_5">{$smarty.const.ANNOUNCE_AGE}:<span style="font-weight: bold;">{$resume.age}</span></p>
			</div>
		</td>
	</tr>
	{if $resume.educations}
		<tr>
			<td colspan="3" valign="top">
				<p class="p_head" style="text-align: left;">{$smarty.const.ANNOUNCE_EDUCATION_HEAD}</p>
				<div class="ext_subinfo">
					{foreach from=$resume.educations item="education" key="key" name="education"}
						<div style="padding: 10px 0px 10px 0px; {if $smarty.foreach.education.last}border-bottom: #000000 dashed 1px;{/if} border-top: #000000 dashed 1px;">
							<p class="p_5"><span class="p_name">{$smarty.const.ANNOUNCE_SELECT_EDUCATION_TYPE}:&nbsp;</span>{$education.type}</p>
							<p class="p_name">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_INSTITUTION}</p>
							<p class="p_5">{$education.institution}</p>
							<p class="p_name">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_DEGREE}</p>
							<p class="p_5">{$education.degree}</p>
							<p class="p_name">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_FINISH_DATE}:&nbsp;{$education.finish_month}&nbsp;{$education.finish_year}</p>
							{if $education.ext_info}
								<p class="p_name">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_EXTINFO}</p>
								<div class="ext_subinfo">{$education.ext_info}</div>
							{/if}
						</div>
					{/foreach}
				</div>
			</td>
		</tr>
	{/if}
	<tr>
		<td colspan="3" valign="top">
			<p class="p_head" style="text-align: left;">{$smarty.const.ANNOUNCE_EXPIREINFO_HEAD}</p>
			<div class="ext_subinfo">
				{if $resume.expires}
					{foreach from=$resume.expires item="expire" key="key" name="expire"}
						<div style="padding: 10px 0px 10px 0px; {if $smarty.foreach.expire.last}border-bottom: #000000 dashed 1px;{/if} border-top: #000000 dashed 1px;">
							<p class="p_name">{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}</p>
							<p class="p_5">{$expire.company}</p>
							{if $expire.company_discription}
								<p class="p_name">{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}</p>
								<div class="ext_subinfo">{$expire.company_discription}</div>
							{/if}
							<p class="p_name">{$smarty.const.ANNOUNCE_INPUT_EXPIRE_PERIOD}:&nbsp;{$expire.begin_month}&nbsp;{$expire.begin_year}&nbsp;-&nbsp;{if $expire.finish_month && $expire.finish_year}{$expire.finish_month}&nbsp;{$expire.finish_year}{else}{$smarty.const.ANNOUNCE_INPUT_EXPIRE_PERIOD_NOW}{/if}</p>
							<p class="p_name">{$smarty.const.ANNOUNCE_INPUT_EXPIRE_APPOINTMENT}:&nbsp;{$expire.appointment}</p>
							<p class="p_name">{$smarty.const.ANNOUNCE_TEXTAREA_EXPIRE_DUTIES_INFO}</p>
							<div class="ext_subinfo">{$expire.duties_info}</div>
						</div>
					{/foreach}
				{else}
					<p class="p_name">{$smarty.const.ANNOUNCE_INPUT_EXPIRE_CAREER_LAUNCH}</p>
				{/if}
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3" valign="top">
			<p class="p_head" style="text-align: left;">{$smarty.const.ANNOUNCE_LANGUAGES_HEAD}</p>
			<div class="ext_subinfo">
				{foreach from=$resume.languages item="language" key="key" name="language"}
					{if  $smarty.foreach.language.first} 
							<p class="p_name" style="padding: 10px 0px 10px 0px;">{$smarty.const.ANNOUNCE_INPUT_NATIVE_LANGUAGE}:&nbsp;<span class="p_5">{$language.lang}</span></p>
					{else}
						<div style="padding: 10px 0px 10px 0px; {if $smarty.foreach.language.last}border-bottom: #000000 dashed 1px;{/if} border-top: #000000 dashed 1px;">
							<p class="p_name">{$smarty.const.ANNOUNCE_INPUT_FOREIGN_LANGUAGE}:&nbsp;<span class="p_5">{$language.lang}</span></p>
							<p class="p_name">{$smarty.const.ANNOUNCE_SELECT_LANGUAGE_DEGREE}:&nbsp;<span class="p_5">{$language.degree}</span></p>
							{if $language.note}
								<p class="p_name">{$smarty.const.ANNOUNCE_TEXTAREA_LANGUAGE_NOTE}</p>
								<div class="ext_subinfo">{$language.note}</div>
							{/if}
						</div>
					{/if}
					{if $smarty.foreach.language.total eq 1}
						<p class="p_5">{$smarty.const.ANNOUNCE_INPUT_NOFOREIGN_LANGUAGE}</p>
					{/if}
				{/foreach}
			</div>
		</td>
	</tr>
	{if $resume.about_info}
	<tr>
		<td colspan="3">
			<p class="p_name">{$smarty.const.ANNOUNCE_TEXTAREA_EXT_INFO}</p>
			<div class="ext_subinfo">{$resume.about_info}</div>
		</td>
	</tr>
	{/if}
	{if $resume.meta_keywords}
		<tr>
			<td colspan="3">
				<p class="p_name">{$smarty.const.ANNOUNCE_META_KEYWORDS}</p>
				<div class="ext_subinfo">{$resume.meta_keywords}</div>
			</td>
		</tr>
	{/if}
	{if $resume.meta_description}
		<tr>
			<td colspan="3">
				<p class="p_name">{$smarty.const.ANNOUNCE_META_DESCRIPTION}</p>
				<div class="ext_subinfo">{$resume.meta_description}</div>
			</td>
		</tr>
	{/if}
</table>