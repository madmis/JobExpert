{* ГОЛОВНОЙ ШАБЛОН АДМИНИСТРИРОВАНИЯ *}
{* Вывод ошибок *}
{if $errors}
	{include file="adm.errors.message.tpl"}
{/if}
{* Технические работы *}
{if $action.maintenance}
	{include file="adm.service.administration.maintenance.tpl"}
{/if}