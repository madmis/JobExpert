{if $return_subcategory_data|default:false}
  <div class="InfoBlockWrapper" style="margin-left:5px; margin-right:-5px;">
      <div class="withoutHeader"></div>
      <div class="InfoBlock"><div>
        	<table cellspacing="1" cellpadding="1" style="width: 95%; padding: 0px 5px 20px 5px;">
        		<tr>
        			{foreach from=$return_subcategory_data item="subcategory" name="subcategory"}
        				<td style="text-align: right;">&bull;&nbsp;</td>
        				{if $actPage.sections|default:false}
        					<td style="text-align: left; width: 40%;"><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=professions&amp;id=`$subcategory.tId`")}">{$subcategory.name}</a>&nbsp;</td>
        				{elseif $actPage.regions|default:false}
        					<td style="text-align: left; width: 40%;"><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=citys&amp;id=`$subcategory.tId`")}">{if $subcategory.capital eq on}<strong>{/if}{$subcategory.name}{if $subcategory.capital eq on}</strong>{/if}</a>&nbsp;</td>
        				{/if}
        				<td style="text-align: left;">[{if !$user_email}{$subcategory.cnt_resume_v}{else}{$subcategory.cnt_resume_m}{/if}]</td>
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
		{foreach from=$return_data item="resume" name="resume"}
          <div class="DesignMainPageBody">
          <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
                  <tr>
                      <th colspan="2"><a href="{$chpu->createChpuUrl("$link`$resume.tId`")}" class="light" title="{$resume.title|escape}, {$sections[$resume.id_section].name}, {$regions[$resume.id_region].name|escape}, {$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$resume.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$resume.pay_from} {$resume.currency}">{$resume.title|truncate:180:'...'}</a></th>
                  </tr>
                  {if $resume.vip || $resume.hot}
                    <tr>
                        <td colspan="2" class="noBorderRight last AlignLeft" valign="top">
                            <div class="paddingText5">
            						{if $resume.vip}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/vip.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}" title="{$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}: {$resume.title|truncate:80:'...'}">{/if}
            						{if $resume.hot}<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/hot.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}" title="{$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}: {$resume.title|truncate:80:'...'}">{/if}
                            </div>
                        </td>
                    </tr>
                  {/if}
                  <tr class="noBorderBottom">
                      <td class="noBorderRight AlignLeft" valign="top">
                          <div class="paddingText5">
                              <strong class="Header">{$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$resume.act_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</strong>

                              <table class="paddingText5">
                                  <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_REGION}:</strong></td><td>{$regions[$resume.id_region].name|escape}</td></tr>
                                  <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_SECTION}:</strong></td><td>{$sections[$resume.id_section].name}</td></tr>
                              </table>
							  {if 'visiblehc' neq $resume.visibility && 'membershc' neq $resume.visibility}
                              <strong class="Header">{$smarty.const.ANNOUNCE_CONTACTS_PERSON}:</strong>
                              <table class="paddingTextWBottom5">
                                  <tr><td><strong>{$smarty.const.ANNOUNCE_CONTACTS_LASTNAME}:</strong></td><td>{$resume.last_name}</td></tr>
                                  <tr><td><strong>{$smarty.const.ANNOUNCE_CONTACTS_FIRSTNAME}:</strong></td><td>{$resume.first_name}</td></tr>
                                  <tr><td><strong>{$smarty.const.ANNOUNCE_CONTACTS_MIDDLENAME}:</strong></td><td>{$resume.middle_name}</td></tr>
                              </table>
                              {/if}
                          </div>
                      </td>
                      <td class="noBorderLeft last AlignRight" valign="top">
                          <div class="paddingText5">
                                    <div class="InfoBlockWrapper">
                                        <div class="withoutHeader"></div>
                                        <div class="InfoBlock"><div>
                                            <table>
                                                <tr><td style="width:150px;"><strong>{$smarty.const.ANNOUNCE_PAY_HEAD}:</strong></td><td>{$smarty.const.SITE_FROM} {$resume.pay_from}&nbsp;{$resume.currency}</td></tr>
                                                <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}:</strong></td><td>{$resume.chart_work}</td></tr>
                                                <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_EDUCATION}:</strong></td><td>{$resume.education}</td></tr>
                                                <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}:</strong></td><td>{$resume.expire_work}</td></tr>
                                                <tr><td><strong>{$smarty.const.ANNOUNCE_SELECT_GENDER}:</strong></td><td>{$arrSysDict.Gender.values[$resume.gender]}</td></tr>
                                                <tr><td><strong>{$smarty.const.ANNOUNCE_AGE}:</strong></td><td>{$resume.age}</td></tr>
                                            </table>
                                        </div></div>
                                    </div>
                          </div>
                      </td>
                  </tr>
                  {if $resume.about_info}
                    <tr class="noBorderTop noBorderBottom">
                        <td colspan="2"class="last AlignLeft">
                           <div class="paddingText5" style="margin-top:0px;">
                                <strong class="Header">{$smarty.const.ANNOUNCE_TEXTAREA_ABOUTINFO}:</strong>
                                <div class="paddingText5">
                                   {$resume.about_info}
                                </div>
                           </div>
                        </td>
                    </tr>
                  {/if}

          		<tr class="noBorderTop">
          			<td class="noBorderRight" valign="bottom" style="text-align:left;">
                          <div class="submitButtonLight paddingText5">
                              <a href="{$chpu->createChpuUrl("$link`$resume.tId`")}" class="submitButton">{$smarty.const.FORM_LOOK_AT}...</a>
                          </div>
          			</td>
          			<td class="noBorderLeft last" style="text-align:right;">
                          <div style="margin:10px 0px;">
              				{if $arrPayments.vip_resume && !$resume.vip}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=setVIP&amp;id=`$resume.id`")}" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setVIP.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}"></a>{/if}
          	    			{if $arrPayments.hot_resume && !$resume.hot}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=setHOT&amp;id=`$resume.id`")}" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setHOT.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}"></a>{/if}
          		    		{if !$smarty.foreach.resume.first && $arrPayments.rate_resume}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=setRate&amp;id=`$resume.id`")}" rel="nofollow"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setRate.png" style="padding: 0px 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}"></a>{/if}
                          </div>
          			</td>
          		</tr>
              </table>
          </div><br>
    	{/foreach}
	</div>
	<div id="id_block" class="table_views">
		{include file="resume.view.block.tpl"}
	</div>
	<div id="id_list" class="table_views">
		{include file="resume.view.list.tpl"}
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
	if (currCookie = $.cookie('res_views'))	{
		$('#' + currCookie).addClass('select');
		$('div.table_views').hide().filter('#id_' + currCookie).fadeIn('normal');
	} else {
		$('#short').addClass('select');
		$('div.table_views').hide().filter('#id_short').fadeIn('normal');
		$.cookie('res_views', 'short', { path: '/', expires: 30 });
	}

	$('div.views > div').click( function() {
		$('div.table_views').hide().filter('#id_' + $(this).attr('id')).fadeIn('normal');
		$(this).parent().children('div').removeClass('select');
		$(this).addClass('select');
		$.cookie('res_views', $(this).attr('id'), { path: '/', expires: 30 });
	});
});
-->
</script>
