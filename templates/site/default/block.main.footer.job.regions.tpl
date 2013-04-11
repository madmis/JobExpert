<div class="DesignFooterHR"></div>
{if $user_type eq 'agent' OR $user_type eq 'competitor'}
	{assign var="type" value="vacancy"}
{else}
	{assign var="type" value="resume"}
{/if}

<table style="width: 100%;">
	<tr>
	{foreach from=$regions item="region" name="i"}
		{if $smarty.foreach.i.first OR (($smarty.foreach.i.iteration-1) is div by 5)}
		<td style="white-space: nowrap; vertical-align: top;">
			<div class="footerBlock">
		{/if}
				<p><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$type&amp;action=regions&amp;id=`$region.tId`")}" title="{$region.name}">
					{$region.name}
				</a></p>
		{if $smarty.foreach.i.last OR ($smarty.foreach.i.iteration is div by 5)}
			</div>
		</td>
		{/if}
	{/foreach}
	</tr>
</table>