<div class="Design_panesBGWrapper">
	<div class="Design_panesBG">
		<ul class="Design_tabs">
			<li class="delim"><div></div></li>
			<li><a href="#info" class="active">{$smarty.const.ANNOUNCE_INFO_TAB}</a></li>
			<li class="delim"><div></div></li>
			<li><a href="#params">{$smarty.const.ANNOUNCE_PARAMS_TAB}</a></li>
			<li class="delim"><div></div></li>
			<li><a href="#education">{$smarty.const.ANNOUNCE_EDUCATION_TAB}</a></li>
			<li class="delim"><div></div></li>
			<li><a href="#expire">{$smarty.const.ANNOUNCE_EXPIREINFO_TAB}</a></li>
			<li class="delim"><div></div></li>
			<li><a href="#addition">{$smarty.const.ANNOUNCE_ADDITION_PARAMS_TAB}</a></li>
			<li class="delim"><div></div></li>
		</ul>

		<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=$currAction")}" method="post" enctype="multipart/form-data">

			<div class="Design_panes">

			{* -------------------- Панель 1 ---------------------------- *}
				<div>
					<h3>{$smarty.const.ANNOUNCE_RESUME_INFO_HEAD}</h3>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.RESUME_TITLE}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.title}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.title}">
								{/if}
							</td>
							<td class="form">
								<input type="text" name="arrBindFields[title]" value="{$arrBindFields.title|escape}" size="60" maxlength="255">&nbsp;
								<span class="user_help" id="HELP_RESUME_INPUT_TITLE"><img class="top" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
							</td>
						</tr>
					</table>

					<hr class="Design_panesDelimiter">

					<h3>{$smarty.const.ANNOUNCE_COMPETITOR_INFO}</h3>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_LASTNAME}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.last_name}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.last_name}">
								{/if}
							</td>
							<td class="form">
								<input type="text" name="arrBindFields[last_name]" value="{$arrBindFields.last_name}" size="30" maxlength="50">
							</td>
							{if $smarty.const.CONF_RESUME_ADD_PHOTO}
								<td class="name" rowspan="5" style="width: 40%; vertical-align: text-top;">
									{$smarty.const.ANNOUNCE_CONTACTS_PHOTOCARD}
									<br><br>
									<div id="uploadPhoto" class="submitButtonLight"{if $arrNoBindFields.image} style="display: none;"{/if}>
										<input type="button" class="shadow01red" value="{$smarty.const.FORM_BUTTON_UPLOAD}" style="margin-left: 5px;">
									</div>
									{if $arrNoBindFields.image}
										<div id="uploadedPhoto">
											<img id="delPhotocard" src="{$smarty.const.CONF_SCRIPT_URL}templates/site/{$smarty.const.CONF_TEMPLATE}/images/actions/delete.png" alt="{$smarty.const.SITE_DELETE_FILE}" title="{$smarty.const.SITE_DELETE_FILE}" style="float: left;">
											<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/temporary/{$arrNoBindFields.image}" alt="" title="">
										</div>
									{/if}
                                    <input type="hidden" name="arrNoBindFields[image]" id="iPhotocard" value="{if $arrNoBindFields.image}{$arrNoBindFields.image}{/if}">
								</td>
							{/if}
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_FIRSTNAME}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.first_name}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.first_name}">
								{/if}
							</td>
							<td class="form">
								<input type="text" name="arrBindFields[first_name]" value="{$arrBindFields.first_name}" size="30" maxlength="50">
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_MIDDLENAME}</td>
							<td class="name">&nbsp;</td>
							<td class="form">
								<input type="text" name="arrNoBindFields[middle_name]" value="{$arrNoBindFields.middle_name}" size="30" maxlength="50">
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.FORM_USER_BIRTHDAY}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.age}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.age}">
								{/if}
							</td>
							<td class="form">
								{html_select_date time=$arrBindFields.birthday field_array="birthday" field_order="DMY" month_format="%m" start_year="-65" end_year="-14" reverse_years="true" day_empty="" month_empty="" year_empty="" all_extra='style="text-align: center;"'}
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_GENDER}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.gender}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.gender}">
								{/if}
							</td>
							<td class="form">
								{foreach from=$arrSysDict.Gender.values item="item" key="key"}
									<input type="radio" name="arrBindFields[gender]" value="{$key}"{if $arrBindFields.gender eq $key} checked="checked"{/if}>&nbsp;{$item}
								{/foreach}
							</td>
						</tr>
					</table>

					<hr class="Design_panesDelimiter">

					<h3>{$smarty.const.ANNOUNCE_CONTACTS_HEAD}</h3>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_EMAIL}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.email}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.email}">
								{/if}
							</td>
							<td class="form">
								<input type="text" name="arrBindFields[email]" value="{$arrBindFields.email}" size="30" maxlength="50">&nbsp;
								<input type="checkbox" name="arrNoBindFields[public_email]" {if $arrNoBindFields.public_email}checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_CONTACTS_EMAIL_PUBLIC}
								<span class="user_help" id="HELP_RESUME_CHECKBOX_PUBLIC_EMAIL">&nbsp;<img  src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
							</td>
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
								<img id="add_phones" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/{if !$arrNoBindFields.addition_phone_1 && !$arrNoBindFields.addition_phone_2}plus{else}minus{/if}AddButton.png" alt="{$smarty.const.ANNOUNCE_CONTACTS_ADDITION_PHONES}" title="{$smarty.const.ANNOUNCE_CONTACTS_ADDITION_PHONES}" style="cursor: pointer;">
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

					<a class="naviLeftInActive">&larr; {$smarty.const.FORM_BUTTON_PREV}</a>
					<a href="#params" class="naviRight">{$smarty.const.FORM_BUTTON_NEXT} &rarr;</a>
					<div class="clearL">&nbsp;</div>

					<br>
				</div>
			{* -------------------- ^^Панель 1^^ ---------------------------- *}

			{* -------------------- Панель 2 ---------------------------- *}
				<div>
					<h3>{$smarty.const.ANNOUNCE_RESUME_PARAMS_HEAD}</h3>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name" valign="top">{$smarty.const.ANNOUNCE_VISIBILITY_HEAD}&nbsp;<span class="text-red">*</span></td>
							<td class="error" valign="top">
							{if $errFields.visibility}
								<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.visibility}">
							{/if}
							</td>
							<td class="form" valign="top" style="width:300px;">
								<input type="radio" name="arrBindFields[visibility]" class="radio" value="visible"{if 'visible' eq $arrBindFields.visibility} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_VISIBILITY_VISIBLE} <br>
								<input type="radio" name="arrBindFields[visibility]" class="radio" value="visiblehc"{if 'visiblehc' eq $arrBindFields.visibility} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_VISIBILITY_VISIBLEHC}<br>
								<input type="radio" name="arrBindFields[visibility]" class="radio" value="members"{if 'members' eq $arrBindFields.visibility} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_VISIBILITY_MEMBERS}<br>
								<input type="radio" name="arrBindFields[visibility]" class="radio" value="membershc"{if 'membershc' eq $arrBindFields.visibility} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_VISIBILITY_MEMBERSHC}<br>
								<input type="radio" name="arrBindFields[visibility]" class="radio" value="hide"{if 'hide' eq $arrBindFields.visibility} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_VISIBILITY_HIDE}<br>
							</td>
							<td valign="top">
								<span class="user_help" id="HELP_ANNOUNCE_RADIOBOX_VISIBILITY">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
							</td>
						</tr>
					</table>

					<br><hr class="Design_panesDelimiter"><br>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_SECTION}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.id_section}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.id_section}">
								{/if}
							</td>
							<td class="form">
								<select name="arrBindFields[id_section]" id="section" >
									<option value="">{$smarty.const.ANNOUNCE_OPTION_SECTION}</option>
									{foreach from=$sections item="section"}
										<option value="{$section.id}"{if $arrBindFields.id_section eq $section.id} selected="selected"{/if}>{$section.name}</option>
									{/foreach}
								</select>
							</td>
						</tr>
						<tr id="div_professions">
							<td class="name" valign="top">{$smarty.const.ANNOUNCE_SELECT_PROFESSION}&nbsp;<span class="text-red">*</span></td>
							<td class="error" valign="top">
								{if $errFields.id_section}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.id_section}">
								{elseif $errFields.id_profession}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.id_profession}">
								{/if}
							</td>
							<td class="form" valign="top">
								<div style="font-weight:bold">
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/actions/errpage.png" alt="">
									{$smarty.const.ANNOUNCE_SELECT_PROFESSION_NOTE}
								</div>
								<div id="professions_list"></div>
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_REGION}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.id_region}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.id_region}">
								{/if}
							</td>
							<td class="form">
								<select name="arrBindFields[id_region]" id="region" >
									<option value="">{$smarty.const.ANNOUNCE_OPTION_REGION}</option>
									{foreach from=$regions item="region"}
										<option value="{$region.id}"{if $arrBindFields.id_region eq $region.id} selected="selected"{/if}>{$region.name}</option>
									{/foreach}
								</select>
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_CITY}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.id_region}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.id_region}">
								{elseif $errFields.id_city}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.id_city}">
								{/if}
							</td>
							<td class="form">
								<select name="arrBindFields[id_city]" id="city" >
									<option value="">{$smarty.const.ANNOUNCE_OPTION_CITY}</option>
								</select>
								<input type="text" id="id_other_city" name="other_city" style="display: none;"  size="25" maxlength="50">
							</td>
						</tr>
					</table>

					<br><hr class="Design_panesDelimiter"><br>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_PAY_HEAD}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.pay_from}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.pay_from}">
								{/if}
							</td>
							<td class="form">
								{$smarty.const.SITE_FROM}&nbsp;
								<input type="text" name="arrBindFields[pay_from]"  size="5" maxlength="10" value="{$arrBindFields.pay_from}">
								<select name="arrBindFields[currency]" id="currency" >
									{foreach from=$arrSysDict.Currency.values item="item"}
										<option value="{$item}"{if $arrBindFields.currency eq $item} selected="selected"{/if}>{$item}</option>
									{/foreach}
								</select>
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								<select name="arrNoBindFields[chart_work]" id="chart_work">
									{foreach from=$arrAddDict.ChartWork.values item="item"}
										<option value="{$item}"{if $arrNoBindFields.chart_work eq $item} selected="selected"{/if}>{$item}</option>
									{/foreach}
								</select>
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_EDUCATION}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.education}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.education}">
								{/if}
							</td>
							<td class="form">
								<select name="arrBindFields[education]" id="education" >
									<option value="0">{$smarty.const.ANNOUNCE_OPTION_EDUCATION}</option>
									{foreach from=$arrAddDict.Education.values item="item"}
										<option value="{$item}"{if $arrBindFields.education eq $item} selected="selected"{/if}>{$item}</option>
									{/foreach}
								</select>
							</td>
						</tr>
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}&nbsp;<span class="text-red">*</span></td>
							<td class="error">
								{if $errFields.expire_work}
									<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.expire_work}">
								{/if}
							</td>
							<td class="form">
								<select name="arrBindFields[expire_work]" id="expire_work" >
									<option value="0">{$smarty.const.ANNOUNCE_OPTION_EXPIREWORK}</option>
									{foreach from=$arrAddDict.ExpireWorkResume.values item="item"}
										<option value="{$item}"{if $arrBindFields.expire_work eq $item} selected="selected"{/if}>{$item}</option>
									{/foreach}
								</select>
							</td>
						</tr>
					</table>

					<br><br>

					<a href="#info" class="naviLeft">&larr; {$smarty.const.FORM_BUTTON_PREV}</a>
					<a href="#education" class="naviRight">{$smarty.const.FORM_BUTTON_NEXT} &rarr;</a>
					<div class="clearL">&nbsp;</div>

					<br>
				</div>
			{* -------------------- ^^Панель 2^^ ---------------------------- *}

			{* -------------------- Панель 3 ---------------------------- *}
				<div>
					{foreach from=$arrFieldsXmlData.educations item="education" key="key" name="edu_foreach"}
						<div class="div_ext">
							<br>
							<div class="DesignDivExt">
								{if $smarty.foreach.edu_foreach.first}
									<h3>{$smarty.const.ANNOUNCE_INPUT_BASIC_EDUCATION}</h3>
									<input type="hidden" name="arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrBindFields][type]" value="{$smarty.const.ANNOUNCE_INPUT_BASIC_EDUCATION}">
								{else}
									<table class="Design_panesFormTable">
										<tr>
											<td class="tdHeader">
												<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/delbutton.gif" alt="" class="close_button" style="cursor: pointer; float: right;">
											</td>
										</tr>
									</table>
									<table class="Design_panesFormTable">
										<tr>
											<td class="name">{$smarty.const.ANNOUNCE_SELECT_EDUCATION_TYPE}&nbsp;<span class="text-red">*</span></td>
											<td class="error">
												{if $errFields.educations[$key].arrBindFields.type}
													<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.educations[$key].arrBindFields.type}">
												{/if}
											</td>
											<td class="form">
												<select name="arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrBindFields][type]">
													<option value="0">{$smarty.const.ANNOUNCE_OPTION_EDUCATION_TYPE}</option>
													{foreach from=$arrAddDict.EducationType.values item="item"}
														<option value="{$item}"{if $education.arrBindFields.type eq $item} selected="selected"{/if}>{$item}</option>
													{/foreach}
												</select>
											</td>
										</tr>
									</table>
								{/if}

									<table class="Design_panesFormTable">
										<tr>
											<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_INSTITUTION}&nbsp;<span class="text-red">*</span></td>
											<td class="error">
												{if $errFields.educations[$key].arrBindFields.institution}
													<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.educations[$key].arrBindFields.institution}">
												{/if}
											</td>
											<td class="form">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3">
												<input type="text" name="arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrBindFields][institution]" value="{$education.arrBindFields.institution}" size="90" maxlength="255">
											</td>
										</tr>
										<tr>
											<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_DEGREE}&nbsp;<span class="text-red">*</span></td>
											<td class="error">
												{if $errFields.educations[$key].arrBindFields.degree}
													<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.educations[$key].arrBindFields.degree}">
												{/if}
											</td>
											<td class="form">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3">
												<input type="text" name="arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrBindFields][degree]" value="{$education.arrBindFields.degree}" size="90" maxlength="255">
											</td>
										</tr>
									</table>

									<table class="Design_panesFormTable">
										<tr>
											<td class="name">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_FINISH_DATE}:&nbsp;<span class="text-red">*</span>&nbsp;</td>
											<td class="error">
												{if $errFields.educations[$key].arrBindFields.finish_month || $errFields.educations[$key].arrBindFields.finish_year}
													<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt=""
													title="{if $errFields.educations[$key].arrBindFields.finish_month} {$errFields.educations[$key].arrBindFields.finish_month}
													{elseif $errFields.educations[$key].arrBindFields.finish_year} {$errFields.educations[$key].arrBindFields.finish_year}
													{/if}">
												{/if}
											</td>
											<td class="form">
												<select name="arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrBindFields][finish_month]" >
													<option value="0"></option>
													{foreach from=$arrAddDict.Month.values item="item"}
														<option value="{$item}"{if $education.arrBindFields.finish_month eq $item} selected="selected"{/if}>{$item}</option>
													{/foreach}
												</select>
												<select name="arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrBindFields][finish_year]" >
													<option value="0"></option>
													{foreach from=$years item="item"}
														<option value="{$item}"{if $education.arrBindFields.finish_year eq $item} selected="selected"{/if}>{$item}</option>
													{/foreach}
												</select>
											</td>
										</tr>
									</table>

									<table class="Design_panesFormTable">
										<tr>
											<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_EXTINFO}</td>
											<td class="error">&nbsp;</td>
											<td class="form">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3">
												<textarea name="arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrNoBindFields][ext_info]" rows="3" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$education.arrNoBindFields.ext_info}</textarea>
											</td>
										</tr>
									</table>
								</div>
							</div>
					{/foreach}

					<div id="ext_edu" style="display: none;">
						<div class="div_ext">
							<br>
							<div class="DesignDivExt">
								<table class="Design_panesFormTable">
									<tr>
										<td colspan="2" class="tdHeader">
											<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/delbutton.gif" alt="" class="close_button" style="cursor: pointer; float:right;">
										</td>
									</tr>
								</table>
								<table class="Design_panesFormTable">
									<tr>
										<td class="name">{$smarty.const.ANNOUNCE_SELECT_EDUCATION_TYPE}</td>
										<td class="error">&nbsp;</td>
										<td class="form">
											<select name="added[educations][][arrBindFields][type]" >
												<option value="0">{$smarty.const.ANNOUNCE_OPTION_EDUCATION_TYPE}</option>
												{foreach from=$arrAddDict.EducationType.values item="item"}
													<option value="{$item}">{$item}</option>
												{/foreach}
											</select>
										</td>
									</tr>
								</table>

								<table class="Design_panesFormTable">
									<tr>
										<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_INSTITUTION}</td>
										<td class="error">&nbsp;</td>
										<td class="form">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">
											<input type="text" name="added[educations][][arrBindFields][institution]"  size="90" maxlength="255">
										</td>
									</tr>

									<tr>
										<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_DEGREE}</td>
										<td class="error">&nbsp;</td>
										<td class="form">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">
											<input type="text" name="added[educations][][arrBindFields][degree]"  size="90" maxlength="255">
										</td>
									</tr>
								</table>

								<table class="Design_panesFormTable">
									<tr>
										<td class="name">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_FINISH_DATE}:&nbsp;</td>
										<td class="error">&nbsp;</td>
										<td class="form">
											<select name="added[educations][][arrBindFields][finish_month]" >
												<option value="0"></option>
												{foreach from=$arrAddDict.Month.values item="item"}
													<option value="{$item}">{$item}</option>
												{/foreach}
											</select>
											<select name="added[educations][][arrBindFields][finish_year]" >
												<option value="0"></option>
												{foreach from=$years item="item"}
													<option value="{$item}">{$item}</option>
												{/foreach}
											</select>
										</td>
									</tr>
								</table>

								<table class="Design_panesFormTable">
									<tr>
										<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_EXTINFO}</td>
										<td class="error">&nbsp;</td>
										<td class="form">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">
											<textarea name="added[educations][][arrNoBindFields][ext_info]" rows="3" cols="70"></textarea>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<br>

					<div class="DesignDivExt">
						<table class="Design_panesFormTable">
							<tr>
								<td colspan="3" class="tdHeader">
									<img class="edu" id="add_edu" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/plusAddButton.png" alt="{$smarty.const.ANNOUNCE_BUTTON_ADD_EDUCATION}..." title="{$smarty.const.ANNOUNCE_BUTTON_ADD_EDUCATION}..." style="cursor: pointer;">&nbsp;
									{$smarty.const.ANNOUNCE_BUTTON_ADD_EDUCATION}
								</td>
							</tr>
						</table>
					</div>

					<br><br>

					<a href="#params" class="naviLeft">&larr; {$smarty.const.FORM_BUTTON_PREV}</a>
					<a href="#expire" class="naviRight">{$smarty.const.FORM_BUTTON_NEXT} &rarr;</a>
					<div class="clearL">&nbsp;</div>

					<br>

				</div>
			{* -------------------- ^^Панель 3^^ ---------------------------- *}

			{* -------------------- Панель 4 ---------------------------- *}
				<div class="divexp">
					<h3>{$smarty.const.ANNOUNCE_EXPIREINFO_HEAD}</h3>

					<table class="Design_panesFormTable">
						<tr>
							<td>
								<input type="checkbox" name="career_launch" id="id_career_launch" class="exp" {if $career_launch}checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_INPUT_EXPIRE_CAREER_LAUNCH}
							</td>
						</tr>
					</table>
					<table class="Design_panesFormTable expAttention">
						<tr>
							<td style="font-weight:bold">
								<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/actions/errpage.png" alt="">
								{$smarty.const.ANNOUNCE_EXPIRE_DISCRIPTION}
							</td>
						</tr>
					</table>
					{if $arrFieldsXmlData.expires}
						{foreach from=$arrFieldsXmlData.expires item="expire" key="key" name="exp_foreach"}
							<div class="div_ext">
								<br>
								<div class="DesignDivExt">
									<table class="Design_panesFormTable">
										{if !$smarty.foreach.exp_foreach.first}
											<tr>
												<td class="tdHeader" colspan="3"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/delbutton.gif" alt="" class="close_button" style="cursor: pointer; vertical-align: middle; float: right;"></td>
											</tr>
										{/if}
										<tr>
											<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EXPIRE_PERIOD}:&nbsp;<span class="text-red">*</span></td>
											<td class="error">
												{if $errFields.expires[$key].arrBindFields.begin_month || $errFields.expires[$key].arrBindFields.begin_year}
												<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt=""
												title="{if $errFields.expires[$key].arrBindFields.begin_month}{$errFields.expires[$key].arrBindFields.begin_month}
												{elseif $errFields.expires[$key].arrBindFields.begin_year}{$errFields.expires[$key].arrBindFields.begin_year}{/if}
												">
												{/if}
											</td>
											<td class="form">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3">
												{$smarty.const.SITE_WITH}&nbsp;
												<select name="arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrBindFields][begin_month]">
													<option value="0"></option>
													{foreach from=$arrAddDict.Month.values item="item"}
														<option value="{$item}"{if $expire.arrBindFields.begin_month eq $item} selected="selected"{/if}>{$item}</option>
													{/foreach}
												</select>
												<select name="arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrBindFields][begin_year]">
													<option value="0"></option>
													{foreach from=$years item="item"}
														<option value="{$item}"{if $expire.arrBindFields.begin_year eq $item} selected="selected"{/if}>{$item}</option>
													{/foreach}
												</select>
												&nbsp;{$smarty.const.SITE_UPON}&nbsp;
												<select name="arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrNoBindFields][finish_month]">
													<option value="0"></option>
													{foreach from=$arrAddDict.Month.values item="item"}
														<option value="{$item}"{if $expire.arrNoBindFields.finish_month eq $item} selected="selected"{/if}>{$item}</option>
													{/foreach}
												</select>
												<select name="arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrNoBindFields][finish_year]">
													<option value="0"></option>
													{foreach from=$years item="item"}
														<option value="{$item}"{if $expire.arrNoBindFields.finish_year eq $item} selected="selected"{/if}>{$item}</option>
													{/foreach}
												</select>
												<span class="user_help" id="HELP_RESUME_INPUT_EXPIRE_PERIOD">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
											</td>
										</tr>
										<tr>
											<td class="name300">{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}&nbsp;<span class="text-red">*</span></td>
											<td class="error">
												{if $errFields.expires[$key].arrBindFields.company}
													<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.expires[$key].arrBindFields.company}">
												{/if}
											</td>
											<td class="form">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3">
												<input type="text" name="arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrBindFields][company]" value="{$expire.arrBindFields.company}" size="50" maxlength="255">
											</td>
										</tr>
										<tr>
											<td class="name300">{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION} <span class="user_help" id="HELP_ANNOUNCE_TEXTAREA_COMPANY_DISCRIPTION">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span></td>
											<td class="error">&nbsp;</td>
											<td class="form">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3">
												<textarea name="arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrNoBindFields][company_discription]" rows="2" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$expire.arrNoBindFields.company_discription}</textarea>
											</td>
										</tr>
										<tr>
											<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EXPIRE_APPOINTMENT}&nbsp;<span class="text-red">*</span></td>
											<td class="error">
												{if $errFields.expires[$key].arrBindFields.appointment}
													<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.expires[$key].arrBindFields.appointment}">
												{/if}
											</td>
											<td class="form">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3">
												<input type="text" name="arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrBindFields][appointment]" value="{$expire.arrBindFields.appointment}"  size="50" maxlength="255">
											</td>
										</tr>
										<tr>
											<td class="name300">{$smarty.const.ANNOUNCE_TEXTAREA_EXPIRE_DUTIES_INFO}&nbsp;<span class="text-red">*</span></td>
											<td class="error">
												{if $errFields.expires[$key].arrBindFields.duties_info}
													<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.expires[$key].arrBindFields.duties_info}">
												{/if}
											</td>
											<td class="form">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="3">
												<textarea name="arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrBindFields][duties_info]" rows="10" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$expire.arrBindFields.duties_info}</textarea>
											</td>
										</tr>
									</table>
								</div>
							</div>
						{/foreach}
					{/if}

					<div id="ext_exp" style="display: none;">
						<div class="div_ext">
							<br>
							<div class="DesignDivExt">
								<table class="Design_panesFormTable">
									<tr>
										<td colspan="3" class="tdHeader">
											<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/delbutton.gif" alt="" class="close_button" style="cursor: pointer; vertical-align: middle; float: right;">
										</td>
									</tr>
								</table>

								<table class="Design_panesFormTable">
									<tr>
										<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EXPIRE_PERIOD}:</td>
										<td class="error">&nbsp;</td>
										<td class="form">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">
											&nbsp;{$smarty.const.SITE_WITH}&nbsp;
											<select name="added[expires][][arrBindFields][begin_month]">
												<option value="0"></option>
												{foreach from=$arrAddDict.Month.values item="item"}
													<option value="{$item}">{$item}</option>
												{/foreach}
											</select>
											<select name="added[expires][][arrBindFields][begin_year]">
												<option value="0"></option>
												{foreach from=$years item="item"}
													<option value="{$item}">{$item}</option>
												{/foreach}
											</select>
											&nbsp;{$smarty.const.SITE_UPON}&nbsp;
											<select name="added[expires][][arrNoBindFields][finish_month]">
												<option value="0"></option>
												{foreach from=$arrAddDict.Month.values item="item"}
													<option value="{$item}">{$item}</option>
												{/foreach}
											</select>
											<select name="added[expires][][arrNoBindFields][finish_year]">
												<option value="0"></option>
												{foreach from=$years item="item"}
													<option value="{$item}">{$item}</option>
												{/foreach}
											</select>
										</td>
									</tr>
									<tr>
										<td class="name300">{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}</td>
										<td class="error">&nbsp;</td>
										<td class="form">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">
											<input type="text" name="added[expires][][arrBindFields][company]"  size="50" maxlength="255">
										</td>
									</tr>
									<tr>
										<td class="name300">{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}</td>
										<td class="error">&nbsp;</td>
										<td class="form">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">
											<textarea name="added[expires][][arrNoBindFields][company_discription]" rows="2" cols="70"></textarea>
										</td>
									</tr>
									<tr>
										<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EXPIRE_APPOINTMENT}</td>
										<td class="error">&nbsp;</td>
										<td class="form">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">
											<input type="text" name="added[expires][][arrBindFields][appointment]"  size="50" maxlength="255">
										</td>
									</tr>
									<tr>
										<td class="name300">{$smarty.const.ANNOUNCE_TEXTAREA_EXPIRE_DUTIES_INFO}</td>
										<td class="error">&nbsp;</td>
										<td class="form">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">
											<textarea name="added[expires][][arrBindFields][duties_info]" rows="10" cols="70"></textarea>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<br>

					<div class="DesignDivExt"{if $career_launch} style="display: none;"{/if}>
						<table class="Design_panesFormTable">
							<tr>
								<td colspan="3" class="tdHeader">
									<img class="exp" id="add_exp" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/plusAddButton.png" alt="{$smarty.const.ANNOUNCE_BUTTON_ADD_EXPIRE}..." title="{$smarty.const.ANNOUNCE_BUTTON_ADD_EXPIRE}..." style="vertical-align: middle; cursor: pointer;">
									&nbsp; {$smarty.const.ANNOUNCE_BUTTON_ADD_EXPIRE}
								</td>
							</tr>
							</table>
					</div>

					<br><br>

					<a href="#education" class="naviLeft">&larr; {$smarty.const.FORM_BUTTON_PREV}</a>
					<a href="#addition" class="naviRight">{$smarty.const.FORM_BUTTON_NEXT} &rarr;</a>
					<div class="clearL">&nbsp;</div>

					<br>
				</div>
			{* -------------------- ^^Панель 4^^ ---------------------------- *}

			{* -------------------- Панель 5 ---------------------------- *}
				<div class="divlang">
					<h3>{$smarty.const.ANNOUNCE_LANGUAGES_HEAD}</h3>
					{foreach from=$arrFieldsXmlData.languages item="language" key="key" name="lang_foreach"}
						{if $smarty.foreach.lang_foreach.first}
							<table class="Design_panesFormTable">
								<tr>
									<td class="name">{$smarty.const.ANNOUNCE_INPUT_NATIVE_LANGUAGE}&nbsp;<span class="text-red">*</span></td>
									<td class="error">
										{if $errFields.languages[$key].arrBindFields.lang}
											<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.languages[$key].arrBindFields.lang}">
										{/if}
									</td>
									<td class="form">
										<input type="hidden" name="arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrBindFields][type]" value="native">
										<input type="hidden" name="arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrBindFields][degree]" value="Native">
										<input type="hidden" name="arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrNoBindFields][note]" value="">
										<select name="arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrBindFields][lang]">
											<option value="0">{$smarty.const.ANNOUNCE_OPTION_LANGUAGE}</option>
											{foreach from=$arrAddDict.Languages.values item="item"}
												<option value="{$item}"{if $language.arrBindFields.lang eq $item} selected="selected"{/if}>{$item}</option>
											{/foreach}
										</select>
									</td>
								</tr>
								<tr>
									<td class="name">{$smarty.const.ANNOUNCE_INPUT_FOREIGN_LANGUAGE}</td>
									<td class="error">&nbsp;</td>
									<td class="form"><input type="checkbox" name="noforeign_lang" id="id_noforeign_lang" class="lang" {if $noforeign_lang}checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_INPUT_NOFOREIGN_LANGUAGE}</td>
								</tr>
							</table>
						{else}
							<div class="div_ext">
								<br>
								<div class="DesignDivExt">
									{if $smarty.foreach.lang_foreach.iteration>2}
										<table class="Design_panesFormTable">
											<tr>
												<td colspan="3" class="tdHeader">
													<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/delbutton.gif" alt="" class="close_button" style="cursor: pointer; float: right;">
												</td>
											</tr>
										</table>
									{/if}
									<table class="Design_panesFormTable">
										<tr>
											<td class="name175">{$smarty.const.ANNOUNCE_INPUT_FOREIGN_LANGUAGE}&nbsp;<span class="text-red">*</span></td>
											<td class="error">
												{if $errFields.languages[$key].arrBindFields.lang}
													<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.languages[$key].arrBindFields.lang}">
												{/if}
											</td>
											<td class="form">
												<input type="hidden" name="arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrBindFields][type]" value="foreign">
												<select name="arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrBindFields][lang]">
													<option value="0">{$smarty.const.ANNOUNCE_OPTION_LANGUAGE}</option>
													{foreach from=$arrAddDict.Languages.values item="item"}
														<option value="{$item}"{if $language.arrBindFields.lang eq $item} selected="selected"{/if}>{$item}</option>
													{/foreach}
												</select>
											</td>
										</tr>
										<tr>
											<td class="name175">{$smarty.const.ANNOUNCE_SELECT_LANGUAGE_DEGREE}&nbsp;<span class="text-red">*</span></td>
											<td class="error">
												{if $errFields.languages[$key].arrBindFields.degree}
													<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" title="{$errFields.languages[$key].arrBindFields.degree}">
												{/if}
											</td>
											<td class="form">
												<select name="arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrBindFields][degree]">
													<option value="0">{$smarty.const.ANNOUNCE_OPTION_LANGUAGE_DEGREE}</option>
													{foreach from=$arrAddDict.LangDegree.values item="item"}
														<option value="{$item}"{if $language.arrBindFields.degree eq $item} selected="selected"{/if}>{$item}</option>
													{/foreach}
												</select>
												<span class="user_help" id="HELP_ANNOUNCE_OPTION_LANGUAGE_DEGREE">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span>
											</td>
										</tr>
										<tr>
											<td class="namecolspan" colspan="3">{$smarty.const.ANNOUNCE_TEXTAREA_LANGUAGE_NOTE}</td>
										</tr>
										<tr>
											<td colspan="3">
												<textarea name="arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrNoBindFields][note]" rows="2" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$language.arrNoBindFields.note}</textarea>
											</td>
										</tr>
									</table>
								</div>
							</div>
						{/if}
					{/foreach}

					<div id="ext_lang" style="display: none;">
						<div class="div_ext">
							<br>
							<div class="DesignDivExt">
								<table class="Design_panesFormTable">
									<tr>
										<td colspan="3" class="tdHeader">
											<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/delbutton.gif" alt="" class="close_button" style="cursor: pointer; vertical-align: middle; float: right;">
										</td>
									</tr>
								</table>
								<table class="Design_panesFormTable">
									<tr>
										<td class="name175">{$smarty.const.ANNOUNCE_INPUT_FOREIGN_LANGUAGE}</td>
										<td class="error">&nbsp;</td>
										<td class="form">
											<input type="hidden" name="added[languages][][arrBindFields][type]" value="foreign">
											<select name="added[languages][][arrBindFields][lang]" >
												<option value="0">{$smarty.const.ANNOUNCE_OPTION_LANGUAGE}</option>
												{foreach from=$arrAddDict.Languages.values item="item"}
													<option value="{$item}">{$item}</option>
												{/foreach}
											</select>
										</td>
									</tr>
									<tr>
										<td class="name175">{$smarty.const.ANNOUNCE_SELECT_LANGUAGE_DEGREE}</td>
										<td class="error">&nbsp;</td>
										<td class="form">
											<select name="added[languages][][arrBindFields][degree]">
												<option value="0">{$smarty.const.ANNOUNCE_OPTION_LANGUAGE_DEGREE}</option>
												{foreach from=$arrAddDict.LangDegree.values item="item"}
													<option value="{$item}">{$item}</option>
												{/foreach}
											</select>
										</td>
									</tr>
									<tr>
										<td class="name" colspan="3">{$smarty.const.ANNOUNCE_TEXTAREA_LANGUAGE_NOTE}</td>
									</tr>
									<tr>
										<td class="name" colspan="3">
											<textarea name="added[languages][][arrNoBindFields][note]" rows="2" cols="70"></textarea>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<br>

					<div class="DesignDivExt"{if $noforeign_lang} style="display: none;"{/if}>
						<table class="Design_panesFormTable">
							<tr>
								<td colspan="3" class="tdHeader">
									<img class="lang" id="add_lang" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/plusAddButton.png" alt="{$smarty.const.ANNOUNCE_BUTTON_ADD_EXPIRE}..." title="{$smarty.const.ANNOUNCE_BUTTON_ADD_EXPIRE}..." style="cursor: pointer;">
									&nbsp; {$smarty.const.ANNOUNCE_BUTTON_ADD_LANGUAGE}
								</td>
							</tr>
						</table>
					</div>

					<br>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name300">{$smarty.const.ANNOUNCE_TEXTAREA_ABOUTINFO}&nbsp;<span class="user_help" id="HELP_RESUME_TEXTAREA_ABOUTINFO">&nbsp;<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt=""></span></td>
							<td class="error">&nbsp;</td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<textarea name="arrNoBindFields[about_info]" rows="10" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$arrNoBindFields.about_info}</textarea>
							</td>
						</tr>
					</table>

					<br><hr class="Design_panesDelimiter"><br>

					<table class="Design_panesFormTable">
						<tr>
							<td colspan="3">
								<br>
								<input type="checkbox" name="arrNoBindFields[subscription]" class="checkbox" {if $arrNoBindFields.subscription}checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_CHECKBOX_SUBCRIPTION}
								<br><br>
							</td>
						</tr>
					</table>

					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_ACTPERIOD}</td>
							<td class="error">&nbsp;</td>
							<td class="form">
								<select name="arrBindFields[act_period]" id="act_period">
									{foreach from=$arrSysDict.ActPeriod.values item="item" key="key"}
										<option value="{$key}"{if $arrBindFields.act_period eq $key} selected="selected"{/if}>{$item}</option>
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
										<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="" style="vertical-align: middle;" title="{$errFields.captcha}">
									{/if}
									<br><br>
								{/if}
							</td>
						</tr>
						<tr>
							<td colspan="3" align="center">
								<div class="submitButtonLight">
									<input type="submit" class="shadow01red" name="{$currAction}" value="{$smarty.const.FORM_BUTTON_SEND}">
								</div>
							</td>
						</tr>
					</table>

					{if 'edit' eq $currAction}
						<input type="hidden" name="unikey" value="{$unikey}">
					{/if}

						<input type="hidden" id="hprofessions" value="{$hprofessions}">
						<input type="hidden" id="hcity" value="{$arrBindFields.id_city}">
						<input type="hidden" name="arrBindFields[age]" value="{$arrBindFields.age}">
				</div>
			{* -------------------- ^^Панель 5^^ ---------------------------- *}
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
<!--
(function($) {
	// clear <div id="professions_list"></div>
	$.fn.clearProfessionsList =
		function() {
			$('#div_professions').hide();
			return $(this).empty();
		}
	// fill <div id="professions_list"></div>
	$.fn.fillProfessionsList = function(dataArray) {
		return this.clearProfessionsList().each(function() {
			var cntCheckBox = 0;
			var strCheckBox = '<table class="form"><tr>';
			$.each(dataArray, function(index, data)	{
				cntCheckBox++;
				var strAttr = '';
				if ($('#hprofessions').val()) {
					var sp = eval($('#hprofessions').val());
					for (i in sp) {
						if (sp[i] == data.id) {
							strAttr = 'checked="checked"';
						} else if (!strAttr && sp.length >= 3) {
							strAttr = 'disabled="disabled"';
						}
					}
				}
				strCheckBox = strCheckBox + '<td><input name="professions[]" type="checkbox" value="' + data.id + '" ' + strAttr + ' class="checkbox">' + data.name + '</td>';
				if (cntCheckBox > 1) {
					strCheckBox = strCheckBox + '</tr><tr>';
					cntCheckBox = 0;
				}
			});
			$(strCheckBox + '</tr></table>').appendTo('#professions_list');
			$('#div_professions').fadeIn('fast');
			// обрабатываем чекбоксы, если были изменения
			$('#professions_list :checkbox').click(function() {
				($('#professions_list :checkbox:checked').length < 3) ? $('#professions_list :checkbox').removeAttr('disabled') : $('#professions_list :checkbox:not(:checked)').attr('disabled', 'disabled');
			});
		});
	}
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
					var selVal = $('#hcity').val();
					var this_select = ('0' !== selVal && data.id == selVal) ? true : false;
					var option = new Option(data.name, data.id, false, this_select);
					($.support.cssFloat) ? currentSelect.add(option, null): currentSelect.add(option);
				});
				$('#selector').val('');
			}
		});
	}
})(jQuery);

