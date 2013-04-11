{if $errors}
	{include file="errors.message.tpl"}
{/if}

{if $action.edit}
	{include file="user.data.edit.tpl"}
{else}
 <div class="Design_panesBGWrapper">
    <div class="Design_panesBG">
        <table style="width:100%;" cellpadding="0" cellspacing="0">
            <tr><td style="width:50%;">
            	<ul class="Design_tabs">
                	<li><a class="active current" style="font-size:11px;">{$smarty.const.MENU_USER_DATA}</a></li>
                </ul>
            </td><td style="width:50%;" valign="top" class="DesignUserDataTopDataCellDelim">
            	<ul class="Design_tabs" style="height:23px;">
                	<li style="height:23px;">&nbsp;</li>
                </ul>
            </td></tr>

            <tr><td class="DesignUserDataTopData" style="width:50%;" valign="top">
            	<strong class="shadow01">{$smarty.const.SITE_MAIN_DATA}</strong>
{* -------------------- [ основные данные начало] ---------------- *}
                    <table class="DesignSMainData">
                        <tr>
                            <td class="MDheader">{$smarty.const.SITE_USER_EMAIL}</td>
                            <td class="MDdata">{$arrUser.email}</td>
                        </tr>
                        <tr>
                            <td class="MDheader">{$smarty.const.SITE_USER_TYPE}</td>
                            <td class="MDdata">
            					{if $arrUser.user_type eq "agent"}
            						{$smarty.const.FORM_TYPE_AGENT}
            					{elseif $arrUser.user_type eq "company"}
            						{$smarty.const.FORM_TYPE_COMPANY}
            					{elseif $arrUser.user_type eq "employer"}
            						{$smarty.const.FORM_TYPE_EMPLOYER}
            					{elseif $arrUser.user_type eq "competitor"}
            						{$smarty.const.FORM_TYPE_COMPETITOR}
            					{/if}
                            </td>
                        </tr>
                        <tr>
                            <td class="MDheader">{$smarty.const.SITE_USER_REG_DATE}</td>
                            <td class="MDdata">{$arrUser.reg_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</td>
                        </tr>
                        {if $arrUser.alias}
                        <tr>
                            <td class="MDheader">{$smarty.const.SITE_USER_ALIAS}</td>
                            <td class="MDdata">{$arrUser.alias}</td>
                        </tr>
                        {/if}
                        {if $arrUser.pre_ip}
                        <tr>
                            <td class="MDheader">{$smarty.const.SITE_USER_PRE_IP}</td>
                            <td class="MDdata">
                            	{$arrUser.pre_ip}
            					<span class="user_help" id="HELP_USER_PRE_IP">
            						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info2.gif" alt="Info">
            					</span>
                            </td>
                        </tr>
                        {/if}
                        {if $arrUser.curr_ip}
                        <tr>
                            <td class="MDheader">{$smarty.const.SITE_USER_CURRENT_IP}</td>
                            <td class="MDdata">{$arrUser.curr_ip}</td>
                        </tr>
                        {/if}

                    </table>
{* -------------------- [ основные данные конец] ---------------- *}
            </td><td class="DesignUserDataTopData DesignUserDataTopDataCellDelim" style="width:50%;" valign="top">
                	<strong class="shadow01">{$smarty.const.SITE_ADDITIONAL_DATA}</strong>
{* -------------------- [ дополнительные данные начало] ---------------- *}
                    <table class="DesignSMainData">
                        <tr>
                            <td class="MDheader">{$smarty.const.SITE_USER_FIRST_NAME}</td>
                            <td class="MDdata">{$arrUser.first_name}</td>
                        </tr>
                        <tr>
                            <td class="MDheader">{$smarty.const.SITE_USER_LAST_NAME}</td>
                            <td class="MDdata">{$arrUser.last_name}</td>
                        </tr>
                        {if $arrUser.middle_name}
                        <tr>
                            <td class="MDheader">{$smarty.const.SITE_USER_MIDDLE_NAME}</td>
                            <td class="MDdata">{$arrUser.middle_name}</td>
                        </tr>
                        {/if}
                        <tr>
                            <td class="MDheader">{$smarty.const.SITE_USER_PHONE}</td>
                            <td class="MDdata">{$arrUser.phone}</td>
                        </tr>
                        {if $arrUser.addition_phone_1}
                        <tr>
                            <td class="MDheader">{$smarty.const.SITE_USER_ADDITIONAL_PHONE}</td>
                            <td class="MDdata">{$arrUser.addition_phone_1}</td>
                        </tr>
                        {/if}
                        {if $arrUser.addition_phone_2}
                        <tr>
                            <td class="MDheader">{$smarty.const.SITE_USER_ADDITIONAL_PHONE}</td>
                            <td class="MDdata">{$arrUser.addition_phone_2}</td>
                        </tr>
                        {/if}
                    </table>
{* -------------------- [ дополнительные данные конец] ---------------- *}
            </td></tr>
        </table>
    </div>
  </div>

<div style="margin:10px 0px; font-size:11px; text-align:left;">
    <img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/actions/edit.png" style="vertical-align: middle;" />
    <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.data&amp;action=edit")}" style="font-weight:bold;">{$smarty.const.MENU_EDIT_USER_DATA}</a>
</div>
{* -------------------- [ Права пользователя ] ---------------- *}
        <div class="DesignMainPageBody" style="margin-left:-5px; margin-right:5px;">
          <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
                  <tr>
                      <th colspan="2">{* <img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/rights.png" class="middle" /> *} {$smarty.const.SITE_USER_RIGHTS}</th>
                  </tr>
                  <tr>
                      {if $arrUser.user_type eq "agent" OR $arrUser.user_type eq "company" OR $arrUser.user_type eq "employer"}
                      <td class="AlignLeft" style="vertical-align: top; width: 50%;">
                          <div class="paddingText5">
                              <strong>{$smarty.const.SITE_VACANCY}</strong>
                              <table>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_ADD_VACANCY}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.add_vacancy}yes{else}no{/if}.png" /></td>
                                </tr>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_EDIT_VACANCY}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.edit_vacancy}yes{else}no{/if}.png" /></td>
                                </tr>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_DEL_VACANCY}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.del_vacancy}yes{else}no{/if}.png" /></td>
                                </tr>
                              </table>
                          </div>
                      </td>
                      {/if}

         			  {if $arrUser.user_type eq "agent" OR $arrUser.user_type eq "competitor"}
                      <td class="AlignLeft {if $arrUser.user_type eq 'agent'}last{/if}" style="vertical-align: top; width: 50%;">
                          <div class="paddingText5">
                              <strong>{$smarty.const.SITE_RESUME}</strong>
                              <table>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_ADD_RESUME}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.add_resume}yes{else}no{/if}.png" /></td>
                                </tr>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_EDIT_RESUME}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.edit_resume}yes{else}no{/if}.png" /></td>
                                </tr>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_DEL_RESUME}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.del_resume}yes{else}no{/if}.png" /></td>
                                </tr>
                              </table>
                          </div>
                      </td>
        			  {/if}

                      {if $arrUser.user_type neq "agent"}
                        <td class="last">&nbsp;</td>
                      {/if}
                 </tr>
                  <tr>
                      <td class="AlignLeft" style="vertical-align: top; width: 50%;">
                          <div class="paddingText5">
                              <strong>{$smarty.const.SITE_ARTICLES}</strong>
                              <table>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_ADD_ARTICLES}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.add_articles}yes{else}no{/if}.png" /></td>
                                </tr>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_EDIT_ARTICLES}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.edit_articles}yes{else}no{/if}.png" /></td>
                                </tr>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_ARC_ARTICLES}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.arc_articles}yes{else}no{/if}.png" /></td>
                                </tr>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_DEL_ARTICLES}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.del_articles}yes{else}no{/if}.png" /></td>
                                </tr>
                              </table>
                          </div>
                      </td>
                      <td class="last AlignLeft" style="vertical-align: top; width: 50%;">
                          <div class="paddingText5">
                              <strong>{$smarty.const.SITE_NEWS}</strong>
                              <table>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_ADD_NEWS}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.add_news}yes{else}no{/if}.png" /></td>
                                </tr>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_EDIT_NEWS}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.edit_news}yes{else}no{/if}.png" /></td>
                                </tr>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_ARC_NEWS}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.edit_news}yes{else}no{/if}.png" /></td>
                                </tr>
                                <tr>
                                    <td>{$smarty.const.TABLE_COLUMN_DEL_NEWS}</td>
                                    <td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/{if $codex.rights.del_news}yes{else}no{/if}.png" /></td>
                                </tr>
                              </table>
                          </div>
                      </td>
				  </tr>
          </table>
        </div>
{/if}