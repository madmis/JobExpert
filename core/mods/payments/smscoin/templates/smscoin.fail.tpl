<div class="DesignMainPageBody">
    <table class="mainBodyTable" cellspacing="0" style="table-layout: fixed; margin: 0 auto;">
        <tr>
            <th>{$smarty.const.SMSCOIN_FAIL_FORM_HEAD}</th>
        </tr>
        <tr>
            <td class="last">
                <p>{$smarty.const.SMSCOIN_PAY_NUMBER}: <strong>{$order_id}</strong></p>
                <p>{$smarty.const.SMSCOIN_PAY_AMOUNT}: <strong>{$amount} {$smarty.const.SMSCOIN_CONF_BANK_CURRENCY}</strong></p>
            </td>
        </tr>
        <tr>
            <td class="last">
                <p>{$smarty.const.SMSCOIN_FAIL_MESSAGE}</p>
            </td>
        </tr>
    </table>
</div>