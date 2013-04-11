{* ГОЛОВНОЙ ШАБЛОН ДЕЙСТВИЙ РАЗДЕЛА ЯЗЫКОВОГО МЕНЕДЖЕРА *}
{* Вывод ошибок *}
{if $errors}
	{include file="adm.errors.message.tpl"}
{/if}
{* Настройки объявлений *}
{if $action.localizConst && !$ownAdmin}
	{include file="adm.service.language.manager.const.tpl"}
{elseif $action.localizConst && $ownAdmin}
	{include file="adm.service.language.manager.const.ownadmin.tpl"}
{elseif $action.localizText}
	{include file="adm.service.language.manager.text.tpl"}
{elseif $action.localizAgreement}
	{include file="adm.service.language.manager.agreement.tpl"}
{/if}