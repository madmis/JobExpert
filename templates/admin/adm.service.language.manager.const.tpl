<div class="sub_menu">
	<div style="float: left;">
		<form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&amp;s=language.manager&amp;action=localizConst" method="post" enctype="multipart/form-data">
			&nbsp;{$smarty.const.FORM_SELECT_LANGUAGE}:&nbsp;
			<select name="currLocaliz" class="langSelect">
				{foreach from=$langs item="lang"}
					<option value="{$lang}"{if $lang eq $currLang} selected{/if}>{$lang}</option>
				{/foreach}
			</select>
		</form>
	</div>
	<div class="colorbox_help" id="HELP_ADMIN_SERVICE_LANGUAGE_MANAGER_CONST">
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
	</div>
</div>
{foreach from=$defLocalizConst key="fileNameLocaliz" item="arrContentLocaliz"}
	<table style="width: 100%; border: 0px;" cellspacing="10" cellpadding="5">
		<thead class="data_head" style="cursor: pointer;">
			<tr>
				<td class="toggleList">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/attention.png" class="hasDifferents" data-fnl="{$fileNameLocaliz}" style="display: none;" title="" alt="">
					{$fileNameLocaliz}
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/attention.png" class="hasDifferents" data-fnl="{$fileNameLocaliz}" style="display: none;" title="" alt="">
				</td>
				{if 'russian' eq $currLang && 'lang._custom.php' eq $fileNameLocaliz}
					<td style="width: 5%;">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/add.png" class="addConstLang_custom" title="{$smarty.const.FORM_BUTTON_ADD_LANG_CONST_CUSTOM}" alt="">
					</td>
				{/if}
			</tr>
		</thead>
		<tbody class="data_body" style="display: none;">
			<tr>
				<td colspan="2">
					<form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&amp;s=language.manager&amp;action=localizConst" method="post" enctype="multipart/form-data">
						<table style="width: 100%; border: 0px;" cellspacing="1" cellpadding="1">
							{foreach from=$arrContentLocaliz key="nameConstant" item="valueConstant"}
								<tr class="tr_hover">
									{if !$currLocalizConst.$fileNameLocaliz.$nameConstant || $currLocalizConst.$fileNameLocaliz.$nameConstant eq $nameConstant}
										<td>
											<div style="margin: 5px;">{$smarty.const.TABLE_LANGUAGE_DEFAULT_VALUE}:</div>
											<textarea class="defValueConstant" cols="50" rows="3" readonly="readonly" style="padding: 5px;">{$valueConstant}</textarea>
										</td>
										<td class="GoogleTtranslation" style="display: none;">
											<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/GoogleTtranslation.png" style="cursor: pointer;" alt="">
										</td>
										<td class="emptyConst" data-fnl="{$fileNameLocaliz}">
											<div style="margin: 5px; font-weight: bold; color: #cc3333;">{$nameConstant}</div>
											<textarea name="{$nameConstant}" cols="50" rows="3" style="padding: 5px; border: 2px solid #cc3333;"></textarea>
										</td>
									{else}
										<td colspan="3">
											<div style="margin: 5px; font-weight: bold;">{$nameConstant}</div>
											<textarea name="{$nameConstant}" cols="100" rows="3" style="padding: 5px;">{$currLocalizConst.$fileNameLocaliz.$nameConstant}</textarea>
										</td>
									{/if}
                                    {if 'russian' eq $currLang && 'lang._custom.php' eq $fileNameLocaliz}
                                        <td style="width: 5%; text-align: center; vertical-align: middle;">
                                            <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/delete.png" class="delConstLang_custom" data-nameConst="{$nameConstant}" style="cursor: pointer;" title="{$smarty.const.FORM_BUTTON_DELETE_LANG_CONST_CUSTOM}" alt="">
                                        </td>
                                    {/if}
                                </tr>
							{/foreach}
							<tfoot class="data_foot">
								<tr>
									<td colspan="4">
										<input type="hidden" name="fileNameLocaliz" value="{$fileNameLocaliz}">
										<input type="submit" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button">
									</td>
								</tr>
							</tfoot>
						</table>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
{/foreach}

{* Диалоговое окно - Форма добавления пользовательской константы *}
<div id="addConstLang_custom" title="{$smarty.const.FORM_BUTTON_ADD_LANG_CONST_CUSTOM}" style="display: none;">
	<div id="emptyRequiredFields" class="errors ui-state-error ui-corner-all" style="padding: 5px; margin: 10px; display: none;"> 
		<span class="ui-icon ui-icon-alert" style="float: left; margin: 0px 10px;"></span> 
		{$smarty.const.ERROR_EMPTY_FORM_FIELDS}
	</div>
	<form action="#" id="fAddConstLang_custom">
		<fieldset class="ui-corner-all">
			<label for="nameConst">{$smarty.const.FORM_ADD_LANG_CONST_CUSTOM_NAME}:</label>
			<b>LANG_CONST_CUSTOM_</b><input type="text" name="nameConst" id="nameConst" size="55" maxlength="255" class="text ui-widget-content ui-corner-all">
			<br><br>
			<label for="valueConst">{$smarty.const.FORM_ADD_LANG_CONST_CUSTOM_VALUE}:</label><br>
			<textarea name="valueConst" id="valueConst" class="text ui-widget-content ui-corner-all" cols="100" rows="3"></textarea>
            <input type="hidden" name="currLocaliz" value="{$currLang}">
		</fieldset>
	</form>
