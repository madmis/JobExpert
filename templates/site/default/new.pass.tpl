{if $errors}
	{include file="errors.message.tpl"}
{/if}

<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=new.pass")}" method="post" enctype="multipart/form-data">
        <div class="DesignMainPageBody">
          <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
                  <tr>
                      <th>{$namePage[0].name}</th>
                  </tr>
                  <tr>
                      <td class="last AlignLeft">
                          <div class="paddingText5">
                                <table><tr><td>
                                    <strong>{$smarty.const.FORM_EMAIL}</strong>&nbsp;
                                    <input type="text" name="email" size="30" value="{$return_data.email}"><br>
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




