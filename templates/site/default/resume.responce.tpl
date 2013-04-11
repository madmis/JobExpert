<!DOCTYPE html>
<html>
	<head>
		<meta charset="{$smarty.const.CONF_DEFAULT_CHARSET}">
		<style type="text/css">
			body, #body {
				font-family: Arial, Tahoma, Verdana, Sans-serif;
				font-size: 12px;
				background-color: #F5F6F6;
			}
			img {
				border: 0px;
				vertical-align: middle;
			}
		</style>
	</head>
	<body><div id="body" style="margin: 5px; padding: 10px;">
		<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type")}" title="{$smarty.const.CONF_SITE_NAME}">
			<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/topLogo.png" alt="{$smarty.const.CONF_SITE_NAME}">
		</a>
		<hr>
		<p>{$return_data.title}&nbsp;-&nbsp;{$return_data.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</p>
		<table>
		    <tr>
		        {if $return_data.image}
		            <td style="vertical-align: middle; padding: 5px;">
		                <img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/photos/{$return_data.image}" alt="" title="">
		            </td>
		        {/if}
		        <td style="vertical-align: top; padding-right: 20px;">
		            <table>
		                <tr>
		                    <td><strong>{$smarty.const.ANNOUNCE_SELECT_REGION}:</strong></td><td>{$regions[$return_data.id_region].name|escape}{if $return_data.id_city}&nbsp;/&nbsp;{$citys[$return_data.id_city].name|escape}{/if}</td>
		                </tr>
		                <tr>
		                    <td><strong>{$smarty.const.ANNOUNCE_SELECT_SECTION}:</strong></td><td>{$sections[$return_data.id_section].name}&nbsp;/&nbsp;{$professions[$return_data.id_profession].name}</td>
		                </tr>
		            </table>
		        </td>
		        <td style="vertical-align: top;">
		            <table>
		                <tr>
		                    <td style="width:150px;"><strong>{$smarty.const.ANNOUNCE_PAY_HEAD}:</strong></td>
		                    <td>{$smarty.const.SITE_FROM} {$return_data.pay_from}&nbsp;{$return_data.currency}</td>
		                </tr>
		                <tr>
		                    <td><strong>{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}:</strong></td>
		                    <td>{$return_data.chart_work}</td>
		                </tr>
		                <tr>
		                    <td><strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION}:</strong></td>
		                    <td>{$return_data.education}</td>
		                </tr>
		                <tr>
		                    <td><strong>{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}:</strong></td>
		                    <td>{$return_data.expire_work}</td>
		                </tr>
		                <tr>
		                    <td><strong>{$smarty.const.ANNOUNCE_SELECT_GENDER}:</strong></td>
		                    <td>{$arrSysDict.Gender.values[$return_data.gender]}</td>
		                </tr>
		                <tr>
		                    <td><strong>{$smarty.const.ANNOUNCE_AGE}:</strong></td>
		                    <td>{$return_data.age}</td>
		                </tr>
		            </table>
		        </td>
		    </tr>
		</table>
		{if $return_data.educations}
		    <hr style="color: #C1C1C1;" noshade="noshade" size="1">
		    <p style="font-size: 16px; font-weight: bold;">{$smarty.const.ANNOUNCE_EDUCATION_HEAD}</p>
		    {foreach from=$return_data.educations item="education" key="key" name="education"}
		        <div style="margin-top: 10px;">
		            <table>
		                <tr>
		                    <td>
		                        <strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION_TYPE}:</strong>&nbsp;{$education.type}
		                    </td>
		                </tr>
		                <tr>
		                    <td>
		                        <strong>{$smarty.const.ANNOUNCE_INPUT_EDUCATION_INSTITUTION}:</strong>&nbsp;{$education.institution}
		                    </td>
		                </tr>
		                <tr>
		                    <td>
		                        <strong>{$smarty.const.ANNOUNCE_INPUT_EDUCATION_DEGREE}:</strong>&nbsp;{$education.degree}
		                    </td>
		                </tr>
		                <tr>
		                    <td>
		                        <strong>{$smarty.const.ANNOUNCE_INPUT_EDUCATION_FINISH_DATE}:</strong>&nbsp;{$education.finish_month}&nbsp;{$education.finish_year}
		                    </td>
		                </tr>
		                {if $education.ext_info}
		                <tr>
		                    <td>
		                        <strong>{$smarty.const.ANNOUNCE_INPUT_EDUCATION_EXTINFO}:</strong>&nbsp;<div style="margin:5px 10px;">{$education.ext_info}</div>
		                    </td>
		                </tr>
		                {/if}
		            </table>
		        </div>
		    {/foreach}
		{/if}
		{* ----------------------------------- *}
		{if $return_data.expires !== null}
		    <hr style="color: #C1C1C1;" noshade="noshade" size="1">
		    <p style="font-size: 16px; font-weight: bold;">{$smarty.const.ANNOUNCE_EXPIREINFO_HEAD}</p>
		    {if $return_data.expires}
		        {foreach from=$return_data.expires item="expire" key="key" name="expire"}
		            <div style="margin-top: 10px;">
		                <table>
		                    <tr><td><strong>{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}:</strong>&nbsp;{$expire.company}</td></tr>
		                    {if $expire.company_discription}
		                    <tr><td><strong>{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}:</strong>&nbsp;{$expire.company_discription}</td></tr>
		                    {/if}
		                    <tr><td><strong>{$smarty.const.ANNOUNCE_INPUT_EXPIRE_PERIOD}:</strong>&nbsp;{$expire.begin_month}&nbsp;{$expire.begin_year}</td></tr>
		                    <tr><td><strong>{$smarty.const.ANNOUNCE_INPUT_EXPIRE_APPOINTMENT}:</strong>&nbsp;{$expire.appointment}</td></tr>
		                    <tr><td><strong>{$smarty.const.ANNOUNCE_TEXTAREA_EXPIRE_DUTIES_INFO}:</strong><div style="margin:5px 10px;">{$expire.duties_info}</div></td></tr>
		                </table>
		            </div>
		        {/foreach}
		    {else}
		        <table><tr><td><strong>{$smarty.const.ANNOUNCE_INPUT_EXPIRE_CAREER_LAUNCH}</strong></td></tr></table>
		    {/if}
		{/if}
		{* ----------------------------------- *}
		{if $return_data.languages !== null}
		    <hr style="color: #C1C1C1;" noshade="noshade" size="1">
		    <p style="font-size: 16px; font-weight: bold;">{$smarty.const.ANNOUNCE_LANGUAGES_HEAD}</p>
		    {foreach from=$return_data.languages item="language" key="key" name="language"}
		        <div style="margin-top: 10px;">
		            <table>
		            {if  $smarty.foreach.language.first}
		                <tr><td><strong>{$smarty.const.ANNOUNCE_INPUT_NATIVE_LANGUAGE}:</strong>&nbsp;{$language.lang}</td></tr>
		            {else}
		                <tr><td><strong>{$smarty.const.ANNOUNCE_INPUT_FOREIGN_LANGUAGE}:</strong>&nbsp;{$language.lang}</td></tr>
		                <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_LANGUAGE_DEGREE}:</strong>&nbsp;{$language.degree}</td></tr>
		                {if $language.note}
		                    <tr><td><strong>{$smarty.const.ANNOUNCE_TEXTAREA_LANGUAGE_NOTE}:</strong>&nbsp;<div style="margin:5px 10px;">{$language.note}</div></td></tr>
		                {/if}
		            {/if}
		            {if $smarty.foreach.language.total eq 1}
		                <tr><td><strong>{$smarty.const.ANNOUNCE_INPUT_NOFOREIGN_LANGUAGE}</strong></td></tr>
		            {/if}
		            </table>
		        </div>
		    {/foreach}
		{/if}
		{* ----------------------------------- *}
		{if $return_data.about_info}
		    <hr style="color: #C1C1C1;" noshade="noshade" size="1">
		    <p style="font-size: 16px; font-weight: bold;">{$smarty.const.ANNOUNCE_TEXTAREA_ABOUTINFO}</p>
		    <div style="margin:10px 10px 20px 10px;">{$return_data.about_info}</div>
		{/if}
		{* ----------------------------------- *}
		<hr style="color: #C1C1C1;" noshade="noshade" size="1">
		<p style="font-size: 16px; font-weight: bold;">
			{$smarty.const.ANNOUNCE_CONTACTS_HEAD}
			<input type="hidden" id="sendFrom" value="{$return_data.email}">
		</p>
		<table>
		    <tr><td><strong>{$smarty.const.ANNOUNCE_CONTACTS_LASTNAME}:</strong></td><td>{$return_data.last_name}</td></tr>
		    <tr><td><strong>{$smarty.const.ANNOUNCE_CONTACTS_FIRSTNAME}:</strong></td><td>{$return_data.first_name}</td></tr>
		    {if $return_data.middle_name}<tr><td><strong>{$smarty.const.ANNOUNCE_CONTACTS_MIDDLENAME}:</strong></td><td>{$return_data.middle_name}</td></tr>{/if}
		</table>
		<table>
		    <tr><td>
		        <strong>{$smarty.const.ANNOUNCE_CONTACTS_PHONE}:</strong>&nbsp;{$return_data.phone}&nbsp;
		        {if $return_data.note_phone}(<span style="font-style: italic;">{$return_data.note_phone}</span>){/if}
		    </td></tr>
		    {if $return_data.addition_phone_1 || $return_data.addition_phone_2}
		        <tr><td>
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
		<hr style="color: #C1C1C1; margin-bottom: 15px;" noshade="noshade" size="1">
	</div></body>
</html>