</div>

{* Диалоговое окно - Удаление пользовательской константы *}
<div id="delConstLang_custom" title="{$smarty.const.FORM_BUTTON_DELETE_LANG_CONST_CUSTOM}" style="display: none;">
	<div class="ui-state-highlight ui-corner-all" style="padding: 5px; margin: 10px; text-align: center;">
		<span class="ui-icon ui-icon-help" style="float: right; margin: 0px 5px;"></span>
		{$smarty.const.MESSAGE_DELETE_CONST_LANG_CUSTOM}
	</div>
</div>

<script type="text/javascript">
<!--
$(document).ready(function() {
    if ($('.delConstLang_custom').size() < 2) {
        $('.delConstLang_custom').hide();
	}

    $('.langSelect').change(function() {
		$(this).parent('form').submit();
	});

	$('.toggleList').click(function() {
		$(this).parents('thead').next().toggle();
	});
	$('.emptyConst').each(function() {
		var objRow = $(this).parent();
		var objTable = objRow.parent();
		objRow.prependTo(objTable);
		$('.hasDifferens[data-fnl="' + $(this).data('fnl') + '"]').show().removeClass('hasDifferens');
	});

	$('#addConstLang_custom').dialog({
		autoOpen: false,
		modal: true,
		width: 'auto',
		draggable: false,
		resizable: false,
		buttons: {
			'{$smarty.const.FORM_BUTTON_ADD}': function() {
				if (!$('#nameConst').val() ) {
					$('#emptyRequiredFields').show();
					$('#nameConst').focus();
					return false;
				} else if (!$('#valueConst').val() ) {
					$('#emptyRequiredFields').show();
					$('#valueConst').focus();
					return false;
				} else {
					var thisDialog = $(this);
					var tmpB = thisDialog.dialog('option', 'buttons');
					thisDialog.dialog('option', { buttons: {} }).children().hide();
					$.post(
						'/admajax.php?action=addConstLang_custom',
						$('#fAddConstLang_custom').serialize(),
						function(resp) {
							thisDialog.dialog('option', { buttons: tmpB }).dialog('close').children().show();
							if ('success' === resp) {
                                window.location.reload();
							} else {
								switch (resp) {
                                    case 'errConstLangCustomExsists':
										resp = '{$smarty.const.ERROR_CONST_LANG_CUSTOM_EXSISTS}';
										break;
                                    case 'errConstAdding':
										resp = '{$smarty.const.ERROR_NOT_SAVE_CHANGE}';
										break;
									default:
										resp = '{$smarty.const.ERROR_UNDEFINED}';
										break;
								}
								$.alert(resp);
							}
						}
					);
				}
			},
			'{$smarty.const.SITE_CANCEL}': function() {
				$(this).dialog('close');
			}
		},
		beforeClose: function() {
			$('#nameConst, #valueConst').val('');
		}
	});

	$('.addConstLang_custom').click(function() {
		$('.errors').hide();
		$('#addConstLang_custom').dialog('open');
	});

	$('#delConstLang_custom').dialog({
		autoOpen: false,
		modal: true,
		width: 'auto',
		draggable: false,
		resizable: false,
		buttons: {
			'{$smarty.const.FORM_BUTTON_DELETE}': function() {
				var thisDialog = $(this);
                $.post(
                    '/admajax.php?action=delConstLang_custom',
                    { 'nameConst': $(this).data('nameConst'), 'currLocaliz': '{$currLang}' },
                    function(resp) {
                        thisDialog.removeData('nameConst').dialog('close');
                        if ('success' === resp) {
                            window.location.reload();
                        } else {
                            switch (resp) {
                                case 'errConstLangCustomNoExsists':
                                    resp = '{$smarty.const.ERROR_CONST_LANG_CUSTOM_NOEXSISTS}';
                                    break;
                                case 'errConstDeleting':
                                    resp = '{$smarty.const.ERROR_NOT_SAVE_CHANGE}';
                                    break;
                                default:
                                    resp = '{$smarty.const.ERROR_UNDEFINED}';
                                    break;
                            }
                            $.alert(resp);
                        }
                    }
                );
			},
			'{$smarty.const.SITE_CANCEL}': function() {
				$(this).removeData('nameConst').dialog('close');
			}
		}
	});

    $('.delConstLang_custom').click(function() {
        $('#delConstLang_custom').data('nameConst', $(this).data('nameConst')).dialog('open');
    });

	var languages = {
		'english': 'en',
		'ukrainian': 'uk',
		'georgian': 'ka'
	};

    $('.GoogleTtranslation').bind('click', function() {
    	currObj = $(this);
		$.ajax({
			url: '/admajax.php?action=googleTranslate',
			type: 'POST',
			data: {
				key: '',
				q: $(this).prev().find('.defValueConstant').text(),
				source: 'ru',
				target: languages.{$currLang}
			},
			success: function(json){
				try {
					json = $.parseJSON(json);
				} catch (e) {
					$.alert(json);
					return;
				}

				if (!json || !json.data || !json.data.translations) {
                   	return;
				} else {
   					currObj.next().find('textarea').val(json.data.translations[0].translatedText);
				}
			}
		});
	});
});
-->
</script>