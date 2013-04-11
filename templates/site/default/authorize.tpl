{if $errors}{include file="errors.message.tpl"}{/if}

<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=authorize")}" method="post" enctype="multipart/form-data">
<div class="DesignMainPageBody">
    <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
        <tr>
            <th colspan="2">{$namePage[0].name}</th>
        </tr>
        <tr>
            <td colspan="2" class="last AlignLeft">
                <div class="paddingText5">
                    <table cellspacing="0" cellpadding="0">
                        <tr>
                            <td rowspan="5" style="width: 70px; text-align: left;">
                                <img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/login.png" alt="">
                            </td>
                            <td>
                                <strong>{$smarty.const.FORM_EMAIL}</strong><br>
                                <input type="text" name="email" size="30" value="{$return_data.email|default:$smarty.const.FORM_EMAIL}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>{$smarty.const.FORM_PASSWORD}</strong><br>
                                <input type="password" name="password" size="30" value="{$smarty.const.FORM_PASSWORD}">
                            </td>
                        </tr>
                        {if $secure}
                        <tr>
                            <td align="left" nowrap>
                                <table>
                                    <tr>
                                        <td align="right">{include file="securimage.tpl"}</td>
                                        <td align="left"><input type="text" name="keystring" size="10"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        {/if}
                        <tr>
                            <td>
                                <input type="checkbox" name="remember"> {$smarty.const.FORM_REMEMBER}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="submitButtonLight"><input type="submit" class="shadow01red" name="send" value="{$smarty.const.FORM_BUTTON_SEND}"></div><br>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</div>
</form>



