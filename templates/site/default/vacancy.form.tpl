<div class="Design_panesBGWrapper">
	<div class="Design_panesBG">
		<ul class="Design_tabs">
			<li><a href="#params"  class="active">{$smarty.const.ANNOUNCE_PARAMS_TAB}</a></li>
			<li class="delim"><div></div></li>
			<li><a href="#requirements">{$smarty.const.ANNOUNCE_REQUIREMENTS_TAB}</a></li>
			<li class="delim"><div></div></li>
			<li><a href="#info">{$smarty.const.ANNOUNCE_INFO_TAB}</a></li>
			<li class="delim"><div></div></li>
			<li><a href="#addition">{$smarty.const.ANNOUNCE_ADDITION_PARAMS_TAB}</a></li>
		</ul>
		<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&amp;action=$currAction")}" method="post" enctype="multipart/form-data">
			<div class="Design_panes">

				{* -------------------- Панель 1: Параметры ---------------------------- *}
				<div>
					<h3>{$smarty.const.ANNOUNCE_VACANCY_PARAMS_HEAD}</h3>
					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.VACANCY_TITLE}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.title}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.title}">
								{/if}
							</td>
							<td class="form">
								<input type="text" name="arrBindFields[title]" value="{$arrBindFields.title|escape}" style="width:300px;" maxlength="255">
								<span class="user_help" id="HELP_VACANCY_INPUT_TITLE">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
							</td>
						</tr>
					</table>

					<br><hr class="Design_panesDelimiter"><br>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_SECTION}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.id_section}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.id_section}">
								{/if}
							</td>
							<td class="form">
								<select name="arrBindFields[id_section]" id="section" style="width:300px;">
									<option value="">{$smarty.const.ANNOUNCE_OPTION_SECTION}</option>
									{foreach from=$sections item="section"}
										<option value="{$section.id}" {if $arrBindFields.id_section eq $section.id}selected="selected"{/if}>{$section.name}</option>
									{/foreach}
								</select>
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_PROFESSION}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.id_section}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.id_section}">
								{elseif $errFields.id_profession}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.id_profession}">
								{/if}
							</td>
							<td class="form">
								<select name="arrBindFields[id_profession]" id="profession" style="width:300px;">
									<option value="">{$smarty.const.ANNOUNCE_OPTION_PROFESSION}</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_REGION}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
							{if $errFields.id_region}
								<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.id_region}">
							{/if}
							</td>
							<td class="form">
								<select name="arrBindFields[id_region]" id="region" style="width:300px;">
									<option value="">{$smarty.const.ANNOUNCE_OPTION_REGION}</option>
									{foreach from=$regions item="region"}
										<option value="{$region.id}" {if $arrBindFields.id_region eq $region.id}selected="selected"{/if}>{$region.name}</option>
									{/foreach}
								</select>
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_CITY}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.id_region}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.id_region}">
								{elseif $errFields.id_city}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.id_city}">
								{/if}
							</td>
							<td class="form">
								<table cellpadding="0" cellspacing="0">
									<tr>
										<td>
											<select name="arrBindFields[id_city]" id="city" style="width:300px;">
												<option value="">{$smarty.const.ANNOUNCE_OPTION_CITY}</option>
											</select>
										</td>
										<td style="padding-left:5px;">
											<input type="text" id="id_other_city" name="other_city" style="display: none;" size="25" maxlength="50">
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<br><hr class="Design_panesDelimiter"><br>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_PAY_HEAD}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.pay_from}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.pay_from}">
								{/if}
							</td>
							<td class="form">
								{$smarty.const.SITE_FROM}&nbsp;<input style="text-align: right;" type="text" name="arrBindFields[pay_from]"  size="5" maxlength="10" value="{$arrBindFields.pay_from}">
								{$smarty.const.SITE_UNTO}&nbsp;<input style="text-align: right;" type="text" name="arrNoBindFields[pay_post]"  size="5" maxlength="10" value="{if $arrNoBindFields.pay_post}{$arrNoBindFields.pay_post}{/if}">
								<select name="arrBindFields[currency]" id="currency">
									{foreach from=$arrSysDict.Currency.values item="item"}
										<option value="{$item}" {if $arrBindFields.currency eq $item}selected="selected"{/if}>{$item}</option>
									{/foreach}
								</select>
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								<select name="arrNoBindFields[chart_work]" id="chart_work" style="width:300px;">
									{foreach from=$arrAddDict.ChartWork.values item="item"}
										<option value="{$item}" {if $arrNoBindFields.chart_work eq $item}selected="selected"{/if}>{$item}</option>
									{/foreach}
								</select>
							</td>
						</tr>
					</table>
					<br><br>
					<a class="naviLeftInActive">&larr; {$smarty.const.FORM_BUTTON_PREV}</a>
					<a href="#requirements" class="naviRight">{$smarty.const.FORM_BUTTON_NEXT} &rarr;</a>
					<div class="clearL">&nbsp;</div><br>
				</div>
				{* -------------------- ^Панель 1: Параметры^ ---------------------------- *}

				{* -------------------- Панель 2: Требования ---------------------------- *}
				<div>
					<h3>{$smarty.const.ANNOUNCE_VACANCY_REQUIREMENTS_HEAD}</h3>
					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								<select name="arrNoBindFields[expire_work]" id="expire_work" style="width:300px;">
									{foreach from=$arrAddDict.ExpireWorkVacancy.values item="item"}
										<option value="{$item}" {if $arrNoBindFields.expire_work eq $item}selected="selected"{/if}>{$item}</option>
									{/foreach}
								</select>
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_EDUCATION}</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								<select name="arrNoBindFields[edu_work]" id="edu_work" style="width:300px;">
									{foreach from=$arrAddDict.Education.values item="item"}
										<option value="{$item}" {if $arrNoBindFields.edu_work eq $item}selected="selected"{/if}>{$item}</option>
									{/foreach}
								</select>
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_AGE}</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								{$smarty.const.SITE_FROM}&nbsp;<input style="text-align: right;" type="text" name="arrNoBindFields[age_from]" size="2" maxlength="2" value="{if $arrNoBindFields.age_from}{$arrNoBindFields.age_from}{/if}">
								{$smarty.const.SITE_UNTO}&nbsp;<input style="text-align: right;" type="text" name="arrNoBindFields[age_post]" size="2" maxlength="2" value="{if $arrNoBindFields.age_post}{$arrNoBindFields.age_post}{/if}">
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_GENDER}</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								<select name="arrNoBindFields[gender]" id="gender">
									{foreach from=$arrSysDict.Gender.values item="item" key="key"}
										<option value="{$key}" {if $arrNoBindFields.gender eq $key}selected="selected"{/if}>{$item}</option>
									{/foreach}
								</select>
							</td>
						</tr>
					</table>
					<table class="Design_panesFormTable">
						<tr>
							<td class="name300">
								{$smarty.const.ANNOUNCE_TEXTAREA_REQUIREMENTS}&nbsp;<span class="text-red">*</span>&nbsp;<span class="user_help" id="HELP_ANNOUNCE_TEXTAREA_REQUIREMENTS">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
							</td>
							<td class="error">
								{if $errFields.requirements}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.requirements}">
								{/if}
							</td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<textarea name="arrBindFields[requirements]" rows="5" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$arrBindFields.requirements}</textarea>
							</td>
						</tr>
						<tr>
							<td class="name300">
								{$smarty.const.ANNOUNCE_TEXTAREA_DUTESWORK}&nbsp;<span class="text-red">*</span>
								<span class="user_help" id="HELP_ANNOUNCE_TEXTAREA_DUTESWORK">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
							</td>
							<td class="error">
								{if $errFields.duties_work}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.duties_work}">
								{/if}
							</td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<textarea name="arrBindFields[duties_work]" rows="10" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$arrBindFields.duties_work}</textarea>
							</td>
						</tr>
						<tr>
							<td class="name300">
								{$smarty.const.ANNOUNCE_TEXTAREA_CONDITIONS_WORK}
								<span class="user_help" id="HELP_ANNOUNCE_TEXTAREA_CONDITIONS">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
							</td>
							<td class="error">&nbsp;</td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<textarea name="arrNoBindFields[conditions_work]" rows="5" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$arrNoBindFields.conditions_work}</textarea>
							</td>
						</tr>
					</table>
					<br><br>
					<a href="#params" class="naviLeft">&larr; {$smarty.const.FORM_BUTTON_PREV}</a>
					<a href="#info" class="naviRight">{$smarty.const.FORM_BUTTON_NEXT} &rarr;</a>
					<div class="clearL">&nbsp;</div><br>
				</div>
				{* -------------------- ^Панель 2: Требования^ ---------------------------- *}

				{* -------------------- Панель 3: Информация ---------------------------- *}
				<div>
					<table class="Design_panesFormTable">
						<tr>
							<td class="name" valign="top">
								{$smarty.const.ANNOUNCE_RADIOBOX_USER_TYPE_HEAD}&nbsp;<span class="text-red">*</span>
							</td>
							<td class="error" valign="top">
								{if $errFields.user_type}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.user_type}">
								{/if}
							</td>
							<td class="form" valign="top">
								<input type="radio" name="arrBindFields[user_type]" class="radio" value="{$user_type}"{if 'employer' eq $arrBindFields.user_type || 'company' eq $arrBindFields.user_type} checked="checked"{/if}{if $user_email && 'agent' eq $user_type} disabled="disabled"{/if}>&nbsp;{$smarty.const.ANNOUNCE_RADIOBOX_USER_TYPE_EMPLOYER}
								<br>
								<input type="radio" name="arrBindFields[user_type]" class="radio" value="agent"{if 'agent' eq $arrBindFields.user_type} checked="checked"{/if}{if $user_email && 'agent' neq $user_type} disabled="disabled"{/if}>&nbsp;{$smarty.const.ANNOUNCE_RADIOBOX_USER_TYPE_AGENT}
							</td>
							<td valign="top">
								<span class="user_help" id="HELP_ANNOUNCE_RADIOBOX_USER_TYPE">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
							</td>
						</tr>
					</table>

					<div id="id_agent_name"{if 'agent' neq $arrBindFields.user_type} style="display: none"{/if}>
						<table class="Design_panesFormTable">
							<tr>
								<td class="name300">{$smarty.const.ANNOUNCE_CONTACTS_AGENT_NAME}&nbsp;<span class="text-red">*</span></td>
								<td class="error">
									{if $errFields.agent_name}
										<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.agent_name}">
									{/if}
								</td>
								<td class="form">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="3">
									<input type="text" name="arrBindFields[agent_name]" value="{$arrBindFields.agent_name}" size="60" maxlength="255">
								</td>
							</tr>
						</table>
					</div>

					<br><hr class="Design_panesDelimiter">

					<h3>{$smarty.const.ANNOUNCE_VACANCY_INFO_HEAD}</h3>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.company_name}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.company_name}">
								{/if}
							</td>
							<td class="form">
								<input type="text" name="arrBindFields[company_name]" value="{$arrBindFields.company_name}" size="60" maxlength="255">
							</td>
						</tr>
					</table>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name300">
								{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}&nbsp;<span class="text-red">*</span>
								<span class="user_help" id="HELP_ANNOUNCE_TEXTAREA_COMPANY_DISCRIPTION">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
							</td>
							<td class="error">
								{if $errFields.company_discription}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.company_discription}">
								{/if}
							</td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<textarea name="arrBindFields[company_discription]" rows="2" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$arrBindFields.company_discription}</textarea>
							</td>
						</tr>
					</table>

					<br><hr class="Design_panesDelimiter">

					<h3>{$smarty.const.ANNOUNCE_CONTACTS_HEAD}</h3>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name300" valign="top">{$smarty.const.ANNOUNCE_CONTACTS_FIO}&nbsp;<span class="text-red">*</span></td>
							<td class="error" valign="top">
								{if $errFields.contacts_fio}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.contacts_fio}">
								{/if}
							</td>
							<td class="form" valign="top">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3"><input type="text" name="arrBindFields[contacts_fio]" value="{$arrBindFields.contacts_fio}" size="50" maxlength="100"></td>
						</tr>
					</table>
					<table class="Design_panesFormTable">
						<tr>
							<td class="name" valign="top">{$smarty.const.ANNOUNCE_CONTACTS_EMAIL}&nbsp;<span class="text-red">*</span></td>
							<td class="error" valign="top">
								{if $errFields.email}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" title="{$errFields.email}">
								{/if}
							</td>
							<td class="form" valign="top">
								<input type="text" name="arrBindFields[email]" value="{$arrBindFields.email}" size="30" maxlength="50">
								<span class="user_help" id="HELP_VACANCY_CHECKBOX_PUBLIC_EMAIL">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
								<input type="checkbox" name="arrNoBindFields[public_email]" {if $arrNoBindFields.public_email}checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_CONTACTS_EMAIL_PUBLIC}
							</td>
						</tr>
						<tr>
							<td class="name300" valign="top">{$smarty.const.ANNOUNCE_CONTACTS_URL}</td>
							<td class="error" valign="top">&nbsp;</td>
							<td class="form" valign="top"><input type="text" name="arrNoBindFields[url]" value="{$arrNoBindFields.url}" size="30" maxlength="50"></td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.phone}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.phone}">
								{/if}
							</td>
							<td class="form">
								<input type="text" name="arrBindFields[phone]" value="{$arrBindFields.phone}" size="30" maxlength="50">&nbsp;
								<img id="add_phones" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/{if !$arrNoBindFields.addition_phone_1 && !$arrNoBindFields.addition_phone_2}plus{else}minus{/if}AddButton.png" alt="{$smarty.const.ANNOUNCE_CONTACTS_ADDITION_PHONES}" title="{$smarty.const.ANNOUNCE_CONTACTS_ADDITION_PHONES}">
								<span class="user_help" id="HELP_ANNOUNCE_INPUT_PHONE">&nbsp;<img class="top" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE_NOTE}</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								<input type="text" name="arrNoBindFields[note_phone]" value="{$arrNoBindFields.note_phone}" size="75" maxlength="250">
							</td>
						</tr>
						<tr class="addition_phones"{if !$arrNoBindFields.addition_phone_1} style="display: none;"{/if}>
							<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE}</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								<input type="text" name="arrNoBindFields[addition_phone_1]" value="{$arrNoBindFields.addition_phone_1}" size="30" maxlength="50">
							</td>
						</tr>
						<tr class="addition_phones"{if !$arrNoBindFields.addition_phone_1} style="display: none;"{/if}>
							<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE_NOTE}</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								<input type="text" name="arrNoBindFields[note_addition_phone_1]" value="{$arrNoBindFields.note_addition_phone_1}" size="75" maxlength="250">
							</td>
						</tr>
						<tr class="addition_phones"{if !$arrNoBindFields.addition_phone_2} style="display: none;"{/if}>
							<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE}</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								<input type="text" name="arrNoBindFields[addition_phone_2]" value="{$arrNoBindFields.addition_phone_2}" size="30" maxlength="50">
							</td>
						</tr>
						<tr class="addition_phones"{if !$arrNoBindFields.addition_phone_2} style="display: none;"{/if}>
							<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE_NOTE}</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								<input type="text" name="arrNoBindFields[note_addition_phone_2]" value="{$arrNoBindFields.note_addition_phone_2}" size="75" maxlength="250">
							</td>
						</tr>
					</table>
					<br><br>
					<a href="#requirements" class="naviLeft">&larr; {$smarty.const.FORM_BUTTON_PREV}</a>
					<a href="#addition" class="naviRight">{$smarty.const.FORM_BUTTON_NEXT} &rarr;</a>
					<div class="clearL">&nbsp;</div><br>
				</div>
				{* -------------------- ^Панель 3: Информация^ ---------------------------- *}

				{* -------------------- Панель 4: Дополнительно ---------------------------- *}
				<div>
					<h3>{$smarty.const.ANNOUNCE_ADDITION_PARAMS_HEAD}</h3>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name300">
								{$smarty.const.ANNOUNCE_TEXTAREA_EXT_INFO}
								<span class="user_help" id="HELP_ANNOUNCE_TEXTAREA_EXT_INFO">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
							</td>
							<td class="error">&nbsp;</td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<textarea name="arrNoBindFields[ext_info]" rows="10" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$arrNoBindFields.ext_info}</textarea>
							</td>
						</tr>
					</table>

					<br><hr class="Design_panesDelimiter"><br>

					<table class="Design_panesFormTable">
						<tr>
							<td colspan="3">
								<input type="checkbox" name="arrNoBindFields[subscription]" class="checkbox" {if $arrNoBindFields.subscription}checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_CHECKBOX_SUBCRIPTION}
							</td>
						</tr>
					</table>
					<table class="Design_panesFormTable">
						<tr>
							<td class="name">
								{$smarty.const.ANNOUNCE_SELECT_ACTPERIOD}
							</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								<select name="arrBindFields[act_period]" id="act_period">
									{foreach from=$arrSysDict.ActPeriod.values item="item" key="key"}
										<option value="{$key}" {if $arrBindFields.act_period eq $key}selected="selected"{/if}>{$item}</option>
									{/foreach}
								</select>
							</td>
						</tr>
					</table>

					{if !$user_email && $smarty.const.CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED}
						<br><hr class="Design_panesDelimiter">
						<table class="Design_panesFormTable">
							<tr>
								<td colspan="3">
									<div id="agreement" style="-moz-box-shadow:0 0 0px #000000;background-color:#FFFFFF;border:1px solid #DDDDDD;color:#000000;font-size:11px;height:200px;overflow-x:hidden;overflow-y:auto;padding:10px;margin:0px;width:620px;"></div>
								</td>
							</tr>
							<tr>
								<td class="namecolspan" colspan="2">
									{if $errFields.agreement}<span class="error"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.agreement}" style="vertical-align:top;"></span>{/if}
									<input type="checkbox" name="agreement" value="agree">&nbsp;{$smarty.const.FORM_USER_AGREEMENT}&nbsp;<span class="text-red">*</span>
								</td>
								<td>
									<div class="agreement">
										{$smarty.const.SITE_OPEN_NEW_WINDOW}
										<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/actions/rotait.png" alt="">
									</div>
								</td>
							</tr>
						</table>
					{/if}

					<br><hr class="Design_panesDelimiter">

					<table class="Design_panesFormTable">
						<tr>
							<td colspan="3" align="center">
								{if $smarty.const.SECURE_CAPTCHA}
									<br>
									{include file="securimage.tpl"}
									<input style="text-align: right;" type="text" name="keystring" size="5" maxlength="5">
									{if $errFields.captcha}
										<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="Error!" style="vertical-align: middle;" title="{$errFields.captcha}">
									{/if}
									<br><br>
								{/if}
							</td>
						</tr>
						<tr>
							<td colspan="3" align="center">
								<div class="submitButtonLight">
									<input type="submit" name="{$currAction}" class="shadow01red" value="{$smarty.const.FORM_BUTTON_SEND}">
								</div>
							</td>
						</tr>
					</table>
					<a href="#info" class="naviLeft">&larr; {$smarty.const.FORM_BUTTON_PREV}</a>
					{if 'edit' eq $currAction}
						<input type="hidden" name="unikey" value="{$unikey}">
					{/if}
					<input type="hidden" id="selector" value="">
					<input type="hidden" id="hcity" value="{$arrBindFields.id_city}">
					<input type="hidden" id="hprofession" value="{$arrBindFields.id_profession}">
				</div>
				{* -------------------- ^Панель 4: Дополнительно^ ---------------------------- *}
			</div>
		</form>
	</div>
