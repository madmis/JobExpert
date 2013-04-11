<div class="sub_menu">
	<div style="float: left;">
		<form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&amp;s=language.manager&amp;action=localizText" method="post" enctype="multipart/form-data">
			&nbsp;{$smarty.const.FORM_SELECT_LANGUAGE}:&nbsp;
			<select name="currLocaliz" class="langSelect">
				{foreach from=$langs item="lang"}
					<option value="{$lang}"{if $lang eq $currLang} selected{/if}>{$lang}</option>
				{/foreach}
			</select>
		</form>
	</div>
	<div class="colorbox_help" id="HELP_ADMIN_SERVICE_LANGUAGE_MANAGER_TEXT">
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
	</div>
</div>

<p>
	{$smarty.const.FORM_MAIL_TEMPLATES_FILE}:&nbsp;
	<select name="file">
	{foreach from=$files item="file"}
		<option value="{$file.id}">{$file.name}</option>
	{/foreach}
	</select>
</p>

<table class="tmpl_mail_table">
	<thead class="tmpl_mail_head">
		<tr>
			<td id="fdescription"></td>
		</tr>
	</thead>
	<tbody class="tmpl_mail_body">
		<tr>
			<td>
				<p><textarea name="fText" cols="120" rows="20" id="fText"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{else} class="text"{/if}></textarea></p>
				<p><input id="txtSave" type="button" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
			</td>
		</tr>
	</tbody>
</table>

{foreach from=$files item="file"}
	<div style="display: none;" id="{$file.id}">
		<div class="fdescription">{$file.description}</div>
		<div class="ftext">{$file.text}</div>
	</div>
{/foreach}

<script type="text/javascript">
<!--
$(document).ready(function() {
	$('.langSelect').change(function() {
		$(this).parent('form').submit();
	});

	$('select[name="file"]').change(function() {
		var fId = $(this).val();
		var fText = $('#' + fId).children('.ftext').html();
		var fD = $('#' + fId).children('.fdescription').html();
		('' == '{$smarty.const.CONF_USE_VISUAL_EDITOR}' || !tinyMCE.execCommand('mceSetContent', false, fText)) ? $('textarea').text(fText) : $.noop;
		$('#fdescription').html(fD);
	}).change();

	$('#txtSave').click(function() {
        $('#overlay, #dialog').show();
        var fileContents = ('' == '{$smarty.const.CONF_USE_VISUAL_EDITOR}') ? $('textarea').text() : tinyMCE.activeEditor.getContent({ format : 'text' });
		$.post(
			'/admajax.php?action=putFileContent',
			{ fileName: 'lang/{$currLang}/texts/' + $('select[name="file"] option:selected').text(), 'fileContents': fileContents },
			function(resp) {
		        $('#overlay, #dialog').hide();
		        if ('success' == resp) {
					$('#' + $('select[name="file"] option:selected').val()).children('.ftext').html(fileContents);
					$.alert('{$smarty.const.MESSAGE_CHANGE_SAVED}');
				} else {
					$.alert('{$smarty.const.ERROR_NOT_SAVE_CHANGE}');
				}
		    }
		);
	});
});
-->
</script>