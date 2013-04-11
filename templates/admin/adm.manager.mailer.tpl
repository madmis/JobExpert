<p class="sub_menu"><span class="colorbox_help" id="HELP_ADMIN_MANAGER_MAILER"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}"></span></p>

{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

{* Настройки рассылки *}
{if $actions.config}
	{include file="adm.manager.mailer.config.tpl"}
{* Настройки рассылки *}
{elseif $actions.templates}
	{include file="adm.manager.mailer.templates.tpl"}
{* Список новостей *}
{else}
	<table class="tmpl_mail_table">
		<thead class="tmpl_mail_head">
			<tr>
				<td id="fdescription">
					<table style="width: 70%; border: 0px; text-align: left;">
						<tr>
							<td style="vertical-align: top; width: 50px;">{$smarty.const.FORM_USERS_DATA_GROUP}</td>
							<td style="vertical-align: top; width: 210px;">
								<select id="uGroups" multiple="multiple" size="4" style="width: 200px;">
									{foreach from=$uGroups item="group"}
										<option value="{$group.id}">{$group.id}</option>
									{/foreach}
								</select>
							</td>
							<td style="vertical-align: top; width: 50px;">{$smarty.const.FORM_USERS_DATA_TYPE}</td>
							<td style="vertical-align: top; width: 210px;">
								<select id="uTypes" multiple="multiple" size="4" style="width: 200px;">
									{foreach from=$uTypes item="type"}
										<option value="{$type}">
											{if $type eq "competitor"}{$smarty.const.FORM_TYPE_COMPETITOR}
											{elseif $type eq "employer"}{$smarty.const.FORM_TYPE_EMPLOYER}
											{elseif $type eq "company"}{$smarty.const.FORM_TYPE_COMPANY}
											{else}{$smarty.const.FORM_TYPE_AGENT}{/if}
										</option>
									{/foreach}
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="4">
								<label><input type="checkbox" id="noSubscr" {if $return_data.subscr}checked="checked"{/if}>&nbsp;{$smarty.const.FORM_MAILER_SEND_ALL}</label>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</thead>
		<tbody class="tmpl_mail_body">
			<tr>
				<td id="sResult" style="display: none; font-weight: bold; color: #CC3333; padding: 10px 40px;">
					<img style="cursor: pointer;" id="sResultClose" src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/forbidden.png" alt="{$smarty.const.FORM_BUTTON_DELETE}">&nbsp;
				</td>
			</tr>
			<tr>
				<td>
					<table style="width: 100%; text-align: left;">
						<tr>
							<td style="width: 70%;">
								<p style="font-size: 11px; font-weight: bold;">{$smarty.const.FORM_SUBJECT}</p>
								<input type="text" id="mailerSubject" maxlength="200" size="90">
								<p style="font-size: 11px; font-weight: bold;">{$smarty.const.FORM_MAILER_TEXT}</p>
								<textarea id="text" rows="20" cols="80" {if $smarty.const.CONF_USE_VISUAL_EDITOR}class="tinymce"{/if}></textarea>
								<p><input id="send" type="button" value="{$smarty.const.FORM_BUTTON_SEND}" class="button"></p>
							</td>
							<td style="vertical-align: top;">
								<p style="font-size: 11px; font-weight: bold; text-align: left;">{$smarty.const.MENU_ACTION_TEMPLATE}</p>
								{if $arrTemplates}
									<select name="file" size="10" style="width: 210px;">
									{foreach from=$arrTemplates item="template"}
										<option value="{$template.name}">{$template.name}</option>
									{/foreach}
									</select>
								{/if}
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</tbody>
	</table>

	<div id="overlayIn"></div>
	<div id="dialogIn">
		<table>
			<tr><td class="alignCenter">{$smarty.const.MESSAGE_WAIT_RUNNING_MILER}.<br>{$smarty.const.MESSAGE_DO_NOT_RELOAD_PAGE}</td></tr>
			<tr><td class="alignCenter"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/processing.gif" alt=""></td></tr>
		</table>
	</div>

	<script type="text/javascript">
	<!--

	$( function() {
		$('#send').click( function() {
			var uGroups = $("#uGroups").val() || [];
			var uTypes = $("#uTypes").val() || [];
			var mailerSubject = $("#mailerSubject").val();
			var noSubscr = $('#noSubscr').is(':checked') ? 1 : 0;
			var text = ('' == '{$smarty.const.CONF_USE_VISUAL_EDITOR}') ? $('textarea').text() : tinyMCE.activeEditor.getContent({ format : 'text' });

			if (!uGroups.length && !uTypes.length) {
				alert ( '{$smarty.const.ERROR_MAILER_SELECT_GROUP_OR_TYPE}' );
				return false;
			}

			if ( text.length < 20 ) {
				alert ('{$smarty.const.ERROR_MAILER_TEXT_IS_SHORT}');
				return false;
			}

			if ( mailerSubject.length < 1 ) {
				alert ('{$smarty.const.ERROR_EMPTY_SUBJECT}');
				return false;
			}

			$('#overlayIn, #dialogIn').show();

			$.ajax({ type: 'post', url: '/admajax.php',
				data: ({ doUserSubscription: text, mailerSubject: mailerSubject, uGroups: uGroups, uTypes: uTypes, noSubscr: noSubscr }),
				success: function( response ) {
					response = $.parseJSON(response);

						$('#overlayIn, #dialogIn').hide();

						if (response.success) {
							$('#sResult').html('<img style="cursor: pointer;" id="sResultClose" src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/forbidden.png" alt="{$smarty.const.FORM_BUTTON_DELETE}">&nbsp;');
							$('#sResult').append('{$smarty.const.MESSAGE_MAILER_SUCCESSFUL}: ' + response.success);
							$('#sResult').show();
						} else {
							$.alert(response.error);
						}
				}
			});
		});
		
		$('#sResultClose').live('click', function() {
			$('#sResult').hide();
		});
	});
	-->
	</script>
{/if}

<script type="text/javascript">
<!--

$( function() {
    // получаем текст шаблона
	$('select[name="file"]').change(function() {
		var fId = $(this).val();

        $('#overlay, #dialog').show();

		$.ajax({ type: 'post', url: '/admajax.php',
			data: ({ getMailerTemplate: fId }),
			success: function( data ) {
				$('#overlay, #dialog').hide();
				('' == '{$smarty.const.CONF_USE_VISUAL_EDITOR}' || !tinyMCE.execCommand('mceSetContent', false, data)) ? $('textarea').text(data) : $.noop;
			}
		});
	});
});
-->
</script>