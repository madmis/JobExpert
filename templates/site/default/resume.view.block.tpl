<div class="DesignMainPageBody">
{if $return_data}
	{foreach from=$return_data item="resume" name="resume"}
		{if $smarty.foreach.resume.iteration is odd}<table style="width: 100%; border: 0px;" cellspacing="2"><tr>{/if}
				<td width="50%" valign="top">
                      <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
                              <tr>
                                  <th><a href="{$chpu->createChpuUrl("$link`$resume.tId`")}" style="display:block;" class="light" title="{$resume.title|escape}, {$sections[$resume.id_section].name}, {$regions[$resume.id_region].name|escape}, {$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$resume.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$resume.pay_from} {$resume.currency}">{$resume.title|truncate:80:'...'}</a></th>
                              </tr>
                              <tr>
                                <td class="last">
                                    {$regions[$resume.id_region].name|escape}<br>
                                    {$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}<br>
                                    <strong>{$resume.pay_from}&nbsp;{$resume.currency}</strong>
                                </td>
                              </tr>
                      </table>
				</td>
		{if $smarty.foreach.resume.iteration is even}
			</tr></table>
		{elseif $smarty.foreach.resume.last}
			<td>&nbsp;</td></tr></table>
		{/if}
	{/foreach}
{/if}
</div>