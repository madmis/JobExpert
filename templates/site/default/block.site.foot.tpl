<div style="height: 2px; background-color:#413C3C;"></div>

<table width="100%" class="footerCopyrights">
	<tr>
		<td style="white-space: nowrap;">
			{assign var="year" value=$smarty.now|date_format:"%Y"}
			engine Expert
			<span class="lastQuerys" style="cursor: default">&copy;</span>
			<a href="http://sd-group.org.ua/" target="_blank">SD-Group</a>
			{$year} - {$year + 5}
		</td>
		<td style="text-align: right;">
			<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=rss")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/rss_20.png" alt="RSS" style="background-color: #CC0000;"></a>
			<a href="http://www.php.net/" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/generic/php.gif" alt="Developed using PHP" title="Developed using PHP" style="background-color: #FFF;"></a>
			<a href="http://www.mysql.com/" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/generic/mysql.gif" alt="Developed using MySql" title="Developed using MySql" style="background-color: #FFF;"></a>
		</td>
	</tr>
</table>
<div id="overlay"></div>
<div id="dialog"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/loading.gif" alt=""></div>