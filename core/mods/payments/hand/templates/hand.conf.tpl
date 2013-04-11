<h2 style="text-align: center;">{$smarty.const.HAND_CONFIG_FORM_HEAD}</h2>
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments&amp;action=config&amp;id=hand" method="post">
<table style="width: 100%; border-spacing: 5px;" class="data_table">
	<tr><td style="text-align: center; font-weight: bold;" colspan="3">{$smarty.const.HAND_CONFIG_FORM_PAYMENT_TYPES}</td></tr>
	<tr><td class="mod_help" colspan="3">{$smarty.const.HAND_CONFIG_FORM_PAYMENT_TYPES_HELP}</td></tr>
{if $paymentTypes}
	<tr>
		<td colspan="3">
		{foreach from=$paymentTypes item="type" key="key"}
			<div style="padding: 5px;">
				{$smarty.const.HAND_CONFIG_FORM_KEY}&nbsp;<input type="text" name="arrPayTypes[index][]" value="{$key}" title="{$smarty.const.HAND_CONFIG_FORM_KEY}">&nbsp;{$smarty.const.HAND_CONFIG_FORM_VALUE}&nbsp;<input type="text" name="arrPayTypes[value][]" value="{$type}" title="{$smarty.const.HAND_CONFIG_FORM_VALUE}">&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/delete.png" class="valDelete" style="vertical-align: middle; cursor: pointer;" alt="{$smarty.const.HAND_ACTION_DELETE}" title="{$smarty.const.HAND_ACTION_DELETE}">
			</div>
		{/foreach}
			<div id="extVal" style="display: none;">
			<div style="padding: 5px;">
					{$smarty.const.HAND_CONFIG_FORM_KEY}&nbsp;<input type="text" name="arrPayTypes[index][]" value="" title="{$smarty.const.HAND_CONFIG_FORM_KEY}">&nbsp;{$smarty.const.HAND_CONFIG_FORM_VALUE}&nbsp;<input type="text" name="arrPayTypes[value][]" value="" title="{$smarty.const.HAND_CONFIG_FORM_VALUE}">&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/delete.png" class="valDelete" style="vertical-align: middle; cursor: pointer;" alt="{$smarty.const.HAND_ACTION_DELETE}" title="{$smarty.const.HAND_ACTION_DELETE}">
				</div>
			</div>
		</td>
	</tr>
{/if}
	<tr><td colspan="3"><input id="addButton" type="button" value="{$smarty.const.FORM_DICT_VALUE_INPUT_ADD}" class="button"></td></tr>
	<tr>
		<td>{$smarty.const.HAND_CONFIG_FORM_CURRENCY}</td>
		<td><input type="text" name="currency" value="{$smarty.const.HAND_CONF_CURRENCY}"></td>
		<td class="mod_help">{$smarty.const.HAND_CONFIG_FORM_CURRENCY_HELP}</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="config" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>

<script type="text/javascript">
<!--
$(function()
{
	$('#addButton').live('click', function() {
		//alert ( $('#extVal:last').val() );
		$('#extVal > *').clone().insertBefore('#extVal').show();
	});
	
	$('.valDelete').live('click', function() {
		$(this).parent().remove();
		if ($('.valDelete').size() < 3) {
			$('.valDelete').hide();
		} else if (($('.valDelete').size() > 2))  {
			$('.valDelete').show();
		}
	});
});
-->
</script>

{if $tariffs_template}
	{include file=$tariffs_template}
{/if}