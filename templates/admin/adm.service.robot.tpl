{*Форма настроек работы робота*}
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&amp;s=robot&amp;action=config" method="post" enctype="multipart/form-data">
	<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
		<tbody>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_ROBOT_RUNNING}</td>
				<td style="text-align: center;"><input type="checkbox" name="arrConf[robot_running]"{if $arrRobotConf.configs.robot_running} checked="checked"{/if}></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_CONF_ADMINISTRATION_ROBOT_RUNNING">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_ROBOT_RUNNING_FIRSTTIME}</td>
				<td style="text-align: center;">
					{assign var="robot_running_firsttime" value="{if $arrRobotConf.configs.robot_running_firsttime}{$arrRobotConf.configs.robot_running_firsttime}{else}{$smarty.now}{/if}"}
					{html_select_time display_seconds=false minute_interval=5 time=$robot_running_firsttime prefix='' field_array="arrConf[robot_running_firsttime]"}
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_CONF_ADMINISTRATION_ROBOT_RUNNING_FIRST_TIME">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_ROBOT_RUNNING_TERM}</td>
				<td style="text-align: center;">
					<input type="text" name="arrConf[robot_term]" value="{$arrRobotConf.configs.robot_term}" size="5" maxlength="5" style="text-align: right;">
					<select name="arrConf[robot_term_coef]">
						<option value="60"{if $arrRobotConf.configs.robot_term_coef eq 60} selected="selected"{/if}>{$smarty.const.SITE_MINUTES}</option>
						<option value="3600"{if $arrRobotConf.configs.robot_term_coef eq 3600} selected="selected"{/if}>{$smarty.const.SITE_HOURS}</option>
						<option value="86400"{if $arrRobotConf.configs.robot_term_coef eq 86400} selected="selected"{/if}>{$smarty.const.SITE_DAYS}</option>
					</select>
				</td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_CONF_ADMINISTRATION_ROBOT_RUNNING_TERM">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3" style="border: none; text-align: center;">
					<input type="submit" name="conf_save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button">
				</td>
			</tr>
		</tfoot>
	</table>
</form>

{*Форма настроек действий робота*}
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&amp;s=robot&amp;action=config" method="post" enctype="multipart/form-data">
	<table style="width: 100%;" cellspacing="5" cellpadding="5">
		<thead class="data_head">
			<tr>
				<td colspan="3">{$smarty.const.FORM_CONF_ADMINISTRATION_ROBOT_CONTROL}</td>
			</tr>
		</thead>
		<tbody class="data_body">
			<tr>
				<td>{$smarty.const.FORM_CONF_ADMINISTRATION_UPDATE_COUNTERS}</td>
				<td>
					<table style="width: 100%; border: 0px;" cellspacing="0" cellpadding="0">
						<tr style="text-align: center;">
							<td style="border: none;">
								<input type="checkbox" name="arrCtrl[updateCounters]"{if $arrRobotConf.actions.updateCounters} checked="checked"{/if}>
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
								<input type="checkbox" name="arrCtrl[delNonverifyUsers]"{if $arrRobotConf.actions.delNonverifyUsers} checked="checked"{/if}>
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
								<input type="checkbox" name="arrCtrl[delNontypeUsers]"{if $arrRobotConf.actions.delNontypeUsers} checked="checked"{/if}>
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
								<input type="checkbox" name="arrCtrl[delUnpaidUsers]"{if $arrRobotConf.actions.delUnpaidUsers} checked="checked"{/if}>
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
								<input type="checkbox" name="arrCtrl[delUnpaidSubscr]"{if $arrRobotConf.actions.delUnpaidSubscr} checked="checked"{/if}>
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
								<input type="radio" name="arrCtrl[vacActionSlo]" value="deleted"{if $arrRobotConf.actions.vacActionSlo eq 'deleted'} checked="checked"{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
							</td>
							<td style="border: none;">
								<input type="radio" name="arrCtrl[resActionSlo]" value="deleted"{if $arrRobotConf.actions.resActionSlo eq 'deleted'} checked="checked"{/if}> {$smarty.const.FORM_RESUMES_HEAD}
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
								<input type="radio" name="arrCtrl[vacActionSlo]" value="archived"{if $arrRobotConf.actions.vacActionSlo eq 'archived'} checked="checked"{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
							</td>
							<td style="border: none;">
								<input type="radio" name="arrCtrl[resActionSlo]" value="archived"{if $arrRobotConf.actions.resActionSlo eq 'archived'} checked="checked"{/if}> {$smarty.const.FORM_RESUMES_HEAD}
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
								<input type="checkbox" name="arrCtrl[vacDelNonverify]"{if $arrRobotConf.actions.vacDelNonverify} checked="checked"{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
							</td>
							<td style="border: none;">
								<input type="checkbox" name="arrCtrl[resDelNonverify]"{if $arrRobotConf.actions.resDelNonverify} checked="checked"{/if}> {$smarty.const.FORM_RESUMES_HEAD}
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
								<input type="checkbox" name="arrCtrl[vacDelUnpaid]"{if $arrRobotConf.actions.vacDelUnpaid} checked="checked"{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
							</td>
							<td style="border: none;">
								<input type="checkbox" name="arrCtrl[resDelUnpaid]"{if $arrRobotConf.actions.resDelUnpaid} checked="checked"{/if}> {$smarty.const.FORM_RESUMES_HEAD}
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
								<input type="checkbox" name="arrCtrl[vacVipResetSlo]"{if $arrRobotConf.actions.vacVipResetSlo} checked="checked"{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
							</td>
							<td style="border: none;">
								<input type="checkbox" name="arrCtrl[resVipResetSlo]"{if $arrRobotConf.actions.resVipResetSlo} checked="checked"{/if}> {$smarty.const.FORM_RESUMES_HEAD}
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
								<input type="checkbox" name="arrCtrl[vacHotResetSlo]"{if $arrRobotConf.actions.vacHotResetSlo} checked="checked"{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
							</td>
							<td style="border: none;">
								<input type="checkbox" name="arrCtrl[resHotResetSlo]"{if $arrRobotConf.actions.resHotResetSlo} checked="checked"{/if}> {$smarty.const.FORM_RESUMES_HEAD}
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
					<input type="submit" name="ctrl_save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button">
					<input type="button" value="{$smarty.const.FORM_RESET}" class="reset button" style="margin-left: 25px;">
				</td>
			</tr>
		</tfoot>
	</table>
</form>
<script type="text/javascript">
<!--
	$(document).ready(function() {
		$('.reset').click(function() {
			$(this).parents('form').find(':checkbox, :radio').removeAttr('checked');
		});
	});
-->
</script>