$(document).ready(function() {
	//Формируем вкладки
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
	var divProfList = $('#professions_list');
	// обрабатываем селект после перезагрузки страницы
	if ($('#section').val()) {
		$.get('/ajax.php', { id_s: $('#section').val() }, function(data) {
			var data = $.parseJSON(data);
			divProfList.fillProfessionsList(data);
		});
	}
	// обрабатываем селект если он был изменен
	$('#section').change(function () {
		$('#hprofessions').val('')
		if (!$(this).val()) {
			$('#div_professions').hide('fast');
			divProfList.clearProfessionsList();
		} else {
			$.get('/ajax.php', { id_s: $(this).val() }, function(data) {
				var data = $.parseJSON(data);
				divProfList.fillProfessionsList(data);
			});
		}
	});
	// Обработка селектов Региона и Городов
	var selCitys = $('#city');
	var otherCity = $('#id_other_city');
	// обрабатываем селект если он был изменен
	selCitys.change(function () {
		if ('0' === $(this).val()) {
			otherCity.show('fast');
		} else {
			otherCity.hide('fast');
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
		otherCity.val('');
		otherCity.fadeOut('fast');
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
	//обрабатываем клик по кнопке дополнительных телефонов
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
	//обрабатываем добавление данных Образования, Опыта работы, Иностранных языков
	$('#add_edu, #add_exp, #add_lang').click(function () {
		var add_class = $(this).attr('class');
			ta = $('#ext_' + add_class +' > *').clone().hide().insertBefore('#ext_' + add_class).show('fast').find('textarea');
		//визуальный редактор
		{if $smarty.const.CONF_USE_VISUAL_EDITOR && $smarty.const.CONF_ANNOUNCE_USE_VISUAL_EDITOR}
			ta.addClass('tinymce add_tinymce');
			// инициируем редактор для новых полей
			tinyMCE.init({
				mode : "specific_textareas",
				editor_selector : "add_tinymce",
				language : "ru",
				/* PLUGINS */
				plugins : "autosave,fullscreen,advlist",
				relative_urls : false,
				remove_script_host : true,
				/* THEMES */
				theme : "advanced",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,outdent,indent,|,fontselect,fontsizeselect,|,bullist,numlist,|,cut,copy,paste,|,undo,redo,|,fullscreen",
				theme_advanced_buttons2 : false,
				theme_advanced_buttons3 : false,
				// Example content CSS (should be your site CSS)
				content_css : "/core/modules/tinymce/sd/style.css"
			});
			ta.removeClass('add_tinymce');
		{/if}
	});

	$('.div_ext').find('.close_button').live('click', (function () {
		$(this).parents('.div_ext').removeClass('div_ext').addClass('div_deleted').hide('fast');
	}));

	$('#id_career_launch, #id_noforeign_lang').click(function () {
		var chk_class = $(this).attr('class');
		if ($(this).attr('checked')) {
			$(this).parents('.div' + chk_class).find('.div_deleted').remove();
			$('.' + chk_class + 'Attention').hide('fast');
			$(this).parents('.div' + chk_class).find('.div_ext').removeClass('div_ext').addClass('div_deleted').hide('fast');
			$('#add_' + chk_class).parents('.DesignDivExt').hide('fast');
		} else {
			$('.' + chk_class + 'Attention').show('fast');
			if(!$(this).parents('.div' + chk_class).find('.div_deleted').size()) {
				ta = $('#ext_' + chk_class).children().clone().hide().insertBefore('#ext_' + chk_class);
				ta.find('.close_button').remove();
				//визуальный редактор
				{if $smarty.const.CONF_USE_VISUAL_EDITOR && $smarty.const.CONF_ANNOUNCE_USE_VISUAL_EDITOR}
					ta.find('textarea').addClass('tinymce add_tinymce');
					// инициируем редактор для новых полей
					tinyMCE.init({
						mode : "specific_textareas",
						editor_selector : "add_tinymce",
						language : "ru",
						/* PLUGINS */
						plugins : "autosave,fullscreen,advlist",
						relative_urls : false,
						remove_script_host : true,
						/* THEMES */
						theme : "advanced",
						theme_advanced_toolbar_location : "top",
						theme_advanced_toolbar_align : "left",
						theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,outdent,indent,|,fontselect,fontsizeselect,|,bullist,numlist,|,cut,copy,paste,|,undo,redo,|,fullscreen",
						theme_advanced_buttons2 : false,
						theme_advanced_buttons3 : false,
						// Example content CSS (should be your site CSS)
						content_css : "/core/modules/tinymce/sd/style.css"
					});
					ta.find('textarea').removeClass('add_tinymce');
				{/if}
				ta.show('fast');
				$('#add_' + chk_class).parents('.DesignDivExt').show('fast');
			} else {
		 		$(this).parents('.div' + chk_class).find('.div_deleted').removeClass('div_deleted').addClass('div_ext').show('fast');
				$('#add_' + chk_class).parents('.DesignDivExt').show('fast');
			}
		}
	});
	// действия при отправке формы
	$('form').submit(function () {
		$('#ext_edu, #ext_exp, #ext_lang, .div_deleted').remove();
	});
});
-->
</script>
{* Добавление фотокарточки к объявлению - Резюме *}
{if $smarty.const.CONF_RESUME_ADD_PHOTO}
<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/js/jquery/plugins/jquery.ajaxUploadFile.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function() {
    var uplDeleted = new Array();
	$('#uploadPhoto').ajaxUploadFile({
		urlUpload: '/ajax.php?uploadFile&fType=rPhotocard',
		attrInputFile: {
			name: 'uploadPhoto',
			size: 10,
			maxlength: 250
		},
		maxFileSize: {$smarty.const.CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE},
		maxUploadedFiles: 1,
		buttonUpload: '<input type="image" src="{$smarty.const.CONF_SCRIPT_URL}templates/site/{$smarty.const.CONF_TEMPLATE}/images/actions/add.png" style="vertical-align: bottom;" title="{$smarty.const.SITE_UPLOAD_FILE}" alt="{$smarty.const.SITE_UPLOAD_FILE}">',
		buttonCancel: '<img src="{$smarty.const.CONF_SCRIPT_URL}templates/site/{$smarty.const.CONF_TEMPLATE}/images/actions/cancel.png" style="margin: 0px 5px 0px 0px; vertical-align: bottom;" title="{$smarty.const.SITE_CANCEL}" alt="{$smarty.const.SITE_CANCEL}">',
		imgLoading: '<img src="{$smarty.const.CONF_SCRIPT_URL}templates/site/{$smarty.const.CONF_TEMPLATE}/images/loading.gif" style="margin-left: 5px; vertical-align: top;" alt="">',
		onComplete: function(data) {
			if (!data.responce.error) {
				var iPhotocard = data.key + '.' + data.realFileName;
                $('#iPhotocard').val(iPhotocard);
				$(document.createElement('img')).attr({
					src: '{$smarty.const.CONF_SCRIPT_URL}templates/site/{$smarty.const.CONF_TEMPLATE}/images/actions/delete.png',
					title: '{$smarty.const.FORM_ACTION_DELETE}',
					alt: '{$smarty.const.FORM_ACTION_DELETE}'
				}).css({ cursor: 'pointer', 'float': 'left' }).insertBefore(
					$(document.createElement('img')).attr({
						src: '{$smarty.const.CONF_SCRIPT_URL}uploads/temporary/' + iPhotocard,
						title: '',
						alt: ''
                    }).appendTo(
                        $(document.createElement('div')).attr({
                            id: 'uploadedPhoto'
                        }).insertBefore(data.selector)
                    )
                ).click(function() {
                	$.fn.ajaxUploadFile('delUploaded', {
                		urlDelUploaded: '/ajax.php?uploadFile&action=delUploaded',
						nameDeleteFile: iPhotocard
					});
					$('#iPhotocard').val('');
					$('#uploadedPhoto').remove();
					$('#uploadPhoto').show();
                });
			} else {
				switch (data.responce.error) {
					case 'errFileMaxSize':
						alert('{$smarty.const.ERROR_FILE_UPLOAD_MAX_FILESIZE}');
						break;
					case 'errFileUploading':
						alert('{$smarty.const.ERROR_FILE_NOT_LOAD}');
						break;
					case 'errFileName':
						alert('{$smarty.const.ERROR_FILE_NAME}');
						break;
					case 'errFileType':
						alert('{$smarty.const.ERROR_FILE_FORMAT_ERROR}');
						break;
					case 'errFileUploaded':
						alert('{$smarty.const.ERROR_FILE_UPLOAD_DESTINATION}');
						break;
					case 'ErrInputFile':
						alert('{$smarty.const.ERROR_FILE_NOT_SELECTED}');
						break;
					default:
						alert('{$smarty.const.ERROR_UNKNOWN}');
				}
				data.buttonCancel.show();
			}
		}
	});
	// Удаление фотокарточки
	$('#delPhotocard').css({ cursor: 'pointer' }).click(function() {
        if (confirm('{$smarty.const.MESSAGE_DELETE_FILE}')) {
        	$.fn.ajaxUploadFile('delUploaded', {
            	urlDelUploaded: '/ajax.php?uploadFile&action=delUploaded',
				nameDeleteFile: $('#iPhotocard').val()
			});
			$('#iPhotocard').val('');
			$('#uploadedPhoto').remove();
			$('#uploadPhoto').show();
        }
    });

	$(window).unload(function() {
		var delUploadedFile = new Array();
		var wData = $(window).data('delUploadedFile');
		(wData) ? delUploadedFile = wData.split(',') : $.noop;
		for (fName in delUploadedFile) {
			if ($('#iPhotocard').val() === delUploadedFile[fName]) {
				delete delUploadedFile[fName];
			}
		}
		$(window).data('delUploadedFile', delUploadedFile.join());
	});
});
-->
</script>
{/if}