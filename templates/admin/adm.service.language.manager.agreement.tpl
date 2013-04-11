<div class="sub_menu">
	<div style="float: left;">
		<form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&amp;s=language.manager&amp;action=localizAgreement" method="post" enctype="multipart/form-data">
			&nbsp;{$smarty.const.FORM_SELECT_LANGUAGE}:&nbsp;
			<select name="currLocaliz" class="langSelect">
				{foreach from=$langs item="lang"}
					<option value="{$lang}"{if $lang eq $currLang} selected{/if}>{$lang}</option>
				{/foreach}
			</select>
		</form>
	</div>
	<div class="colorbox_help" id="HELP_ADMIN_SERVICE_LANGUAGE_MANAGER_AGREEMENT">
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
	</div>
</div>
<table class="tmpl_mail_table">
	<tbody class="tmpl_mail_body">
		<tr>
			<td>
				<form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&amp;s=language.manager&amp;action=localizAgreement" method="post" enctype="multipart/form-data">
					<p>
					<textarea name="agreement" cols="120" rows="35" class="{if $smarty.const.CONF_USE_VISUAL_EDITOR}tinymce{else}text{/if}">{$agreement}</textarea>
					</p>
					<p><input type="submit" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
				</form>
			</td>
		</tr>
	</tbody>
</table>
<script type="text/javascript">
<!--
$(document).ready(function() {
	$('.langSelect').change(function() {
		$(this).parent('form').submit();
	});
});
-->
</script>