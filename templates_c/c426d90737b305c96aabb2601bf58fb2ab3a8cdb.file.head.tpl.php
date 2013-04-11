<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:04
         compiled from "templates/site/default\head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173634faa48942b46c6-28501422%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c426d90737b305c96aabb2601bf58fb2ab3a8cdb' => 
    array (
      0 => 'templates/site/default\\head.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173634faa48942b46c6-28501422',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_title' => 0,
    'meta_keywords' => 0,
    'meta_description' => 0,
    'chpu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa489447289',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa489447289')) {function content_4faa489447289($_smarty_tpl) {?><head>
	<meta charset="<?php echo @CONF_DEFAULT_CHARSET;?>
">

	<meta name="Resource-type" content="document">
	<meta name="Document-state" content="dynamic">

	<title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['page_title']->value)===null||$tmp==='' ? @CONF_DEFAULT_TITLE : $tmp);?>
</title>

	<meta content="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['meta_keywords']->value)===null||$tmp==='' ? @CONF_DEFAULT_KEYWORDS : $tmp);?>
" name="Keywords">
	<meta content="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['meta_description']->value)===null||$tmp==='' ? @CONF_DEFAULT_DESCRIPTION : $tmp);?>
" name="Description">

	<link rel="sitemap" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=sitemap");?>
" title="<?php echo @MENU_SITEMAP;?>
">
	<link rel="alternate" type="application/sitemap+xml" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=sitemap&amp;action=xml");?>
" title="<?php echo @MENU_SITEMAP;?>
">
	<link rel="alternate" type="application/rss+xml" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=rss");?>
" title="<?php echo @MENU_RSS;?>
">

	<link rel="stylesheet" type="text/css" href="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
style/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
style/design.css">

	<!--[if (gte IE 5.5)&(lt IE 7)]>
		<link rel="stylesheet" type="text/css" href="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
style/designIE6.css">
	<![endif]-->

<!-- JQUERY -->
	<script type="text/javascript" src="<?php echo @CONF_SCRIPT_URL;?>
core/js/jquery/jquery.js"></script>
	<script type="text/javascript" src="<?php echo @CONF_SCRIPT_URL;?>
core/js/jquery/ui/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo @CONF_SCRIPT_URL;?>
core/js/jquery/ui/css/blitzer/jquery-ui.css">
<!-- JQUERY -->

<!-- RATING -->
	<link rel="stylesheet" type="text/css" href="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
style/rating.css">
<!-- RATING -->

<!-- PLUGINS JQUERY -->
	<!-- COLORBOX -->
	<script type="text/javascript" src="<?php echo @CONF_SCRIPT_URL;?>
core/modules/colorbox/jquery.colorbox-1.3.11.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo @CONF_SCRIPT_URL;?>
core/modules/colorbox/style3/colorbox.css">
	<!-- COLORBOX -->

	<!-- JQUERY LIBTOOLS -->
	<script type="text/javascript" src="<?php echo @CONF_SCRIPT_URL;?>
core/modules/libtools/jquery.libtools-1.1.2.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo @CONF_SCRIPT_URL;?>
core/modules/libtools/jquery.libtools.css">
	<!-- JQUERY LIBTOOLS -->

	<!-- OTHER -->
	<script type="text/javascript" src="<?php echo @CONF_SCRIPT_URL;?>
core/js/jquery/plugins/jquery.cookie.js"></script>
	<!-- OTHER -->

	<!-- JQUERY SCROLLABLE -->
	<script type="text/javascript" src="<?php echo @CONF_SCRIPT_URL;?>
core/js/jquery/plugins/scrollable/scrollable.js "></script>

	<link rel="stylesheet" type="text/css" href="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
style/scrollable-buttons.css">
	<link rel="stylesheet" type="text/css" href="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
style/scrollable-horizontal.css">
	<!-- JQUERY SCROLLABLE -->
<!-- PLUGINS JQUERY -->

<!-- Наши файлы с использованием JQuery -->
	<script type="text/javascript" src="<?php echo @CONF_SCRIPT_URL;?>
core/js/jquery/jq.tools.js"></script>
<!-- Наши файлы с использованием JQuery -->

<?php if (@CONF_USE_VISUAL_EDITOR){?>
	<!-- TinyMCE -->
	<script type="text/javascript" src="<?php echo @CONF_SCRIPT_URL;?>
core/modules/tinymce/tiny_mce.js"></script>
	<!-- TinyMCE -->
<?php }?>

	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

	<!--<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>-->

</head><?php }} ?>