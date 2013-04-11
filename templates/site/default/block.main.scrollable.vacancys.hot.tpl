{if $hot.vacancy}
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
				{foreach from=$hot.vacancy item="vacancy" name="vacancy"}
					
					{if $smarty.foreach.vacancy.first}<div>{/if}
						<span>
							<table style="height: 75px; width: 100%;">
								<!-- Можно программно огарничить длину заголовка объявления. На мой взгляд, это оптимальное решение. Иначе с дизайном трудности. -->
								<tr>
									<td style="vertical-align: top;">
										<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&amp;action=view&amp;id=`$vacancy.tId`")}" title="{$vacancy.title|escape}, {$smarty.const.FORM_TYPE_COMPANY} - {$vacancy.company_name}, {$sections[$vacancy.id_section].name} - {$professions[$vacancy.id_profession].name}, {$regions[$vacancy.id_region].name|escape}{if $vacancy.id_city} - {$citys[$vacancy.id_city].name|escape}{/if}, {$vacancy.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$vacancy.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$vacancy.pay_from}{if $vacancy.pay_post}-{$vacancy.pay_post}{/if} {$vacancy.currency}">{$vacancy.title|truncate:25}</a>
									</td>
								</tr>
								<tr>
									<td style="vertical-align: top; font-weight: bold;">
										{if $vacancy.pay_post}{$smarty.const.SITE_FROM}&nbsp;{$vacancy.pay_from}&nbsp;{$smarty.const.SITE_UNTO}&nbsp;{$vacancy.pay_post}{else}{$vacancy.pay_from}{/if}&nbsp;{$vacancy.currency}
									</td>
								</tr>
								<tr>
									<td style="vertical-align: bottom; font-size: 11px;">
										{$regions[$vacancy.id_region].name|escape}
									</td>
								</tr>
							</table>
						</span>
					{if $smarty.foreach.vacancy.last}
						</div>
					{elseif $smarty.foreach.vacancy.iteration is div by 3}
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