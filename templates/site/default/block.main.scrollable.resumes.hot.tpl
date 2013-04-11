{if $hot.resume}
<table style="width: 100%;">
	<tr>
		<td style="width: 30px;">
			<!-- "previous page" action -->
			<a class="prev browse left"></a>
		</td>
		<td>
			<!-- root element for scrollable -->
			<div class="scrollable">
				<!-- root element for the items -->
				<div class="items">

				{counter start=0 print=false}
				{foreach from=$hot.resume item="resume" name="resume"}
					
					{if $smarty.foreach.resume.first}<div>{/if}
						<span>
							<table style="height: 75px; width: 100%;">
								<!-- Можно программно огарничить длину заголовка объявления. На мой взгляд, это оптимальное решение. Иначе с дизайном трудности. -->
								<tr>
									<td style="vertical-align: top;">
										<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=view&amp;id=`$resume.tId`")}" title="{$resume.title|escape}, {$sections[$resume.id_section].name}, {$regions[$resume.id_region].name|escape}, {$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$resume.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$resume.pay_from} {$resume.currency}">{$resume.title|truncate:25}</a>
									</td>
								</tr>
								<tr>
									<td style="vertical-align: top; font-weight: bold;">
										{$resume.pay_from}&nbsp;{$resume.currency}
									</td>
								</tr>
								<tr>
									<td style="vertical-align: bottom; font-size: 11px;">
										{$regions[$resume.id_region].name|escape}
									</td>
								</tr>
							</table>
						</span>
					{if $smarty.foreach.resume.last}
						</div>
					{elseif $smarty.foreach.resume.iteration is div by 3}
						</div><div>
					{/if}
				{/foreach}

				</div>
			</div>
		</td>
		<td style="width: 30px;">
			<!-- "next page" action -->
			<a class="next browse right"></a>
		</td>
	</tr>
</table>

<br clear="all" />
<script type="text/javascript">
<!--
// execute your scripts when the DOM is ready. this is mostly a good habit
$(function() {
	// initialize scrollable
	$(".scrollable").scrollable();
});
-->
</script>
{/if}