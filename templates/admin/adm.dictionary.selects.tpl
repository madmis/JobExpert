{* Ошибки *}
{if $errors}
	{include file="adm.errors.message.tpl"}
{/if}
{* Добавление словаря *}
{if $action.add}
	{include file="adm.dictionary.selects.add.tpl"}
{* Редактирование словаря *}
{elseif $action.edit}
	{include file="adm.dictionary.selects.edit.tpl"}
{else}
	{include file="adm.dictionary.selects.main.tpl"}
{/if}