</div>

{if $smarty.const.CONF_USE_VISUAL_EDITOR && $smarty.const.CONF_ANNOUNCE_USE_VISUAL_EDITOR}
<!-- TinyMCE -->
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/modules/tinymce/announces_config.js"></script>
<!-- TinyMCE -->
{/if}

<script type="text/javascript">
(function($) {
	// очищаем select
	$.fn.clearSelect = function() {
		return this.each(function() {
			if('SELECT' === this.tagName) {
				this.options.length = 1;
				$(this).attr('disabled', 'disabled');
			}
		});
	}
	// заполняем select
	$.fn.fillSelect = function(dataArray) {
		return this.clearSelect().each(function() {
			if('SELECT' === this.tagName) {
				var currentSelect = this;
				$.each(dataArray, function(index, data) {
					var currVal;
					var selVal = $('#selector').val();
					if (selVal) {
						currVal = $('#h' + selVal).val();
					}
					var this_select = ('0' !== currVal && data.id === currVal) ? true : false;
					var option = new Option(data.name, data.id, false, this_select);
					($.support.cssFloat) ? currentSelect.add(option, null) : currentSelect.add(option);
				});
				$('#selector').val('');
			}
		});
	}
})(jQuery);

$(document).ready(function() {
	$('ul.Design_tabs').tabs('div.Design_panes > div', {
		effect: 'fade',
		fadeInSpeed: 'normal'
	}).history();
	//Просмотр Пользовательского соглашения
	$.get("/index.php?do=agreement", function(data){
		$('#agreement').append(data);
	});
	$('.agreement').click(function() {
		var targ = $('#agreement').html();
		$.fn.colorbox({ html: targ, preloading: true, width: '70%', height: '100%', opacity: 0, open: true, scrolling: true });
		// отключаем горизонтальный скролл в окне colorbox (IE)
		$(targ).parent().css('overflow-x','hidden');
	});
	// Обработка селектов Раздела и Профессий
	// обрабатываем селект если он был изменен
	$('#profession').change(function () {
		var sp = $('#profession').val();
		$('#hprofession').val(sp);
	});
	// обрабатываем селект после перезагрузки страницы
	var selProfessions = $('#profession');
	if ($('#section').val()) {
		$.get('/ajax.php', { id_s: $('#section').val() }, function(data) {
			$('#selector').val('profession');
			var data = $.parseJSON(data);
			selProfessions.fillSelect(data).removeAttr('disabled');
		});
	} else {
		selProfessions.clearSelect();
		selProfessions.attr('disabled', 'disabled');
	}
	// обрабатываем селект если он был изменен
	$('#section').change(function () {
		if (!$(this).val()) {
			selProfessions.clearSelect();
			selProfessions.attr('disabled', 'disabled');
		} else {
			$.get('/ajax.php', { id_s: $(this).val() }, function(data) {
				var data = $.parseJSON(data);
				selProfessions.fillSelect(data).removeAttr('disabled');
			});
		}
	});
	// Обработка селектов Региона и Городов
	var selCitys = $('#city');
	var otherCity = $("#id_other_city");
	// обрабатываем селект если он был изменен
	selCitys.change(function () {
		if ('0' === $(this).val()) {
			otherCity.show('normal');
		} else {
			otherCity.hide('normal');
			otherCity.val('');
		}
	});
	// обрабатываем селект после перезагрузки страницы
	if ($('#region').val()) {
		$.get('/ajax.php', { id_r: $('#region').val() }, function(resp) {
			$('#selector').val('city');
			var resp = $.parseJSON(resp);
			if (resp.success && resp.data) {
				selCitys.fillSelect(resp.data).show('fast').removeAttr('disabled');
			} else if (resp.success && !resp.data) {
				selCitys.hide().val('0');
				otherCity.hide().val('');
			}
		});
	} else {
		selCitys.clearSelect();
		selCitys.attr('disabled', 'disabled');
	}
	// обрабатываем селект если он был изменен
	$('#region').change(function () {
		$('#hcity').val('');
		otherCity.val('');
		otherCity.hide('normal');
		if (!$(this).val()) {
			selCitys.clearSelect();
			selCitys.attr('disabled', 'disabled').show('fast');
		} else {
			$.get('/ajax.php', { id_r: $(this).val() }, function(resp) {
				var resp = $.parseJSON(resp);
				if (resp.success && resp.data) {
					selCitys.fillSelect(resp.data).show('fast').removeAttr('disabled');
				} else if (resp.success && !resp.data) {
					selCitys.hide('fast').val('0');
					otherCity.hide('fast').val('');
				}
			});
		}
	});

	$('#add_phones').click(function () {
		var sh_phones = $('.addition_phones');
		var butt;
		if ('none' === sh_phones.css('display')) {
			sh_phones.show();
			butt = 'minus';
		} else {
			sh_phones.hide();
			butt = 'plus';
		}
		$('#add_phones').attr('src', '{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/' + butt + 'AddButton.png');
	});

	$('.radio').click(function () {
		if ('agent' === $(this).val()) {
			$('#id_agent_name').show('normal');
		} else if ('employer' === $(this).val() || 'company' === $(this).val()) {
			$('#id_agent_name').hide('normal');
		}
	});
});
-->
</script>