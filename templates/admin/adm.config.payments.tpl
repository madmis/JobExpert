<p class="sub_menu">
	<span class="colorbox_help" id="HELP_ADMIN_PAYMENTS" alt="Help">
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
	</span>
</p>

{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=config&amp;s=payments" method="post">
<table style="width: 100%; " class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_PAYMENTS_REGISTER}</td>
		<td>
			<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[register_agent]" {if $arrPayments.register_agent}checked{/if}>{$smarty.const.FORM_TYPE_AGENT}
					</td>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[register_company]" {if $arrPayments.register_company}checked{/if}>{$smarty.const.FORM_TYPE_COMPANY}
					</td>
				</tr>
				<tr>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[register_employer]" {if $arrPayments.register_employer}checked{/if}>{$smarty.const.FORM_TYPE_EMPLOYER}
					</td>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[register_competitor]" {if $arrPayments.register_competitor}checked{/if}>{$smarty.const.FORM_TYPE_COMPETITOR}
					</td>
				</tr>
			</table>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_TEMPLATE_DEBUGGING">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_PAYMENTS_ADD_ANNOUNCE}</td>
		<td>
			<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[add_vacancy]" {if $arrPayments.add_vacancy}checked{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
					</td>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[add_resume]" {if $arrPayments.add_resume}checked{/if}> {$smarty.const.FORM_RESUMES_HEAD}
					</td>
				</tr>
			</table>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_TEMPLATE_DEBUGGING">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_PAYMENTS_SET_VIP}</td>
		<td>
			<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[vip_vacancy]" {if $arrPayments.vip_vacancy}checked{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
					</td>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[vip_resume]" {if $arrPayments.vip_resume}checked{/if}> {$smarty.const.FORM_RESUMES_HEAD}
					</td>
				</tr>
			</table>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_TEMPLATE_DEBUGGING">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_PAYMENTS_SET_HOT}</td>
		<td>
			<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[hot_vacancy]" {if $arrPayments.hot_vacancy}checked{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
					</td>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[hot_resume]" {if $arrPayments.hot_resume}checked{/if}> {$smarty.const.FORM_RESUMES_HEAD}
					</td>
				</tr>
			</table>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_TEMPLATE_DEBUGGING">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_PAYMENTS_SET_RATE}</td>
		<td>
			<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[rate_vacancy]" {if $arrPayments.rate_vacancy}checked{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
					</td>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[rate_resume]" {if $arrPayments.rate_resume}checked{/if}> {$smarty.const.FORM_RESUMES_HEAD}
					</td>
				</tr>
			</table>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_TEMPLATE_DEBUGGING">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_PAYMENTS_SUBSCRIPTIONS}</td>
		<td>
			<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[subscr_vacancy]" {if $arrPayments.subscr_vacancy}checked{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
					</td>
					<td style="border: none;">
						<input type="checkbox" name="paymentOn[subscr_resume]" {if $arrPayments.subscr_resume}checked{/if}> {$smarty.const.FORM_RESUMES_HEAD}
					</td>
				</tr>
			</table>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_TEMPLATE_DEBUGGING">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>