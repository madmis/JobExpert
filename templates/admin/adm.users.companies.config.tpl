<form action="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=companies&amp;action=config" method="post" enctype="multipart/form-data">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL}</td>
		<td>
			<input type="text" name="admperpage" size="5" value="{$smarty.const.CONF_COMPANIES_STRINGS_PERPAGE_ADMIN_PANEL}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_STRINGS_PERPAGE_ADMIN_PANEL">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_COMPANIES_PERPAGE}</td>
		<td>
			<input type="text" name="perpage" size="5" value="{$smarty.const.CONF_COMPANIES_PERPAGE}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_COMPANIES_PERPAGE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_COMPANIES_SHOW_ONLY_WITH_LOGO}</td>
		<td><input type="checkbox" name="with_logo" {if $smarty.const.CONF_COMPANIES_SHOW_ONLY_WITH_LOGO}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_COMPANIES_SHOW_ONLY_WITH_LOGO">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_COMPANIES_DELETE_LOGO}</td>
		<td><input type="checkbox" name="delete_logo" {if $smarty.const.CONF_COMPANIES_DELETE_LOGO}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_COMPANIES_DELETE_LOGO">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_COMPANIES_USE_VISUAL_EDITOR}</td>
		<td>
			{if !$smarty.const.CONF_USE_VISUAL_EDITOR}
				<input type="checkbox" name="html" disabled>
			{else}
				<input type="checkbox" name="html" {if $smarty.const.CONF_COMPANIES_USE_VISUAL_EDITOR}checked{/if}>
			{/if}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_COMPANIES_USE_VISUAL_EDITOR">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_COMPANIES_SHOW_MAIN_LOGO}</td>
		<td>
			<input type="checkbox" name="show_main_logo" {if $smarty.const.CONF_COMPANIES_SHOW_MAIN_LOGO}checked{/if}>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_COMPANIES_SHOW_MAIN_LOGO">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_COMPANIES_SHOW_MAIN_LOGO_QTY}</td>
		<td>
			{if $smarty.const.CONF_COMPANIES_SHOW_MAIN_LOGO}
				<input type="text" name="logo_qty" size="5" value="{$smarty.const.CONF_COMPANIES_SHOW_MAIN_LOGO_QTY}" class="text">
			{else}
				<input type="text" name="logo_qty" size="5" value="{$smarty.const.CONF_COMPANIES_SHOW_MAIN_LOGO_QTY}" class="text" disabled>
			{/if}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_COMPANIES_SHOW_MAIN_LOGO_QTY">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>