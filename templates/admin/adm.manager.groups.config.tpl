<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=groups&amp;action=config" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_COMPETITOR_REGISTER_DEFAULT_GROUP}</td>
		<td>
			<select name="competitor_group" class="select">
				{foreach from=$arrGroups item="group"}
				<option value="{$group.id}" {if $smarty.const.CONF_COMPETITOR_REGISTER_DEFAULT_GROUP eq $group.id}selected{/if}>{$group.id}</option>
				{/foreach}
			</select>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_REGISTER_COMPETITOR_REGISTER_DEFAULT_GROUP">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_EMPLOYER_REGISTER_DEFAULT_GROUP}</td>
		<td>
			<select name="employer_group" class="select">
				{foreach from=$arrGroups item="group"}
				<option value="{$group.id}" {if $smarty.const.CONF_EMPLOYER_REGISTER_DEFAULT_GROUP eq $group.id}selected{/if}>{$group.id}</option>
				{/foreach}
			</select>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_REGISTER_EMPLOYER_REGISTER_DEFAULT_GROUP">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_AGENT_REGISTER_DEFAULT_GROUP}</td>
		<td>
			<select name="agent_group" class="select">
				{foreach from=$arrGroups item="group"}
				<option value="{$group.id}" {if $smarty.const.CONF_AGENT_REGISTER_DEFAULT_GROUP eq $group.id}selected{/if}>{$group.id}</option>
				{/foreach}
			</select>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_REGISTER_AGENT_REGISTER_DEFAULT_GROUP">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_COMPANY_REGISTER_DEFAULT_GROUP}</td>
		<td>
			<select name="company_group" class="select">
				{foreach from=$arrGroups item="group"}
				<option value="{$group.id}" {if $smarty.const.CONF_COMPANY_REGISTER_DEFAULT_GROUP eq $group.id}selected{/if}>{$group.id}</option>
				{/foreach}
			</select>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_REGISTER_COMPANY_REGISTER_DEFAULT_GROUP">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_TYPE_GUEST_RIGHTS}</td>
		<td>
			<p><input type="checkbox" name="add_vacancy" {if $smarty.const.CONF_TYPE_GUEST_RIGHT_ADD_VACANCY}checked{/if}> {$smarty.const.FORM_TYPE_GUEST_RIGHTS_ADD_VACANCY}</p>
			<p><input type="checkbox" name="add_resume" {if $smarty.const.CONF_TYPE_GUEST_RIGHT_ADD_RESUME}checked{/if}> {$smarty.const.FORM_TYPE_GUEST_RIGHTS_ADD_RESUME}</p>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_REGISTER_TYPE_GUEST_RIGHT_ADD_ANNOUNCE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>
<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>
