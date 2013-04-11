{* Ошибки *}
{if $errors}
	{include file="adm.errors.message.tpl"}
{/if}
{* Список Регионов *}
{if $action.regions}
	{if $action.edit}
		{include file="adm.dictionary.regions.edit.tpl"}
	{else}
		{include file="adm.dictionary.regions.main.tpl"}
	{/if}
{* Список Городов *}
{elseif $action.citys}
	{if $action.edit}
		{include file="adm.dictionary.regions.edit.tpl"}
	{else}
		{include file="adm.dictionary.regions.citys.tpl"}
	{/if}
{/if}