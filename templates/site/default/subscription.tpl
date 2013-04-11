{if $errors}{include file="errors.message.tpl"}{/if}
<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=subscription")}" method="post" enctype="multipart/form-data">
        <div class="DesignMainPageBody">
          <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
                  <tr>
                      <th colspan="2">&nbsp;{$smarty.const.FORM_SUBSCRIPTION_ADD}</th>
                  </tr>
                  <tr>
                      <td class="AlignLeft" valign="top">
                          <div class="paddingText5">
                    			{* Выбор раздела *}
                                <strong>{$smarty.const.ANNOUNCE_OPTION_SECTION}<span class="text-red">*</span></strong>
                				<br>
                				<select name="arrBindFields[id_section]" id="section">
                					<option value="">{$smarty.const.ANNOUNCE_OPTION_SECTION}</option>
                					{foreach from=$sections item="section"}
                					<option value="{$section.id}" {if $retFields.id_section eq $section.id}selected{/if}>{$section.name}</option>
                					{/foreach}
                				</select>
                                <br><br>
                    			{* Выбор области *}
                				<strong>{$smarty.const.ANNOUNCE_OPTION_REGION}<span class="text-red">*</span></strong>
                				<br>
                				<select name="arrBindFields[id_region]" id="region">
                					<option value="">{$smarty.const.ANNOUNCE_OPTION_REGION}</option>
                					{foreach from=$regions item="region"}
                					<option value="{$region.id}" {if $retFields.id_region eq $region.id}selected{/if}>{$region.name}</option>
                					{/foreach}
                				</select>
                                <br><br>
                    			{* Выбор города *}
                  				<strong>{$smarty.const.ANNOUNCE_OPTION_CITY}</strong>
                  				<br>
                  				<select name="arrNoBindFields[id_city]" id="city">
                  					<option value="">{$smarty.const.FORM_SEARCH_ANY_CITY}</option>
                  				</select>


                          </div>
                      </td>
                      <td class="last AlignLeft" valign="top">
                          <div class="paddingText5">
                    			{* Выбор профессии *}
                				<strong>{$smarty.const.ANNOUNCE_OPTION_PROFESSION}</strong>
                				<br>
                				<select name="arrNoBindFields[id_profession]" id="profession">
                					<option value="">{$smarty.const.FORM_SEARCH_ANY_PROFESSION}</option>
                				</select>
                                <br><br>
                    			{* Выбор выбор периода подписки *}
                				<strong>{$smarty.const.FORM_SUBSCRIPTION_SELECT_PERIOD}<span class="text-red">*</span></strong>
                				<br>
                				<select name="arrBindFields[period]">
                					{foreach from=$arrSysDict.SubscriptionPeriod.values item="item" key="key"}
                					<option value="{$key}" {if $retFields.id_region eq $key}selected{/if}>{$item}</option>
                					{/foreach}
                				</select>
                        		{if $user_type eq 'agent'}
                                    <br><br>
                        			<strong>{$smarty.const.FORM_SUBSCRIPTION_SIGN_ON}<span class="text-red">*</span>:</strong><br>
                        			<label><input type="radio" name="arrBindFields[type_subscription]" value="vacancy">{$smarty.const.FORM_VACANCYS_HEAD}</label>
                        			<label><input type="radio" name="arrBindFields[type_subscription]" value="resume">{$smarty.const.FORM_RESUMES_HEAD}</label>
                        		{/if}
                          </div>
                      </td>
                 </tr>
                 <tr>
                    <td colspan="2" class="last AlignLeft">
                       <div class="paddingText5">
                			<label><input type="checkbox" name="test_send">{$smarty.const.FORM_SUBSCRIPTION_SEND_TEST_MAIL}</label>
                			<span class="user_help" id="HELP_SUBSCRIPTION_SEND_TEST_MAIL">
                				<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt="Info">
                			</span>
                        </div>
                    </td>
                 </tr>
                 <tr>
                    <td colspan="2" class="last AlignLeft">
                       <div class="paddingText5">
                          <div class="submitButtonLight">
                              <input type="submit" class="shadow01red" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}">
                          </div>
                       </div>
                    </td>
                 </tr>

          </table>
        </div>
</form>



