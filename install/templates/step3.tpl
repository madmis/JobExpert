<form action="install.php?step=3" method="post" enctype="multipart/form-data">
<h2 class="center">{$smarty.const.TMPL_CONF_HEAD}</h2>
<table class="centerTable configTable">
	<tr>
		{if $msEr}
			<td style="font-size: 14px; color: #FF0000; font-weight: bold;" >{$tmplMess}</td>
		{else}
			<td style="font-size: 14px; color: #0000CC; font-weight: bold;" >{$tmplMess}</td>
		{/if}
	</tr>
</table>
<div class="form">
	<span class="floatLeft"><a href="install.php?step=2" class="prevButton"><< {$smarty.const.BUTTON_PREV}</a></span>
	<span class="floatRight"><input type="submit" name="step3" class="nextButton" value="{$smarty.const.BUTTON_NEXT} >>"></span>
</div>
</form>