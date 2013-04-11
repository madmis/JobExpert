{if $logData}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=logs&amp;s=sql" method="post" enctype="multipart/form-data">
	<p style="margin: 0px 15px;"><input type="submit" name="clear" value="{$smarty.const.FORM_ACTION_CLEAR_LOGS}" class="button"></p>
	</form>
	{foreach from="$logData" item="data"}
	<div style="margin: 40px 15px; background-color: #EEE;">
		{$data|nl2br}
	</div>
	{/foreach}
	
<script type="text/javascript">
<!--
$(document).ready( function()
{
	// проверяем выбранное действие
	$("form:last").submit( function() {
			return confirm('{$smarty.const.MESSAGE_CLEAR_LOGS}');
	});
});
-->
</script>	
{else}
	{$smarty.const.TABLE_NOT_DATA}
{/if}