{if $errors}{include file="errors.message.tpl"}{/if}

{if $arrActions.add}
	{if $arrUser.alias}{include file="user.articles.add.tpl"}{/if}
{elseif $arrActions.edit}
	{if $arrUser.alias}{include file="user.articles.edit.tpl"}{/if}
{elseif $arrActions.moderate}
	{include file="user.articles.moderate.tpl"}
{elseif $arrActions.correction}
	{include file="user.articles.correction.tpl"}
{elseif $arrActions.archived}
	{include file="user.articles.archived.tpl"}
{elseif $arrActions.active}
	{include file="user.articles.active.tpl"}
{/if}