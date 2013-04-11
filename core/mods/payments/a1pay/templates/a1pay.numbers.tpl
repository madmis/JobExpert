<h2 style="text-align: center;">{$smarty.const.A1PAY_CONFIG_NUMDERS_FORM_HEAD}</h2>
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments&amp;action=config&amp;id=a1pay" method="post" enctype="multipart/form-data">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td {if $arrPayments.register_agent AND !$arrNumbers.register_agent}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_REGISTER_AGENT}
		</td>
		<td>
			<input type="text" name="arrNumbers[register_agent]" {if !$arrPayments.register_agent}value="" readonly style="background-color: #DDD;" style="background-color: #DDD;"{else}value="{$arrNumbers.register_agent}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.register_company AND !$arrNumbers.register_company}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_REGISTER_COMPANY}
		</td>
		<td>
			<input type="text" name="arrNumbers[register_company]" {if !$arrPayments.register_company}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.register_company}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.register_employer AND !$arrNumbers.register_employer}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_REGISTER_EMPLOYER}
		</td>
		<td>
			<input type="text" name="arrNumbers[register_employer]" {if !$arrPayments.register_employer}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.register_employer}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.register_competitor AND !$arrNumbers.register_competitor}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_REGISTER_COMPETITOR}
		</td>
		<td>
			<input type="text" name="arrNumbers[register_competitor]" {if !$arrPayments.register_competitor}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.register_competitor}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.add_vacancy AND !$arrNumbers.add_vacancy}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_ADD_ANNOUNCE} - {$smarty.const.FORM_VACANCYS_HEAD}
		</td>
		<td>
			<input type="text" name="arrNumbers[add_vacancy]" {if !$arrPayments.add_vacancy}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.add_vacancy}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.add_resume AND !$arrNumbers.add_resume}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_ADD_ANNOUNCE} - {$smarty.const.FORM_RESUMES_HEAD}
		</td>
		<td>
			<input type="text" name="arrNumbers[add_resume]" {if !$arrPayments.add_resume}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.add_resume}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.vip_vacancy AND !$arrNumbers.vip_vacancy}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SET_VIP} - {$smarty.const.FORM_VACANCYS_HEAD}
		</td>
		<td>
			<input type="text" name="arrNumbers[vip_vacancy]" {if !$arrPayments.vip_vacancy}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.vip_vacancy}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.hot_vacancy AND !$arrNumbers.hot_vacancy}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SET_HOT} - {$smarty.const.FORM_VACANCYS_HEAD}
		</td>
		<td>
			<input type="text" name="arrNumbers[hot_vacancy]" {if !$arrPayments.hot_vacancy}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.hot_vacancy}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.rate_vacancy AND !$arrNumbers.rate_vacancy}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SET_RATE} - {$smarty.const.FORM_VACANCYS_HEAD}
		</td>
		<td>
			<input type="text" name="arrNumbers[rate_vacancy]" {if !$arrPayments.rate_vacancy}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.rate_vacancy}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.subscr_vacancy AND !$arrNumbers.subscr_vacancy}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SUBSCRIPTIONS} - {$smarty.const.FORM_VACANCYS_HEAD}
		</td>
		<td>
			<input type="text" name="arrNumbers[subscr_vacancy]" {if !$arrPayments.subscr_vacancy}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.subscr_vacancy}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.vip_resume AND !$arrNumbers.vip_resume}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SET_VIP} - {$smarty.const.FORM_RESUMES_HEAD}
		</td>
		<td>
			<input type="text" name="arrNumbers[vip_resume]" {if !$arrPayments.vip_resume}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.vip_resume}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.hot_resume AND !$arrNumbers.hot_resume}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SET_HOT} - {$smarty.const.FORM_RESUMES_HEAD}
		</td>
		<td>
			<input type="text" name="arrNumbers[hot_resume]" {if !$arrPayments.hot_resume}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.hot_resume}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.rate_resume AND !$arrNumbers.rate_resume}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SET_RATE} - {$smarty.const.FORM_RESUMES_HEAD}
		</td>
		<td>
			<input type="text" name="arrNumbers[rate_resume]" {if !$arrPayments.rate_resume}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.rate_resume}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.subscr_resume AND !$arrNumbers.subscr_resume}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SUBSCRIPTIONS} - {$smarty.const.FORM_RESUMES_HEAD}
		</td>
		<td>
			<input type="text" name="arrNumbers[subscr_resume]" {if !$arrPayments.subscr_resume}value="" readonly style="background-color: #DDD;"{else}value="{$arrNumbers.subscr_resume}"{/if}>
		</td>
	</tr>
</table>

<p align="center"><input type="submit" name="numbers" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>