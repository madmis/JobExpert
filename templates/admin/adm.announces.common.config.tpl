<form action="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=common&amp;action=confCommon" method="post" enctype="multipart/form-data">
	<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED}</td>
			<td><input type="checkbox" name="cauanmr"{if $smarty.const.CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED} checked="checked"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_ADD_SUCCESS_ADMIN_INFORM}</td>
			<td><input type="checkbox" name="caasai"{if $smarty.const.CONF_ANNOUNCE_ADD_SUCCESS_ADMIN_INFORM} checked="checked"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_ANNOUNCE_ADD_SUCCESS_ADMIN_INFORM">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_ADD_SUCCESS_USER_INFORM}</td>
			<td><input type="checkbox" name="caasui"{if $smarty.const.CONF_ANNOUNCE_ADD_SUCCESS_USER_INFORM} checked="checked"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_ANNOUNCE_ADD_SUCCESS_USER_INFORM">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCE_USE_VISUAL_EDITOR}</td>
			<td><input type="checkbox" name="cauve"{if $smarty.const.CONF_USE_VISUAL_EDITOR}{if $smarty.const.CONF_ANNOUNCE_USE_VISUAL_EDITOR} checked="checked"{/if}{else} disabled="disabled"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_ANNOUNCE_USE_VISUAL_EDITOR">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_PREVIEW}</td>
			<td><input type="checkbox" name="cap"{if $smarty.const.CONF_ANNOUNCE_PREVIEW} checked="checked"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_ANNOUNCE_PREVIEW">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_PERPAGE_SITE}</td>
			<td><input type="text" name="caps" size="5" value="{$smarty.const.CONF_ANNOUNCE_PERPAGE_SITE}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_ANNOUNCE_PERPAGE_SITE">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_PERPAGE_ADMIN_PANEL}</td>
			<td><input type="text" name="capap" size="5" value="{$smarty.const.CONF_ANNOUNCE_PERPAGE_ADMIN_PANEL}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_ANNOUNCE_PERPAGE_ADMIN_PANEL">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_CATEGORY_PERLINE}</td>
			<td><input type="text" name="ccp" size="5" value="{$smarty.const.CONF_CATEGORY_PERLINE}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_CATEGORY_PERLINE">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_EMAIL_ATTACHMENT_FILES_ALLOW}</td>
			<td><input type="checkbox" name="ceafa"{if $smarty.const.CONF_EMAIL_ATTACHMENT_FILES_ALLOW} checked="checked"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_EMAIL_ATTACHMENT_FILES_ALLOW">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_EMAIL_ATTACHMENT_MAX_FILES}</td>
			<td><input type="text" name="ceamf" size="5" value="{$smarty.const.CONF_EMAIL_ATTACHMENT_MAX_FILES}" class="text"{if !$smarty.const.CONF_EMAIL_ATTACHMENT_FILES_ALLOW} disabled="disabled"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_EMAIL_ATTACHMENT_MAX_FILES">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_EMAIL_ATTACHMENT_FILE_MAX_SIZE}</td>
			<td><input type="text" name="ceafms" size="5" value="{$smarty.const.CONF_EMAIL_ATTACHMENT_FILE_MAX_SIZE}" class="text"{if !$smarty.const.CONF_EMAIL_ATTACHMENT_FILES_ALLOW} disabled="disabled"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_EMAIL_ATTACHMENT_FILE_MAX_SIZE">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>

	</table>
	<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>