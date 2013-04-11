<table style="width: 90%;">
	<tr>
		<td>
			<div class="rss">
				<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=rss&amp;action=news")}">{$smarty.const.MENU_NEWS}</a>
			</div>
		</td>
		<td>
			<div class="rss">
				<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=rss&amp;action=articles")}">{$smarty.const.MENU_ARTICLES}</a>
			</div>
		</td>
	</tr>
	<tr>
		<td>               
			<div class="rss">
				<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=competitor&amp;do=rss&amp;action=vacancy")}">{$smarty.const.MENU_VACANCYS}</a>
			</div>
		</td>
		<td>
			<div class="rss">
				<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=employer&amp;do=rss&amp;action=resume")}">{$smarty.const.MENU_RESUMES}</a>
			</div>
		</td>
	</tr>
</table>