<div class="freesubscribe">
    {$smarty.const.SITE_SUBSCRIPTIONS_CAN_ADD_FREE}: &nbsp;&nbsp;
	{if $user_type eq 'agent' OR $user_type eq 'competitor'}{$smarty.const.SITE_SUBSCRIPTIONS_VACANCY}: <strong>{$statData['availFreeSubscrV']}</strong>{/if}
    &nbsp;&nbsp;
    {if $user_type eq 'agent' OR $user_type eq 'company' OR $user_type eq 'employer'}{$smarty.const.SITE_SUBSCRIPTIONS_RESUME}: <strong>{$statData['availFreeSubscrR']}</strong>{/if}
</div>

{* СПИСОК ПОДПИСОК *}
<form id="s" action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=subscription")}" method="post">
        <div class="DesignMainPageBody">
        <h1 class="DesignPageHeader">{$smarty.const.MENU_SUBSCRIPTION}</h1>
          <table class="mainBodyTable" cellspacing="0">
            <tr>
			<th>{$smarty.const.TABLE_COLUMN_TYPE_SUBSCRIPTION}</th>
			<th>{$smarty.const.ANNOUNCE_SELECT_SECTION}</th>
			<th style="width:90px;">{$smarty.const.ANNOUNCE_SELECT_PROFESSION}</th>
			<th>{$smarty.const.ANNOUNCE_SELECT_REGION}</th>
			<th>{$smarty.const.ANNOUNCE_SELECT_CITY}</th>
			<th style="width:90px;">{$smarty.const.TABLE_COLUMN_DATE_END_SUBSCRIPTION}</th>
			<th>{$smarty.const.TABLE_COLUMN_PERIOD}</th>
			<th>{$smarty.const.TABLE_COLUMN_DATE_LASTSEND}</th>
			<th style="width:25px;">-</th>
			<th style="width:25px;"><input type="checkbox" class="s_all"></th>
            </tr>
            {if $subscriptions}
            	{foreach from=$subscriptions item="subscription"}
            		<tr>
            			<td>{if $subscription.type_subscription eq 'vacancy'}{$smarty.const.FORM_VACANCYS_HEAD}{else}{$smarty.const.FORM_RESUMES_HEAD}{/if}</td>
            			<td>{$sections[$subscription.id_section].name}</td>
            			<td>
            				{if !$subscription.id_profession}
            					{$smarty.const.FORM_SEARCH_ANY_PROFESSION}
            				{else}
            					<p>{$professions[$subscription.id_profession].name}</p>
            					{if $subscription.id_profession_1}<p>{$professions[$subscription.id_profession_1].name}</p>{/if}
            					{if $subscription.id_profession_2}<p>{$professions[$subscription.id_profession_2].name}</p>{/if}
            				{/if}
            			</td>
            			<td>{$regions[$subscription.id_region].name|escape}</td>
            			<td>
            				{if !$subscription.id_city}{$smarty.const.FORM_SEARCH_ANY_CITY}{else}{$citys[$subscription.id_city].name|escape}{/if}
            			</td>
            			<td>{if $subscription.token_datetime neq '0000-00-00 00:00:00'}{$subscription.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}{else}-----{/if}</td>
            			<td>{$subscription.period}</td>
            			<td>{if $subscription.date_lastsend neq '0000-00-00'}{$subscription.date_lastsend|date_format:$smarty.const.CONF_DATE_FORMAT}{else}-----{/if}</td>
            			<td>{if $subscription.payment eq 'yes'}P{elseif $subscription.id_announce}A{else}F{/if}*</td>
            			<td class="last"><input type="checkbox" name="subscr[{$subscription.id}]"></td>
            		</tr>
            	{/foreach}
                    <tr>
                        <td colspan="10" style="text-align:right;">
                            <table align="right"><tr><td>
                				<select name="action" class="select">
                					<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
                					<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
                				</select>
                            </td><td>
                                  <div class="submitButtonLight" >
                                      <input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_EXECUTE}">
                                  </div>
                            </td></tr></table>
                        </td>
                    </tr>
            {else}
            		<tr>
            			<td class="last" align="center" colspan="10">{$smarty.const.TABLE_NOT_DATA}</td>
            		</tr>
            {/if}
          </table>
        </div>
	</form>
{* ^Подписки ожидающие оплату^ *}
<div class="subscribeNote">
	*&nbsp;{$smarty.const.HELP_SUBSCRIPTION_FPA}
