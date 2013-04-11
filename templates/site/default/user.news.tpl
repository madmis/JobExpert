{if $errors}{include file="errors.message.tpl"}{/if}

{if $arrActions.add}
	{if $arrUser.alias}{include file="user.news.add.tpl"}{/if}
{elseif $arrActions.edit}
	{if $arrUser.alias}{include file="user.news.edit.tpl"}{/if}
{elseif $arrActions.moderate}
	{include file="user.news.moderate.tpl"}
{elseif $arrActions.correction}
	{include file="user.news.correction.tpl"}
{elseif $arrActions.archived}
	{include file="user.news.archived.tpl"}
{elseif $arrActions.active}
	{include file="user.news.active.tpl"}
{/if}