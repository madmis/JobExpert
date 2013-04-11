<div class="sub_menu">
	<div style="float: left;">
		<form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&amp;s=language.manager&amp;action=localizConst&amp;own=admin" method="post" enctype="multipart/form-data">
			&nbsp;{$smarty.const.FORM_SELECT_LANGUAGE}:&nbsp;
			<select name="currLocaliz" class="langSelect">
				{foreach from=$langs item="lang"}
					<option value="{$lang}"{if $lang eq $currLang} selected{/if}>{$lang}</option>
				{/foreach}
			</select>
		</form>
	</div>
</div>
{foreach from=$defLocalizConst key="fileNameLocaliz" item="arrContentLocaliz"}
	{foreach from=$arrContentLocaliz key="nameConstant" item="valueConstant" name="ncLocaliz"}
		{if !$currLocalizConst.$fileNameLocaliz.$nameConstant || $currLocalizConst.$fileNameLocaliz.$nameConstant eq $nameConstant}
			{assign var="hasDiff" value=true}
			{if $currFileNameLocaliz && $currFileNameLocaliz neq $fileNameLocaliz}
				</table>
			{/if}
			{if !$currFileNameLocaliz || $currFileNameLocaliz neq $fileNameLocaliz}
				{assign var="currFileNameLocaliz" value=$fileNameLocaliz}
				<table style="width: 100%; border: 0px;" cellspacing="10" cellpadding="5">
					<thead class="data_head">
						<tr>
							<td>{$fileNameLocaliz}</td>
						</tr>
					</thead>
			{/if}
					<tbody class="data_body">
						<tr>
							<td>
								<div style="margin: 5px; font-weight: bold;">{$nameConstant}</div>
							</td>
						</tr>
					</tbody>
		{/if}
	{/foreach}
{/foreach}
{if !$hasDiff}
	<div style="width: 100%; text-align: center;">{$smarty.const.TABLE_NOT_DATA}</div>
{else}
	</table>
{/if}
<script type="text/javascript">
<!--
$(document).ready(function() {
	$('.langSelect').change(function() {
		$(this).parent('form').submit();
	});
});
-->
</script>