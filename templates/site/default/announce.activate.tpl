<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$typeAnnounce&amp;action=activate")}" method="post" enctype="multipart/form-data">
    <div class="DesignMainPageBody">
      <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
              <tr>
                  <th>{$smarty.const.ANNOUNCE_ACTIVATE_CODE_HEAD}</th>
              </tr>
              <tr>
                  <td class="last AlignLeft">
                      <div class="paddingText5">
                          {$smarty.const.ANNOUNCE_ACTIVATE_CODE}:&nbsp;<input type="text" name="code" class="input" size="35" maxlength="32">
                          <br><br>
                          <div class="submitButtonLight"><input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_ACTIVATE}"></div>
                      </div>
                  </td>
             </tr>
      </table>
    </div>
</form>