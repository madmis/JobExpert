<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:03
         compiled from "templates/site/default\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:65944faa4893d07999-84570295%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ff539733d00b1dcdad6dc6bce900d477629c488' => 
    array (
      0 => 'templates/site/default\\index.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65944faa4893d07999-84570295',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'xmlTemplate' => 0,
    'mods' => 0,
    'advert' => 0,
    'block' => 0,
    'namePage' => 0,
    'page' => 0,
    'main_template' => 0,
    'ScriptWorkReport' => 0,
    'query' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa489424865',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa489424865')) {function content_4faa489424865($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'I:\\home\\Smarty\\plugins\\modifier.truncate.php';
?><!DOCTYPE html>
<html>
<?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


	<body>
		<!-- Проверка кукисов и JavaScript -->
		<div id="coockie_disabled"><?php echo @COOKIE_DISABLED;?>
</div>
		<script type="text/javascript">
		<!--
			(!navigator.cookieEnabled) ? $('#coockie_disabled').show(1000) : null;
		-->
		</script>
		<noscript><p class="noscript"><?php echo @JAVASCRIPT_DISABLED;?>
</p></noscript>
		<!-- Проверка кукисов и JavaScript -->

		<?php if ($_smarty_tpl->tpl_vars['xmlTemplate']->value){?>
			<table style="width: 100%; min-width:1200px;" cellpadding="0" cellspacing="0">
				<?php if ($_smarty_tpl->tpl_vars['mods']->value['adsimple']['token']=='active'&&$_smarty_tpl->tpl_vars['advert']->value->get('toper')){?>
					<tr>
						<td colspan="3" style="padding: 5px;">
							<center><?php echo $_smarty_tpl->tpl_vars['advert']->value->getShuffleCode('toper');?>
</center>
						</td>
					</tr>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['xmlTemplate']->value['head_site']){?>
					<tr>
						<td colspan="3">
							<?php  $_smarty_tpl->tpl_vars["block"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["block"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['xmlTemplate']->value['head_site']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["block"]->key => $_smarty_tpl->tpl_vars["block"]->value){
$_smarty_tpl->tpl_vars["block"]->_loop = true;
?>
								<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['block']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

							<?php } ?>
						</td>
					</tr>
				<?php }?>

				<tr>
						<?php if ($_smarty_tpl->tpl_vars['xmlTemplate']->value['left_side']){?>
							<td class="DesignSideBarLeft" valign="top">
								<?php  $_smarty_tpl->tpl_vars["block"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["block"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['xmlTemplate']->value['left_side']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["block"]->key => $_smarty_tpl->tpl_vars["block"]->value){
$_smarty_tpl->tpl_vars["block"]->_loop = true;
?>
									<?php if ($_smarty_tpl->tpl_vars['block']->value=='advertisment'){?>
										<?php if ($_smarty_tpl->tpl_vars['mods']->value['adsimple']['token']=='active'&&$_smarty_tpl->tpl_vars['advert']->value->get('advertisement_left')){?>
											<table cellspacing="0" cellpadding="0" style="width: 100%;">
												<tr>
													<td class="text_block">
														<?php echo $_smarty_tpl->tpl_vars['advert']->value->getShuffleCode('advertisement_left');?>

													</td>
												</tr>
											</table>
										<?php }?>
									<?php }else{ ?>
										<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['block']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

									<?php }?>
								<?php } ?>
							</td>
						<?php }?>
						<td align="center" class="td_center">
							<?php if ($_smarty_tpl->tpl_vars['mods']->value['adsimple']['token']=='active'&&$_smarty_tpl->tpl_vars['advert']->value->get('advertisement_top')){?>
								<?php echo $_smarty_tpl->tpl_vars['advert']->value->getShuffleCode('advertisement_top');?>

							<?php }?>

							<?php if ((($tmp = @$_smarty_tpl->tpl_vars['namePage']->value)===null||$tmp==='' ? false : $tmp)){?>
								<h1 class="DesignPageHeader">
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
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['page']->value['name'],150,'...');?>
</a><?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['page']['last']){?>&nbsp;&raquo;<?php }?>
										<?php }else{ ?>
											<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['page']->value['name'],150,'...');?>
<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['page']['last']){?>&nbsp;&raquo;<?php }?>
										<?php }?>
									<?php } ?>
								</h1>
							<?php }?>
							<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['main_template']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

							<?php if ($_smarty_tpl->tpl_vars['mods']->value['adsimple']['token']=='active'&&$_smarty_tpl->tpl_vars['advert']->value->get('advertisement_bottom')){?>
								<?php echo $_smarty_tpl->tpl_vars['advert']->value->getShuffleCode('advertisement_bottom');?>

							<?php }?>

							<!-- Holy hack for IE6 min-width -->
							<div style="width:650px; height:1px; font-size:1px; clear:both;">&nbsp;</div>
						</td>
						<?php if ($_smarty_tpl->tpl_vars['xmlTemplate']->value['right_side']){?>
							<td class="DesignSideBarRight" valign="top">
								<?php  $_smarty_tpl->tpl_vars["block"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["block"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['xmlTemplate']->value['right_side']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["block"]->key => $_smarty_tpl->tpl_vars["block"]->value){
$_smarty_tpl->tpl_vars["block"]->_loop = true;
?>
									<?php if ($_smarty_tpl->tpl_vars['block']->value=='advertisment'){?>
										<?php if ($_smarty_tpl->tpl_vars['mods']->value['adsimple']['token']=='active'&&$_smarty_tpl->tpl_vars['advert']->value->get('advertisement_right')){?>
											<table cellspacing="0" cellpadding="0" style="width: 100%;">
												<tr>
													<td class="text_block">
														<?php echo $_smarty_tpl->tpl_vars['advert']->value->getShuffleCode('advertisement_right');?>

													</td>
												</tr>
											</table>
										<?php }?>
									<?php }else{ ?>
										<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['block']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

									<?php }?>
								<?php } ?>
							</td>
						<?php }?>
				</tr>

				<tr>
					<td colspan="3">
						<?php echo $_smarty_tpl->getSubTemplate ('block.main.footer.job.sections.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					</td>
				</tr>
				<?php if ($_smarty_tpl->tpl_vars['xmlTemplate']->value['foot_site']){?>
					<tr>
						<td colspan="3">
							<?php  $_smarty_tpl->tpl_vars["block"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["block"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['xmlTemplate']->value['foot_site']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["block"]->key => $_smarty_tpl->tpl_vars["block"]->value){
$_smarty_tpl->tpl_vars["block"]->_loop = true;
?>
								<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['block']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

							<?php } ?>
						</td>
					</tr>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['mods']->value['adsimple']['token']=='active'&&$_smarty_tpl->tpl_vars['advert']->value->get('bottomer')){?>
					<tr>
						<td colspan="3" style="padding: 5px;">
							<center><?php echo $_smarty_tpl->tpl_vars['advert']->value->getShuffleCode('bottomer');?>
</center>
						</td>
					</tr>
				<?php }?>

			</table>
		<?php }?>

		<?php if (@TEMPLATE_DEBUGGING){?>
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
					//запросы к базе
					$('.lastQuerys').click(function() {
						$.fn.colorbox({ html: $('#lastQuerys').html(), preloading: true, opacity: 0, open: true, maxWidth: '100%', maxHeight: '100%', scrolling: true });
						$(this).parent().css('overflow-x','hidden');
					});
				});
			-->
			</script>
		<?php }?>

		<script type="text/javascript">
		<!--
			$(document).ready(function() {
				// проверяем кукисы меню
				if (currCookie = $.cookie('closedUserBlocks')) {
					for (var i in arrlist = currCookie.split(',')) {
						$('#' + arrlist[i]).addClass('closed').next().hide();
					}
				}
				// обрабатываем клики меню
				$('.sideBlockHeader').click(function() {
					$(this).toggleClass('closed').next().toggle('fast');
					var arrlist = [];
					$('.closed').each(function() {
						arrlist.push($(this).attr('id'));
					});
					$.cookie('closedUserBlocks', arrlist.join(), { path: '/', expires: 30 });
				});
				$('.openLink').click(function () {
					window.location.href = $(this).find('.gotoLink').val();
				});
			});
		-->
		</script>
	</body>
</html><?php }} ?>