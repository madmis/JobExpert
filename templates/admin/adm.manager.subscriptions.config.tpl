<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=subscriptions&amp;action=config" method="post" enctype="multipart/form-data">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL}</td>
		<td>
			<input type="text" name="perpage" size="5" value="{$smarty.const.CONF_SUBSCRIPTIONS_STRINGS_PERPAGE_ADMIN_PANEL}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_STRINGS_PERPAGE_ADMIN_PANEL">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_SUBSCRIPTIONS_FREE}</td>
		<td nowrap>
			{$smarty.const.FORM_VACANCYS_HEAD} <input type="text" name="free_vacancy" size="5" value="{$smarty.const.CONF_SUBSCRIPTIONS_FREE_VACANCY}" class="text">
			{$smarty.const.FORM_RESUMES_HEAD} <input type="text" name="free_resume" size="5" value="{$smarty.const.CONF_SUBSCRIPTIONS_FREE_RESUME}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_SUBSCRIPTIONS_FREE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_SUBSCRIPTIONS_PAYMENT_DELETE}</td>
		<td>
			<input type="text" name="payment" size="5" value="{$smarty.const.CONF_SUBSCRIPTIONS_PAYMENT_DELETE}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_SUBSCRIPTIONS_PAYMENT_DELETE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_SUBSCRIPTIONS_ANNOUNCE_PERIOD}</td>
		<td>
			<select name="announce_period">
				{foreach from=$arrSysDict.SubscriptionPeriod.values item="item" key="key"}
					<option value="{$key}" {if $smarty.const.CONF_SUBSCRIPTIONS_ANNOUNCE_PERIOD eq $key}selected{/if}>{$item}</option>
				{/foreach}
			</select>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_SUBSCRIPTIONS_ANNOUNCE_PERIOD">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_SUBSCRIPTIONS_START_TIME}</td>
		<td>
			{assign var="subscription_start_time" value="{if $smarty.const.CONF_SUBSCRIPTIONS_START_TIME}{$smarty.const.CONF_SUBSCRIPTIONS_START_TIME}{else}{$smarty.now}{/if}"}
			{html_select_time display_seconds=false minute_interval=5 time=$subscription_start_time prefix='' field_array="start_time"}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_SUBSCRIPTIONS_START_TIME">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>