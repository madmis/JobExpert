<div class="DesignMainPageBody">
{if $return_data}
	{foreach from=$return_data item="vacancy" name="vacancy"}
		{if $smarty.foreach.vacancy.iteration is odd}<table style="width: 100%; border: 0px;" cellspacing="2"><tr>{/if}
				<td width="50%" valign="top">
                      <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
                              <tr>
                                  <th><a href="{$chpu->createChpuUrl("$link`$vacancy.tId`")}" style="display:block;" class="light" title="{$vacancy.title|escape}, {$smarty.const.FORM_TYPE_COMPANY} - {$vacancy.company_name}, {$sections[$vacancy.id_section].name}, {$regions[$vacancy.id_region].name|escape}, {$vacancy.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$vacancy.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$vacancy.pay_from}{if $vacancy.pay_post}-{$vacancy.pay_post}{/if} {$vacancy.currency}">{$vacancy.title|truncate:80:'...'}</a></th>
                              </tr>
                              <tr>
                                <td class="last">
                                    {$regions[$vacancy.id_region].name|escape}<br>
                                    {$vacancy.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}<br>
                                    <strong>{if $vacancy.pay_post}{$smarty.const.SITE_FROM}&nbsp;{$vacancy.pay_from}&nbsp;{$smarty.const.SITE_UNTO}&nbsp;{$vacancy.pay_post}{else}{$vacancy.pay_from}{/if}&nbsp;{$vacancy.currency}</strong>
                                </td>
                              </tr>
                      </table>
				</td>
		{if $smarty.foreach.vacancy.iteration is even}
			</tr></table>
		{elseif $smarty.foreach.vacancy.last}
			<td>&nbsp;</td></tr></table>
		{/if}
	{/foreach}
{/if}
</div>