</div>

{* СПИСОК ПОДПИСОК ОЖИДАЮЩИХ ОПЛАТЫ *}
{if ($arrPayments.subscr_vacancy OR $arrPayments.subscr_resume) AND $paySubscr}
    	<form id="p" action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=subscription")}" method="post">
        <div class="DesignMainPageBody">
        <h1 class="DesignPageHeader">{$smarty.const.SITE_SUBSCRIPTIONS_WAIT_PAYMENT}</h1>
          <table class="mainBodyTable" cellspacing="0">
            <tr>
				<th>{$smarty.const.TABLE_COLUMN_TYPE_SUBSCRIPTION}</th>
				<th>{$smarty.const.ANNOUNCE_SELECT_SECTION}</th>
				<th>{$smarty.const.ANNOUNCE_SELECT_PROFESSION}</th>
				<th>{$smarty.const.ANNOUNCE_SELECT_REGION}</th>
				<th>{$smarty.const.ANNOUNCE_SELECT_CITY}</th>
				<th>{$smarty.const.TABLE_COLUMN_PERIOD}</th>
				<th style="width:25px;"><input type="checkbox" class="s_all"></th>
            </tr>
		{foreach from=$paySubscr item="pSubscr"}
			<tr>
				<td>{if $pSubscr.type_subscription eq 'vacancy'}{$smarty.const.FORM_VACANCYS_HEAD}{else}{$smarty.const.FORM_RESUMES_HEAD}{/if}</td>
				<td>{$sections[$pSubscr.id_section].name}</td>
				<td>
					{if !$pSubscr.id_profession}
						{$smarty.const.FORM_SEARCH_ANY_PROFESSION}
					{else}
						<p>{$professions[$pSubscr.id_profession].name}</p>
						{if $pSubscr.id_profession_1}<p>{$professions[$pSubscr.id_profession_1].name}</p>{/if}
						{if $pSubscr.id_profession_2}<p>{$professions[$pSubscr.id_profession_2].name}</p>{/if}
					{/if}
				</td>
				<td>{$regions[$pSubscr.id_region].name|escape}</td>
				<td>
					{if !$pSubscr.id_city}{$smarty.const.FORM_SEARCH_ANY_CITY}{else}{$citys[$pSubscr.id_city].name|escape}{/if}
				</td>
				<td>{$subscription.period}</td>
				<td class="last"><input type="checkbox" name="subscr[{$pSubscr.id}]" value="{$pSubscr.type_subscription}"></td>
			</tr>
		    {/foreach}
            <tr>
                <td colspan="7" style="text-align:right;">
                    <table align="right"><tr><td>
					<select name="action" class="select">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						<option value="pay">{$smarty.const.FORM_ACTION_PAY_SELECTED}</option>
						<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
					</select>
                    </td><td>
                          <div class="submitButtonLight" >
                              <input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_EXECUTE}">
                          </div>
                    </td></tr></table>
                </td>
            </tr>
          </table>
        </div>
	</form>
{/if}

<script type="text/javascript">
<!--
$(document).ready( function() {
	//включаем все переключатели в таблице	
	$('.s_all').click( function() {
		var current = $(this);
		var parentEls = $(this).parents().map( function() {
		    							if (this.tagName == 'FORM') return (this);
		                              });
		var id = parentEls.attr('id');
		$('#' + id + ' :checkbox').each( function() {
			( current.is(':checked') ) ? $(this).attr('checked', true) : $(this).attr('checked', false);
      	});
	});

	// проверяем выбранное действие
	$("form").submit( function() {
		var id = '#' + $(this).attr('id');
		var val = $(id + ' select[name="action"] option:selected').val();
		var size = $(id + ' input[name]:checked').size();

		if ( !val ) {
			alert( '{$smarty.const.ERROR_NOT_SELECT_ACTION}' );
			return false;
		} else {
			if ( !size ) {
				alert( '{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}' );
				return false;
			}
			// проверяем, чтобы при оплате было выбрано не более одной записи
			else if ( val === 'pay' && size > 1 ) {
				alert( '{$smarty.const.MESSAGE_WARNING_PAYMENT_NO_MORE_THAN_ONE_RECORD}' );
				return false;
			}

			return ( val === 'del' ) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
		}
	});
});
-->
</script>