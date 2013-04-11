<div class="DesignFooterHR"></div>
{if $user_type eq 'agent' OR $user_type eq 'competitor'}
	{assign var="type" value="vacancy"}
{else}
	{assign var="type" value="resume"}
{/if}

<table style="width: 100%;">
	<tr>
	{foreach from=$sections item="section" name="i"}
		{if $smarty.foreach.i.first OR (($smarty.foreach.i.iteration-1) is div by 6)}
		<td style="white-space: nowrap; vertical-align: top;">
			<div class="footerBlock">
		{/if}
				<p><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$type&amp;action=sections&amp;id=`$section.tId`")}" title="{$section.name}">
					{$section.name}
				</a></p>
		{if $smarty.foreach.i.last OR ($smarty.foreach.i.iteration is div by 6)}
			</div>
		</td>
		{/if}
	{/foreach}
	</tr>
</table>