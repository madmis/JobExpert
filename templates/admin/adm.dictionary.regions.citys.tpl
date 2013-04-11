{if !$errors}
    <form action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=regions&amp;action=citys&amp;pid={$pid}" method="post" enctype="multipart/form-data">
        <table style="width: 100%; border: 0px;" cellspacing="0" class="add_table">
            <thead>
                <tr>
                    <td style="width: 75%;">{$smarty.const.FORM_CITY_INPUT_ADD}</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left" style="width: 100%; border: 0px;">
                        <table style="width: 100%; border: 0px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="hidden" name="arrBindFields[parent_id]" value="{$pid}">
                                        <strong>{$smarty.const.TABLE_COLUMN_NAME}:</strong>&nbsp;<input type="text" name="arrBindFields[name]" size="100" maxlength="255">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="arrNoBindFields[capital]" style="vertical-align: middle;">&nbsp;<strong>{$smarty.const.TABLE_FORM_CAPITAL}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <strong>{$smarty.const.SITE_PAGE_TITLE}:</strong><br><br>
                                        <input type="text" name="arrNoBindFields[title]" size="150" maxlength="255">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <strong>{$smarty.const.SITE_PAGE_META_KEYWORDS}:</strong><br><br>
                                        <input type="text" name="arrNoBindFields[meta_keywords]" size="150" maxlength="255">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <strong>{$smarty.const.SITE_PAGE_META_DESCRIPTION}:</strong><br><br>
                                        <textarea name="arrNoBindFields[meta_description]" rows="3" cols="100"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><input type="submit" name="add_city" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></td>
                </tr>
            </tfoot>
        </table>
    </form>
    <form name="ActionCitys" action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=regions&amp;action=citys&amp;pid={$pid}" method="post" enctype="multipart/form-data">
        <table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
            <thead class="data_head">
                <tr>
                    <td style="width: 80%;">{$smarty.const.TABLE_COLUMN_NAME}</td>
                    <td>{$smarty.const.TABLE_FORM_CAPITAL}</td>
                    <td><input type="checkbox" class="chk_all"></td>
                </tr>
            </thead>
            <tbody class="data_body">
                {if $arrCitys}
                    {foreach from=$arrCitys item="citys" name="citys"}
                        <tr>
                            <td style="width: 80%;">{$citys.name}</td>
                            <td align="center">
                                <input type="radio" name="capital_city" value="{$citys.id}"{if $citys.capital} checked="checked"{/if}>
                            </td>
                            <td align="center">
                                <input type="checkbox" name="city[{$citys.id}]" class="chk_citys">
                            </td>
                        </tr>
                    {/foreach}
                    </tbody>
                    <tfoot class="data_foot">
                        <tr>
                            <td align="center" style="width: 80%;">
                                {$smarty.const.TABLE_RECORDS}&nbsp;{$smarty.foreach.citys.total}
                            </td>
                            <td align="right" colspan="2">
                                <select name="action" class="select">
                                    <option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
                                    <option value="edit">{$smarty.const.FORM_ACTION_EDIT}</option>
                                    <option value="setcapital">{$smarty.const.FORM_ACTION_SETCAPITAL}</option>
                                    <option value="resetcapital">{$smarty.const.FORM_ACTION_RESETCAPITAL}</option>
                                    <option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
                                </select>
                                <input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button" style="margin: 5px;">
                            </td>
                        </tr>
                    </tfoot>
                {else}
                        <tr>
                            <td align="center" colspan="3">
                                {$smarty.const.TABLE_NOT_DATA}
                            </td>
                        </tr>
                    </tbody>
                {/if}
        </table>
    </form>
    <script type="text/javascript">
    <!--
        $(document).ready( function()
        {
            //включаем все переключатели в таблице
            $('.chk_all').click( function()
            {
                var current = $(this);
                $('.chk_citys').each( function()
                {
                    (current.is(':checked')) ? $(this).attr('checked', true) : $(this).attr('checked', false);
                });
            });

            // проверяем выбранное действие
            $('form[name="ActionCitys"]').submit( function()
            {
                if (!$('select[name="action"] option:selected').val())
                {
                    $.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
                    return false;
                }
                else
                {
                    if ('resetcapital' !== $("select[name='action'] option:selected").val() && 'setcapital' !== $("select[name='action'] option:selected").val() && !$('input:checked').size())
                    {
                        $.alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
                        return false;
                    }

                    return ('del' === $("select[name='action'] option:selected").val()) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS_CITYS}') : true;
                }
            });
        });
    -->
    </script>
{/if}