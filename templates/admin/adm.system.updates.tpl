<p class="sub_menu"><span class="colorbox_help" id="HELP_ADMIN_SYSTEM_UPDATES"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}"></span></p>

{if $errors}{include file="adm.errors.message.tpl"}{/if}

{* Страница настроек *}
{if $action.config}
	{include file="adm.system.updates.config.tpl"}
{* Страница создания резервных копий *}
{elseif $action.backup}
	{include file="adm.system.updates.backup.tpl"}
{* Страница установки обновления *}
{elseif $action.setup}
	{include file="adm.system.updates.setup.tpl"}
{* Страница логов обновлений *}
{elseif $action.logs}
    {include file="adm.system.updates.logs.tpl"}
{* Список обновлений *}
{else}
	{*<div class="warning">{$smarty.const.WARNING_NOT_FORGET_SITE_ON_MAINTENANCE}</div>*}

	<table style="width: 100%;" cellspacing="5" cellpadding="3">
		<thead class="data_head">
			<tr>
				<td>{$smarty.const.MENU_UPDATES}</td>
			</tr>
		</thead>
	{if $arrUpdates}
		<tbody style="background-color: #FFFFCC;">
			{foreach from=$arrUpdates item="update" name="i"}
			<tr><td>
				{if $smarty.foreach.i.first}<form action="{$smarty.const.CONF_ADMIN_FILE}?m=system&amp;s=updates" method="post">{/if}
				<table style="width: 100%; border: 1px dashed #DA6969; padding: 5px;">
					<tr>
						<td style="width: 20%;">
							<p>{$smarty.const.SITE_REVISION}:&nbsp;<strong>{$update.revision}</strong></p>
							<p>{$smarty.const.SITE_FILE}:&nbsp;<strong>{$update.file}</strong></p>
							<p>{$smarty.const.SITE_DATE}:&nbsp;<strong>{$update.datetime|date_format:$smarty.const.CONF_DATE_FORMAT} {$update.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</strong></p>
						</td>
						<td style="width: 60%; text-align: center;"><textarea cols="70" rows="5" class="text" readonly>{if $update.changelog neq 'empty'}{$update.changelog}{/if}</textarea></td>
						<td style="width: 20%; text-align: center; font-size: 11px;">
							{if $smarty.foreach.i.first}
							{$smarty.const.FORM_LOGIN}<br>
							<input type="text" name="login" value="" class="text" title="{$smarty.const.FORM_SYSTEM_UPDATES_LOGIN}"><br>
							<input type="hidden" name="file" value="{$update.file}">
							<input type="hidden" name="revision" value="{$update.revision}">
							{$smarty.const.FORM_PASSWORD}<br>
							<input type="password" name="password" value="" class="text" title="{$smarty.const.FORM_SYSTEM_UPDATES_PASSWORD}"><br>
							<input type="submit" value="{$smarty.const.FORM_BUTTON_SETUP}" class="button">
							{/if}
						</td>
					</tr>
				</table>
				{if $smarty.foreach.i.first}</form>{/if}
			</tr></td>
			{/foreach}
		</tbody>
	{else}
		<tbody>
			<tr>
				<td style="text-align: center;">{$smarty.const.SITE_NOT_AVAILABLE_UPDATES}</td>
			</tr>
		</tbody>
	{/if}
{/if}