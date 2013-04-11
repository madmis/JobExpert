<form action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=selects&amp;action=add" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="0" class="add_table">
		<thead>
			<tr>
				<td>{$smarty.const.FORM_DICT_INPUT_ADD}</td>
				<td>{$smarty.const.FORM_SELECT_LANGUAGE}:&nbsp;{$currLang}</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td align="left" style="width: 100%; border: 0px;" colspan="2">
					<table style="width: 100%; border: 0px;">
						<tbody>
							<tr>
								<td style="white-space: nowrap;">
									<b>{$smarty.const.TABLE_COLUMN_ALIAS_LIST}:</b>&nbsp;$arrAddDict['<input type="text" name="newDict[alias]" style="text-align: center; font-weight: bold;" size="30" maxlength="100">']['values']
								</td>
								<td style="text-align: center;"><b>{$smarty.const.TABLE_COLUMN_NAME}</b>&nbsp;<input type="text" name="newDict[discription]" size="70" maxlength="255"></td>
							</tr>
							<tr>
								<td>
									<b>{$smarty.const.TABLE_COLUMN_CONTENTS_TYPE}</b>
								</td>
								<td style="text-align: center;">
									<input type="radio" name="newDict[type]" checked="checked" value="index" class="dict_radio">&nbsp;<b>{$smarty.const.TABLE_COLUMN_CONTENTS_TYPE_INDEX}</b>&nbsp;&nbsp;|&nbsp;&nbsp;
									<input type="radio" name="newDict[type]" value="assoc" class="dict_radio">&nbsp;<b>{$smarty.const.TABLE_COLUMN_CONTENTS_TYPE_ASSOC}</b>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table style="width: 100%; border: 0px;" cellspacing="0" class="add_table">
										<thead>
											<tr>
												<td colspan="2">{$smarty.const.TABLE_COLUMN_CONTENTS_LIST}</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<table style="width: 100%; border: 0px;">
														<tr>
															<td>
																<b>{$smarty.const.TABLE_COLUMN_CONTENTS_VALUE}:</b>
																<input type="text" name="newDict[value][]" size="80" maxlength="255">&nbsp;
															</td>
															<td class="dict_index">
																<b>{$smarty.const.TABLE_COLUMN_INDEX_LIST}:</b>
																<input type="text" name="newDict[index][]" size="25" maxlength="100" class="index_input">
															</td>
															<td style="width: 5%;">
																<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/delete.png" class="val_delete" style="vertical-align: middle; display: none; cursor: pointer;" title="{$smarty.const.MENU_ACTION_DELETE}" alt="{$smarty.const.MENU_ACTION_DELETE}">
															</td>
														</tr>
													</table>
													<div id="ext_val" style="display: none;">
														<table style="width: 100%; border: 0px;">
															<tr>
																<td>
																	<b>{$smarty.const.TABLE_COLUMN_CONTENTS_VALUE}:</b>
																	<input type="text" name="newDict[value][]" size="80" maxlength="255">&nbsp;
																</td>
																<td class="dict_index">
																	<b>{$smarty.const.TABLE_COLUMN_INDEX_LIST}:</b>
																	<input type="text" name="newDict[index][]" size="25" maxlength="100" class="index_input">
																</td>
																<td style="width: 5%;">
																	<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/delete.png" class="val_delete" style="vertical-align: middle; cursor: pointer;" title="{$smarty.const.MENU_ACTION_DELETE}" alt="{$smarty.const.MENU_ACTION_DELETE}">
																</td>
															</tr>
														</table>
													</div>
												</td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<td style="text-align: right;"><input id="add_button" type="button" value="{$smarty.const.FORM_DICT_VALUE_INPUT_ADD}" class="button"></td>
											</tr>
										</tfoot>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2"><input type="submit" name="add_dict" value="{$smarty.const.FORM_BUTTON_ADD}" class="button"></td>
			</tr>
		</tfoot>
	</table>
</form>
<script type="text/javascript">
<!--
$(document).ready(function() {
	$('.dict_radio').click(function() {
		('assoc' === $(this).val()) ? $('.dict_index').show() : $('.dict_index').hide();
	});

	$('#add_button').click(function() {
		$('#ext_val > *').clone().insertBefore('#ext_val').show();
		($('.val_delete').size() > 2) ? $('.val_delete').show() : null;
	});

	$('.val_delete').live('click', function() {
		$(this).parent().parent().parent().remove();
		($('.val_delete').size() < 3) ? $('.val_delete').hide() : null;
	});

	$('form').submit(function() {
		var result = true;
		var temp = $(this).find('#ext_val > *');
		$(this).find('#ext_val > *').remove();

		var arrInputs = ('assoc' !== $(this).find(':radio:checked').val()) ? $(this).find(':input not:(.index_input)') : $(this).find(':input');
		arrInputs.each(function() {
			if (!$(this).val()) {
				$.alert('{$smarty.const.ERROR_EMPTY_FORM_FIELDS}');
				return result = false;
			}
		});

		if (!result) {
			temp.appendTo('#ext_val');
			return result;
		} else {
			return result;
		}
	});
});
-->
</script>