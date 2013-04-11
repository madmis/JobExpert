<div id="tabTemplate" style="width: 98%;">
    <ul>
        <li><a href="#user">{$smarty.const.FORM_USERS_DATA}</a></li>
        {if $user.user_type eq "company" OR $user.user_type eq "agent"}
        	<li><a href="#company">{$smarty.const.FORM_USERS_COMPANY_DATA}</a></li>
        {/if}
        <li><a href="#actions">{$smarty.const.FORM_USERS_ACTIONS}</a></li>
    </ul>
{* USER *}
    <div id="user" style="width: 98%;">
		<form action="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=detail&amp;id={$user.id}" method="post" enctype="multipart/form-data">
		<table style="width: 100%; border-spacing: 5px;">
			<tr>
				<td style="font-weight: bold; width: 250px;">{$smarty.const.FORM_USERS_DATA_TOKEN}</td>
				<td>
					{if $user.token eq 'new'}
						{$smarty.const.RECORD_WAIT_ACTIVATE}
					{elseif $user.token eq 'active'}
						{$smarty.const.RECORD_ACTIVE}
					{elseif $user.token eq 'moderate'}
						{$smarty.const.RECORD_MODERATE}
					{elseif $user.token eq 'payment'}
						{$smarty.const.RECORD_WAIT_PAYMENT}
					{/if}
				</td>
			</tr>
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_EMAIL}</td>
				<td>{$user.email}</td>
			</tr>
			{if $user.token ne 'new'}
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_TYPE}</td>
				<td>
					<input type="hidden" id="uID" value="{$user.id}">
					<select name="conf[user_type]" class="text ui-widget-content ui-corner-all">
						<option value="agent" {if $user.user_type eq "agent"}selected="selected"{/if}>{$smarty.const.FORM_TYPE_AGENT}</option>
						<option value="company" {if $user.user_type eq "company"}selected="selected"{/if}>{$smarty.const.FORM_TYPE_COMPANY}</option>
						<option value="employer" {if $user.user_type eq "employer"}selected="selected"{/if}>{$smarty.const.FORM_TYPE_EMPLOYER}</option>
						<option value="competitor" {if $user.user_type eq "competitor"}selected="selected"{/if}>{$smarty.const.FORM_TYPE_COMPETITOR}</option>
					</select>
				</td>
			</tr>
			{/if}
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_GROUP}</td>
				<td>
				{if $user.token ne 'new'}
					<select name="conf[user_group]" class="text ui-widget-content ui-corner-all">
					{foreach from=$groups item="group"}
						<option value="{$group.id}" {if $group.id eq $user.user_group}selected{/if}>{$group.id|upper}</option>
					{/foreach}
					</select>
				{else}
					{$user.user_group|upper}
				{/if}
				&nbsp;(<a style="color: #CC3333;" href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&s=groups&action=edit&id={$user.user_group}" target="_blank">{$user.user_group|upper}</a>)
				</td>
			</tr>
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_REG_DATETIME}</td>
				<td>{$user.reg_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</td>
			</tr>
			{if $user.alias}
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_ALIAS}</td>
				<td>{$user.alias}</td>
			</tr>
			{/if}
			{if $user.first_name}
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_FIRST_NAME}</td>
				<td><input type="text" name="user[first_name]" value="{$user.first_name|escape}" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			{/if}
			{if $user.last_name}
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_LAST_NAME}</td>
				<td><input type="text" name="user[last_name]" value="{$user.last_name|escape}" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			{/if}
			{if $user.middle_name}
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_MIDDLE_NAME}</td>
				<td><input type="text" name="user[middle_name]" value="{$user.middle_name|escape}" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			{/if}
			{if $user.gender neq 'none'}
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_GENDER}</td>
				<td>{$user.gender}</td>
			</tr>
			{/if}
			{if $user.birthday neq '0000-00-00'}
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_BIRTHDAY}</td>
				<td>{$user.birthday|date_format:$smarty.const.CONF_DATE_FORMAT}</td>
			</tr>
			{/if}
			{if $user.phone}
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_PHONE}</td>
				<td><input type="text" name="user[phone]" value="{$user.phone|escape}" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			{/if}
			{if $user.addition_phone_1}
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_ADDITION_PHONE} 1</td>
				<td><input type="text" name="conf[addition_phone_1]" value="{$user.addition_phone_1|escape}" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			{/if}
			{if $user.addition_phone_2}
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_ADDITION_PHONE} 2</td>
				<td><input type="text" name="conf[addition_phone_2]" value="{$user.addition_phone_2|escape}" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			{/if}
		</table>
			<div><input type="submit" name="saveUserData" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></div>
		</form>
    </div>
{* COMPANY *}
	{if $user.user_type eq "company" OR $user.user_type eq "agent"}
    <div id="company" style="width: 98%;">
		<form action="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=detail&amp;id={$user.id}" method="post" enctype="multipart/form-data">
		<table style="width: 100%; border-spacing: 5px;" cellpadding="3">
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_COMPANY_NAME}</td>
				<td><input type="text" name="conf[company_name]" value="{$user.company_name|escape}" size="80" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_COMPANY_CITY}</td>
				<td><input type="text" name="conf[company_city]" value="{$user.company_city|escape}" size="50" class="text ui-widget-content ui-corner-all"></td>
			</tr>
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_COMPANY_URL}</td>
				<td>
					<input type="text" name="conf[company_url]" value="{$user.company_url}" size="50" class="text ui-widget-content ui-corner-all">
					<a href="{$user.company_url}" target="_blank">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/regions.png" alt="{$user.company_url|escape}" title="{$user.company_url|escape}">
					</a>
				</td>
			</tr>
			<tr>
				<td style="font-weight: bold;">{$smarty.const.FORM_USERS_DATA_COMPANY_LOGO}</td>
				<td>
					{if $user.logo}
						<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/thumbs/thumb_{$user.logo}">
					{else}
						<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/not_logo.png">
					{/if}
					<input type="file" name="cLogo" id="cLogo" value="{$arrUser.logo}" size="50" class="text ui-widget-content ui-corner-all">
					<span id="newLogo"></span>
				</td>
			</tr>
			<tr>
				<td style="font-weight: bold;" colspan="2">{$smarty.const.FORM_USERS_DATA_COMPANY_DESCRIPTION}</td>
			</tr>
			<tr>
				<td colspan="2">
					{if $smarty.const.CONF_USE_VISUAL_EDITOR AND $smarty.const.CONF_COMPANIES_USE_VISUAL_EDITOR}
						<textarea name="conf[company_description]" rows="10" cols="80" class="tinymce">{$user.company_description}</textarea>
					{else}
						<textarea name="conf[company_description]" rows="10" cols="80">{$user.company_description|nl2br}</textarea>
					{/if}
				</td>
			</tr>
		</table>
			<div><input type="submit" name="saveCompanyData" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></div>
		</form>
    </div>
    {/if}
{* ACTIONS *}
    <div id="actions" style="width: 98%;">
		{if $user.token ne 'new'}
		<form action="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=detail&amp;id={$user.id}" method="post" enctype="multipart/form-data">
			<p><label><input type="checkbox" name="articles">{$smarty.const.FORM_USERS_DATA_DELETE_USER_ARTICLES}</label></p>
			<p><label><input type="checkbox" name="news">{$smarty.const.FORM_USERS_DATA_DELETE_USER_NEWS}</label></p>
			<p><input type="submit" class="button" name="delete" value="{$smarty.const.FORM_BUTTON_DELETE_USER}"></p>
		</form>
		{/if}
    </div>
</div>

<script type="text/javascript">
<!--
(function($) {
    $.getScript('/core/js/jquery/ui/jquery.ui.tabs.js', function() {
        $('#tabTemplate').tabs({
        	cookie: { expires: 1 }
		});
    });
})(jQuery);

$( function() {
});
-->
</script>