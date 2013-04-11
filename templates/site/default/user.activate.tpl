{if $errors}{include file="errors.message.tpl"}{/if}

<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.activate")}" method="post" enctype="multipart/form-data">
    <div class="DesignMainPageBody">
        <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
            <tr>
                <th>&nbsp;</th>
            </tr>
            <tr>
                <td class="last AlignLeft">
                    <div class="paddingText5">
                        {$smarty.const.MESSAGE_ACTIVATE_REG_USER}<br>
                            <table><tr><td>
                                <strong>{$smarty.const.FORM_ACTIVATE_CODE}</strong>&nbsp;
                                <input type="text" name="code" size="50" value="">
                            </td><td>
                                <div class="submitButtonLight">
                                    <input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_SEND}">
                                </div>
                            </td></tr></table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>