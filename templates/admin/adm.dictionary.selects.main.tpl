<table class="dict_head" cellpadding="1" cellspacing="1">
	<tr>
		<td style="width: 70%;">{$smarty.const.MENU_DICTIONARY_SELECTS_SYSTEM}</td>
		<td style="text-align: right;">
			<form action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=selects" method="post" enctype="multipart/form-data">
				&nbsp;{$smarty.const.FORM_SELECT_LANGUAGE}:&nbsp;
				<select name="langDict" class="lang_select">
					{foreach from=$langs item="lang"}
						<option value="{$lang}"{if $lang eq $currLang} selected{/if}>{$lang}</option>
					{/foreach}
				</select>
			</form>
		</td>
	</tr>
</table>
<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
	<thead class="data_head">
		<tr>
			<td>{$smarty.const.TABLE_COLUMN_ALIAS_LIST}</td>
			<td style="width: 65%;">{$smarty.const.TABLE_COLUMN_NAME}</td>
			<td>{$smarty.const.TABLE_COLUMN_OPTIONS}</td>
		</tr>
	</thead>
	<tbody class="data_body">
		{foreach from=$return_data.sysDict item="systemDictionary" key="alias" name="systemDictionary"}
			<tr>
				<td class="dict_alias">$arrSysDict['{$alias}']['values']</td>
				<td style="width: 65%;" class="dictionary">
					{$systemDictionary.discription}
					<table class="dict_tlist" cellspacing="2" cellpadding="2">
						<thead class="data_head">
							<tr>
								{if $systemDictionary.type eq "assoc"}
									<td style="width: 10%;">{$smarty.const.TABLE_COLUMN_INDEX_LIST}</td>
								{/if}
								<td>{$smarty.const.TABLE_COLUMN_CONTENTS_LIST}</td>
							</tr>
						</thead>
						<tbody class="data_body">
							{foreach from=$systemDictionary.values item="dictValues" key="index" name="dictValues"}
								<tr style="background-color: #FFFFFF;">
									{if $systemDictionary.type eq "assoc"}
										<td style="width: 10%; text-align: center;">{$index}</td>
									{/if}
									<td style="padding-left: 10px;">{$dictValues}</td>
								</tr>
							{/foreach}
						</tbody>
					</table>
				</td>
				<td style="text-align: center; width: 7%;">
					<a href="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=selects&amp;action=edit&amp;type=SysDict&amp;alias={$alias}">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/edit.png" style="vertical-align: middle;" title="{$smarty.const.MENU_ACTION_EDIT}" alt="{$smarty.const.MENU_ACTION_EDIT}">
					</a>
				</td>
			</tr>
		{/foreach}
	</tbody>
</table>
<table class="dict_head" cellpadding="0" cellspacing="0" style="margin-top: 30px;">
	<tr>
		<td>{$smarty.const.MENU_DICTIONARY_SELECTS_ADDITION}</td>
		<td style="text-align: right;">
			<a href="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=selects&amp;action=add">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/add.png" style="vertical-align: middle;" title="{$smarty.const.MENU_ACTION_ADD}" alt="{$smarty.const.MENU_ACTION_ADD}">
			</a>
		</td>
	</tr>
</table>
<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
	<thead class="data_head">
		<tr>
			<td>{$smarty.const.TABLE_COLUMN_ALIAS_LIST}</td>
			<td style="width: 65%;">{$smarty.const.TABLE_COLUMN_NAME}</td>
			<td>{$smarty.const.TABLE_COLUMN_OPTIONS}</td>
		</tr>
	</thead>
	<tbody class="data_body">
		{if $return_data.addDict}
			{foreach from=$return_data.addDict item="additionalDictionary" key="alias" name="additionalDictionary"}
				<tr>
					<td class="dict_alias">$arrAddDict['{$alias}']['values']</td>
					<td style="width: 65%;" class="dictionary">
						{$additionalDictionary.discription}
						<table class="dict_tlist" cellspacing="2" cellpadding="2">
							<thead class="data_head">
								<tr>
									{if $additionalDictionary.type eq "assoc"}
										<td style="width: 10%;">{$smarty.const.TABLE_COLUMN_INDEX_LIST}</td>
									{/if}
									<td>{$smarty.const.TABLE_COLUMN_CONTENTS_LIST}</td>
								</tr>
							</thead>
							<tbody class="data_body">
								{foreach from=$additionalDictionary.values item="dictValues" key="index" name="dictValues"}
									<tr style="background-color: #FFFFFF;">
										{if $additionalDictionary.type eq "assoc"}
											<td style="width: 10%; text-align: center;">{$index}</td>
										{/if}
										<td style="padding-left: 10px;">{$dictValues}</td>
									</tr>
								{/foreach}
							</tbody>
						</table>
					</td>
					<td style="text-align: center; white-space: nowrap; width: 7%;">
						<a href="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=selects&amp;action=edit&amp;type=AddDict&amp;alias={$alias}">
							<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/edit.png" style="vertical-align: middle;" title="{$smarty.const.MENU_ACTION_EDIT}" alt="{$smarty.const.MENU_ACTION_EDIT}">
						</a>
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/delete.png" style="vertical-align: middle; cursor: pointer;" title="{$smarty.const.MENU_ACTION_DELETE}" alt="{$smarty.const.MENU_ACTION_DELETE}" class="delAddDict">
						<form action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=selects&amp;action=del" method="post" enctype="multipart/form-data">
							<input type="hidden" name="alias" value="{$alias}">
						</form>
					</td>
				</tr>
			{/foreach}
		{else}
			<tr>
				<td align="center" colspan="3">
					{$smarty.const.TABLE_NOT_DATA}
				</td>
			</tr>
		{/if}
	</tbody>
</table>

<script type="text/javascript">
<!--
	$(document).ready( function()
	{
		$('.lang_select').change( function()
		{
			$(this).parent('form').submit();
		});

		$('.dictionary').hover(
			function ()	{
        		$(this).css('background-color', '#FFFFCC');
      		}, 

      		function () {
	        	$(this).css('background-color', '#F6F6F6');
      		}
      	).click( function() {
      		$(this).children('table').toggle();
		});

		$('.delAddDict').click( function () {
			if (!confirm('{$smarty.const.MESSAGE_DELETE_DICT_SELECTS_ALIAS}'))
			{
				return false;
			}
			else
			{
				$(this).next('form').submit();

				return true;
			}
		});
	});
-->
</script>