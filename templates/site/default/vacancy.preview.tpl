<div class="DesignMainPageBody">
	<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
		<tr>
			<th colspan="2">{$return_data.arrBindFields.title}</th>
		</tr>
		<tr class="noBorderBottom">
			<td class="noBorderRight AlignLeft" valign="top">
				<div class="paddingTextWBottom5">
					<strong class="Header">{$smarty.now|date_format:"%d.%m.%Y %R"}</strong>
					<table class="paddingTextWBottom5">
						<tr>
							<td>
								<strong>{$smarty.const.ANNOUNCE_SELECT_REGION}:</strong></td><td>{$regions[$return_data.arrBindFields.id_region].name|escape}{if $return_data.arrBindFields.id_city}&nbsp;/&nbsp;{$citys[$return_data.arrBindFields.id_city].name|escape}{/if}
							</td>
						</tr>
						<tr>
							<td>
								<strong>{$smarty.const.ANNOUNCE_SELECT_SECTION}:</strong></td><td>{$sections[$return_data.arrBindFields.id_section].name}&nbsp;/&nbsp;{$professions[$return_data.arrBindFields.id_profession].name}
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<br>
								<strong>{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}:</strong>
								<br>{$return_data.arrBindFields.company_name}<br><br>
								<strong>{$smarty.const.ANNOUNCE_CONTACTS_FIO}:</strong>
								<br>{$return_data.arrBindFields.contacts_fio}
							</td>
						</tr>
					</table>
				</div>
			</td>
			<td class="noBorderLeft last AlignRight" valign="top">
				<div class="paddingText5">
					<div class="InfoBlockWrapper">
						<div class="withoutHeader"></div>
						<div class="InfoBlock">
							<div>
								<table>
									<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_ACTPERIOD}:</strong></td><td>{$arrSysDict.ActPeriod.values[$return_data.arrBindFields.act_period]}</td></tr>
									{if $return_data.arrNoBindFields.subscription}
										<tr><td colspan="2"><input type="checkbox" class="input" checked="checked" disabled="disabled">&nbsp;{$smarty.const.ANNOUNCE_CHECKBOX_SUBCRIPTION_ON}</td></tr>
									{/if}
									<tr><td colspan="2"><hr></td></tr>
									<tr>
										<td style="width:150px;"><strong>{$smarty.const.ANNOUNCE_PAY_HEAD}:</strong></td>
										<td>
											{if $return_data.arrNoBindFields.pay_post}
												{$smarty.const.SITE_FROM}
												{$return_data.arrBindFields.pay_from}
												{$smarty.const.SITE_UNTO}
												{$return_data.arrNoBindFields.pay_post}
											{else}
												{$return_data.arrBindFields.pay_from}
											{/if}
											{$return_data.arrBindFields.currency}
										</td>
									</tr>
									<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}:</strong></td><td>{$return_data.arrNoBindFields.chart_work}</td></tr>
									<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION}:</strong></td><td>{$return_data.arrNoBindFields.edu_work}</td></tr>
									<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}:</strong></td><td>{$return_data.arrNoBindFields.expire_work}</td></tr>
									<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_GENDER}:</strong></td><td>{$arrSysDict.Gender.values[$return_data.arrNoBindFields.gender]}</td></tr>
									{if $return_data.arrNoBindFields.age_from or  $return_data.arrNoBindFields.age_post}
										<tr>
											<td><strong>{$smarty.const.ANNOUNCE_AGE}:</strong></td>
											<td>
												{if $return_data.arrNoBindFields.age_from}
													{$smarty.const.SITE_FROM}
													{$return_data.arrNoBindFields.age_from}
												{/if}
												{if $return_data.arrNoBindFields.age_post}
													{$smarty.const.SITE_UNTO}
													{$return_data.arrNoBindFields.age_post}
												{/if}
											</td>
										</tr>
									{/if}
								</table>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr class="noBorderTop">
			<td colspan="2" class="AlignLeft last">
			{* ----------------------------------- *}
				<div class="paddingTextWTop5">
					<table class="paddingTextWTop5">
						<tr>
							<td>
								<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
								<strong>{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}:</strong>
								<br>{$return_data.arrBindFields.company_discription}<br><br>

								<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
								<strong>{$smarty.const.ANNOUNCE_TEXTAREA_REQUIREMENTS}:</strong>
								<br>{$return_data.arrBindFields.requirements}<br><br>

								<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
								<strong>{$smarty.const.ANNOUNCE_TEXTAREA_DUTESWORK}:</strong>
								<br>{$return_data.arrBindFields.duties_work}<br><br>

								{if $return_data.arrNoBindFields.conditions_work}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
									<strong>{$smarty.const.ANNOUNCE_TEXTAREA_CONDITIONS_WORK}:</strong>
									<br>{$return_data.arrNoBindFields.conditions_work}<br><br>
								{/if}

								{if $return_data.arrNoBindFields.ext_info}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
									<strong>{$smarty.const.ANNOUNCE_TEXTAREA_EXT_INFO}:</strong>
									<br>{$return_data.arrNoBindFields.ext_info}
								{/if}
							</td>
						</tr>
					</table>
				</div>
			{* ----------------------------------- *}
				<hr class="Design_panesDelimiter" style="margin-bottom:20px;">
				<div class="paddingText5">
					<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
					<strong class="Header">{$smarty.const.ANNOUNCE_CONTACTS_HEAD}</strong>
					<table class="paddingTextWBottom5">
						<tr><td>
							<strong>{$smarty.const.ANNOUNCE_CONTACTS_EMAIL}:</strong>
							<span class="mailto" style="cursor: default;">
								{if $return_data.arrNoBindFields.public_email}{$return_data.arrBindFields.email}{else}{$smarty.const.SITE_HIDDEN}{/if}
							</span>
						</td></tr>
						{if $return_data.arrNoBindFields.url}
							<tr><td>
							<strong>{$smarty.const.ANNOUNCE_CONTACTS_URL}:</strong>
							{$return_data.arrNoBindFields.url}
							</td></tr>
						{/if}
						<tr><td>
							<strong>	{$smarty.const.ANNOUNCE_CONTACTS_PHONE}:</strong>&nbsp;{$return_data.arrBindFields.phone}&nbsp;
								{if $return_data.arrNoBindFields.note_phone}(<span style="font-style: italic;">{$return_data.arrNoBindFields.note_phone}</span>){/if}
						</td></tr>
						{if $return_data.arrNoBindFields.addition_phone_1 || $return_data.arrNoBindFields.addition_phone_2}
							<tr><td>
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
							</td></tr>
						{/if}
					</table>
				</div>
			{* ----------------------------------- *}
			</td>
		</tr>

		<tr class="noBorderTop">
			<td class="AlignLeft last" colspan="2">
				<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&amp;action=$currAction")}" method="post" enctype="multipart/form-data">
					{foreach from=$return_data.hidden_fields item="valField" key="keyValue"}
						<input type="hidden" name="{$keyValue}" value="{$valField}">
					{/foreach}
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