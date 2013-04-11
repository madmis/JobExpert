{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=config&s=tmpl" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_SMARTY_DIR}</td>
		<td><input type="text" name="smarty_dir" size="80" value="{$smarty.const.TEMPLATE_SMARTY_DIR}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SMARTY_DIR">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_TEMPLATE_ROOT_DIR}</td>
		<td><input type="text" name="root_dir" size="80" value="{$smarty.const.TEMPLATE_ROOT_DIR}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_TEMPLATE_ROOT_DIR">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_TEMPLATE}</td>
		<td>
			<select name="template" class="select">
			{foreach from=$templateDirs item="template"}
				<option value="{$template}" {if $template eq $smarty.const.CONF_TEMPLATE}selected{/if}>{$template}</option>
			{/foreach}
			</select>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_TEMPLATE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_TEMPLATE_COMPILE_DIR}</td>
		<td><input type="text" name="compile_dir" size="80" value="{$smarty.const.TEMPLATE_COMPILE_DIR}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_TEMPLATE_COMPILE_DIR">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_TEMPLATE_DEBUGGING}</td>
		<td><input type="checkbox" name="debugging" {if $smarty.const.TEMPLATE_DEBUGGING}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_TEMPLATE_DEBUGGING">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_TEMPLATE_COMPILE_CHECK}</td>
		<td><input type="checkbox" name="compile_check" {if $smarty.const.TEMPLATE_COMPILE_CHECK}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_TEMPLATE_COMPILE_CHECK">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_TEMPLATE_FORCE_COMPILE}</td>
		<td><input type="checkbox" name="force_compile" {if $smarty.const.TEMPLATE_FORCE_COMPILE}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_TEMPLATE_FORCE_COMPILE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>