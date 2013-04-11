{if $return_subcategory_data|default:false}
  <div class="InfoBlockWrapper" style="margin-left:5px; margin-right:-5px;">
      <div class="withoutHeader"></div>
      <div class="InfoBlock"><div>
        	<table cellspacing="1" cellpadding="1" style="width: 95%; padding: 0px 5px 20px 5px;">
        		<tr>
			        {foreach from=$return_subcategory_data item="subcategory" name="subcategory"}
        				<td style="text-align: right;">&bull;&nbsp;</td>
      				    {if $actPage.sections|default:false}
        					<td style="text-align: left; width: 40%;"><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&amp;action=professions&amp;id=`$subcategory.tId`")}">{$subcategory.name}</a>&nbsp;</td>
        				{elseif $actPage.regions|default:false}
        					<td style="text-align: left; width: 40%;"><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&amp;action=citys&amp;id=`$subcategory.tId`")}">{if $subcategory.capital eq on}<strong>{/if}{$subcategory.name}{if $subcategory.capital eq on}</strong>{/if}</a>&nbsp;</td>
        				{/if}
        				<td style="text-align: left;">[{$subcategory.cnt_vacancy}]</td>
        				{if $smarty.const.CONF_CATEGORY_PERLINE && !($smarty.foreach.subcategory.iteration%$smarty.const.CONF_CATEGORY_PERLINE)}
        					</tr>
        					<tr>
        				{/if}
        			{/foreach}
        		</tr>
        	</table>
      </div></div>
  </div>
{/if}

