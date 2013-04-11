<table style="width: 100%;">
	<tr>
		<td style="width: 80%;">
			<textarea id="text" rows="20" cols="80" {if $smarty.const.CONF_USE_VISUAL_EDITOR}class="tinymce"{/if}></textarea>
			<p>
				<input id="save" type="button" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button">
				<input id="delete" type="button" value="{$smarty.const.FORM_BUTTON_DELETE}" class="button">
			</p>
		</td>
		<td style="vertical-align: top;">
			{if $arrTemplates}
				<select name="file" size="10" style="width: 210px;">
				{foreach from=$arrTemplates item="template"}
					<option value="{$template.name}">{$template.name}</option>
				{/foreach}
				</select>
			{/if}
			<div style="margin: 5px 0px;">
				{$smarty.const.FORM_MAILER_TEMPLATES_NEW}<br>
				<input type="text" name="newTemplate"  style="width: 200px;" maxlength="30">
				<p><input id="newTemplate" type="button" value="{$smarty.const.FORM_BUTTON_ADD}" class="button"></p>
			</div>
		</td>
	</tr>
</table>

<script type="text/javascript">
<!--
$( function() {
	
	// создаем файл шаблона
	$('#newTemplate').click( function() {
		var tmpl = $('input[name="newTemplate"]').val();

		if (tmpl.length > 0) {
			var reg = /[0-9A-z_\-]+$/;

			if (!reg.test(tmpl)) {
				alert ('{$smarty.const.ERROR_MAILER_TEMPLATES_NAME}');
				return false;
			} else {
			    $('#overlay, #dialog').show();

				$.ajax({ type: 'post', url: '/admajax.php',
					data: ({ createMailerTemplate: tmpl }),
					success: function( response ) {
						response = $.parseJSON(response);
							$('#overlay, #dialog').hide();

							if (response.success) {
								$('select[name="file"]').append( $('<option value="' + tmpl + '">' + tmpl + '</option>'));
								$('input[name="newTemplate"]').val('');
							} else {
								$.alert(response.error);
							}
					}
				});
			}
		} else {
			alert ('{$smarty.const.ERROR_FILE_NAME_EMPTY}!');
		}
	});
	
	// удаление шаблона
	$('#delete').click( function() {
		var tmpl = $('select[name="file"]').val() || false;

		if (tmpl) {
			if (confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}')) {
				$('#overlay, #dialog').show();

				$.ajax({ type: 'post', url: '/admajax.php',
					data: ({ deleteMailerTemplate: tmpl }),
					success: function( response ) {
						response = $.parseJSON(response);
							$('#overlay, #dialog').hide();

							if (response.success) {
								$('select[name="file"] option:selected').remove();
								('' == '{$smarty.const.CONF_USE_VISUAL_EDITOR}' || !tinyMCE.execCommand('mceSetContent', false, '')) ? $('textarea').text('') : $.noop;
							} else {
								$.alert(response.error);
							}
					}
				});
			}
		} else {
			alert ('{$smarty.const.ERROR_MAILER_TEMPLATES_NOT_SELECTED}');
		}
	});
	
	// сохранение шаблона
	$('#save').click( function() {
		var tmpl = $('select[name="file"]').val() || false;
		var text = ('' == '{$smarty.const.CONF_USE_VISUAL_EDITOR}') ? $('textarea').text() : tinyMCE.activeEditor.getContent({ format : 'text' });

		if (!tmpl.length || !text.length) {
			alert ('{$smarty.const.ERROR_MAILER_TEMPLATES_NOT_SELECTED_OR_EMPTY}');			
			return false;
		} else {
			$('#overlay, #dialog').show();
			$.ajax({ type: 'post', url: '/admajax.php',
				data: ({ saveMailerTemplate: tmpl, text: text }),
				success: function( response ) {
					$('#overlay, #dialog').hide();
					alert ( response );
				}
			});
		}
	});



});      
-->
</script>
