<div class="DesignMainPageBody">
	<table class="mainBodyTable" cellspacing="0">
		<tr>
			<th colspan="3">{$return_data.arrBindFields.title}</th>
		</tr>
		<tr class="noBorderBottom">
			<td class="noBorderRight AlignLeft" valign="top">
				<div class="paddingText5">
					<strong class="Header">{$smarty.now|date_format:"%d.%m.%Y %R"}</strong>
					<table class="paddingText5">
						<tr>
							<td><strong>{$smarty.const.ANNOUNCE_SELECT_REGION}:</strong></td>
							<td>{$regions[$return_data.arrBindFields.id_region].name|escape}{if $return_data.arrBindFields.id_city}&nbsp;/&nbsp;{$citys[$return_data.arrBindFields.id_city].name|escape}{/if}</td>
						</tr>
						<tr>
							<td><strong>{$smarty.const.ANNOUNCE_SELECT_SECTION}:</strong></td>
							<td>{$sections[$return_data.arrBindFields.id_section].name}</td>
						</tr>
					</table>
					<br>
					<strong class="Header">{$smarty.const.ANNOUNCE_CONTACTS_PERSON}:</strong>
					<table class="paddingTextWBottom5">
						<tr>
							<td><strong>{$smarty.const.ANNOUNCE_CONTACTS_LASTNAME}:</strong></td>
							<td>{$return_data.arrBindFields.last_name}</td>
						</tr>
						<tr>
							<td><strong>{$smarty.const.ANNOUNCE_CONTACTS_FIRSTNAME}:</strong></td>
							<td>{$return_data.arrBindFields.first_name}</td>
						</tr>
						{if $return_data.arrNoBindFields.middle_name}
							<tr>
								<td><strong>{$smarty.const.ANNOUNCE_CONTACTS_MIDDLENAME}:</strong></td>
								<td>{$return_data.arrNoBindFields.middle_name}</td>
							</tr>
						{/if}
					</table>
				</div>
			</td>

			<td class="noBorderLeft last AlignRight" valign="top">
				<div class="paddingText5">
					<div class="InfoBlockWrapper">
						<div class="withoutHeader"></div>
						<div class="InfoBlock"><div>
						<table>
							<tr>
								<td style="width:150px;"><strong>{$smarty.const.ANNOUNCE_SELECT_ACTPERIOD}:</strong></td>
								<td>{$arrSysDict.ActPeriod.values[$return_data.arrBindFields.act_period]}</td>
							</tr>
							{if $return_data.arrNoBindFields.subscription}
								<tr>
									<td colspan="2">
										<input type="checkbox" class="input" checked="checked" disabled="disabled">&nbsp;{$smarty.const.ANNOUNCE_CHECKBOX_SUBCRIPTION_ON}
									</td>
								</tr>
							{/if}
							<tr>
								<td colspan="2"><hr></td>
							</tr>
							<tr>
								<td><strong>{$smarty.const.ANNOUNCE_PAY_HEAD}:</strong></td>
								<td>{$return_data.arrBindFields.pay_from}&nbsp;{$return_data.arrBindFields.currency}</td>
							</tr>
							<tr>
								<td><strong>{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}:</strong></td>
								<td>{$return_data.arrNoBindFields.chart_work}</td>
							</tr>
							<tr>
								<td><strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION}:</strong></td>
								<td>{$return_data.arrBindFields.education}</td>
							</tr>
							<tr>
								<td><strong>{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}:</strong></td>
								<td>{$return_data.arrBindFields.expire_work}</td>
							</tr>
							<tr>
								<td><strong>{$smarty.const.ANNOUNCE_SELECT_GENDER}:</strong></td>
								<td>{$arrSysDict.Gender.values[$return_data.arrBindFields.gender]}</td>
							</tr>
							<tr>
								<td><strong>{$smarty.const.ANNOUNCE_AGE}:</strong></td>
								<td>{$return_data.arrBindFields.age}</td>
							</tr>
						</table>
						</div></div>
					</div>
				</div>
			</td>
		</tr>
{* ----------------------------------- *}
		<tr class="noBorderTop">
			<td colspan="3" class="AlignLeft last">
				{if $return_data.arrFieldsXmlData.educations}
					<hr class="Design_panesDelimiter" style="margin-bottom:20px;">
					<div class="paddingText5">
						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
						<strong class="Header">{$smarty.const.ANNOUNCE_EDUCATION_HEAD}</strong>
						{foreach from=$return_data.arrFieldsXmlData.educations item="education" key="key" name="education"}
							<div class="InfoBlockWrapper" style="margin-top: 10px;">
								<div class="withoutHeader"></div>
								<div class="InfoBlock">
									<div>
										<table class="Design_panesFormTable">
											<tr>
												<td>
													<strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION_TYPE}:</strong>
													{$education.arrBindFields.type}
												</td>
											</tr>
											<tr>
												<td>
													<strong>{$smarty.const.ANNOUNCE_INPUT_EDUCATION_INSTITUTION}:</strong>
													{$education.arrBindFields.institution}
												</td>
											</tr>
											<tr>
												<td>
													<strong>{$smarty.const.ANNOUNCE_INPUT_EDUCATION_DEGREE}:</strong>
													{$education.arrBindFields.degree}
												</td>
											</tr>
											<tr>
												<td>
													<strong>{$smarty.const.ANNOUNCE_INPUT_EDUCATION_FINISH_DATE}:</strong>
													{$education.arrBindFields.finish_month}&nbsp;{$education.arrBindFields.finish_year}
												</td>
											</tr>
											{if $education.arrNoBindFields.ext_info}
												<tr>
													<td>
														<strong>{$smarty.const.ANNOUNCE_INPUT_EDUCATION_EXTINFO}:</strong>
														<div style="margin:5px 10px;">{$education.arrNoBindFields.ext_info}</div>
													</td>
												</tr>
											{/if}
										</table>
									</div>
								</div>
							</div>
						{/foreach}
					</div>
				{/if}
{* ----------------------------------- *}
				<hr class="Design_panesDelimiter" style="margin-bottom:20px;">
				<div class="paddingText5">
					<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
					<strong class="Header">{$smarty.const.ANNOUNCE_EXPIREINFO_HEAD}</strong>
					{if $return_data.arrFieldsXmlData.expires}
						{foreach from=$return_data.arrFieldsXmlData.expires item="expire" key="key" name="expire"}
							<div class="InfoBlockWrapper" style="margin-top: 10px;">
								<div class="withoutHeader"></div>
								<div class="InfoBlock">
									<div>
										<table class="Design_panesFormTable">
											<tr>
												<td><strong>{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}:</strong>&nbsp;{$expire.arrBindFields.company}</td>
											</tr>
											{if $expire.arrNoBindFields.company_discription}
												<tr>
													<td><strong>{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}:</strong>&nbsp;{$expire.arrNoBindFields.company_discription}</td>
												</tr>
											{/if}
											<tr>
												<td><strong>{$smarty.const.ANNOUNCE_INPUT_EXPIRE_PERIOD}:</strong>&nbsp;{$expire.arrBindFields.begin_month}&nbsp;{$expire.arrBindFields.begin_year}&nbsp;-&nbsp;{if $expire.arrNoBindFields.finish_month && $expire.arrNoBindFields.finish_year}{$expire.arrNoBindFields.finish_month}&nbsp;{$expire.arrNoBindFields.finish_year}{else}{$smarty.const.ANNOUNCE_INPUT_EXPIRE_PERIOD_NOW}{/if}</td>
											</tr>
											<tr>
												<td><strong>{$smarty.const.ANNOUNCE_INPUT_EXPIRE_APPOINTMENT}:</strong>&nbsp;{$expire.arrBindFields.appointment}</td>
											</tr>
											<tr>
												<td><strong>{$smarty.const.ANNOUNCE_TEXTAREA_EXPIRE_DUTIES_INFO}:</strong><div style="margin:5px 10px;">{$expire.arrBindFields.duties_info}</div></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						{/foreach}
					{else}
						<table class="paddingTextWBottom5">
							<tr>
								<td><strong>{$smarty.const.ANNOUNCE_INPUT_EXPIRE_CAREER_LAUNCH}</strong></td>
							</tr>
						</table>
					{/if}
				</div>
{* ----------------------------------- *}
				<hr class="Design_panesDelimiter" style="margin-bottom:20px;">
				<div class="paddingText5">
					<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
					<strong class="Header">{$smarty.const.ANNOUNCE_LANGUAGES_HEAD}</strong>
					{foreach from=$return_data.arrFieldsXmlData.languages item="language" key="key" name="language"}
							<div class="InfoBlockWrapper" style="margin-top: 10px;">
								<div class="withoutHeader"></div>
								<div class="InfoBlock">
									<div>
										<table class="Design_panesFormTable">
											{if  $smarty.foreach.language.first}
												<tr>
													<td><strong>{$smarty.const.ANNOUNCE_INPUT_NATIVE_LANGUAGE}:</strong>&nbsp;{$language.arrBindFields.lang}</td>
												</tr>
											{else}
												<tr>
													<td><strong>{$smarty.const.ANNOUNCE_INPUT_FOREIGN_LANGUAGE}:</strong>&nbsp;{$language.arrBindFields.lang}</td>
												</tr>
												<tr>
													<td><strong>{$smarty.const.ANNOUNCE_SELECT_LANGUAGE_DEGREE}:</strong>&nbsp;{$language.arrBindFields.degree}</td>
												</tr>
												{if $language.arrNoBindFields.note}
													<tr>
														<td><strong>{$smarty.const.ANNOUNCE_TEXTAREA_LANGUAGE_NOTE}:</strong>&nbsp;<div style="margin:5px 10px;">{$language.arrNoBindFields.note}</div></td>
													</tr>
												{/if}
											{/if}
											{if $smarty.foreach.language.total eq 1}
												<tr>
													<td><strong>{$smarty.const.ANNOUNCE_INPUT_NOFOREIGN_LANGUAGE}</strong></td>
												</tr>
											{/if}
										</table>
									</div>
								</div>
							</div>
					{/foreach}
				</div>
{* ----------------------------------- *}
				{if $return_data.arrNoBindFields.about_info}
					<hr class="Design_panesDelimiter" style="margin-bottom:20px;">
					<div class="paddingText5">
						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
						<strong class="Header">{$smarty.const.ANNOUNCE_TEXTAREA_ABOUTINFO}</strong>
						<div style="margin:10px 10px 20px 10px;">{$return_data.arrNoBindFields.about_info}</div>
					</div>
				{/if}
{* ----------------------------------- *}
				<hr class="Design_panesDelimiter" style="margin-bottom:20px;">
				<div class="paddingText5">
					<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
					<strong class="Header">{$smarty.const.ANNOUNCE_CONTACTS_HEAD}</strong>
					<table class="paddingTextWBottom5">
						<tr>
                            {if $return_data.arrNoBindFields.image}
                                <td class="noBorderRight AlignLeft" rowspan="3" style="vertical-align: middle; padding: 5px;">
                                    <img src="{$smarty.const.CONF_SCRIPT_URL}uploads/temporary/{$return_data.arrNoBindFields.image}" alt="" title="">
                                </td>
                            {/if}
							<td>
								<strong>{$smarty.const.ANNOUNCE_CONTACTS_EMAIL}:</strong>
								<span class="mailto" style="cursor: default;">
									{if $return_data.arrNoBindFields.public_email}{$return_data.arrBindFields.email}{else}{$smarty.const.SITE_HIDDEN}{/if}
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<strong>{$smarty.const.ANNOUNCE_CONTACTS_PHONE}:</strong>&nbsp;{$return_data.arrBindFields.phone}&nbsp;
								{if $return_data.arrNoBindFields.note_phone}&nbsp;<span style="font-style: italic;">( {$return_data.arrNoBindFields.note_phone} )</span>{/if}
							</td>
						</tr>
						{if $return_data.arrNoBindFields.addition_phone_1 || $return_data.arrNoBindFields.addition_phone_2}
							<tr>
								<td>
									<strong>{$smarty.const.ANNOUNCE_CONTACTS_ADDITION_PHONES}:</strong>
									<div style="margin:5px 10px;">
										{if $return_data.arrNoBindFields.addition_phone_1}
											<div>
												{$return_data.arrNoBindFields.addition_phone_1}
												{if $return_data.arrNoBindFields.note_addition_phone_1}&nbsp;<span style="font-style: italic;">( {$return_data.arrNoBindFields.note_addition_phone_1} )</span>{/if}
											</div>
										{/if}
										{if $return_data.arrNoBindFields.addition_phone_2}
											<div>
												{$return_data.arrNoBindFields.addition_phone_2}
												{if $return_data.arrNoBindFields.note_addition_phone_2}&nbsp;<span style="font-style: italic;">( {$return_data.arrNoBindFields.note_addition_phone_2} )</span>{/if}
											</div>
										{/if}
									</div>
								</td>
							</tr>
						{/if}
					</table>
				</div>
{* ----------------------------------- *}
			</td>
		</tr>
		<tr class="noBorderTop">
			<td class="AlignCenter last" colspan="3">
				<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=$currAction")}" method="post" enctype="multipart/form-data">
					{foreach from=$return_data.hidden_fields item="valField" key="keyValue"}
						<input type="hidden" name="{$keyValue}" value="{$valField}">
					{/foreach}
					<input type="hidden" name="hprofessions" value="{$hprofessions}">
					<input type="hidden" name="career_launch" value="{$career_launch}">
					<input type="hidden" name="noforeign_lang" value="{$noforeign_lang}">
					<input type="hidden" name="agreement" value="{$agreement}">
					{if 'edit' eq $currAction}<input type="hidden" name="unikey" value="{$unikey}">{/if}
					<table class="Design_panesFormTable">
						<tr>
                       		<td>
								<div class="submitButtonLight"><input type="submit" class="shadow01red" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}"></div>
                       		</td>
                       		<td>
								<div class="submitButtonLight"><input type="submit" class="shadow01red" name="correction" value="{$smarty.const.FORM_BUTTON_EDIT}"></div>
                       		</td>
                       	</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
</div>