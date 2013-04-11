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
				<td colspan="2" class="noBorderRight last AlignLeft" valign="top">
					<div class="paddingText5">
						{if $return_data.vip}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/vip.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}" title="{$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}: {$return_data.title|truncate:80:'...'}">{/if}
						{if $return_data.hot}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/hot.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}" title="{$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}: {$return_data.title|truncate:80:'...'}">{/if}
					</div>
				</td>
			</tr>
		{/if}
		<tr class="noBorderBottom">
			<td class="noBorderRight AlignLeft" valign="top">
				<div class="paddingText5">
					<strong class="Header">{$return_data.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$return_data.act_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</strong>
					<table class="paddingText5">
						<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_REGION}:</strong></td><td>{$regions[$return_data.id_region].name|escape}{if $return_data.id_city}&nbsp;/&nbsp;{$citys[$return_data.id_city].name|escape}{/if}</td></tr>
						<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_SECTION}:</strong></td><td>{$sections[$return_data.id_section].name}</td></tr>
						{if $token && 'active' eq $return_data.token}
							<tr>
								<td><strong>{$smarty.const.ANNOUNCE_VISIBILITY_HEAD}:</strong></td>
								<td>
									<img class="editVisibility" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/edit.png" alt="{$smarty.const.FORM_ACTION_EDIT_VISIBILITY}" title="{$smarty.const.FORM_ACTION_EDIT_VISIBILITY}">
									<span class="visibility">{$arrVisibility[$return_data.visibility]}</span>
									<span style="display: none;">
										<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/actions/closeButtonWin.png" class="cancelEditVisibility" alt="{$smarty.const.SITE_CANCEL}" title="{$smarty.const.SITE_CANCEL}" style="vertical-align: bottom;">
										<select class="selectVisibility">
											{foreach from=$arrVisibility item="visibility" key="index"}
												<option value="{$index}"{if $index eq $return_data.visibility} selected="selected"{/if}>{$visibility}</option>
											{/foreach}
										</select>
										<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/yes.png" class="doEditVisibility" data-id="{$return_data.id}" alt="{$smarty.const.FORM_ACTION_EDIT_VISIBILITY}" title="{$smarty.const.FORM_ACTION_EDIT_VISIBILITY}" style="display: none;">
									</span>
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
						<div class="InfoBlock"><div>
							<table>
								<tr><td style="width:150px;"><strong>{$smarty.const.ANNOUNCE_PAY_HEAD}:</strong></td><td>{$smarty.const.SITE_FROM} {$return_data.pay_from}&nbsp;{$return_data.currency}</td></tr>
								<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}:</strong></td><td>{$return_data.chart_work}</td></tr>
								<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION}:</strong></td><td>{$return_data.education}</td></tr>
								<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}:</strong></td><td>{$return_data.expire_work}</td></tr>
								<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_GENDER}:</strong></td><td>{$arrSysDict.Gender.values[$return_data.gender]}</td></tr>
								<tr><td><strong>{$smarty.const.ANNOUNCE_AGE}:</strong></td><td>{$return_data.age}</td></tr>
							</table>
						</div></div>
					</div>
				</div>
			</td>
		</tr>
		<tr class="noBorderTop">
			<td colspan="2" class="AlignLeft last">
{* ----------------------------------- *}
				{if $return_data.educations}
					<hr class="Design_panesDelimiter" style="margin-bottom:20px;">
					<div class="paddingText5">
						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
						<strong class="Header">{$smarty.const.ANNOUNCE_EDUCATION_HEAD}</strong>
						{foreach from=$return_data.educations item="education" key="key" name="education"}
							<div class="InfoBlockWrapper" style="margin-top: 10px;">
								<div class="withoutHeader"></div>
								<div class="InfoBlock">
									<div>
										<table class="paddingTextWBottom5">
											<tr>
												<td>
													<strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION_TYPE}:</strong>
													{$education.type}
												</td>
											</tr>
											<tr>
												<td>
													<strong>{$smarty.const.ANNOUNCE_INPUT_EDUCATION_INSTITUTION}:</strong>
													{$education.institution}
												</td>
											</tr>
											<tr>
												<td>
													<strong>{$smarty.const.ANNOUNCE_INPUT_EDUCATION_DEGREE}:</strong>
													{$education.degree}
												</td>
											</tr>
											<tr>
												<td>
													<strong>{$smarty.const.ANNOUNCE_INPUT_EDUCATION_FINISH_DATE}:</strong>
													{$education.finish_month}&nbsp;{$education.finish_year}
												</td>
											</tr>
											{if $education.ext_info}
												<tr>
													<td>
														<strong>{$smarty.const.ANNOUNCE_INPUT_EDUCATION_EXTINFO}:</strong>
														<div style="margin:5px 10px;">{$education.ext_info}</div>
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
				{if $return_data.expires !== null}
					<hr class="Design_panesDelimiter" style="margin-bottom:20px;">
					<div class="paddingText5">
						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
						<strong class="Header">{$smarty.const.ANNOUNCE_EXPIREINFO_HEAD}</strong>
						{if $return_data.expires}
							{foreach from=$return_data.expires item="expire" key="key" name="expire"}
								<div class="InfoBlockWrapper" style="margin-top: 10px;">
									<div class="withoutHeader"></div>
									<div class="InfoBlock">
										<div>
											<table class="paddingTextWBottom5">
												<tr><td><strong>{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}:</strong>&nbsp;{$expire.company}</td></tr>
												{if $expire.company_discription}
												<tr><td><strong>{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}:</strong>&nbsp;{$expire.company_discription}</td></tr>
												{/if}
												<tr><td><strong>{$smarty.const.ANNOUNCE_INPUT_EXPIRE_PERIOD}:</strong>&nbsp;{$expire.begin_month}&nbsp;{$expire.begin_year}{if $expire.finish_month && $expire.finish_year}&nbsp;-&nbsp;{$expire.finish_month}&nbsp;{$expire.finish_year}{/if}</td></tr>
												<tr><td><strong>{$smarty.const.ANNOUNCE_INPUT_EXPIRE_APPOINTMENT}:</strong>&nbsp;{$expire.appointment}</td></tr>
												<tr><td><strong>{$smarty.const.ANNOUNCE_TEXTAREA_EXPIRE_DUTIES_INFO}:</strong><div style="margin:5px 10px;">{$expire.duties_info}</div></td></tr>
											</table>
										</div>
									</div>
								</div>
							{/foreach}
						{else}
							<table class="paddingTextWBottom5"><tr><td><strong>{$smarty.const.ANNOUNCE_INPUT_EXPIRE_CAREER_LAUNCH}</strong></td></tr></table>
						{/if}
					</div>
				{/if}
{* ----------------------------------- *}
				{if $return_data.languages !== null}
					<hr class="Design_panesDelimiter" style="margin-bottom:20px;">
					<div class="paddingText5">
						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
						<strong class="Header">{$smarty.const.ANNOUNCE_LANGUAGES_HEAD}</strong>
						{foreach from=$return_data.languages item="language" key="key" name="language"}
							<div class="InfoBlockWrapper" style="margin-top: 10px;">
								<div class="withoutHeader"></div>
								<div class="InfoBlock">
									<div>
										<table class="paddingTextWBottom5">
										{if  $smarty.foreach.language.first}
											<tr><td><strong>{$smarty.const.ANNOUNCE_INPUT_NATIVE_LANGUAGE}:</strong>&nbsp;{$language.lang}</td></tr>
										{else}
											<tr><td><strong>{$smarty.const.ANNOUNCE_INPUT_FOREIGN_LANGUAGE}:</strong>&nbsp;{$language.lang}</td></tr>
											<tr><td>
												<strong>{$smarty.const.ANNOUNCE_SELECT_LANGUAGE_DEGREE}:</strong>&nbsp;{$language.degree}&nbsp;
												{if !$token}
													<span class="user_help" id="HELP_ANNOUNCE_OPTION_LANGUAGE_DEGREE">
														<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info2.gif" alt="Info">
													</span>
												{/if}
											</td></tr>
											{if $language.note}
												<tr><td><strong>{$smarty.const.ANNOUNCE_TEXTAREA_LANGUAGE_NOTE}:</strong>&nbsp;<div style="margin:5px 10px;">{$language.note}</div></td></tr>
											{/if}
										{/if}
										{if $smarty.foreach.language.total eq 1}
											<tr><td><strong>{$smarty.const.ANNOUNCE_INPUT_NOFOREIGN_LANGUAGE}</strong></td></tr>
										{/if}
										</table>
									</div>
								</div>
							</div>
						{/foreach}
					</div>
				{/if}
{* ----------------------------------- *}
				{if $return_data.about_info}
					<hr class="Design_panesDelimiter" style="margin-bottom:20px;">
					<div class="paddingText5">
						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
						<strong class="Header">{$smarty.const.ANNOUNCE_TEXTAREA_ABOUTINFO}</strong>
						<div style="margin:10px 10px 20px 10px;">{$return_data.about_info}</div>
					</div>
				{/if}
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
													<th>{$smarty.const.ANNOUNCE_RESUME_RESPONSE_FORM_HEAD}: {$return_data.title|truncate:100:'...'}</th>
												</tr>
												<tr>
													<td class="last AlignLeft">
														<div class="paddingText5">
															<strong>{$smarty.const.FORM_SUBJECT}&nbsp;<span class="text-red">*</span></strong><br>
															<input type="hidden" name="sendto" value="{$return_data.sendto}">
															<input type="text" name="subject" value="{$smarty.const.ANNOUNCE_VACANCY_RESPONSE_FORM_HEAD}: {$return_data.title}" size="100" maxlength="300">
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
													<th>{$smarty.const.ANNOUNCE_RESUME_RESPONSE_FORM_HEAD}: {$return_data.title|truncate:100:'...'}</th>
												</tr>
												<tr>
													<td class="last AlignCenter">
														<div class="paddingText5">
															<strong>{$smarty.const.MESSAGE_WAS_SEND}
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
					{if ($return_data.visibility eq 'visible') || ($return_data.visibility eq 'members' && $user_email)}
						<table class="paddingTextWBottom5">
							<tr>
                                {if $return_data.image}
                                    <td rowspan="5" style="vertical-align: middle; padding: 5px;">
                                        <img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/photos/{$return_data.image}" alt="" title="" style="float: left;">
                                    </td>
                                {/if}
                                <td><strong>{$smarty.const.ANNOUNCE_CONTACTS_LASTNAME}:</strong></td>
                                <td>{$return_data.last_name}</td>
                            </tr>
							<tr>
                                <td><strong>{$smarty.const.ANNOUNCE_CONTACTS_FIRSTNAME}:</strong></td>
                                <td>{$return_data.first_name}</td>
                            </tr>
							{if $return_data.middle_name}
                                <tr>
                                    <td><strong>{$smarty.const.ANNOUNCE_CONTACTS_MIDDLENAME}:</strong></td>
                                    <td>{$return_data.middle_name}</td>
                                </tr>
                            {/if}
							<tr>
                                <td><strong>{$smarty.const.ANNOUNCE_CONTACTS_PHONE}:</strong></td>
                                <td>
                                    {$return_data.phone}&nbsp;
                                    {if $return_data.note_phone}(<span style="font-style: italic;">{$return_data.note_phone}</span>){/if}
                                </td>
							</tr>
							{if $return_data.addition_phone_1 || $return_data.addition_phone_2}
								<tr><td colspan="2">
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
								</td></tr>
							{/if}
						</table>
					{/if}
				</div>
{* ----------------------------------- *}
			</td>
		</tr>
		{if $myAnnounces}
			<tr id="trRespondResume" class="noBorderTop">
				<td class="last" colspan="2" style="text-align: left;">
					<div class="paddingText5">
						<strong class="Header">{$smarty.const.FORM_RESUME_RESPOND}</strong>
						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
						<select id="respondResume" class="selectVisibility">
							<option value="">{$smarty.const.FORM_ACTION_SELECT_LIST}</option>
							{foreach from=$myAnnounces item="myAnnounce"}
								<option value="{$myAnnounce.unikey}">{$myAnnounce.title}</option>
							{/foreach}
						</select>
						<div id="viewRespondResume" class="submitButtonLight" style="float: right; display: none;">
							<input type="button" class="shadow01red" value="{$smarty.const.FORM_LOOK_AT}">
						</div>
						<div id="sendRespondResume" class="submitButtonLight" style="display: none;">
							<input type="button" class="shadow01red" value="{$smarty.const.FORM_BUTTON_SEND}">
						</div>
						<div id="sendSuccessRespondResume" class="DesignMainPageBody" style="display: none;">
							<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
								<tr>
									<th>{$smarty.const.ANNOUNCE_RESUME_RESPONSE_FORM_HEAD}: {$return_data.title|truncate:100:'...'}</th>
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
                    <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&action=print&id=`$return_data.tId`")}" rel="nofollow" target="_blank"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/print_32.png" alt="{$smarty.const.ANNOUNCE_PRINT}" title="{$smarty.const.ANNOUNCE_PRINT}"></a>
                </td>
				<td class="noBorderLeft last" style="text-align:right;">
					<div style="margin:10px 0px;">
						{if $arrPayments.vip_resume && !$return_data.vip}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=setVIP&amp;id=`$return_data.id`")}" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setVIP.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}"></a>{/if}
						{if $arrPayments.hot_resume && !$return_data.hot}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=setHOT&amp;id=`$return_data.id`")}" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setHOT.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}"></a>{/if}
						{if $arrPayments.rate_resume}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=setRate&amp;id=`$return_data.id`")}" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setRate.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}"></a>{/if}
					</div>
				</td>
			</tr>
		{/if}
	</table>
</div>