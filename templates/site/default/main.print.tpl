<!DOCTYPE html>
<html>
	<head>
		<meta charset="{$smarty.const.CONF_DEFAULT_CHARSET}">
		<meta name="Resource-type" content="document">
		<meta name="Document-state" content="dynamic">
		<meta content="{$meta_keywords|default:$smarty.const.CONF_DEFAULT_KEYWORDS}" name="Keywords">
		<meta content="{$meta_description|default:$smarty.const.CONF_DEFAULT_DESCRIPTION}" name="Description">
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}style/style.css">
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}style/design.css">
		<title>{$page_title|default:$smarty.const.CONF_DEFAULT_TITLE}</title>
	</head>
	<body style="margin: 0px 10px;">
		{* Шаблон может быть передан как переменная (откомпилированный шаблон) *}
		{* или может быть передан путь к файлу шаблона *}
		{if $printVar}
			{* Выводим откомпилированный шаблон *}
			{$printVar}
		{else}
			{* Подключаем шаблон *}
			{include file="$printTemplate"}
		{/if}
       	<p>&nbsp;<a href="javascript:window.print();" style="text-decoration: none;"><img alt="{$smarty.const.ANNOUNCE_SEND_TO_PRINT}" title="{$smarty.const.ANNOUNCE_SEND_TO_PRINT}" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/print_16.png" />&nbsp;{$smarty.const.ANNOUNCE_SEND_TO_PRINT}</a></p>
	</body>
</html>