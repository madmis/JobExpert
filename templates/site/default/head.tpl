<head>
	<meta charset="{$smarty.const.CONF_DEFAULT_CHARSET}">

	<meta name="Resource-type" content="document">
	<meta name="Document-state" content="dynamic">

	<title>{$page_title|default:$smarty.const.CONF_DEFAULT_TITLE}</title>

	<meta content="{$meta_keywords|default:$smarty.const.CONF_DEFAULT_KEYWORDS}" name="Keywords">
	<meta content="{$meta_description|default:$smarty.const.CONF_DEFAULT_DESCRIPTION}" name="Description">

	<link rel="sitemap" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=sitemap")}" title="{$smarty.const.MENU_SITEMAP}">
	<link rel="alternate" type="application/sitemap+xml" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=sitemap&amp;action=xml")}" title="{$smarty.const.MENU_SITEMAP}">
	<link rel="alternate" type="application/rss+xml" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=rss")}" title="{$smarty.const.MENU_RSS}">

	<link rel="stylesheet" type="text/css" href="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}style/style.css">
	<link rel="stylesheet" type="text/css" href="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}style/design.css">

	<!--[if (gte IE 5.5)&(lt IE 7)]>
		<link rel="stylesheet" type="text/css" href="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}style/designIE6.css">
	<![endif]-->

<!-- JQUERY -->
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/js/jquery/jquery.js"></script>
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/js/jquery/ui/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="{$smarty.const.CONF_SCRIPT_URL}core/js/jquery/ui/css/blitzer/jquery-ui.css">
<!-- JQUERY -->

<!-- RATING -->
	<link rel="stylesheet" type="text/css" href="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}style/rating.css">
<!-- RATING -->

<!-- PLUGINS JQUERY -->
	<!-- COLORBOX -->
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/modules/colorbox/jquery.colorbox-1.3.11.js"></script>
	<link rel="stylesheet" type="text/css" href="{$smarty.const.CONF_SCRIPT_URL}core/modules/colorbox/style3/colorbox.css">
	<!-- COLORBOX -->

	<!-- JQUERY LIBTOOLS -->
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/modules/libtools/jquery.libtools-1.1.2.js"></script>
	<link rel="stylesheet" type="text/css" href="{$smarty.const.CONF_SCRIPT_URL}core/modules/libtools/jquery.libtools.css">
	<!-- JQUERY LIBTOOLS -->

	<!-- OTHER -->
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/js/jquery/plugins/jquery.cookie.js"></script>
	<!-- OTHER -->

	<!-- JQUERY SCROLLABLE -->
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/js/jquery/plugins/scrollable/scrollable.js "></script>

	<link rel="stylesheet" type="text/css" href="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}style/scrollable-buttons.css">
	<link rel="stylesheet" type="text/css" href="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}style/scrollable-horizontal.css">
	<!-- JQUERY SCROLLABLE -->
<!-- PLUGINS JQUERY -->

<!-- Наши файлы с использованием JQuery -->
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/js/jquery/jq.tools.js"></script>
<!-- Наши файлы с использованием JQuery -->

{if $smarty.const.CONF_USE_VISUAL_EDITOR}
	<!-- TinyMCE -->
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/modules/tinymce/tiny_mce.js"></script>
	<!-- TinyMCE -->
{/if}

	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<!--<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>-->

</head>