{* Вывод ошибок *}
{if $errors}{include file="errors.message.tpl"}{/if}

<form method="get" action="{$smarty.const.CONF_SCRIPT_URL}index.php?ut={$user_type}&amp;do=search.vacancy" enctype="application/x-www-form-urlencoded">
<input type="hidden" name="ut" value="{$user_type}">
<input type="hidden" name="do" value="search.vacancy">
	<div class="DesignMainPageBody" style="{if $return_data} display: none;{/if}" id="sForm">
		<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
			<tr>
				<th>{$namePage[0].name}</th>
			</tr>
			<tr>
				<td class="last AlignLeft">
					<div class="paddingText5">
						<table width="100%" class="extSearchFieldTable">
							<tr>
								<td>
									{* Выбор раздела *}
									<strong>{$smarty.const.ANNOUNCE_SELECT_SECTION}:</strong>
									<select name="id_section" id="section">
										<option value="">{$smarty.const.FORM_SEARCH_ANY_SECTION}</option>
										{foreach from=$sections item="section"}
										<option value="{$section.id}" {if $retFields.id_section eq $section.id}selected{/if}>{$section.name}</option>
										{/foreach}
									</select>
								</td>
								<td>
									{* Выбор профессии *}
									<strong>{$smarty.const.ANNOUNCE_SELECT_PROFESSION}:</strong>
									<select name="id_profession" id="profession">
										<option value="">{$smarty.const.FORM_SEARCH_ANY_PROFESSION}</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									{* Выбор области *}<br />
									<strong>{$smarty.const.ANNOUNCE_SELECT_REGION}:</strong>
									<select name="id_region" id="region">
										<option value="">{$smarty.const.FORM_SEARCH_ANY_REGION}</option>
										{foreach from=$regions item="region"}
										<option value="{$region.id}" {if $retFields.id_region eq $region.id}selected{/if}>{$region.name}</option>
										{/foreach}
									</select>
								</td>
								<td>
									{* Выбор города *}<br />
									<strong>{$smarty.const.ANNOUNCE_SELECT_CITY}:</strong>
									<select name="id_city" id="city">
										<option value="">{$smarty.const.FORM_SEARCH_ANY_CITY}</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									{* Выбор зарплаты *}<br />
									<strong>{$smarty.const.FORM_SEARCH_SALARY}:</strong>
									{$smarty.const.SITE_FROM}&nbsp;<input style="text-align: right;" type="text" name="pay_from" size="5" maxlength="10" value="{$retFields.pay_from}">&nbsp;
									<select name="currency" style="width:100px;">
										{foreach from=$arrSysDict.Currency.values item="item" key="key"}
										<option value="{if $key}{$item}{/if}" {if $retFields.currency eq $item}selected{/if}>{$item}</option>
										{/foreach}
									</select>
								</td>
								<td>
									{* Выбор графика работы *}<br />
									<strong>{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}:</strong>
									<select name="chart_work">
										{foreach from=$arrAddDict.ChartWork.values item="item" key="key"}
										<option value="{if $key}{$item}{/if}" {if $retFields.chart_work eq $item}selected{/if}>{$item}</option>
										{/foreach}
									</select>
								</td>
							</tr>
							<tr>
								<td>
									{* Выбор опыта работы *}<br />
									<strong>{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}:</strong>
									<select name="expire_work">
										{foreach from=$arrAddDict.ExpireWorkSearch.values item="item" key="key"}
										<option value="{if $key}{$item}{/if}" {if $retFields.expire_work eq $item}selected{/if}>{$item}</option>
										{/foreach}
									</select>
								</td>
								<td>
									{* Выбор образования *}<br />
									<strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION}:</strong>
									<select name="edu_work">
										{foreach from=$arrAddDict.Education.values item="item" key="key"}
										<option value="{if $key}{$item}{/if}" {if $retFields.edu_work eq $item}selected{/if}>{$item}</option>
										{/foreach}
									</select>
								</td>
							</tr>
							<tr>
								<td>
									{* Выбор возраста *}<br />
									<strong>{$smarty.const.ANNOUNCE_AGE}:</strong>
									{$smarty.const.SITE_FROM}&nbsp;<input style="text-align: right;" type="text" name="age_from" size="2" maxlength="2" value="{$retFields.age_from}">&nbsp;
									{$smarty.const.SITE_UNTO}&nbsp;<input style="text-align: right;" type="text" name="age_post" size="2" maxlength="2" value="{$retFields.age_post}">
								</td>
								<td>
									{* Выбор пола *}<br />
									<strong>{$smarty.const.ANNOUNCE_SELECT_GENDER}:</strong>
									<select name="gender">
										{foreach from=$arrSysDict.Gender.values item="item" key="key"}
										<option value="{if $key neq 'none'}{$key}{/if}" {if $retFields.gender eq $key}selected{/if}>{$item}</option>
										{/foreach}
									</select>
								</td>
							</tr>
							<tr>
								<td>
									{* Выбор типа пользователя *}<br />
									<strong>{$smarty.const.FORM_SEARCH_USER_TYPE}:</strong>
									<select name="user_type">
										<option value="">{$smarty.const.FORM_SEARCH_ANY}</option>
										<option value="employer" {if 'employer' eq $retFields.user_type}selected{/if}>{$smarty.const.ANNOUNCE_RADIOBOX_USER_TYPE_EMPLOYER}</option>
										<option value="agent" {if 'agent' eq $retFields.user_type}selected{/if}>{$smarty.const.ANNOUNCE_RADIOBOX_USER_TYPE_AGENT}</option>
										<option value="company" {if 'company' eq $arrBindFields.user_type}selected{/if}>{$smarty.const.FORM_TYPE_COMPANY}</option>
									</select>
								</td>
								<td>
									{* Выбор периода *}<br />
									<strong>{$smarty.const.FORM_SEARCH_PERIOD}:</strong>
									<select name="period">
										{foreach from=$arrSysDict.SearchPeriod.values item="item" key="key"}
										<option value="{$key}" {if $retFields.period eq $key}selected{/if}>{$item}</option>
										{/foreach}
									</select>
								</td>
							</tr>
							<tr>
								<td>
									{* Выбор периода *}<br />
									<strong>{$smarty.const.FORM_RECORDS}:</strong>
									<select name="records">
										{foreach from=$arrSysDict.AnnounceRecords.values item="item" name="records"}
										<option value="{$item}" {if $retFields.records eq $item}selected{/if}>{$item}</option>
										{/foreach}
									</select>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr>
				<td class="last">
					<div class="paddingText5">
						<div class="submitButtonLight">
							<input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_SEARCH}" />
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
</form>

{* Скрытые поля, для заполнения селектов *}
<input type="hidden" id="selector" value="">
<input type="hidden" id="hcity" value="{$retFields.id_city}">
<input type="hidden" id="hprofession" value="{$retFields.id_profession}">


{if $return_data}
	<a id="show" href="javascript:void(0);">{$smarty.const.SITE_SEARCH_CHANGE_PARAMS}</a>
	{include file="vacancy.view.short.tpl"}
{/if}

<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/js/jquery/jq.search.selects.js"></script>
<script type="text/javascript">
<!--
$(function() {
	$('#show').click( function() {
		$('#sForm').toggle();
	});
});
-->
</script>