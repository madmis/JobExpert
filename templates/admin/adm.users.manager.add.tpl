<form action="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=add" method="post" enctype="multipart/form-data">
<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
	<tr>
		<td class="data_head user_data_fields">{$smarty.const.FORM_USERS_DATA_EMAIL}</td>
		<td class="data_body"><input type="text" name="data[email]" value="{$return_data.data.email}" class="text" size="50"></td>
	</tr>
	<tr>
		<td class="data_head user_data_fields">{$smarty.const.FORM_USERS_DATA_PASSWORD}</td>
		<td class="data_body"><input type="text" name="data[password]" value="{$return_data.data.password}" class="text" size="50"></td>
	</tr>
	<tr>
		<td class="user_data_fields data_head">{$smarty.const.FORM_USERS_DATA_TYPE}</td>
		<td class="data_body">
			<input type="radio" name="conf[user_type]" value="agent" class="text" {if $return_data.conf.user_type eq 'agent'}checked{/if}>{$smarty.const.FORM_TYPE_AGENT}
			<input type="radio" name="conf[user_type]" value="company" class="text" {if $return_data.conf.user_type eq 'company'}checked{/if}>{$smarty.const.FORM_TYPE_COMPANY}
			<input type="radio" name="conf[user_type]" value="employer" class="text" {if $return_data.conf.user_type eq 'employer'}checked{/if}>{$smarty.const.FORM_TYPE_EMPLOYER}
			<input type="radio" name="conf[user_type]" value="competitor" class="text" {if $return_data.conf.user_type eq 'competitor'}checked{/if}>{$smarty.const.FORM_TYPE_COMPETITOR}
		</td>
	</tr>
	<tr>
		<td class="user_data_fields data_head">{$smarty.const.FORM_USERS_DATA_GROUP}</td>
		<td class="data_body">
			<select class="select" name="conf[user_group]">
			{foreach from=$groups item="group"}
				<option value="{$group.id}" {if $group.id eq $return_data.conf.user_group}selected{/if}>{$group.id|upper}</option>
			{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td class="user_data_fields data_head">{$smarty.const.FORM_USERS_DATA_FIRST_NAME}</td>
		<td class="data_body"><input type="text" name="data[first_name]" value="{$return_data.data.first_name}" class="text" size="50"></td>
	</tr>
	<tr>
		<td class="user_data_fields data_head">{$smarty.const.FORM_USERS_DATA_LAST_NAME}</td>
		<td class="data_body"><input type="text" name="data[last_name]" value="{$return_data.data.last_name}" class="text" size="50"></td>
	</tr>
	<tr>
		<td class="user_data_fields data_head">{$smarty.const.FORM_USERS_DATA_PHONE}</td>
		<td class="data_body"><input type="text" name="data[phone]" value="{$return_data.data.phone}" class="text" size="50"></td>
	</tr>
</table>
<input type="checkbox" name="mail" {if $return_data.mail}checked{/if}> {$smarty.const.FORM_USERS_DATA_SEND_EMAIL_ABOUT_ADD}
<p><input type="submit" class="button" name="save" value="{$smarty.const.FORM_BUTTON_ADD}"></p>
</form>

<script type="text/javascript">
<!--
$(document).ready( function()
{

});
-->
</script>
