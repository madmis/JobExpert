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
		<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type")}" title="{$smarty.const.CONF_SITE_NAME}">
			<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/topLogo.png" alt="{$smarty.const.CONF_SITE_NAME}">
		</a>
		<hr>
		{* Подключаем шаблон печати объявления *}
		{include file="$printTemplate"}
       	<p>&nbsp;<a href="javascript:window.print();" style="text-decoration: none;"><img alt="{$smarty.const.ANNOUNCE_SEND_TO_PRINT}" title="{$smarty.const.ANNOUNCE_SEND_TO_PRINT}" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/print_16.png" />&nbsp;{$smarty.const.ANNOUNCE_SEND_TO_PRINT}</a></p>
		{* Футер сайта *}
		{if $xmlTemplate.foot_site}
		<table style="width: 100%;">
			<tr>
				<td>{foreach from=$xmlTemplate.foot_site item="block"}{include file=$block}{/foreach}</td>
			</tr>
		</table>
		{/if}
	</body>
</html>