{if $return_data}
	<table style="width: 100%;">
		<tr>
			<td style="text-align: left;">
				<div class="views">
					<div class="short" id="short" title="Short"></div>
					<div class="block" id="block" title="Block"></div>
					<div class="list" id="list" title="List"></div>
				</div>
			</td>
		</tr>
	</table>
	<div id="id_short" class="table_views">
		{foreach from=$return_data item="vacancy" name="vacancy"}
          <div class="DesignMainPageBody">
          <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
                  <tr>
                      <th colspan="2"><a href="{$chpu->createChpuUrl("$link`$vacancy.tId`")}" class="light" title="{$vacancy.title|escape}, {$smarty.const.FORM_TYPE_COMPANY} - {$vacancy.company_name}, {$sections[$vacancy.id_section].name}, {$regions[$vacancy.id_region].name|escape}, {$vacancy.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$vacancy.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$vacancy.pay_from}{if $vacancy.pay_post}-{$vacancy.pay_post}{/if} {$vacancy.currency}">{$vacancy.title|truncate:180:'...'}</a></th>
                  </tr>
                  {if $vacancy.vip || $vacancy.hot}
                    <tr>
                        <td colspan="2" class="noBorderRight last AlignLeft" valign="top">
                            <div class="paddingText5">
        						{if $vacancy.vip}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/vip.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}" title="{$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}: {$vacancy.title|truncate:80:'...'}">{/if}
        						{if $vacancy.hot}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/hot.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}" title="{$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}: {$vacancy.title|truncate:80:'...'}">{/if}
                            </div>
                        </td>
                    </tr>
                  {/if}
                  <tr class="noBorderBottom">
                      <td class="noBorderRight AlignLeft" valign="top">
                          <div class="paddingTextWBottom5">
                              <strong class="Header">{$vacancy.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$vacancy.act_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</strong>
                              <table class="paddingTextWBottom5">
                                  <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_REGION}:</strong></td><td>{$regions[$vacancy.id_region].name|escape}</td></tr>
                                  <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_SECTION}:</strong></td><td>{$sections[$vacancy.id_section].name}</td></tr>
                              </table>
                              <table class="paddingTextWBottom5">
                              <tr><td>
                                    <strong>{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}:</strong><br>
                                    {$vacancy.company_name}<br><br>
                                    <strong>{$smarty.const.ANNOUNCE_CONTACTS_FIO}:</strong><br>
                                    {$vacancy.contacts_fio}
                              </td></tr>
                              </table>
                          </div>
                      </td>
                      <td class="noBorderLeft last AlignRight" valign="top">
                          <div class="paddingText5">
                                    <div class="InfoBlockWrapper">
                                        <div class="withoutHeader"></div>
                                        <div class="InfoBlock"><div>
                                            <table>
                                                <tr><td style="width:150px;"><strong>{$smarty.const.ANNOUNCE_PAY_HEAD}:</strong></td><td>{if $vacancy.pay_post}{$smarty.const.SITE_FROM}&nbsp;{$vacancy.pay_from}&nbsp;{$smarty.const.SITE_UNTO}&nbsp;{$vacancy.pay_post}{else}{$vacancy.pay_from}{/if}&nbsp;{$vacancy.currency}</td></tr>
                                                <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}:</strong></td><td>{$vacancy.chart_work}</td></tr>
                                                <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION}:</strong></td><td>{$vacancy.edu_work}</td></tr>
                                                <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}:</strong></td><td>{$vacancy.expire_work}</td></tr>
                                                <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_GENDER}:</strong></td><td>{$arrSysDict.Gender.values[$vacancy.gender]}</td></tr>
                            					{if $vacancy.age_from or $vacancy.age_post}
                                                    <tr><td><strong>{$smarty.const.ANNOUNCE_AGE}:</strong></td><td>{if $vacancy.age_from}{$smarty.const.SITE_FROM}&nbsp;{$vacancy.age_from}{/if}{if $vacancy.age_post}&nbsp;{$smarty.const.SITE_UNTO}&nbsp;{$vacancy.age_post}{/if}</td></tr>
                                                {/if}
                                            </table>
                                        </div></div>
                                    </div>
                          </div>
                      </td>
                  </tr>

                  <tr class="noBorderTop noBorderBottom">
                        <td colspan="2" class="last AlignLeft">
                           <div class="paddingTextBoth5">
                                <table class="paddingTextBoth5"><tr><td>
                                    <strong>{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}:</strong><br>
                                   {$vacancy.company_discription}<br><br>
		            	 		   <strong>{$smarty.const.ANNOUNCE_TEXTAREA_DUTESWORK}:</strong><br>
        			    		   {$vacancy.duties_work}
                                </td></tr></table>
                           </div>
                        </td>
                  </tr>

          		<tr class="noBorderTop">
          			<td class="noBorderRight" valign="bottom" style="text-align:left;">
                          <div class="submitButtonLight paddingText5">
                              <a href="{$chpu->createChpuUrl("$link`$vacancy.tId`")}" class="submitButton">{$smarty.const.FORM_LOOK_AT}...</a>
                          </div>
          			</td>
          			<td class="noBorderLeft last" style="text-align:right;">
                          <div style="margin:10px 0px;">
        						{if $arrPayments.vip_vacancy && !$vacancy.vip}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&action=setVIP&id=`$vacancy.id`")}" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setVIP.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}"></a>{/if}
        						{if $arrPayments.hot_vacancy && !$vacancy.hot}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&action=setHOT&id=`$vacancy.id`")}" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setHOT.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}"></a>{/if}
        						{if !$smarty.foreach.vacancy.first && $arrPayments.rate_vacancy}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&action=setRate&id=`$vacancy.id`")}" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setRate.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_VACANCY}" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_VACANCY}"></a>{/if}
                          </div>
          			</td>
          		</tr>
              </table>
          </div><br>
		{/foreach}
	</div>
	<div id="id_block" class="table_views">
		{include file="vacancy.view.block.tpl"}
	</div>
	<div id="id_list" class="table_views">
		{include file="vacancy.view.list.tpl"}
	</div>
	<p>{$string_page}</p>
{else}
    <div class="ErrorBlockWrapper">
        <div class="ErrorHeader">{$smarty.const.ERROR_NON_DATA}</div>
        <div class="ErrorBlock">
            <ul>
                  <li>{$smarty.const.ERROR_NON_DATA}</li>
            </ul>
        </div>
    </div>
{/if}




<script type="text/javascript">
<!--
$(document).ready( function() {
	if (currCookie = $.cookie('vac_views')) {
		$('#' + currCookie).addClass('select');
		$('div.table_views').hide().filter('#id_' + currCookie).fadeIn('normal');
	} else {
		$('#short').addClass('select');
		$('div.table_views').hide().filter('#id_short').fadeIn('normal');
		$.cookie('vac_views', 'short', { path: '/', expires: 30 });
	}

	$('div.views > div').click( function() {
		$('div.table_views').hide().filter('#id_' + $(this).attr('id')).fadeIn('normal');
		$(this).parent().children('div').removeClass('select');
		$(this).addClass('select');
		$.cookie('vac_views', $(this).attr('id'), { path: '/', expires: 30 });
	});
});
-->
</script>
