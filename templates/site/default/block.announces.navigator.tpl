{if $user_type eq 'competitor'}
	{include file="block.vacancy.list.tpl"}
{elseif $user_type eq 'employer' || $user_type eq 'company'}
	{include file="block.resume.list.tpl"}
{elseif $user_type eq 'agent'}
	{include file="block.sections.list.tpl"}
	{include file="block.regions.list.tpl"}
{/if}