<table class="mainBodyTable" cellspacing="0">
	<tr>
		<th colspan="{$smarty.const.CONF_AGENCIES_SHOW_MAIN_LOGO_QTY}">{$smarty.const.SITE_RECRUITMENT_AGENCIES}</th>
	</tr>
	{foreach from=$mainAgnLogo item="mLogo" name="i"}
	{if $smarty.foreach.i.first OR (($smarty.foreach.i.iteration-1) is div by $smarty.const.CONF_AGENCIES_SHOW_MAIN_LOGO_QTY)}<tr>{/if}
		<td style="width: {$smarty.const.CONF_FILEMANAGER_THUMBNAIL_WIDTH + 20}px; height: {$smarty.const.CONF_FILEMANAGER_THUMBNAIL_HEIGHT + 20}px;" {if $smarty.foreach.i.last OR ($smarty.foreach.i.iteration is div by $smarty.const.CONF_AGENCIES_SHOW_MAIN_LOGO_QTY)}class="last"{/if}>
			<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=agencies&amp;action=detail&amp;id=`$mLogo.tId`")}" title="{$mLogo.company_name|escape}{if $mLogo.company_city} ({$mLogo.company_city}){/if}">
				<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/thumbs/thumb_{$mLogo.logo}" alt="{$mLogo.company_name|escape}" class="mainLogo">
			</a>
		</td>
	{if $smarty.foreach.i.last OR ($smarty.foreach.i.iteration is div by $smarty.const.CONF_AGENCIES_SHOW_MAIN_LOGO_QTY)}</tr>{/if}
	{/foreach}
	<tr>
		<td class="last AlignRight" colspan="{$smarty.const.CONF_AGENCIES_SHOW_MAIN_LOGO_QTY}">
			<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=agencies")}">{$smarty.const.SITE_ALL_AGENCIES}...</a>
		</td>
	</tr>
</table>
