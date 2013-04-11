{* ГОЛОВНОЙ ШАБЛОН ДЕЙСТВИЙ РАЗДЕЛА УПРАВЛЕНИЯ ОБЪЯВЛЕНИЯМИ *}
{* Вывод ошибок *}
{if $errors}
	{include file="adm.errors.message.tpl"}
{/if}
{* Настройки объявлений *}
{if $action.confCommon}
	{include file="adm.announces.common.config.tpl"}
{elseif $action.confVacancy}
	{include file="adm.announces.vacancy.config.tpl"}
{elseif $action.confQuestVacancy}
	{include file="adm.announces.vacancy.quest.config.tpl"}
{elseif $action.confResume}
	{include file="adm.announces.resume.config.tpl"}
{elseif $action.confQuestResume}
	{include file="adm.announces.resume.quest.config.tpl"}
{/if}