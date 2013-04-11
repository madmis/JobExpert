<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:05
         compiled from "templates/site/default\block.main.scrollable.vacancys.hot.tpl" */ ?>
<?php /*%%SmartyHeaderCode:317844faa4895be3993-20475344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f9d5de5b7062979a01f41ba1bb2d9efb8a25058' => 
    array (
      0 => 'templates/site/default\\block.main.scrollable.vacancys.hot.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '317844faa4895be3993-20475344',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'hot' => 0,
    'vacancy' => 0,
    'chpu' => 0,
    'sections' => 0,
    'professions' => 0,
    'regions' => 0,
    'citys' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa4895e05b6',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa4895e05b6')) {function content_4faa4895e05b6($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include 'I:\\home\\Smarty\\plugins\\function.counter.php';
if (!is_callable('smarty_modifier_date_format')) include 'I:\\home\\Smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_modifier_truncate')) include 'I:\\home\\Smarty\\plugins\\modifier.truncate.php';
?><?php if ($_smarty_tpl->tpl_vars['hot']->value['vacancy']){?>
<table style="width: 100%;">
	<tr>
		<td style="width: 30px;">
			<!-- "previous page" action -->
			<a class="prev browse left"></a>
		</td>
		<td>
			<!-- root element for scrollable -->
			<div class="scrollable">
				<!-- root element for the items -->
				<div class="items">

				<?php echo smarty_function_counter(array('start'=>0,'print'=>false),$_smarty_tpl);?>

				<?php  $_smarty_tpl->tpl_vars["vacancy"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["vacancy"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hot']->value['vacancy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["vacancy"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["vacancy"]->iteration=0;
 $_smarty_tpl->tpl_vars["vacancy"]->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["vacancy"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars["vacancy"]->key => $_smarty_tpl->tpl_vars["vacancy"]->value){
$_smarty_tpl->tpl_vars["vacancy"]->_loop = true;
 $_smarty_tpl->tpl_vars["vacancy"]->iteration++;
 $_smarty_tpl->tpl_vars["vacancy"]->index++;
 $_smarty_tpl->tpl_vars["vacancy"]->first = $_smarty_tpl->tpl_vars["vacancy"]->index === 0;
 $_smarty_tpl->tpl_vars["vacancy"]->last = $_smarty_tpl->tpl_vars["vacancy"]->iteration === $_smarty_tpl->tpl_vars["vacancy"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["vacancy"]['first'] = $_smarty_tpl->tpl_vars["vacancy"]->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["vacancy"]['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["vacancy"]['last'] = $_smarty_tpl->tpl_vars["vacancy"]->last;
?>
					
					<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['vacancy']['first']){?><div><?php }?>
						<span>
							<table style="height: 75px; width: 100%;">
								<!-- Можно программно огарничить длину заголовка объявления. На мой взгляд, это оптимальное решение. Иначе с дизайном трудности. -->
								<tr>
									<td style="vertical-align: top;">
										<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&amp;action=view&amp;id=".($_smarty_tpl->tpl_vars['vacancy']->value['tId']));?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vacancy']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo @FORM_TYPE_COMPANY;?>
 - <?php echo $_smarty_tpl->tpl_vars['vacancy']->value['company_name'];?>
, <?php echo $_smarty_tpl->tpl_vars['sections']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_section']]['name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['professions']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_profession']]['name'];?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['regions']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_region']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php if ($_smarty_tpl->tpl_vars['vacancy']->value['id_city']){?> - <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['citys']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_city']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>, <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['vacancy']->value['act_datetime'],@CONF_DATE_FORMAT);?>
 - <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['vacancy']->value['token_datetime'],@CONF_DATE_FORMAT);?>
, <?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_from'];?>
<?php if ($_smarty_tpl->tpl_vars['vacancy']->value['pay_post']){?>-<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_post'];?>
<?php }?> <?php echo $_smarty_tpl->tpl_vars['vacancy']->value['currency'];?>
"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['vacancy']->value['title'],25);?>
</a>
									</td>
								</tr>
								<tr>
									<td style="vertical-align: top; font-weight: bold;">
										<?php if ($_smarty_tpl->tpl_vars['vacancy']->value['pay_post']){?><?php echo @SITE_FROM;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_from'];?>
&nbsp;<?php echo @SITE_UNTO;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_post'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['vacancy']->value['pay_from'];?>
<?php }?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['vacancy']->value['currency'];?>

									</td>
								</tr>
								<tr>
									<td style="vertical-align: bottom; font-size: 11px;">
										<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['regions']->value[$_smarty_tpl->tpl_vars['vacancy']->value['id_region']]['name'], ENT_QUOTES, 'UTF-8', true);?>

									</td>
								</tr>
							</table>
						</span>
					<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['vacancy']['last']){?>
						</div>
					<?php }elseif(!($_smarty_tpl->getVariable('smarty')->value['foreach']['vacancy']['iteration'] % 3)){?>
						</div><div>
					<?php }?>
				<?php } ?>

				</div>
			</div>
		</td>
		<td style="width: 30px;">
			<!-- "next page" action -->
			<a class="next browse right"></a>
		</td>
	</tr>
</table>

<br clear="all" />
<script type="text/javascript">
<!--
// execute your scripts when the DOM is ready. this is mostly a good habit
$(function() {
	// initialize scrollable
	$(".scrollable").scrollable();
});
-->
</script>
<?php }?><?php }} ?>