<h2 style="text-align: center;">{$smarty.const.FORM_PAYMENTS_TARIFF_HEAD}</h2>
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments&amp;action=config&amp;id=a1pay" method="post" enctype="multipart/form-data">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td {if $arrPayments.register_agent AND !$arrTariffs.register_agent}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_REGISTER_AGENT}
		</td>
		<td>
			<input type="text" name="arrTariffs[register_agent]" {if !$arrPayments.register_agent}value="0" readonly{else}value="{$arrTariffs.register_agent}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.register_company AND !$arrTariffs.register_company}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_REGISTER_COMPANY}
		</td>
		<td>
			<input type="text" name="arrTariffs[register_company]" {if !$arrPayments.register_company}value="0" readonly{else}value="{$arrTariffs.register_company}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.register_employer AND !$arrTariffs.register_employer}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_REGISTER_EMPLOYER}
		</td>
		<td>
			<input type="text" name="arrTariffs[register_employer]" {if !$arrPayments.register_employer}value="0" readonly{else}value="{$arrTariffs.register_employer}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.register_competitor AND !$arrTariffs.register_competitor}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_REGISTER_COMPETITOR}
		</td>
		<td>
			<input type="text" name="arrTariffs[register_competitor]" {if !$arrPayments.register_competitor}value="0" readonly{else}value="{$arrTariffs.register_competitor}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.add_vacancy AND !$arrTariffs.add_vacancy}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_ADD_ANNOUNCE} - {$smarty.const.FORM_VACANCYS_HEAD}
		</td>
		<td>
			<input type="text" name="arrTariffs[add_vacancy]" {if !$arrPayments.add_vacancy}value="0" readonly{else}value="{$arrTariffs.add_vacancy}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.add_resume AND !$arrTariffs.add_resume}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_ADD_ANNOUNCE} - {$smarty.const.FORM_RESUMES_HEAD}
		</td>
		<td>
			<input type="text" name="arrTariffs[add_resume]" {if !$arrPayments.add_resume}value="0" readonly{else}value="{$arrTariffs.add_resume}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.vip_vacancy AND !$arrTariffs.vip_vacancy}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SET_VIP} - {$smarty.const.FORM_VACANCYS_HEAD}
		</td>
		<td>
			<input type="text" name="arrTariffs[vip_vacancy]" {if !$arrPayments.vip_vacancy}value="0" readonly{else}value="{$arrTariffs.vip_vacancy}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.hot_vacancy AND !$arrTariffs.hot_vacancy}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SET_HOT} - {$smarty.const.FORM_VACANCYS_HEAD}
		</td>
		<td>
			<input type="text" name="arrTariffs[hot_vacancy]" {if !$arrPayments.hot_vacancy}value="0" readonly{else}value="{$arrTariffs.hot_vacancy}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.rate_vacancy AND !$arrTariffs.rate_vacancy}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SET_RATE} - {$smarty.const.FORM_VACANCYS_HEAD}
		</td>
		<td>
			<input type="text" name="arrTariffs[rate_vacancy]" {if !$arrPayments.rate_vacancy}value="0" readonly{else}value="{$arrTariffs.rate_vacancy}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.subscr_vacancy AND !$arrTariffs.subscr_vacancy}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SUBSCRIPTIONS} - {$smarty.const.FORM_VACANCYS_HEAD}
		</td>
		<td>
			<input type="text" name="arrTariffs[subscr_vacancy]" {if !$arrPayments.subscr_vacancy}value="0" readonly{else}value="{$arrTariffs.subscr_vacancy}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.vip_resume AND !$arrTariffs.vip_resume}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SET_VIP} - {$smarty.const.FORM_RESUMES_HEAD}
		</td>
		<td>
			<input type="text" name="arrTariffs[vip_resume]" {if !$arrPayments.vip_resume}value="0" readonly{else}value="{$arrTariffs.vip_resume}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.hot_resume AND !$arrTariffs.hot_resume}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SET_HOT} - {$smarty.const.FORM_RESUMES_HEAD}
		</td>
		<td>
			<input type="text" name="arrTariffs[hot_resume]" {if !$arrPayments.hot_resume}value="0" readonly{else}value="{$arrTariffs.hot_resume}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.rate_resume AND !$arrTariffs.rate_resume}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SET_RATE} - {$smarty.const.FORM_RESUMES_HEAD}
		</td>
		<td>
			<input type="text" name="arrTariffs[rate_resume]" {if !$arrPayments.rate_resume}value="0" readonly{else}value="{$arrTariffs.rate_resume}"{/if}>
		</td>
	</tr>
	<tr>
		<td {if $arrPayments.subscr_resume AND !$arrTariffs.subscr_resume}style="color: #FF0000;"{/if}>
			{$smarty.const.FORM_PAYMENTS_SUBSCRIPTIONS} - {$smarty.const.FORM_RESUMES_HEAD}
		</td>
		<td>
			<input type="text" name="arrTariffs[subscr_resume]" {if !$arrPayments.subscr_resume}value="0" readonly{else}value="{$arrTariffs.subscr_resume}"{/if}>
		</td>
	</tr>
</table>

<p align="center"><input type="submit" name="tariff" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>