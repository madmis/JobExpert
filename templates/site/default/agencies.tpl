{if $errors}{include file="errors.message.tpl"}{/if}

<div class="DesignMainPageBody">
{if $arrActions.detail}
	{* ИНФОРМАЦИЯ О КОМПАНИИ *}
	{if $uData}
		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th class="CompanyName">{$uData.company_name} {if $uData.company_city}[{$uData.company_city}]{/if}</th>
			</tr>
			<tr>
            	<td class="last" style="vertical-align: top;">
					<table style="width: 100%;">
                    	<tr>
                        	<td>
								{if !$uData.hide_additional_company_data}
									<p class="p_2"><strong>{$smarty.const.SITE_USER_LAST_NAME}:</strong>&nbsp;{$uData.last_name}</p>
									<p class="p_2"><strong>{$smarty.const.SITE_USER_FIRST_NAME}:</strong>&nbsp;{$uData.first_name}</p>
									{if $uData.middle_name}<p class="p_2"><strong>{$smarty.const.SITE_USER_MIDDLE_NAME}:</strong>&nbsp;{$uData.middle_name}</p>{/if}
									<p class="p_2"><strong>{$smarty.const.SITE_USER_PHONE}:</strong>&nbsp;{$uData.phone}</p>
									{if $uData.addition_phone_1}<p class="p_2"><strong>{$smarty.const.SITE_USER_ADDITIONAL_PHONE}:</strong>&nbsp;{$uData.addition_phone_1}</p>{/if}
									{if $uData.addition_phone_2}<p class="p_2"><strong>{$smarty.const.SITE_USER_ADDITIONAL_PHONE}:</strong>&nbsp;{$uData.addition_phone_2}</p>{/if}
								{/if}
								{if $uData.company_url}
                                    {if $smarty.const.CONF_USE_REDIRECT_EXTERNAL_LINK}
                                        <p class="p_2">
                                            <strong>{$smarty.const.FORM_COMPANY_URL}:</strong>&nbsp;
                                            <a href="{$smarty.const.CONF_SCRIPT_URL}index.php?redirect={$uData.company_url}" target="_blank">{$uData.company_url}</a>
                                        </p>
                                    {else}
                                        <p class="p_2">
                                            <strong>{$smarty.const.FORM_COMPANY_URL}:</strong>&nbsp;
                                            <a href="{$uData.company_url}" rel="nofollow" target="_blank">{$uData.company_url}</a>
                                        </p>
                                    {/if}
                                {/if}
							</td>
							<td class="AlignRight">
								{if $uData.logo}
									<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/thumbs/thumb_{$uData.logo}" alt="{$uData.company_name}">
								{else}
									<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/not_logo.png" alt="{$uData.company_name}">
								{/if}
							</td>
						</tr>
					</table>
                </td>
            </tr>
			<tr>
				<td class="last AlignLeft" style="padding: 10px;">
					{* Если включено использование виз. редактора, вставляем без изменений *}
					{if $smarty.const.CONF_USE_VISUAL_EDITOR AND $smarty.const.CONF_AGENCIES_USE_VISUAL_EDITOR}
						{$uData.company_description}
					{else}
						{$uData.company_description|nl2br}
					{/if}
				</td>
			</tr>
		</table>

		{* ВАКАНСИИ КОМПАНИИ *}
		{include file="companies.vacancy.tpl"}
		{* РЕЗЮМЕ КОМПАНИИ *}
		{include file="companies.resume.tpl"}
	{/if}
{else}
	{if $arrCompanies}
		{foreach from=$arrCompanies item='company' name='i'}
		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th colspan="2" class="CompanyName">
						<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=agencies&amp;action=detail&amp;id=`$company.tId`")}" title="{$company.company_name|escape}">
							{$company.company_name} {if $company.company_city}[{$company.company_city}]{/if}
						</a>
				</th>
			</tr>
			<tr>
				<td class="CompanyLogo">
					<br>
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=agencies&amp;action=detail&amp;id=`$company.tId`")}" title="{$company.company_name|escape}">
						{if $company.logo}
							<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/thumbs/thumb_{$company.logo}" alt="{$company.company_name|escape}">
						{else}
							<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/not_logo.png" alt="{$company.company_name|escape}">
						{/if}
					</a>				
				</td>
				<td class="last AlignLeft" style="padding: 10px;">
					{* Если включено использование виз. редактора, вставляем без изменений *}
					{if $smarty.const.CONF_USE_VISUAL_EDITOR AND $smarty.const.CONF_AGENCIES_USE_VISUAL_EDITOR}
						{$company.company_description}
					{else}
						{$company.company_description|nl2br}
					{/if}
				</td>
			</tr>
			<tr>
				<td class="last AlignRight" colspan="2">
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=agencies&amp;action=detail&amp;id=`$company.tId`")}" title="{$smarty.const.SITE_COMPANY_VACANCY}&nbsp;{$company.company_name|escape}">{$smarty.const.SITE_COMPANY_VACANCY}...</a>
				</td>
			</tr>
		</table>
		{/foreach}
		<p class="TextAlignCenter">{$string_page}</p>
	{/if}
{/if}
</div>
