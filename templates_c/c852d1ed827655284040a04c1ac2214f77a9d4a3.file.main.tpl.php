<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:05
         compiled from "templates/site/default\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:231154faa4895978504-48628305%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c852d1ed827655284040a04c1ac2214f77a9d4a3' => 
    array (
      0 => 'templates/site/default\\main.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '231154faa4895978504-48628305',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user_type' => 0,
    'user_email' => 0,
    'chpu' => 0,
    'mainLogo' => 0,
    'mainAgnLogo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa4895bd9ff',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa4895bd9ff')) {function content_4faa4895bd9ff($_smarty_tpl) {?><div class="DesignMainPageBody">
	<br>
	<?php if ($_smarty_tpl->tpl_vars['user_type']->value=='agent'||$_smarty_tpl->tpl_vars['user_type']->value=='competitor'){?>
		<?php echo $_smarty_tpl->getSubTemplate ('block.main.scrollable.vacancys.hot.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php }else{ ?>
		<?php echo $_smarty_tpl->getSubTemplate ('block.main.scrollable.resumes.hot.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php }?>
	<p class="shadow12">
		Проект создан группой разработчиков SD-Group - мы занимаемся разработкой и продвижением готовых решений для создания web-сайтов с тематикой "Board of bulletins" - доски объявлений.
	</p>

	<p class="shadow12">
		<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/arrInCirclce.png" alt="">
		<strong class="titleJob">Job</strong> <strong class="titleExpert">Expert</strong> - является скриптом, специализирующимся на поиске работы для частных лиц, а также подборе персонала для организаций и рекрутинговых агентств.
	</p>

	<p class="shadow12">
		<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/arrInCirclce.png" alt="">
		<strong class="titleJob">Job</strong> <strong class="titleExpert">Expert</strong> - предназначен для Вас, владельцев ресурсов размещенных в глобальной сети Интернет.
	</p>
	<?php if (@CONF_VACANCY_VIP_SHOW||@CONF_RESUME_VIP_SHOW){?><?php echo $_smarty_tpl->getSubTemplate ('block.main.announces.vip.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<br><?php }?>

	<?php if (!$_smarty_tpl->tpl_vars['user_email']->value){?>
		<img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/arrInCirclce.png" alt="">
		<strong class="shadow12">Тестовые аккаунты зарегистрированные в системе</strong>

		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th>&nbsp;</th>
				<th>Администратор</th>
				<th>Соискатель</th>
				<th>Работодатель</th>
				<th>Агентство</th>
				<th>Компания</th>
			</tr>
			<tr>
				<td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/mainBodyTableUser.gif" alt=""></td>
				<td><strong>admin</strong></td>
				<td><strong>competitor@c.com</strong></td>
				<td><strong>employer@c.com</strong></td>
				<td><strong>agent@c.com</strong></td>
				<td class="last"><strong>company@c.com</strong></td>
			</tr>
			<tr>
				<td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/mainBodyTableZamok.gif" alt=""></td>
				<td><strong>admin</strong></td>
				<td><strong>competitor</strong></td>
				<td><strong>employer</strong></td>
				<td><strong>agent</strong></td>
				<td class="last"><strong>company</strong></td>
			</tr>
			<tr>
				<td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/mainBodyTableEarth.png" alt=""></td>
				<td>
					<div class="ContentWrapper" align="center">
						<form action="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @CONF_ADMIN_FILE;?>
" method="post" enctype="multipart/form-data">
							<input type="hidden" name="login" value="admin">
							<input type="hidden" name="password" value="admin">
							<div class="enterButtonLight">
								<input type="submit" class="shadow01red" name="authorize" value="<?php echo @FORM_BUTTON_LOGIN;?>
">
							</div>
						</form>
					</div>
				</td>
				<td>
					<div class="ContentWrapper" align="center">
						<form action="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=authorize");?>
" method="post" enctype="multipart/form-data">
							<input type="hidden" name="email" value="competitor@c.com">
							<input type="hidden" name="password" value="competitor">
							<div class="enterButtonLight">
								<input type="submit" class="shadow01red" value="<?php echo @FORM_BUTTON_LOGIN;?>
">
							</div>
						</form>
					</div>
				</td>
				<td>
					<div class="ContentWrapper" align="center">
						<form action="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=authorize");?>
" method="post" enctype="multipart/form-data">
							<input type="hidden" name="email" value="employer@c.com">
							<input type="hidden" name="password" value="employer">
							<div class="enterButtonLight">
								<input type="submit" class="shadow01red" value="<?php echo @FORM_BUTTON_LOGIN;?>
">
							</div>
						</form>
					</div>
				</td>
				<td>
					<div class="ContentWrapper" align="center">
						<form action="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=authorize");?>
" method="post" enctype="multipart/form-data">
							<input type="hidden" name="email" value="agent@c.com">
							<input type="hidden" name="password" value="agent">
							<div class="enterButtonLight">
								<input type="submit" class="shadow01red" value="<?php echo @FORM_BUTTON_LOGIN;?>
">
							</div>
						</form>
					</div>
				</td>
				<td class="last">
					<div class="ContentWrapper" align="center">
						<form action="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=authorize");?>
" method="post" enctype="multipart/form-data">
							<input type="hidden" name="email" value="company@c.com">
							<input type="hidden" name="password" value="company">
							<div class="enterButtonLight">
								<input type="submit" class="shadow01red" value="<?php echo @FORM_BUTTON_LOGIN;?>
">
							</div>
						</form>
					</div>
				</td>
			</tr>
		</table>
	<?php }?>
	<div class="AttentionWrapper"><div class="Attention shadow12">
		Просьба не менять настройки, которые могут повлиять на работу скрипта. Не удалять имеющиеся дополнительные страницы и новости. Можно добавлять и удалять свои записи.
	</div></div>

	<p class="shadow12 paddingText5">
		Просим активно высказывать свои пожелания, предложения, замечания!!!<br>
		Все вопросы, касательно анкет добавления объявлений, размещать в соответствующих темах:
	</p>

	<div class="resumeLeft shadow12">
		<strong>Резюме:</strong>
		<a href="http://sd-group.org.ua/index.php?topic=5.0">http://sd-group.org.ua/index.php?topic=5.0</a>
	</div>

	<div class="vacancyRight shadow12">
		<strong>Вакансии:</strong>
		<a href="http://sd-group.org.ua/index.php?topic=4.0">http://sd-group.org.ua/index.php?topic=4.0</a>
	</div>

	<div class="clearLeft">&nbsp;</div>
	<?php if ($_smarty_tpl->tpl_vars['mainLogo']->value){?><?php echo $_smarty_tpl->getSubTemplate ('block.main.logo.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['mainAgnLogo']->value){?><?php echo $_smarty_tpl->getSubTemplate ('block.main.agencies.logo.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>
	<?php if (@CONF_VACANCY_LAST_SHOW||@CONF_RESUME_LAST_SHOW){?><?php echo $_smarty_tpl->getSubTemplate ('block.main.announces.last.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<br><?php }?>
	<?php if (@CONF_NEWSES_LAST_SHOW){?><?php echo $_smarty_tpl->getSubTemplate ('block.main.newses.last.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<br><?php }?>
</div><?php }} ?>