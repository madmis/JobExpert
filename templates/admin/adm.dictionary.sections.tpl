{* Ошибки *}
{if $errors}
	{include file="adm.errors.message.tpl"}
{/if}
{* Список Разделов *}
{if $action.sections}
	{if $action.edit}
		{include file="adm.dictionary.sections.edit.tpl"}
	{else}
		{include file="adm.dictionary.sections.main.tpl"}
	{/if}
{* Список Профессий *}
{elseif $action.professions}
	{if $action.edit}
		{include file="adm.dictionary.sections.edit.tpl"}
	{else}
		{include file="adm.dictionary.sections.professions.tpl"}
	{/if}
{/if}
