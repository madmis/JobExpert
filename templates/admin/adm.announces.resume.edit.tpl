<div id="tabForm">
	<ul>
		<li><a href="#info">{$smarty.const.ANNOUNCE_INFO_TAB}</a></li>
		<li><a href="#params">{$smarty.const.ANNOUNCE_PARAMS_TAB}</a></li>
		<li><a href="#education">{$smarty.const.ANNOUNCE_EDUCATION_TAB}</a></li>
		<li><a href="#expire">{$smarty.const.ANNOUNCE_EXPIREINFO_TAB}</a></li>
		<li><a href="#addition">{$smarty.const.ANNOUNCE_ADDITION_PARAMS_TAB}</a></li>
		<li><a href="#metadata">{$smarty.const.FORM_META_DATA}</a></li>
	</ul>

	<form action="#" id="fEditAnnounce" method="post" enctype="multipart/form-data">
		{* -------------------- Панель 1 ---------------------------- *}
		<div id="info">
			<h3>{$smarty.const.ANNOUNCE_RESUME_INFO_HEAD}</h3>
			<table class="Design_panesFormTable">
				<tr>
					<td class="name">{$smarty.const.RESUME_TITLE}</td>
					<td class="form">
						<input type="text" name="arrBindFields[title]" value="{$arrBindFields.title|escape}" size="60" maxlength="255">&nbsp;
					</td>
				</tr>
			</table>

			<hr class="Design_panesDelimiter">

			<h3>{$smarty.const.ANNOUNCE_COMPETITOR_INFO}</h3>

			<table class="Design_panesFormTable">
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_LASTNAME}</td>
					<td class="form">
						<input type="text" name="arrBindFields[last_name]" value="{$arrBindFields.last_name|escape}" size="30" maxlength="50">
					</td>
                    {if $smarty.const.CONF_RESUME_ADD_PHOTO}
                        <td class="name" rowspan="5" style="width: 40%; vertical-align: text-top; padding-left: 25px;">
                            {$smarty.const.ANNOUNCE_CONTACTS_PHOTOCARD}
                            <br><br>
                            <div id="uploadPhoto"{if $arrNoBindFields.image} style="display: none;"{/if}>
                                <input type="button" value="{$smarty.const.FORM_BUTTON_UPLOAD}" style="margin-left: 5px;">
                            </div>
                            {if $arrNoBindFields.image}
                                <div id="uploadedPhoto">
                                    <img id="delPhotocard" src="{$smarty.const.CONF_SCRIPT_URL}templates/admin/images/actions/delete.png" alt="{$smarty.const.FORM_BUTTON_DELETE}" title="{$smarty.const.FORM_BUTTON_DELETE}" style="float: left;">
                                    <img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/photos/{$arrNoBindFields.image}" alt="" title="">
                                </div>
                            {/if}
                            <input type="hidden" name="arrNoBindFields[image]" id="iPhotocard" value="{if $arrNoBindFields.image}{$arrNoBindFields.image}{/if}">
                        </td>
                    {/if}
				</tr>
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_FIRSTNAME}</td>
					<td class="form">
						<input type="text" name="arrBindFields[first_name]" value="{$arrBindFields.first_name|escape}" size="30" maxlength="50">
					</td>
				</tr>
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_MIDDLENAME}</td>
					<td class="form">
						<input type="text" name="arrNoBindFields[middle_name]" value="{$arrNoBindFields.middle_name|escape}" size="30" maxlength="50">
					</td>
				</tr>
				<tr>
					<td class="name">{$smarty.const.FORM_USER_BIRTHDAY}</td>
					<td class="form">
						{html_select_date time=$arrBindFields.birthday field_array="birthday" field_order="DMY" month_format="%m" start_year="-65" end_year="-14" reverse_years="true" day_empty="" month_empty="" year_empty="" all_extra='style="text-align: center;"'}
					</td>
				</tr>
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_SELECT_GENDER}</td>
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
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_EMAIL}</td>
					<td class="form">
						<input type="text" name="arrBindFields[email]" value="{$arrBindFields.email}" size="30" maxlength="50">&nbsp;
						<input type="checkbox" name="arrNoBindFields[public_email]" disabled="disabled"{if $arrNoBindFields.public_email} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_CONTACTS_EMAIL_PUBLIC}
					</td>
				</tr>
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE}</td>
					<td class="form">
						<input type="text" name="arrBindFields[phone]" value="{$arrBindFields.phone}" size="30" maxlength="50">&nbsp;
					</td>
				</tr>
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE_NOTE}</td>
					<td class="form">
						<input type="text" name="arrNoBindFields[note_phone]" value="{$arrNoBindFields.note_phone|escape}" size="75" maxlength="250">
					</td>
				</tr>
				<tr class="addition_phones">
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE}</td>
					<td class="form">
						<input type="text" name="arrNoBindFields[addition_phone_1]" value="{$arrNoBindFields.addition_phone_1}" size="30" maxlength="50">
					</td>
				</tr>
				<tr class="addition_phones">
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE_NOTE}</td>
					<td class="form">
						<input type="text" name="arrNoBindFields[note_addition_phone_1]" value="{$arrNoBindFields.note_addition_phone_1|escape}" size="75" maxlength="250">
					</td>
				</tr>
				<tr class="addition_phones">
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE}</td>
					<td class="form">
						<input type="text" name="arrNoBindFields[addition_phone_2]" value="{$arrNoBindFields.addition_phone_2}" size="30" maxlength="50">
					</td>
				</tr>
				<tr class="addition_phones">
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE_NOTE}</td>
					<td class="form">
						<input type="text" name="arrNoBindFields[note_addition_phone_2]" value="{$arrNoBindFields.note_addition_phone_2|escape}" size="75" maxlength="250">
					</td>
				</tr>
			</table>
		</div>
		{* -------------------- ^^Панель 1^^ ---------------------------- *}

		{* -------------------- Панель 2 ---------------------------- *}
		<div id="params">
			<h3>{$smarty.const.ANNOUNCE_RESUME_PARAMS_HEAD}</h3>
			<table class="Design_panesFormTable">
				<tr>
					<td class="name" valign="top">{$smarty.const.ANNOUNCE_VISIBILITY_HEAD}</td>
					<td class="form" valign="top" style="width:300px;">
						<input type="radio" name="arrBindFields[visibility]" class="radio" value="visible"{if 'visible' eq $arrBindFields.visibility} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_VISIBILITY_VISIBLE} <br>
						<input type="radio" name="arrBindFields[visibility]" class="radio" value="visiblehc"{if 'visiblehc' eq $arrBindFields.visibility} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_VISIBILITY_VISIBLEHC}<br>
						<input type="radio" name="arrBindFields[visibility]" class="radio" value="members"{if 'members' eq $arrBindFields.visibility} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_VISIBILITY_MEMBERS}<br>
						<input type="radio" name="arrBindFields[visibility]" class="radio" value="membershc"{if 'membershc' eq $arrBindFields.visibility} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_VISIBILITY_MEMBERSHC}<br>
						<input type="radio" name="arrBindFields[visibility]" class="radio" value="hide"{if 'hide' eq $arrBindFields.visibility} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_VISIBILITY_HIDE}<br>
					</td>
				</tr>
			</table>

			<hr class="Design_panesDelimiter">

			<table class="Design_panesFormTable">
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_SELECT_SECTION}</td>
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
						<td class="name" valign="top">{$smarty.const.ANNOUNCE_SELECT_PROFESSION}</td>
						<td class="form" valign="top">
							<div style="font-weight:bold">
								<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/actions/errpage.png" alt="">
								{$smarty.const.ANNOUNCE_SELECT_PROFESSION_NOTE}
							</div>
							<div id="professions_list"></div>
						</td>
					</tr>
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_SELECT_REGION}</td>
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
						<td class="name">{$smarty.const.ANNOUNCE_SELECT_CITY}</td>
						<td class="form">
							<select name="arrBindFields[id_city]" id="city" >
								<option value="">{$smarty.const.ANNOUNCE_OPTION_CITY}</option>
							</select>
						</td>
					</tr>
				</table>

				<hr class="Design_panesDelimiter">

				<table class="Design_panesFormTable">
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_PAY_HEAD}</td>
						<td class="form">
							{$smarty.const.SITE_FROM}&nbsp;
							<input type="text" name="arrBindFields[pay_from]"  size="5" maxlength="10" value="{$arrBindFields.pay_from}">
							<select name="arrBindFields[currency]">
								{foreach from=$arrSysDict.Currency.values item="item"}
									<option value="{$item}"{if $arrBindFields.currency eq $item} selected="selected"{/if}>{$item}</option>
								{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}</td>
						<td class="form">
							<select name="arrNoBindFields[chart_work]">
								{foreach from=$arrAddDict.ChartWork.values item="item"}
									<option value="{$item}"{if $arrNoBindFields.chart_work eq $item} selected="selected"{/if}>{$item}</option>
								{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_SELECT_EDUCATION}</td>
						<td class="form">
							<select name="arrBindFields[education]">
								<option value="0">{$smarty.const.ANNOUNCE_OPTION_EDUCATION}</option>
								{foreach from=$arrAddDict.Education.values item="item"}
									<option value="{$item}"{if $arrBindFields.education eq $item} selected="selected"{/if}>{$item}</option>
								{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}</td>
						<td class="form">
							<select name="arrBindFields[expire_work]">
								<option value="0">{$smarty.const.ANNOUNCE_OPTION_EXPIREWORK}</option>
								{foreach from=$arrAddDict.ExpireWorkResume.values item="item"}
									<option value="{$item}"{if $arrBindFields.expire_work eq $item} selected="selected"{/if}>{$item}</option>
								{/foreach}
							</select>
						</td>
					</tr>
				</table>
		</div>
		{* -------------------- ^^Панель 2^^ ---------------------------- *}

		{* -------------------- Панель 3 ---------------------------- *}
		<div id="education">
			{foreach from=$arrFieldsXmlData.educations item="education" key="key" name="edu_foreach"}
				{if $smarty.foreach.edu_foreach.first}
					<h3>{$smarty.const.ANNOUNCE_INPUT_BASIC_EDUCATION}</h3>
					<input type="hidden" name="arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrBindFields][type]" value="{$smarty.const.ANNOUNCE_INPUT_BASIC_EDUCATION}">
				{else}
					<hr class="Design_panesDelimiter">
					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_SELECT_EDUCATION_TYPE}</td>
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
						<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_INSTITUTION}</td>
						<td class="form">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">
							<input type="text" name="arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrBindFields][institution]" value="{$education.arrBindFields.institution|escape}" size="90" maxlength="255">
						</td>
					</tr>
					<tr>
						<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_DEGREE}</td>
						<td class="form">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">
							<input type="text" name="arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrBindFields][degree]" value="{$education.arrBindFields.degree|escape}" size="90" maxlength="255">
						</td>
					</tr>
				</table>

				<table class="Design_panesFormTable">
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_INPUT_EDUCATION_FINISH_DATE}:&nbsp;</td>
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
						<td class="form">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">
							<textarea name="arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrNoBindFields][ext_info]" rows="3" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$education.arrNoBindFields.ext_info}</textarea>
						</td>
					</tr>
				</table>
			{/foreach}
		</div>
		{* -------------------- ^^Панель 3^^ ---------------------------- *}

		{* -------------------- Панель 4 ---------------------------- *}
		<div id="expire">
			<h3>{$smarty.const.ANNOUNCE_EXPIREINFO_HEAD}</h3>
			<table class="Design_panesFormTable">
				<tr>
					<td>
						<input type="checkbox" name="career_launch" disabled="disabled"{if $career_launch} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_INPUT_EXPIRE_CAREER_LAUNCH}
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
					{if !$smarty.foreach.exp_foreach.first}
						<hr class="Design_panesDelimiter">
					{/if}
					<table class="Design_panesFormTable">
						<tr>
							<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EXPIRE_PERIOD}:</td>
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
							</td>
						</tr>
						<tr>
							<td class="name300">{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}</td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<input type="text" name="arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrBindFields][company]" value="{$expire.arrBindFields.company|escape}" size="50" maxlength="255">
							</td>
						</tr>
						<tr>
							<td class="name300">{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}</td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<textarea name="arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrNoBindFields][company_discription]" rows="2" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$expire.arrNoBindFields.company_discription}</textarea>
							</td>
						</tr>
						<tr>
							<td class="name300">{$smarty.const.ANNOUNCE_INPUT_EXPIRE_APPOINTMENT}</td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<input type="text" name="arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrBindFields][appointment]" value="{$expire.arrBindFields.appointment|escape}"  size="50" maxlength="255">
							</td>
						</tr>
						<tr>
							<td class="name300">{$smarty.const.ANNOUNCE_TEXTAREA_EXPIRE_DUTIES_INFO}</td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<textarea name="arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrBindFields][duties_info]" rows="10" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$expire.arrBindFields.duties_info}</textarea>
							</td>
						</tr>
					</table>
				{/foreach}
			{/if}
		</div>
		{* -------------------- ^^Панель 4^^ ---------------------------- *}

		{* -------------------- Панель 5 ---------------------------- *}
		<div id="addition">
			<h3>{$smarty.const.ANNOUNCE_LANGUAGES_HEAD}</h3>
			{foreach from=$arrFieldsXmlData.languages item="language" key="key" name="lang_foreach"}
				{if $smarty.foreach.lang_foreach.first}
					<table class="Design_panesFormTable">
						<tr>
							<td class="name">{$smarty.const.ANNOUNCE_INPUT_NATIVE_LANGUAGE}</td>
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
							<td class="form"><input type="checkbox" disabled="disabled"{if $noforeign_lang} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_INPUT_NOFOREIGN_LANGUAGE}</td>
						</tr>
					</table>
				{else}
					<hr class="Design_panesDelimiter">
					<table class="Design_panesFormTable">
						<tr>
							<td class="name175">{$smarty.const.ANNOUNCE_INPUT_FOREIGN_LANGUAGE}</td>
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
							<td class="name175">{$smarty.const.ANNOUNCE_SELECT_LANGUAGE_DEGREE}</td>
							<td class="form">
								<select name="arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrBindFields][degree]">
									<option value="0">{$smarty.const.ANNOUNCE_OPTION_LANGUAGE_DEGREE}</option>
									{foreach from=$arrAddDict.LangDegree.values item="item"}
										<option value="{$item}"{if $language.arrBindFields.degree eq $item} selected="selected"{/if}>{$item}</option>
									{/foreach}
								</select>
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
				{/if}
			{/foreach}

			<table class="Design_panesFormTable">
				<tr>
					<td class="name300">{$smarty.const.ANNOUNCE_TEXTAREA_ABOUTINFO}</td>
					<td class="form">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="arrNoBindFields[about_info]" rows="10" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$arrNoBindFields.about_info}</textarea>
					</td>
				</tr>
			</table>

			<hr class="Design_panesDelimiter">

			<table class="Design_panesFormTable">
				<tr>
					<td colspan="3">
						<br>
						<input type="checkbox" name="arrNoBindFields[subscription]" class="checkbox" disabled="disabled"{if $arrNoBindFields.subscription}checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_CHECKBOX_SUBCRIPTION_ON}
						<br><br>
					</td>
				</tr>
			</table>

			<table class="Design_panesFormTable">
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_SELECT_ACTPERIOD}</td>
					<td class="form">
						<select name="arrBindFields[act_period]" id="act_period">
							{foreach from=$arrSysDict.ActPeriod.values item="item" key="key"}
								<option value="{$key}"{if $arrBindFields.act_period eq $key} selected="selected"{/if}>{$item}</option>
							{/foreach}
						</select>
					</td>
				</tr>
			</table>
		</div>
		{* -------------------- ^^Панель 5^^ ---------------------------- *}

		{* -------------------- Панель 6: META-данные ---------------------------- *}
		<div id="metadata">
			<table class="Design_panesFormTable">
				<tr>
					<td class="name300">{$smarty.const.FORM_KEYWORDS}</td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="arrServiceFields[meta_keywords]" rows="3" cols="70">{$arrServiceFields.meta_keywords}</textarea>
					</td>
				</tr>
			</table>

			<table class="Design_panesFormTable">
				<tr>
					<td class="name300">{$smarty.const.FORM_DESCRIPTION}</td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="arrServiceFields[meta_description]" rows="10" cols="70">{$arrServiceFields.meta_description}</textarea>
					</td>
				</tr>
			</table>

			<input type="hidden" id="hprofessions" value="{$hprofessions}">
			<input type="hidden" id="hcity" value="{$arrBindFields.id_city}">
			<input type="hidden" name="arrBindFields[age]" value="{$arrBindFields.age}">
		</div>
		{* -------------------- ^Панель 6: META-данные^ ---------------------------- *}
	</form>

