<div class="sub_menu">
	<div style="float: left;">
		<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=mail.templates{$list}" method="post">
			&nbsp;{$smarty.const.FORM_SELECT_LANGUAGE}:&nbsp;
			<select name="langDict" class="lang_select">
				{foreach from=$langs item="lang"}
					<option value="{$lang}"{if $lang eq $currLang} selected{/if}>{$lang}</option>
				{/foreach}
			</select>
		</form>
	</div>
	<div class="colorbox_help" id="HELP_ADMIN_MANAGER_MAIL_TEMPLATES">
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
	</div>
</div>
<p>{$smarty.const.FORM_MAIL_TEMPLATES_FILE}:&nbsp;
<select name="file">
{foreach from=$files item="file"}
	<option value="{$file.id}" {if !$file.exists}class="error_option"{/if}>{$file.name}.txt</option>
{/foreach}
</select>
</p>

{foreach from=$files item="file"}
	<div style="display: none;" id="{$file.id}">
		<div class="ftext">{$file.text}</div>
		<div class="fdescription">{$file.description}{if !$file.exists}<p class="tmpl_mail_error"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/error_logo.png">{$smarty.const.ERROR_CRITICAL_FILE_NOT_EXISTS}</p>{/if}</div>
		<div class="fexists">{$file.exists}</div>
	</div>
{/foreach}

<table class="tmpl_mail_table">
	<thead class="tmpl_mail_head">
		<tr>
			<td id="fdescription"></td>
		</tr>
	</thead>
	<tbody class="tmpl_mail_body">
		<tr>
			<td>
				<p><textarea name="fText" cols="120" rows="20" {if $smarty.const.CONF_USE_VISUAL_EDITOR}class="tinymce"{else}class="text"{/if} id="fText"></textarea></p>
				<p><input id="save" type="button" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
			</td>
		</tr>
	</tbody>
</table>

<script type="text/javascript">
<!--
$(document).ready(function() {
	$('.lang_select').change( function() {
		$(this).parent('form').submit();
	});

	$('select[name="file"]').change(function() {
		var fId = $(this).val();
		var fText = $('#' + fId).children('.ftext').html();
		var fD = $('#' + fId).children('.fdescription').html();
		var fEx = $('#' + fId).children('.fexists').html();

		if (!fEx) {
			$('.tmpl_mail_body').hide();
		} else {
			('' == '{$smarty.const.CONF_USE_VISUAL_EDITOR}' || !tinyMCE.execCommand('mceSetContent', false, fText)) ? $('textarea').text(fText) : $.noop;
			$('.tmpl_mail_body').show();
		}
		$('#fdescription').html(fD);
	}).change();
	
	$('#save').click(function() {
		var file = $('select[name="file"]').val();
		var text = ('' == '{$smarty.const.CONF_USE_VISUAL_EDITOR}') ? $('textarea').text() : tinyMCE.activeEditor.getContent({ format : 'text' });
		if (!file || !text) {
			 alert ('{$smarty.const.ERROR_EMPTY_FORM_FIELDS}');
			 return false;
		}

        $('#overlay, #dialog').show();

		$.post('/admajax.php', { mailFile: file, mailText: text, pathMailTemplates: '{$pathMailTemplates}' },
			function(data) {
		        $('#overlay, #dialog').hide();
		        if (data != 'true') {
					$.alert(data);
				} else {
					$('#' + file).children('.ftext').html(text);
					$.alert('{$smarty.const.MESSAGE_CHANGE_SAVED}');
				}
		});
	});
});      
-->
</script>
