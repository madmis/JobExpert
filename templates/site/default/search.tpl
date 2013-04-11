{* Вывод ошибок *}
{if $errors}
	{include file="errors.message.tpl"}
{/if}
<div style="text-align:right; font-size:11px;">
	{if $user_type eq 'agent'}
		<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=search.vacancy")}">{$smarty.const.MENU_ADVANCED_SEARCH_VACANCY}</a>&nbsp;&bull;&nbsp;<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=search.resume")}">{$smarty.const.MENU_ADVANCED_SEARCH_RESUME}</a>
	{elseif $user_type eq 'employer' OR $user_type eq 'company'}
		<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=search.resume")}">{$smarty.const.MENU_ADVANCED_SEARCH_RESUME}</a>
	{elseif $user_type eq 'competitor'}
		<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=search.vacancy")}">{$smarty.const.MENU_ADVANCED_SEARCH_VACANCY}</a>
	{/if}
</div>

<form method="get" action="{$smarty.const.CONF_SCRIPT_URL}index.php?ut={$user_type}&amp;do=search" enctype="application/x-www-form-urlencoded">
<input type="hidden" name="ut" value="{$user_type}">
<input type="hidden" name="do" value="search">

	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
			<tr>
				<th>
					{if $user_type eq 'agent'}
						{$namePage[0].name}
					{elseif $user_type eq 'employer' OR $user_type eq 'company'}
						{$smarty.const.MENU_SEARCH_RESUME}
					{elseif $user_type eq 'competitor'}
						{$smarty.const.MENU_SEARCH_VACANCY}
					{/if}
				</th>
			</tr>
			<tr>
				<td class="last AlignLeft">
					<div class="paddingText5">
						<table>
							<tr>
								<td>
									<input maxlength="250" name="q" size="55" title="{$smarty.const.MENU_SEARCH}" value="{$retFields.q|default:false}">
								</td>
								<td>
									<div class="submitButtonLight">
										<input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_SEARCH}">
									</div>
								</td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="javascript:void(0);" id="dop">{$smarty.const.FORM_SEARCH_MORE_OPTIONS}</a>
								</td>
							</tr>
						</table>

						{if $user_type eq 'agent'}
							<input type="radio" name="base" value="vacancy" {if !$retFields.base OR $retFields.base eq 'vacancy'}checked{/if}>&nbsp;{$smarty.const.FORM_SEARCH_IN_VACANCY}
							<input type="radio" name="base" value="resume" {if $retFields.base eq 'resume'}checked{/if}>&nbsp;{$smarty.const.FORM_SEARCH_IN_RESUME}
						{elseif $user_type eq 'employer' OR $user_type eq 'company'}
							<input type="hidden" name="base" value="resume">
						{elseif $user_type eq 'competitor'}
							<input type="hidden" name="base" value="vacancy">
						{/if}
					</div>
				</td>
			</tr>
			<tr id="dop_params" style="display: none;">
				<td class="last AlignLeft">
					<div class="paddingText5">
						<table width="100%">
							<tr>
								<td colspan="3" nowrap>
									<input type="radio" name="type" value="any" {if !$retFields.type OR $retFields.type eq 'any'}checked{/if}>&nbsp;{$smarty.const.FORM_SEARCH_ANY_WORDS}
									<input type="radio" name="type" value="exact" {if $retFields.type eq 'exact'}checked{/if}>&nbsp;{$smarty.const.FORM_SEARCH_EXACTMATCH}
									<br><br>
								</td>
							</tr>
							<tr>
								<td>
									{* Выбор раздела *}
									<select name="id_section" id="section" style="width:250px;">
										<option value="">{$smarty.const.FORM_SEARCH_ANY_SECTION}</option>
										{foreach from=$sections item="section"}
										<option value="{$section.id}" {if $retFields.id_section eq $section.id}selected{/if}>{$section.name}</option>
										{/foreach}
									</select>
								</td>
								<td colspan="2">
									{* Выбор профессии *}
									<select name="id_profession" id="profession" style="width:250px;">
										<option value="">{$smarty.const.FORM_SEARCH_ANY_PROFESSION}</option>
									</select>
								</td>
							</tr>
							<tr>
								<td style="padding: 10px 0px 10px 0px;">
									{* Выбор области *}
									<select name="id_region" id="region" style="width:250px;">
										<option value="">{$smarty.const.FORM_SEARCH_ANY_REGION}</option>
										{foreach from=$regions item="region"}
										<option value="{$region.id}" {if $retFields.id_region eq $region.id}selected{/if}>{$region.name}</option>
										{/foreach}
									</select>
								</td>
								<td colspan="2">
									{* Выбор города *}
									<select name="id_city" id="city" style="width:250px;">
										<option value="">{$smarty.const.FORM_SEARCH_ANY_CITY}</option>
									</select>
								</td>
							</tr>
							<tr>
								<td style="padding: 10px 0px 10px 0px;">
									{* Выбор зарплаты *}
									{$smarty.const.FORM_SEARCH_SALARY}&nbsp;{$smarty.const.SITE_FROM}&nbsp;<input style="text-align: right;" type="text" name="pay_from" size="5" maxlength="10" value="{$retFields.pay_from}">&nbsp;
									<select name="currency">
										{foreach from=$arrSysDict.Currency.values item="item" key="key"}
										<option value="{if $key}{$item}{/if}" {if $retFields.currency eq $item}selected{/if}>{$item}</option>
										{/foreach}
									</select>
								</td>
								<td >
									{* Выбор периода *}
									{$smarty.const.FORM_SEARCH_PERIOD}:&nbsp;
									<select name="period">
										{foreach from=$arrSysDict.SearchPeriod.values item="item" key="key" name="i"}
										<option value="{$key}" {if $retFields.period}{if $retFields.period eq $key}selected{/if}{else}{if $smarty.foreach.i.last}selected{/if}{/if}>{$item}</option>
										{/foreach}
									</select>
								</td>
								<td >
									{* Выбор периода *}
									{$smarty.const.FORM_RECORDS}
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
		</table>
	</div>

{* ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; *}
</form>

{* Скрытые поля, для заполнения селектов *}
<input type="hidden" id="selector" value="">
<input type="hidden" id="hcity" value="{$retFields.id_city}">


{if $retFields.base}
	<div style="margin:5px; font-size:11px; color:#666; text-align:left;">
		{$smarty.const.SITE_SEARCH_UPON_REQUEST}&nbsp;<strong>"{$retFields.q}"</strong>&nbsp;{$smarty.const.SITE_SEARCH_RECORDS_FOUND}&nbsp;<b>{$find}&nbsp;{if $retFields.base eq 'vacancy'}{$smarty.const.FORM_SEARCH_IN_VACANCY}{else}{$smarty.const.FORM_SEARCH_IN_RESUME}{/if}</b>
		<br>
		{$smarty.const.SITE_SEARCH_TIME}:&nbsp;<b>{$time}</b>
	</div>
	<hr>
	{include file=$template}
{/if}

<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/js/jquery/jq.search.selects.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function ()
{
	// форма расширенного поиска
	$('#dop').click(function () {
		$('#dop_params').toggle();
	});
});
-->
</script>