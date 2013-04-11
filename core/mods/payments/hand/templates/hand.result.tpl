<div class="DesignMainPageBody">
    <table class="mainBodyTable" cellspacing="0" style="table-layout: fixed; margin: 0 auto;">
        <tr>
            <th>{if $status eq 'wait_secure'}{$smarty.const.LIQPAY_WAIT_SECURE_FORM_HEAD}{else}{$smarty.const.LIQPAY_FAIL_FORM_HEAD}{/if}</th>
        </tr>
        <tr>
            <td class="last">
                <p>{$smarty.const.LIQPAY_PAY_NUMBER}: <strong>{$order_id}</strong></p>
                <p>{$smarty.const.LIQPAY_PAY_AMOUNT}: <strong>{$amount} {$smarty.const.LIQPAY_CONF_CURRENCY}</strong></p>
            </td>
        </tr>
        <tr>
            <td class="last">
                <p>{if $status eq 'wait_secure'}{$smarty.const.LIQPAY_WAIT_SECURE_MESSAGE}{else}{$smarty.const.LIQPAY_FAIL_MESSAGE}{/if}</p>
            </td>
        </tr>
    </table>
</div>