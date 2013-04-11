{*Форма отключения сайта на обслуживание*}
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&amp;s=administration&amp;action=maintenance" method="post" enctype="multipart/form-data">
	<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
		<tbody>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_MAINTENANCE}</td>
				<td style="text-align: center;"><input type="checkbox" name="maintenance"{if $smarty.const.CONF_SERVICE_ADMINISTRATION_MAINTENANCE} checked="checked"{/if}></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_CONF_ADMINISTRATION_MAINTENANCE">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3" style="border: none; text-align: center;">
					<input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button">
				</td>
			</tr>
		</tfoot>
	</table>
</form>

{*Форма ручного управления данными БД сайта*}
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&amp;s=administration&amp;action=maintenance" method="post" enctype="multipart/form-data">
	<table style="width: 100%;" cellspacing="5" cellpadding="5">
		<thead class="data_head">
			<tr>
				<td colspan="3">{$smarty.const.FORM_CONF_ADMINISTRATION_MANUAL_CONTROL}</td>
			</tr>
		</thead>
		<tbody class="data_body">
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_UPDATE_COUNTERS}</td>
				<td>
					<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
						<tr style="text-align: center;">
							<td style="border: none;">
								<input type="checkbox" name="updateCounters">
							</td>
						</tr>
					</table>
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_UPDATE_COUNTERS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_DELETE_NONVERIFY_USERS}</td>
				<td>
					<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
						<tr style="text-align: center;">
							<td style="border: none;">
								<input type="checkbox" name="delNonverifyUsers">
							</td>
						</tr>
					</table>
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_DELETE_NONVERIFY_USERS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_DELETE_NONTYPE_USERS}</td>
				<td>
					<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
						<tr style="text-align: center;">
							<td style="border: none;">
								<input type="checkbox" name="delNontypeUsers">
							</td>
						</tr>
					</table>
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_DELETE_NONTYPE_USERS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_DELETE_UNPAID_USERS}</td>
				<td>
					<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
						<tr style="text-align: center;">
							<td style="border: none;">
								<input type="checkbox" name="delUnpaidUsers">
							</td>
						</tr>
					</table>
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_DELETE_UNPAID_USERS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_DELETE_UNPAID_SUBSCRIPTIONS}</td>
				<td>
					<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
						<tr style="text-align: center;">
							<td style="border: none;">
								<input type="checkbox" name="delUnpaidSubscr">
							</td>
						</tr>
					</table>
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_DELETE_UNPAID_SUBSCRIPTIONS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_DELETE_ANNOUNCES_STORAGE_LIFE_OVER}</td>
				<td>
					<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
						<tr style="text-align: center;">
							<td style="border: none;">
								<input type="radio" name="vacActionSlo" value="deleted"> {$smarty.const.FORM_VACANCYS_HEAD}
							</td>
							<td style="border: none;">
								<input type="radio" name="resActionSlo" value="deleted"> {$smarty.const.FORM_RESUMES_HEAD}
							</td>
						</tr>
					</table>
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_DELETE_ANNOUNCES_STORAGE_LIFE_OVER">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_ARCHIVED_ANNOUNCES_STORAGE_LIFE_OVER}</td>
				<td>
					<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
						<tr style="text-align: center;">
							<td style="border: none;">
								<input type="radio" name="vacActionSlo" value="archived"> {$smarty.const.FORM_VACANCYS_HEAD}
							</td>
							<td style="border: none;">
								<input type="radio" name="resActionSlo" value="archived"> {$smarty.const.FORM_RESUMES_HEAD}
							</td>
						</tr>
					</table>
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_ARCHIVED_ANNOUNCES_STORAGE_LIFE_OVER">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_DELETE_NONVERIFY_ANNOUNCES}</td>
				<td>
					<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
						<tr style="text-align: center;">
							<td style="border: none;">
								<input type="checkbox" name="vacDelNonverify"> {$smarty.const.FORM_VACANCYS_HEAD}
							</td>
							<td style="border: none;">
								<input type="checkbox" name="resDelNonverify"> {$smarty.const.FORM_RESUMES_HEAD}
							</td>
						</tr>
					</table>
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_DELETE_NONVERIFY_ANNOUNCES">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_DELETE_UNPAID_ANNOUNCES}</td>
				<td>
					<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
						<tr style="text-align: center;">
							<td style="border: none;">
								<input type="checkbox" name="vacDelUnpaid"> {$smarty.const.FORM_VACANCYS_HEAD}
							</td>
							<td style="border: none;">
								<input type="checkbox" name="resDelUnpaid"> {$smarty.const.FORM_RESUMES_HEAD}
							</td>
						</tr>
					</table>
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_DELETE_UNPAID_ANNOUNCES">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_RESET_VIP_STORAGE_LIFE_OVER}</td>
				<td>
					<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
						<tr style="text-align: center;">
							<td style="border: none;">
								<input type="checkbox" name="vacVipResetSlo"> {$smarty.const.FORM_VACANCYS_HEAD}
							</td>
							<td style="border: none;">
								<input type="checkbox" name="resVipResetSlo"> {$smarty.const.FORM_RESUMES_HEAD}
							</td>
						</tr>
					</table>
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_RESET_VIP_STORAGE_LIFE_OVER">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_RESET_HOT_STORAGE_LIFE_OVER}</td>
				<td>
					<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
						<tr style="text-align: center;">
							<td style="border: none;">
								<input type="checkbox" name="vacHotResetSlo"> {$smarty.const.FORM_VACANCYS_HEAD}
							</td>
							<td style="border: none;">
								<input type="checkbox" name="resHotResetSlo"> {$smarty.const.FORM_RESUMES_HEAD}
							</td>
						</tr>
					</table>
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_RESET_HOT_STORAGE_LIFE_OVER">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3" style="border: none; text-align: center;">
					<input type="submit" name="mcontrol" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
					<input type="reset" value="{$smarty.const.FORM_RESET}" class="button" style="margin-left: 25px;">
				</td>
			</tr>
		</tfoot>
	</table>
</form>