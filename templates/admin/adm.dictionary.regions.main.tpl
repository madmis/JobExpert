<form action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=regions" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="0" class="add_table">
		<thead style="cursor: pointer;" id="addNewRegion">
			<tr>
				<td>{$smarty.const.FORM_REGION_INPUT_ADD}</td>
			</tr>
		</thead>
		<tbody style="display: none;">
			<tr>
				<td align="left" style="width: 100%; border: 0px;">
					<table style="width: 100%; border: 0px;">
						<tbody>
							<tr>
								<td colspan="3">
                                    <strong>{$smarty.const.TABLE_COLUMN_NAME}:</strong><br><br>
                                    <input type="text" name="arrBindFields[name]" size="150" maxlength="255">
                                </td>
							</tr>
							<tr>
								<td><strong>{$smarty.const.TABLE_COLUMN_SORT}:</strong>&nbsp;<input type="text" name="arrNoBindFields[sort]" size="5" maxlength="3"></td>
								<td><input type="checkbox" id="addNewMajorRegion" name="arrNoBindFields[major]">&nbsp;<strong>Регион-Город</strong></td>
								<td><input type="checkbox" id="addNewNoMajorRegion" name="arrNoBindFields[add_city_allowed]">&nbsp;<strong>Разрешить пользователям сайта добавлять города</strong></td>
							</tr>
							<tr>
								<td colspan="3">
									<strong>{$smarty.const.SITE_PAGE_TITLE}:</strong><br><br>
									<input type="text" name="arrNoBindFields[title]" size="150" maxlength="255">
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<strong>{$smarty.const.SITE_PAGE_META_KEYWORDS}:</strong><br><br>
									<input type="text" name="arrNoBindFields[meta_keywords]" size="150" maxlength="255">
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<strong>{$smarty.const.SITE_PAGE_META_DESCRIPTION}:</strong><br><br>
									<textarea name="arrNoBindFields[meta_description]" rows="3" cols="100"></textarea>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
		<tfoot style="display: none;">
			<tr>
				<td colspan="2"><input type="submit" name="add_region" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></td>
			</tr>
		</tfoot>
	</table>
</form>
<form name="ActionRegions" action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=regions" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
		<thead class="data_head">
			<tr>
				<td style="width: 80%;">{$smarty.const.TABLE_COLUMN_NAME}</td>
				<td>{$smarty.const.TABLE_COLUMN_SORT}</td>
				<td>Регион-Город</td>
				<td>Добавление городов</td>
				<td><input type="checkbox" class="chk_all"></td>
			</tr>
		</thead>
		<tbody class="data_body">
			{if $arrRegions}
				{foreach from=$arrRegions item="regions" name="regions"}
					<tr>
						<td style="width: 80%;">
                            <span class="isMajorRegion"{if '0' eq $regions.major} style="display: none;"{/if}>
                                {$regions.name}
                            </span>
                            <span class="isNoMajorRegion"{if 'on' eq $regions.major} style="display: none;"{/if}>
                                <a href="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=regions&amp;action=citys&amp;pid={$regions.id}" class="regions">{$regions.name}</a>
                            </span>
						</td>
						<td style="text-align: center; vertical-align: top;">
							<input type="text" name="sort_region[{$regions.id}]" value="{$regions.sort}" size="5" maxlength="3" class="text">
						</td>
						<td style="text-align: center; vertical-align: top;">
							<input type="checkbox" class="checkboxMajorRegion" data-rid="{$regions.id}"{if $regions.add_city_allowed} disabled="disabled"{/if}{if $regions.major} checked="checked"{/if}>
						</td>
						<td style="text-align: center; vertical-align: top;">
							<input type="checkbox" class="checkboxAddCityAllowed" data-rid="{$regions.id}"{if $regions.major} disabled="disabled"{/if}{if $regions.add_city_allowed} checked="checked"{/if}>
						</td>
						<td style="text-align: center; vertical-align: top;">
							<input type="checkbox" name="region[{$regions.id}]" class="chk_region">
						</td>
					</tr>
				{/foreach}
				</tbody>
				<tfoot class="data_foot">
					<tr>
						<td style="text-align: center; width: 80%;">
							{$smarty.const.TABLE_RECORDS}&nbsp;{$smarty.foreach.regions.total}
						</td>
						<td style="text-align: right;" colspan="4">
							<select name="action" class="select">
								<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
								<option value="edit">{$smarty.const.FORM_ACTION_EDIT}</option>
								<option value="sort">{$smarty.const.FORM_ACTION_SAVE_SORT}</option>
								<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
							</select>
							<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button" style="margin: 5px;">
						</td>
					</tr>
				</tfoot>
			{else}
					<tr>
						<td align="center" colspan="5">
							{$smarty.const.TABLE_NOT_DATA}
						</td>
					</tr>
				</tbody>
			{/if}
	</table>
</form>

