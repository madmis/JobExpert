{if $resumes}
<table class="mainBodyTable" cellspacing="0">
	<tr>
		<th colspan="6">{$smarty.const.SITE_COMPANY_RESUME}&nbsp;{$uData.company_name}</th>
	</tr>
	{foreach from=$resumes item="resume" name="resume"}
		<tr class="tr_hover showResume" title="{$uData.company_name|escape}, {$resume.title|escape}">
			<td class="VRIcon"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/mainBodyTableVRIcon.gif" alt=""></td>
			<td class="VRIcon"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclceDown.png" alt=""></td>
			<td class="VRDescr">
				<strong>{$sections[$resume.id_section].name}</strong><br>
				<a style="text-decoration: none" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=view&amp;id=`$resume.tId`")}" title="{$resume.title|escape}, {$sections[$resume.id_section].name|escape} - {$professions[$resume.id_profession].name|escape}{if $resume.id_profession_1} / {$professions[$resume.id_profession_1].name|escape}{/if}{if $resume.id_profession_2} / {$professions[$resume.id_profession_2].name|escape}{/if}, {$regions[$resume.id_region].name|escape}{if $resume.id_city} - {$citys[$resume.id_city].name|escape}{/if}, {$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$resume.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$resume.pay_from} {$resume.currency}">{$resume.title|truncate:80}</a>
			</td>
			<td class="VRRegion">{if $resume.id_city}{$citys[$resume.id_city].name|escape}{else}&nbsp;{/if}</td>
			<td class="VRDate">{$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</td>
			<td class="last VRSallary">{$resume.pay_from}&nbsp;{$resume.currency}</td>
		</tr>
		<tr style="display: none;">
			<td class="last" colspan="6">
				<table style="width: 100%;">
					{if $resume.vip || $resume.hot}
						<tr>
							<td colspan="2" class="noBorderRight AlignLeft" valign="top">
								<div class="paddingText5">
									{if $resume.vip}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/vip.png" style="padding: 0px 10px;" alt="VIP" title="VIP">{/if}
									{if $resume.hot}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/hot.png" style="padding: 0px 10px;" alt="HOT" title="HOT">{/if}
								</div>
							</td>
						</tr>
					{/if}
					<tr class="noBorderBottom">
						<td class="noBorderRight AlignLeft" valign="top">
							<div class="paddingText5">
								<strong class="Header">{$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$resume.act_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</strong>
								<table class="paddingText5">
									<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_REGION}:</strong></td><td>{$regions[$resume.id_region].name|escape}{if $resume.id_city}&nbsp;/&nbsp;{$citys[$resume.id_city].name|escape}{/if}</td></tr>
									<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_SECTION}:</strong></td><td>{$sections[$resume.id_section].name}</td></tr>
								</table>
								<strong class="Header">{$smarty.const.ANNOUNCE_CONTACTS_PERSON}:</strong>
								<table class="paddingTextWBottom5">
									<tr><td><strong>{$smarty.const.ANNOUNCE_CONTACTS_LASTNAME}:</strong></td><td>{$resume.last_name}</td></tr>
									<tr><td><strong>{$smarty.const.ANNOUNCE_CONTACTS_FIRSTNAME}:</strong></td><td>{$resume.first_name}</td></tr>
									<tr><td><strong>{$smarty.const.ANNOUNCE_CONTACTS_MIDDLENAME}:</strong></td><td>{$resume.middle_name}</td></tr>
								</table>
							</div>
						</td>
						<td class="noBorderLeft AlignRight" valign="top">
							<div class="paddingText5">
								<div class="InfoBlockWrapper">
									<div class="withoutHeader"></div>
									<div class="InfoBlock"><div>
										<table>
											<tr><td style="width:150px;"><strong>{$smarty.const.ANNOUNCE_PAY_HEAD}:</strong></td><td>{$smarty.const.SITE_FROM} {$resume.pay_from}&nbsp;{$resume.currency}</td></tr>
											<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}:</strong></td><td>{$resume.chart_work}</td></tr>
											<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION}:</strong></td><td>{$resume.education}</td></tr>
											<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}:</strong></td><td>{$resume.expire_work}</td></tr>
											<tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_GENDER}:</strong></td><td>{$arrSysDict.Gender.values[$resume.gender]}</td></tr>
											<tr><td><strong>{$smarty.const.ANNOUNCE_AGE}:</strong></td><td>{$resume.age}</td></tr>
										</table>
									</div></div>
								</div>
							</div>
						</td>
					</tr>
					{if $resume.about_info}
						<tr class="noBorderTop noBorderBottom">
							<td colspan="2"class="AlignLeft">
								<div class="paddingText5" style="margin-top:0px;">
									<strong class="Header">{$smarty.const.ANNOUNCE_TEXTAREA_ABOUTINFO}:</strong>
									<div class="paddingText5">
										{$resume.about_info}
									</div>
								</div>
							</td>
						</tr>
					{/if}
					<tr class="noBorderTop">
						<td class="noBorderRight" valign="bottom" style="text-align:left;">
							<div class="submitButtonLight paddingText5">
								<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=view&amp;id=`$resume.tId`")}" class="submitButton">{$smarty.const.FORM_LOOK_AT}...</a>
							</div>
						</td>
						<td class="noBorderLeft" style="text-align:right;">
							<div style="margin:10px 0px;">
								{if !$resume.vip}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=setVIP&amp;id=`$resume.id`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setVIP.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS}" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}"></a>{/if}
								{if !$resume.hot}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=setHOT&amp;id=`$resume.id`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setHOT.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS}" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}"></a>{/if}
								<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=setRate&amp;id=`$resume.id`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setRate.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}"></a>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	{/foreach}
</table>
<script type="text/javascript">
<!--
	$( function() {
		function showResume() {
			$(this).next().toggle();
		}
		$('.showResume').bind('click', showResume);
		$('.showResume').find('a').hover(function () {
			$('.showResume').unbind('click', showResume);
		}, function () {
			$('.showResume').bind('click', showResume);
		});
	});
-->
</script>
{/if}