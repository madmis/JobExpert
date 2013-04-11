<div class="DesignMainPageBody">
	<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
		<tr>
			<th colspan="2">{$return_data.title}</th>
		</tr>
		{if 'correction' eq $return_data.token}
			<tr>
				<td class="noBorderRight AlignLeft" valign="top" colspan="2">
					<div class="paddingText5">
						<strong class="Header">{$smarty.const.FORM_ANNOUNCE_COMMENTS_TITLE}:</strong>
						<div class="comments_correction">
							{$return_data.comments|nl2br}
						</div>
					</div>
				</td>
			</tr>
		{elseif 'active' eq $return_data.token && ($return_data.vip || $return_data.hot)}
			<tr>
				<td class="noBorderRight last AlignLeft" valign="top" colspan="2">
					<div class="paddingText5">
						{if $return_data.vip}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/vip.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}" title="{$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}: {$return_data.title|truncate:80:'...'}">{/if}
						{if $return_data.hot}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/hot.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}" title="{$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}: {$return_data.title|truncate:80:'...'}">{/if}
					</div>
				</td>
			</tr>
		{/if}
		<tr class="noBorderBottom">
			<td class="noBorderRight AlignLeft" valign="top">
				<div class="paddingTextWBottom5">
					<strong class="Header">{$return_data.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$return_data.act_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</strong>
					<table class="paddingTextWBottom5">
						<tr>
							<td><strong>{$smarty.const.ANNOUNCE_SELECT_REGION}:</strong></td><td>{$regions[$return_data.id_region].name|escape}{if $return_data.id_city}&nbsp;/&nbsp;{$citys[$return_data.id_city].name|escape}{/if}</td>
						</tr>
						<tr>
							<td><strong>{$smarty.const.ANNOUNCE_SELECT_SECTION}:</strong></td><td>{$sections[$return_data.id_section].name}&nbsp;/&nbsp;{$professions[$return_data.id_profession].name}</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}:</strong>
								<br>{$return_data.company_name}
							</td>
						</tr>
						{if $return_data.url}
							<tr>
								<td colspan="2">
									<strong>{$smarty.const.ANNOUNCE_CONTACTS_URL}:</strong>
                                    {if $smarty.const.CONF_USE_REDIRECT_EXTERNAL_LINK}
                                        <br><a href="{$smarty.const.CONF_SCRIPT_URL}index.php?redirect={$return_data.url}" target="_blank" title="{$smarty.const.FORM_TYPE_COMPANY} - {$return_data.company_name}">{$return_data.url}</a>
                                    {else}
                                        <br><a href="{$return_data.url}" rel="nofollow" target="_blank" title="{$smarty.const.FORM_TYPE_COMPANY} - {$return_data.company_name|escape}">{$return_data.url}</a>
                                    {/if}
								</td>
							</tr>
						{/if}
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
									{if $token}
										<tr>
											<td><strong>{$smarty.const.ANNOUNCE_SELECT_ACTPERIOD}:</strong></td>
											<td>{$arrSysDict.ActPeriod.values[$return_data.act_period]}</td>
										</tr>
										{if $return_data.subscription}
											<tr>
												<td colspan="2"><input type="checkbox" class="input" checked="checked" disabled="disabled">&nbsp;{$smarty.const.ANNOUNCE_CHECKBOX_SUBCRIPTION_ON}</td>
											</tr>
										{/if}
										<tr><td colspan="2"><hr></td></tr>
									{/if}
									<tr>
										<td style="width:150px;"><strong>{$smarty.const.ANNOUNCE_PAY_HEAD}:</strong></td>
										<td>
											{if $return_data.pay_post}
												{$smarty.const.SITE_FROM}
												{$return_data.pay_from}
												{$smarty.const.SITE_UNTO}
												{$return_data.pay_post}
											{else}
												{$return_data.pay_from}
											{/if}
											{$return_data.currency}
										</td>
									</tr>
									<tr>
										<td><strong>{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}:</strong></td><td>{$return_data.chart_work}</td>
									</tr>
									<tr>
										<td><strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION}:</strong></td><td>{$return_data.edu_work}</td>
									</tr>
									<tr>
										<td><strong>{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}:</strong></td><td>{$return_data.expire_work}</td>
									</tr>
									<tr>
										<td><strong>{$smarty.const.ANNOUNCE_SELECT_GENDER}:</strong></td><td>{$arrSysDict.Gender.values[$return_data.gender]}</td>
									</tr>
									{if $return_data.age_from or $return_data.age_post}
										<tr>
											<td><strong>{$smarty.const.ANNOUNCE_AGE}:</strong></td>
											<td>
												{if $return_data.age_from}
													{$smarty.const.SITE_FROM}
													{$return_data.age_from}
												{/if}
												{if $return_data.age_post}
													{$smarty.const.SITE_UNTO}
													{$return_data.age_post}
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
								<br>{$return_data.company_discription}<br><br>

								<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
								<strong>{$smarty.const.ANNOUNCE_TEXTAREA_REQUIREMENTS}:</strong>
								<br>{$return_data.requirements}<br><br>

								<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
								<strong>{$smarty.const.ANNOUNCE_TEXTAREA_DUTESWORK}:</strong>
								<br>{$return_data.duties_work}<br><br>

								{if $return_data.conditions_work}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
									<strong>{$smarty.const.ANNOUNCE_TEXTAREA_CONDITIONS_WORK}:</strong>
									<br>{$return_data.conditions_work}<br><br>
								{/if}

								{if $return_data.ext_info}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
									<strong>{$smarty.const.ANNOUNCE_TEXTAREA_EXT_INFO}:</strong>
									<br>{$return_data.ext_info}
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
						<tr>
							<td>
								<strong>{$smarty.const.ANNOUNCE_CONTACTS_EMAIL}:</strong>
								{if $token}
									<span class="mailto" style="cursor: default;">
										{if $return_data.public_email}{$return_data.email}{else}{$smarty.const.SITE_HIDDEN}{/if}
									</span>
								{elseif $return_data.public_email}
									<a href="mailto:{$return_data.email}" class="mailto" title="{$smarty.const.FORM_SEND_EMAIL}" rel="nofollow">{$return_data.email}</a>
								{else}
									<span class="sendto" title="{$smarty.const.FORM_SEND_EMAIL}">
										{$smarty.const.FORM_SEND_EMAIL}
									</span>
									<div style="display: none;">
										<div class="DesignMainPageBody">
											<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
												<tr>
													<th>{$smarty.const.ANNOUNCE_VACANCY_RESPONSE_FORM_HEAD}: {$return_data.title|truncate:100:'...'}</th>
												</tr>
												<tr>
													<td class="last AlignLeft">
														<div class="paddingText5">
															<strong>{$smarty.const.FORM_SUBJECT}&nbsp;<span class="text-red">*</span></strong><br>
															<input type="hidden" name="sendto" value="{$return_data.sendto}">
															<input type="text" name="subject" value="{$smarty.const.ANNOUNCE_VACANCY_RESPONSE_FORM_HEAD}: {$return_data.title|escape}" size="100" maxlength="300">
															<br><br>
															<strong>{$smarty.const.FORM_EMAIL}&nbsp;<span class="text-red">*</span></strong><br>
															<input type="text" name="email" size="50"{if $user_email} value="{$user_email}"{/if}>
															<br><br>
															<strong>{$smarty.const.FORM_MESSAGE}&nbsp;<span class="text-red">*</span></strong><br>
															<textarea name="message" cols="70" rows="10"></textarea>
															<br><br>
															{if $smarty.const.CONF_EMAIL_ATTACHMENT_FILES_ALLOW}
																{$smarty.const.ANNOUNCE_ATTACH_FILES}:
																<br><br>
																<div class="submitButtonLight uploadFile">
																	<input type="button" class="shadow01red" value="{$smarty.const.FORM_BUTTON_UPLOAD}">
																</div>
															{/if}
															{if $smarty.const.SECURE_CAPTCHA}
																<br><br>
																<table>
																	<tr>
																		<td align="right">
																			{include file="securimage.tpl"}
																			<input style="text-align: right;" type="text" name="keystring" size="5" maxlength="5">
																		</td>
																	</tr>
																</table>
																<br>
															{/if}
															<div class="submitButtonLight">
																<input type="button" class="shadow01red" id="onSubmit" value="{$smarty.const.FORM_BUTTON_SEND}">
															</div>
															<div style="display: none;">
																<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/processing.gif" alt="">
															</div>
														</div>
													</td>
												</tr>
											</table>
										</div>
										<div class="DesignMainPageBody" style="display: none;">
											<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
												<tr>
													<th>{$smarty.const.ANNOUNCE_VACANCY_RESPONSE_FORM_HEAD}: {$return_data.title|truncate:100:'...'}</th>
												</tr>
												<tr>
													<td class="last AlignCenter">
														<div class="paddingText5">
															<strong>{$smarty.const.MESSAGE_WAS_SEND}</strong>
														</div>
													</td>
												</tr>
											</table>
										</div>
									</div>
								{/if}
							</td>
						</tr>
					</table>
					<table class="paddingTextWBottom5">
						<tr>
							<td>
								<strong>{$smarty.const.ANNOUNCE_CONTACTS_FIO}:</strong>&nbsp;{$return_data.contacts_fio}
							</td>
						</tr>
					</table>
					<table class="paddingTextWBottom5">
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
				</div>
			{* ----------------------------------- *}
			</td>
		</tr>
		{if $myAnnounces}
			<tr id="trRespondVacancy" class="noBorderTop">
				<td class="last" colspan="2" style="text-align: left;">
					<div class="paddingText5">
						<strong class="Header">{$smarty.const.FORM_VACANCY_RESPOND}</strong>
						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
						<select id="respondVacancy" class="selectVisibility">
							<option value="">{$smarty.const.FORM_ACTION_SELECT_LIST}</option>
							{foreach from=$myAnnounces item="myAnnounce"}
								<option value="{$myAnnounce.unikey}">{$myAnnounce.title}</option>
							{/foreach}
						</select>
						<div id="viewRespondVacancy" class="submitButtonLight" style="float: right; display: none;">
							<input type="button" class="shadow01red" value="{$smarty.const.FORM_LOOK_AT}">
						</div>
						<div id="sendRespondVacancy" class="submitButtonLight" style="display: none;">
							<input type="button" class="shadow01red" value="{$smarty.const.FORM_BUTTON_SEND}">
						</div>
						<div id="sendSuccessRespondVacancy" class="DesignMainPageBody" style="display: none;">
							<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
								<tr>
									<th>{$smarty.const.ANNOUNCE_VACANCY_RESPONSE_FORM_HEAD}: {$return_data.title|truncate:100:'...'}</th>
								</tr>
								<tr>
									<td class="last AlignCenter">
										<div class="paddingText5">
											<strong>{$smarty.const.MESSAGE_WAS_SEND}</strong>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</td>
			</tr>
		{/if}
		{if !$token}
			<tr class="noBorderTop">
				<td class="noBorderRight" style="text-align: left;">
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&action=print&id=`$return_data.tId`")}" rel="nofollow" target="_blank"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/print_32.png" alt="{$smarty.const.ANNOUNCE_PRINT}" title="{$smarty.const.ANNOUNCE_PRINT}"></a>
				</td>
				<td class="noBorderLeft last" style="text-align:right;">
					<div style="margin:10px 0px;">
						{if $arrPayments.vip_vacancy && !$return_data.vip}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&action=setVIP&id=`$return_data.id`")}" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setVIP.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}"></a>{/if}
						{if $arrPayments.hot_vacancy && !$return_data.hot}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&action=setHOT&id=`$return_data.id`")}" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setHOT.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}"></a>{/if}
						{if $arrPayments.rate_vacancy}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&action=setRate&id=`$return_data.id`")}" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setRate.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_VACANCY}" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_VACANCY}"></a>{/if}
					</div>
				</td>
			</tr>
		{/if}
	</table>
</div>