{if $errors}
	{include file="errors.message.tpl"}
{/if}

<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=change.password")}" method="post" enctype="multipart/form-data">
        <div class="DesignMainPageBody">
          <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
                  <tr><th colspan="2">{$namePage[0].name}</th></tr>
                  <tr>
                      <td colspan="2" class="last AlignLeft">
                          <div class="paddingText5">
                                <strong>{$smarty.const.FORM_NOW_PASSWORD}&nbsp;<span class="text-red">*</span></strong><br>
                                <input type="password" name="password" size="30" value=""><br><br>

                                <strong>{$smarty.const.FORM_NEW_PASSWORD}&nbsp;<span class="text-red">*</span></strong><br>
                                <input type="password" name="new_password" size="30" value=""><br><br>

                                <strong>{$smarty.const.FORM_CONFIRM_PASSWORD}&nbsp;<span class="text-red">*</span></strong><br>
                                <input type="password" name="confirm_password" size="30" value=""><br><br>

                                <div class="submitButtonLight">
                                    <input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_SAVE}">
                                </div>
                          </div>
                      </td>
                 </tr>
          </table>
        </div>
</form>
