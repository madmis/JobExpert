<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:04
         compiled from "templates/site/default\block.site.head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:233124faa489447cb34-99310166%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3feefce2675f0d26146697ec763f37a42691f629' => 
    array (
      0 => 'templates/site/default\\block.site.head.tpl',
      1 => 1336142862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '233124faa489447cb34-99310166',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'chpu' => 0,
    'siteLangs' => 0,
    'lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa48945d569',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa48945d569')) {function content_4faa48945d569($_smarty_tpl) {?>
<table style="width: 100%; border: 0px;" cellpadding="0" cellspacing="0">
	<tr>
		<td class="DesignTopLogo" nowrap="nowrap">
			<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value));?>
" title="<?php echo @CONF_SITE_NAME;?>
">
				<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/topLogo.png" alt="<?php echo @CONF_SITE_NAME;?>
">
			</a>
			<!--<g:plusone size="tall"></g:plusone>-->
		</td>
		<td class="DesignTopLangButtons">
			<?php if ($_smarty_tpl->tpl_vars['siteLangs']->value){?>
				<ul class="langMenu">
					<?php  $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['siteLangs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['lang']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['lang']->iteration=0;
 $_smarty_tpl->tpl_vars['lang']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['lang']->key => $_smarty_tpl->tpl_vars['lang']->value){
$_smarty_tpl->tpl_vars['lang']->_loop = true;
 $_smarty_tpl->tpl_vars['lang']->iteration++;
 $_smarty_tpl->tpl_vars['lang']->index++;
 $_smarty_tpl->tpl_vars['lang']->first = $_smarty_tpl->tpl_vars['lang']->index === 0;
 $_smarty_tpl->tpl_vars['lang']->last = $_smarty_tpl->tpl_vars['lang']->iteration === $_smarty_tpl->tpl_vars['lang']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['langs']['first'] = $_smarty_tpl->tpl_vars['lang']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['langs']['last'] = $_smarty_tpl->tpl_vars['lang']->last;
?>
						<li id="<?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
"<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['langs']['first']){?> class="hidden<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['langs']['last']){?> last<?php }?>"<?php }?>>
							<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icoLangs/<?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
.png" title="<?php echo $_smarty_tpl->tpl_vars['lang']->value['description'];?>
" alt="">
						</li>
					<?php } ?>
				</ul>
				<div class="ulLabel"><?php echo @SITE_LANGUAGE;?>
:&nbsp;</div>
			<?php }else{ ?>
				&nbsp;
			<?php }?>
		</td>
		<td class="DesignTopNaviButtonDelimiter40">&nbsp;</td>
		<td class="DesignTopNaviButtonHome">
			<a class="active" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value));?>
" title="<?php echo @MENU_MAIN;?>
"></a>
		</td>
		<td class="DesignTopNaviButtonMap">
			<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=sitemap");?>
" title="<?php echo @MENU_SITEMAP;?>
"></a>
		</td>
		<td class="DesignTopNaviButtonContact">
			<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=feedback");?>
" title="<?php echo @MENU_FEEDBACK;?>
"></a>
		</td>
		<td class="DesignTopNaviButtonDelimiter10">&nbsp;</td>
	</tr>
</table>
<?php echo $_smarty_tpl->getSubTemplate ("top.menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript">
<!--
$(document).ready(function() {
	$('.langMenu li:first').wrapInner(document.createElement('span'));
	$('.langMenu').click(function () {
		$(this).find('.hidden').slideToggle().click(function () {
			$.cookie('currLang', $(this).attr('id'), { path: '/', expires: 30 });
			location.reload();
			var currLang = $(this).clone().removeClass('hidden last').wrapInner(document.createElement('span'));
			$('.langMenu').empty().append(currLang);
		});
	});
});
-->
</script><?php }} ?>