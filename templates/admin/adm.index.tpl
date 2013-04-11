<!DOCTYPE html>
<html>
	<head>
		<meta charset="{$smarty.const.CONF_DEFAULT_CHARSET}">

		<meta name="Resource-type" content="document">
		<meta name="Document-state" content="dynamic">

		<title>{$smarty.const.TITLE} | {$smarty.const.CONF_SITE_NAME}</title>

		<link rel="stylesheet" type="text/css" href="{$smarty.const.TEMPLATE_PATH_ADMIN}style/style.css">

		<!-- JQUERY -->
			<script type="text/javascript" src="core/js/jquery/jquery.js"></script>
			<script type="text/javascript" src="core/js/jquery/ui/jquery-ui.js"></script>
			<link rel="stylesheet" type="text/css" href="core/js/jquery/ui/css/blitzer/jquery-ui.css">
		<!-- JQUERY -->

		<!-- PLUGINS JQUERY -->
			<!-- JQUERY COOCKIE -->
			<script type="text/javascript" src="core/js/jquery/plugins/jquery.cookie.js"></script>
			<!-- JQUERY COOCKIE -->

			<!-- COLORBOX -->
			<script type="text/javascript" src="core/modules/colorbox/jquery.colorbox-1.3.11.js"></script>
			<link rel="stylesheet" type="text/css" href="core/modules/colorbox/style1/colorbox.css">
			<!-- COLORBOX -->
		<!-- PLUGINS JQUERY -->

		<!-- Наши файлы с использованием JQuery -->
			<script type="text/javascript" src="core/js/jquery/jq.tools.js"></script>
		<!-- Наши файлы с использованием JQuery -->

		{if $smarty.const.CONF_USE_VISUAL_EDITOR}
		<!-- TinyMCE -->
			<script type="text/javascript" src="core/modules/tinymce/tiny_mce.js"></script>
			{if $main_template eq 'adm.manager.mailer.tpl'}
				<script type="text/javascript" src="core/modules/tinymce/mailer_config.js"></script>
			{else}
				<script type="text/javascript" src="core/modules/tinymce/basic_config.js"></script>
			{/if}
			<script type="text/javascript" src="core/modules/tinymce/plugins/tinybrowser/tb_tinymce.js.php"></script>
		<!-- TinyMCE -->
		{/if}

		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	</head>

	<body>
		<p id="cookie_disabled" style="display: none; color: red; text-align: center;">{$smarty.const.COOKIE_DISABLED}</p>

		<noscript>
			<p style="color: red; text-align: center;">{$smarty.const.JAVASCRIPT_DISABLED}</p>
		</noscript>

		<table style="width: 100%; border: 0px;" cellpadding="0" cellspacing="0" class="headtable">
			<tr>
				<td class="logo_t">
					<a href="{$smarty.const.CONF_ADMIN_FILE}" title="{$smarty.const.CONF_SITE_NAME}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/logo_t.png" alt=""></a>
				</td>
				<td style="width: 80%;">
					{include file="adm.menu.top.tpl"}
				</td>
			</tr>
			<tr>
				<td class="logo_b">
					<a href="{$smarty.const.CONF_ADMIN_FILE}" title="{$smarty.const.CONF_SITE_NAME}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/logo_b.png" alt=""></a>
				</td>
				<td style="width: 80%; border-left: 1px solid #CC3333;">
					{if $namePage|default:false}
						<p class="headline">
							{foreach from=$namePage item="page" name="page"}
								{if $page.link}
									<a href="{$page.link}" title="{$page.name}">{$page.name}</a>{if !$smarty.foreach.page.last}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/item_ltr.png" alt="">{/if}
								{else}
									{$page.name}{if !$smarty.foreach.page.last}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/item_ltr.png" alt="">{/if}
								{/if}
							{/foreach}
						</p>
					{/if}
				</td>
			</tr>
		</table>
		<table style="width: 100%; border: 0px;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width: 20%; vertical-align: top;">
					<div class="menu_scroll">{include file="adm.menu.tpl"}</div>
				</td>
				<td style="width: 80%; padding: 5px; vertical-align: top; border-left: 1px solid #CC3333;">
					<div class="content_scroll">{include file=$main_template}</div>
				</td>
			</tr>
		</table>

		{* Блок диалога загрузки и тень *}
		<div id="overlay"></div>
		<div id="dialog"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/processing.gif" alt=""></div>

		{* Диалоговое окно - Алерт *}
		<div id="msgAlert" title="{$smarty.const.WARNING_ATTENTION}" style="display: none;">
			<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="margin: 5px; padding: 10px;">
					<span class="ui-icon ui-icon-info" style="float: left; margin-right: 10px;"></span>
					<span id="msgAlertContent"></span>
				</div>
			</div>
		</div>

		<div id="lastQuerys" style="display: none;">
			{foreach from=$ScriptWorkReport.ListAllQuerysToDB item="query"}
				<p>{if $query.Query}{$query.Query}{else}{$query.QuerySelect}{/if}</p>
			{/foreach}
		</div>

		<script type="text/javascript">
		<!--
			$(document).ready(function() {
				// проверяем включены ли кукисы
				if (!navigator.cookieEnabled)
				{
					$('#cookie_disabled').show();
				}

				// инициализируем datepicker
				$("#datepicker_s").datepicker({
					dateFormat: 'yy-mm-dd',
					dayNamesMin: ['{$smarty.const.SU}','{$smarty.const.MO}','{$smarty.const.TU}','{$smarty.const.WE}','{$smarty.const.TH}','{$smarty.const.FR}','{$smarty.const.SA}'],
					firstDay: 1,
					monthNames: ['{$smarty.const.JANUARY}','{$smarty.const.FEBRUARY}','{$smarty.const.MARCH}','{$smarty.const.APRIL}','{$smarty.const.MAY}','{$smarty.const.JUNE}','{$smarty.const.JULY}','{$smarty.const.AUGUST}','{$smarty.const.SEPTEMBER}','{$smarty.const.OCTOBER}','{$smarty.const.NOVEMBER}','{$smarty.const.DECEMBER}']
				});

   				$("#datepicker_e").datepicker({
					dateFormat: 'yy-mm-dd',
					dayNamesMin: ['{$smarty.const.SU}','{$smarty.const.MO}','{$smarty.const.TU}','{$smarty.const.WE}','{$smarty.const.TH}','{$smarty.const.FR}','{$smarty.const.SA}'],
					firstDay: 1,
					monthNames: ['{$smarty.const.JANUARY}','{$smarty.const.FEBRUARY}','{$smarty.const.MARCH}','{$smarty.const.APRIL}','{$smarty.const.MAY}','{$smarty.const.JUNE}','{$smarty.const.JULY}','{$smarty.const.AUGUST}','{$smarty.const.SEPTEMBER}','{$smarty.const.OCTOBER}','{$smarty.const.NOVEMBER}','{$smarty.const.DECEMBER}']
				});

   				$(".datepicker").datepicker({
					dateFormat: 'yy-mm-dd',
					dayNamesMin: ['{$smarty.const.SU}','{$smarty.const.MO}','{$smarty.const.TU}','{$smarty.const.WE}','{$smarty.const.TH}','{$smarty.const.FR}','{$smarty.const.SA}'],
					firstDay: 1,
					monthNames: ['{$smarty.const.JANUARY}','{$smarty.const.FEBRUARY}','{$smarty.const.MARCH}','{$smarty.const.APRIL}','{$smarty.const.MAY}','{$smarty.const.JUNE}','{$smarty.const.JULY}','{$smarty.const.AUGUST}','{$smarty.const.SEPTEMBER}','{$smarty.const.OCTOBER}','{$smarty.const.NOVEMBER}','{$smarty.const.DECEMBER}']
				});

				// обрабатываем клики меню
				$('.menu_title, .submenu_title').click(function() {
					$(this).toggleClass('open').next().toggle('fast');
					var arrlist = [];
					$('.open').each(function() {
						arrlist.push($(this).attr('id'));
					});
					$.cookie('openAdmMenu', arrlist.join(), { path: '/', expires: 30 });
				});

				// подгоняем высоту документа по экрану
				hdoc = document.documentElement.clientHeight;
				hmenu = (mpos = $('.menu_scroll').offset()) ? hdoc - mpos.top : 700;
				moffset = (moffset = $('#{$currMenu}').offset()) ? moffset.top - mpos.top : 0;
				$('.menu_scroll').height(hmenu).scrollTop(moffset);
				hcontent = (cpos = $('.content_scroll').offset()) ? hdoc - cpos.top : 700;
				$('.content_scroll').height(hcontent);

				/***** Отображение алертов *****/
				$('#msgAlert').dialog({
					autoOpen: false,
					modal: true,
					resizable: false,
					buttons: {
						'{$smarty.const.SITE_CLOSE}': function() {
							$('#msgAlertContent').text('');
							$(this).dialog('close');
						}
					}
				});

                /***** Отображение запросов к БД *****/
				$('.lastQuerys').click(function() {
					$.fn.colorbox({ html: $('#lastQuerys').html(), preloading: true, opacity: 0, open: true, maxWidth: '100%', maxHeight: '100%', scrolling: true });
					$(this).parent().css('overflow-x','hidden');
				});
			});
		-->
		</script>
	</body>
</html>