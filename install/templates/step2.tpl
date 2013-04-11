<h2 class="center">{$smarty.const.CREATE_TABLES_HEAD}</h2>

{* ТАБЛИЦЫ *}
<table class="centerTable tdPadding5 configTable">
	<tr class="thead">
		<td colspan="2">{$smarty.const.CREATE_TABLES_LIST}</td>
	</tr>
{foreach from=$arrTable item=table}
	<tr>
		<td>{$table.table}</td>
		<td>{if !$table.error}<span class="green">{$smarty.const.CREATE_TABLES_SUCCESS}</span>{else}<span class="red">{$smarty.const.CREATE_TABLES_ERROR}: {$table.error}</span>{/if}</td>
	</tr>
{/foreach}

	<tr>
		<td colspan="2">{$smarty.const.CREATE_TABLES_ATTENTION}</td>
	</tr>

{* ОБЯЗАТЕЛЬНЫЕ ДАННЫЕ *}
	<tr class="thead">
		<td colspan="2">{$smarty.const.CREATE_TABLES_MANDATORY_DATA}</td>
	</tr>
{foreach from=$arrData item=data}
	<tr>
		<td>{$data.table}</td>
		<td>{if !$data.error}<span class="green">{$smarty.const.CREATE_TABLES_SUCCESS}</span>{else}<span class="red">{$smarty.const.CREATE_TABLES_ERROR}: {$data.error}</span>{/if}</td>
	</tr>
{/foreach}

{* Доп. ДАННЫЕ *}
{if !$arrDemo && !$arrTables}
	<tr class="thead">
        <td colspan="3">
			{$smarty.const.CREATE_TABLES_ADD_DEMO_DATA}:&nbsp;
			{if $sqlLocales}
				{foreach from=$sqlLocales item="lc"}
					<a href="install.php?step=2&demo=add&lc={$lc}">{$lc}</a>&nbsp;
				{/foreach}
			{else}
				{$smarty.const.ERROR_NOT_FOUND_DATA_FILE}
			{/if}
		</td>
    </tr>
{else}
	{* Не удалось очистить таблицы *}	
	{if $arrTables}
			<tr class="thead">
				<td colspan="2" style="color: red;">{$smarty.const.CREATE_TABLES_NOT_TRUNCATE_TABLES}</td>
			</tr>
		{foreach from=$arrTables item=table}
			<tr>
				<td colspan="2" style="color: red;">{$table}</td>
			</tr>
		{/foreach}
	{else}
			<tr class="thead">
				<td colspan="2">{$smarty.const.CREATE_TABLES_DEMO_DATA}</td>
			</tr>
		{foreach from=$arrDemo item=demo}
			<tr>
				<td>{$demo.table}</td>
				<td>{if !$demo.error}<span class="green">{$smarty.const.CREATE_TABLES_SUCCESS}</span>{else}<span class="red">{$smarty.const.CREATE_TABLES_ERROR}: {$demo.error}</span>{/if}</td>
			</tr>
		{/foreach}
	{/if}
{/if}
</table>

<div class="form">
	<form action="install.php?step=2" method="post" enctype="multipart/form-data">
	<span class="floatLeft"><a href="install.php?step=1" class="prevButton"><< {$smarty.const.BUTTON_PREV}</a></span>
	<span class="floatRight"><input type="submit" name="step2" class="nextButton" value="{$smarty.const.BUTTON_NEXT} >>"></span>
	</form>
</div>