{if $smarty.const.CONF_USE_VISUAL_EDITOR && $smarty.const.CONF_ANNOUNCE_USE_VISUAL_EDITOR}
<!-- TinyMCE -->
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/modules/tinymce/basic_config.js"></script>
<!-- TinyMCE -->
{/if}

<script type="text/javascript">
<!--
(function($) {
	// формируем вкладки
    $.getScript('/core/js/jquery/ui/jquery.ui.tabs.js', function() {
		$('#tabForm').tabs();
	});
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
	if ($('#region').val()) {
		$.get('/ajax.php', { id_r: $('#region').val() }, function(resp) {
			$('#selector').val('city');
			var resp = $.parseJSON(resp);
			if (resp.success && resp.data) {
				selCitys.fillSelect(resp.data).show('fast').removeAttr('disabled');
			} else if (resp.success && !resp.data) {
				selCitys.hide().val('0');
			}
		});
	} else {
		selCitys.clearSelect();
		selCitys.attr('disabled', 'disabled');
	}
	// обрабатываем селект если он был изменен
	$('#region').change(function () {
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
				}
			});
		}
	});

	// действия при отправке формы
	$('form[id="fEditAnnounce"]').submit(function () {
		return false;
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
    $('#uploadPhoto').ajaxUploadFile({
        urlUpload: '/admajax.php?uploadFile&fType=rPhotocard',
        attrInputFile: {
            name: 'uploadPhoto',
            size: 10,
            maxlength: 250
        },
        maxFileSize: {$smarty.const.CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE},
        maxUploadedFiles: 1,
        buttonUpload: '<input type="image" src="{$smarty.const.CONF_SCRIPT_URL}templates/admin/images/actions/add.png" style="vertical-align: bottom;" title="{$smarty.const.SITE_UPLOAD_FILE}" alt="{$smarty.const.SITE_UPLOAD_FILE}">',
        buttonCancel: '<img src="{$smarty.const.CONF_SCRIPT_URL}templates/admin/images/actions/cancel.png" style="margin: 0px 5px 0px 0px; vertical-align: bottom;" title="{$smarty.const.SITE_CANCEL}" alt="{$smarty.const.SITE_CANCEL}">',
        imgLoading: '<img src="{$smarty.const.CONF_SCRIPT_URL}templates/admin/images/loading.gif" style="margin-left: 5px; vertical-align: top;" alt="">',
        onComplete: function(data) {
            if (!data.responce.error) {
				var delUploadedFile = new Array();
				var wData = $(window).data('delUploadedFile');
				var iPhotocard =  data.key + '.' + data.realFileName;
                $('#iPhotocard').val(iPhotocard);
				(wData) ? delUploadedFile = wData.split(',') : $.noop;
				delUploadedFile.push(iPhotocard);
			    $(window).data('delUploadedFile', delUploadedFile.join());
                $(document.createElement('img')).attr({
                    src: '{$smarty.const.CONF_SCRIPT_URL}templates/admin/images/actions/delete.png',
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
                ).bind('click', function() {
		            $('#iPhotocard').val('');
		            $('#uploadedPhoto').remove();
		            $('#uploadPhoto').show();
                });
            } else {
                switch (data.responce.error) {
                    case 'errFileMaxSize':
                        $.alert('{$smarty.const.ERROR_FILE_UPLOAD_MAX_FILESIZE}');
                        break;
                    case 'errFileUploading':
                        $.alert('{$smarty.const.ERROR_FILE_NOT_LOAD}');
                        break;
                    case 'errFileName':
                        $.alert('{$smarty.const.ERROR_FILE_NAME}');
                        break;
                    case 'errFileType':
                        $.alert('{$smarty.const.ERROR_FILE_FORMAT_ERROR}');
                        break;
                    case 'errFileUploaded':
                        $.alert('{$smarty.const.ERROR_FILE_UPLOAD_DESTINATION}');
                        break;
                    case 'ErrInputFile':
                        $.alert('{$smarty.const.ERROR_FILE_NOT_SELECTED}');
                        break;
                    default:
                        $.alert('{$smarty.const.ERROR_UNDEFINED}');
                }
                data.buttonCancel.show();
            }
        }
    });
    // Обработка события - удаление фотокарточки
    $('#delPhotocard').css({ cursor: 'pointer' }).click(function () {
        if (confirm('{$smarty.const.MESSAGE_PERFORM_OPERATION}')) {
            $('#iPhotocard').val('');
            $('#uploadedPhoto').remove();
            $('#uploadPhoto').show();
        }
    });
});
-->
</script>
{/if}