<script type="text/javascript">
<!--
$(document).ready(function() {
	//включаем все переключатели в таблице
	$('.chk_all').click(function() {
		($(this).is(':checked')) ? $('.chk_region').attr('checked', 'checked') : $('.chk_region').removeAttr('checked');
	});

	// проверяем выбранное действие
	$('form[name="ActionRegions"]').submit(function() {
		if (!$('select[name="action"] option:selected').val()) {
			$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
			return false;
		} else if ('sort' !== $("select[name='action'] option:selected").val() && !$('input:checked').size()) {
			$.alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
			return false;
		} else {
			return ('del' === $("select[name='action'] option:selected").val()) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS_REGIONS}') : true;
		}
	});
    //форма добавления нового Региона
    $('#addNewRegion').click(function() {
        $(this).next().toggle().next().toggle();
    });
    $('#addNewMajorRegion').click(function() {
        if ($(this).attr('checked')) {
            $('#addNewNoMajorRegion').removeAttr('checked').attr('disabled', 'disabled');
        } else {
            $('#addNewNoMajorRegion').removeAttr('disabled');
        }
    });
    $('#addNewNoMajorRegion').click(function() {
        if ($(this).attr('checked')) {
            $('#addNewMajorRegion').removeAttr('checked').attr('disabled', 'disabled');
        } else {
            $('#addNewMajorRegion').removeAttr('disabled');
        }
    });
    // обработка чеккеров
    $('.checkboxMajorRegion').click(function() {
        var rid = $(this).data('rid'),
            checkBoxMajorRegion = $(this),
            checkBoxAddCityAllowed = $(this).parent().next().children();

        if ($(this).attr('checked')) {
            $.post('/admajax.php', { 'do': 'setRegionMajor', 'rid': rid }, function(data) {
                data = $.parseJSON(data);
                if (data.success) {
                    checkBoxAddCityAllowed.removeAttr('checked').attr('disabled', 'disabled');
                    checkBoxAddCityAllowed.parent().parent().children().first().children().toggle();
                } else if (data.error) {
                    switch (data.error) {
                        case 'errRegionHasChildRecords':
                            if (confirm('{$smarty.const.WARNING_REGION_HAS_CHILD_RECORDS}')) {
                                $.post('/admajax.php', { 'do': 'setRegionMajor', 'rid': rid, 'force': true }, function(data) {
                                    data = $.parseJSON(data);
                                    if (data.success) {
                                        checkBoxAddCityAllowed.removeAttr('checked').attr('disabled', 'disabled');
                                        checkBoxAddCityAllowed.parent().parent().children().first().children().toggle();
                                    } else if (data.error) {
                                        switch (data.error) {
                                            case 'errRegionSetMajor':
                                                $.alert('{$smarty.const.ERROR_REGION_SET_MAJOR}');
                                                break;
                                            case 'errRegionDeleteChildRecords':
                                                $.alert('{$smarty.const.ERROR_REGION_DELETE_CHILD_RECORDS}');
                                                break;
                                            default:
                                                $.alert(data.error);
                                                break;
                                        }
                                    } else {
                                        $.alert('{$smarty.const.ERROR_FATAL_UNCORRECT_PARAMS}');
                                    }
                                });
                            } else {
                                checkBoxMajorRegion.removeAttr('checked');
                            }
                            break;
                        case 'errRegionSetMajor':
                            $.alert('{$smarty.const.ERROR_REGION_SET_MAJOR}');
                            break;
                        default:
                            $.alert(data.error);
                            break;
                    }
                } else {
                    $.alert('{$smarty.const.ERROR_FATAL_UNCORRECT_PARAMS}');
                }
            });
        } else {
            $.post('/admajax.php', { 'do': 'resetRegionMajor', 'rid': rid }, function(data) {
                checkBoxAddCityAllowed.removeAttr('disabled');
                checkBoxAddCityAllowed.parent().parent().children().first().children().toggle();
            });
        }
    });
    $('.checkboxAddCityAllowed').click(function() {
        var rid = $(this).data('rid'),
            doAction = ($(this).attr('checked')) ? 'setAddCityAllowed' : 'resetAddCityAllowed',
            checkBoxMajorRegion = $(this).parent().prev().children();

            $.post('/admajax.php', { 'do': doAction, 'rid': rid }, function(data) {
                data = $.parseJSON(data);
                if (data.success) {
                    if ('setAddCityAllowed' == doAction) {
                        checkBoxMajorRegion.removeAttr('checked').attr('disabled', 'disabled');
                    } else if ('resetAddCityAllowed' == doAction) {
                        checkBoxMajorRegion.removeAttr('disabled');
                    } else {
                        $.alert('{$smarty.const.ERROR_FATAL_UNCORRECT_PARAMS}');
                    }
                } else if (data.error) {
                    switch (data.error) {
                        case 'errActionAddCityAllowed':
                            $.alert('{$smarty.const.ERROR_REGION_SET_ADD_CITY_ALLOWED}');
                            break;
                        default:
                            $.alert(data.error);
                            break;
                    }
                } else {
                    $.alert('{$smarty.const.ERROR_FATAL_UNCORRECT_PARAMS}');
                }
            });
    });
});
-->
</script>