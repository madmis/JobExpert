<?php /* Smarty version Smarty-3.1.5, created on 2012-05-11 21:33:39
         compiled from "templates/admin\adm.index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204784fad4d731804f5-80255220%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20d963a99963e1769552ef4370f9a057f5a1beb7' => 
    array (
      0 => 'templates/admin\\adm.index.tpl',
      1 => 1336142866,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204784fad4d731804f5-80255220',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'main_template' => 0,
    'namePage' => 0,
    'page' => 0,
    'ScriptWorkReport' => 0,
    'query' => 0,
    'currMenu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fad4d73a5f90',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad4d73a5f90')) {function content_4fad4d73a5f90($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="<?php echo @CONF_DEFAULT_CHARSET;?>
">

		<meta name="Resource-type" content="document">
		<meta name="Document-state" content="dynamic">

		<title><?php echo @TITLE;?>
 | <?php echo @CONF_SITE_NAME;?>
</title>

		<link rel="stylesheet" type="text/css" href="<?php echo @TEMPLATE_PATH_ADMIN;?>
style/style.css">

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

		<?php if (@CONF_USE_VISUAL_EDITOR){?>
		<!-- TinyMCE -->
			<script type="text/javascript" src="core/modules/tinymce/tiny_mce.js"></script>
			<?php if ($_smarty_tpl->tpl_vars['main_template']->value=='adm.manager.mailer.tpl'){?>
				<script type="text/javascript" src="core/modules/tinymce/mailer_config.js"></script>
			<?php }else{ ?>
				<script type="text/javascript" src="core/modules/tinymce/basic_config.js"></script>
			<?php }?>
			<script type="text/javascript" src="core/modules/tinymce/plugins/tinybrowser/tb_tinymce.js.php"></script>
		<!-- TinyMCE -->
		<?php }?>

		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	</head>

	<body>
		<p id="cookie_disabled" style="display: none; color: red; text-align: center;"><?php echo @COOKIE_DISABLED;?>
</p>

		<noscript>
			<p style="color: red; text-align: center;"><?php echo @JAVASCRIPT_DISABLED;?>
</p>
		</noscript>

		<table style="width: 100%; border: 0px;" cellpadding="0" cellspacing="0" class="headtable">
			<tr>
				<td class="logo_t">
					<a href="<?php echo @CONF_ADMIN_FILE;?>
" title="<?php echo @CONF_SITE_NAME;?>
"><img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/logo_t.png" alt=""></a>
				</td>
				<td style="width: 80%;">
					<?php echo $_smarty_tpl->getSubTemplate ("adm.menu.top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				</td>
			</tr>
			<tr>
				<td class="logo_b">
					<a href="<?php echo @CONF_ADMIN_FILE;?>
" title="<?php echo @CONF_SITE_NAME;?>
"><img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/logo_b.png" alt=""></a>
				</td>
				<td style="width: 80%; border-left: 1px solid #CC3333;">
					<?php if ((($tmp = @$_smarty_tpl->tpl_vars['namePage']->value)===null||$tmp==='' ? false : $tmp)){?>
						<p class="headline">
							<?php  $_smarty_tpl->tpl_vars["page"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["page"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['namePage']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["page"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["page"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["page"]->key => $_smarty_tpl->tpl_vars["page"]->value){
$_smarty_tpl->tpl_vars["page"]->_loop = true;
 $_smarty_tpl->tpl_vars["page"]->iteration++;
 $_smarty_tpl->tpl_vars["page"]->last = $_smarty_tpl->tpl_vars["page"]->iteration === $_smarty_tpl->tpl_vars["page"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["page"]['last'] = $_smarty_tpl->tpl_vars["page"]->last;
?>
								<?php if ($_smarty_tpl->tpl_vars['page']->value['link']){?>
									<a href="<?php echo $_smarty_tpl->tpl_vars['page']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['page']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value['name'];?>
</a><?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['page']['last']){?>&nbsp;<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/item_ltr.png" alt=""><?php }?>
								<?php }else{ ?>
									<?php echo $_smarty_tpl->tpl_vars['page']->value['name'];?>
<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['page']['last']){?>&nbsp;<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/item_ltr.png" alt=""><?php }?>
								<?php }?>
							<?php } ?>
						</p>
					<?php }?>
				</td>
			</tr>
		</table>
		<table style="width: 100%; border: 0px;" cellpadding="0" cellspacing="0">
			<tr>
				<td style="width: 20%; vertical-align: top;">
					<div class="menu_scroll"><?php echo $_smarty_tpl->getSubTemplate ("adm.menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div>
				</td>
				<td style="width: 80%; padding: 5px; vertical-align: top; border-left: 1px solid #CC3333;">
					<div class="content_scroll"><?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['main_template']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div>
				</td>
			</tr>
		</table>
		<div id="overlay"></div>
		<div id="dialog"><img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/processing.gif" alt=""></div>
		<div id="msgAlert" title="<?php echo @WARNING_ATTENTION;?>
" style="display: none;">
			<div class="ui-widget">
				<div class="ui-state-highlight ui-corner-all" style="margin: 5px; padding: 10px;">
					<span class="ui-icon ui-icon-info" style="float: left; margin-right: 10px;"></span>
					<span id="msgAlertContent"></span>
				</div>
			</div>
		</div>

		<div id="lastQuerys" style="display: none;">
			<?php  $_smarty_tpl->tpl_vars["query"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["query"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ScriptWorkReport']->value['ListAllQuerysToDB']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["query"]->key => $_smarty_tpl->tpl_vars["query"]->value){
$_smarty_tpl->tpl_vars["query"]->_loop = true;
?>
				<p><?php if ($_smarty_tpl->tpl_vars['query']->value['Query']){?><?php echo $_smarty_tpl->tpl_vars['query']->value['Query'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['query']->value['QuerySelect'];?>
<?php }?></p>
			<?php } ?>
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
					dayNamesMin: ['<?php echo @SU;?>
','<?php echo @MO;?>
','<?php echo @TU;?>
','<?php echo @WE;?>
','<?php echo @TH;?>
','<?php echo @FR;?>
','<?php echo @SA;?>
'],
					firstDay: 1,
					monthNames: ['<?php echo @JANUARY;?>
','<?php echo @FEBRUARY;?>
','<?php echo @MARCH;?>
','<?php echo @APRIL;?>
','<?php echo @MAY;?>
','<?php echo @JUNE;?>
','<?php echo @JULY;?>
','<?php echo @AUGUST;?>
','<?php echo @SEPTEMBER;?>
','<?php echo @OCTOBER;?>
','<?php echo @NOVEMBER;?>
','<?php echo @DECEMBER;?>
']
				});

   				$("#datepicker_e").datepicker({
					dateFormat: 'yy-mm-dd',
					dayNamesMin: ['<?php echo @SU;?>
','<?php echo @MO;?>
','<?php echo @TU;?>
','<?php echo @WE;?>
','<?php echo @TH;?>
','<?php echo @FR;?>
','<?php echo @SA;?>
'],
					firstDay: 1,
					monthNames: ['<?php echo @JANUARY;?>
','<?php echo @FEBRUARY;?>
','<?php echo @MARCH;?>
','<?php echo @APRIL;?>
','<?php echo @MAY;?>
','<?php echo @JUNE;?>
','<?php echo @JULY;?>
','<?php echo @AUGUST;?>
','<?php echo @SEPTEMBER;?>
','<?php echo @OCTOBER;?>
','<?php echo @NOVEMBER;?>
','<?php echo @DECEMBER;?>
']
				});

   				$(".datepicker").datepicker({
					dateFormat: 'yy-mm-dd',
					dayNamesMin: ['<?php echo @SU;?>
','<?php echo @MO;?>
','<?php echo @TU;?>
','<?php echo @WE;?>
','<?php echo @TH;?>
','<?php echo @FR;?>
','<?php echo @SA;?>
'],
					firstDay: 1,
					monthNames: ['<?php echo @JANUARY;?>
','<?php echo @FEBRUARY;?>
','<?php echo @MARCH;?>
','<?php echo @APRIL;?>
','<?php echo @MAY;?>
','<?php echo @JUNE;?>
','<?php echo @JULY;?>
','<?php echo @AUGUST;?>
','<?php echo @SEPTEMBER;?>
','<?php echo @OCTOBER;?>
','<?php echo @NOVEMBER;?>
','<?php echo @DECEMBER;?>
']
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
				moffset = (moffset = $('#<?php echo $_smarty_tpl->tpl_vars['currMenu']->value;?>
').offset()) ? moffset.top - mpos.top : 0;
				$('.menu_scroll').height(hmenu).scrollTop(moffset);
				hcontent = (cpos = $('.content_scroll').offset()) ? hdoc - cpos.top : 700;
				$('.content_scroll').height(hcontent);

				/***** Отображение алертов *****/
				$('#msgAlert').dialog({
					autoOpen: false,
					modal: true,
					resizable: false,
					buttons: {
						'<?php echo @SITE_CLOSE;?>
': function() {
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
</html><?php }} ?>