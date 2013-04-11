<?php /* Smarty version Smarty-3.1.5, created on 2012-05-11 21:33:38
         compiled from "templates/admin\adm.access.tpl" */ ?>
<?php /*%%SmartyHeaderCode:245054fad4d72754736-63825510%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c22c1f4365e12a58dc5d59b2119320052e5bcdd2' => 
    array (
      0 => 'templates/admin\\adm.access.tpl',
      1 => 1336142866,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '245054fad4d72754736-63825510',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'secure' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fad4d729c9e4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad4d729c9e4')) {function content_4fad4d729c9e4($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<meta charset="<?php echo @CONF_DEFAULT_CHARSET;?>
">

		<link rel="stylesheet" type="text/css" href="<?php echo @TEMPLATE_PATH_ADMIN;?>
style/style.css">

		<title><?php echo @FORM_ADMIN_LOGIN_HEAD;?>
</title>
		<!-- JQUERY -->
			<script type="text/javascript" src="core/js/jquery/jquery.js"></script>
		<!-- JQUERY -->

		<!-- PLUGINS JQUERY -->

			<!-- JQUERY COOCKIE -->
				<script type="text/javascript" src="core/js/jquery/plugins/jquery.cookie.js"></script>
			<!-- JQUERY COOCKIE -->

		<!-- PLUGINS JQUERY -->
	</head>

<body>
	<p id="coockie_disabled" style="display: none; color: red; text-align: center;">
		<?php echo @COOKIE_DISABLED;?>

	</p>
	<script type="text/javascript">
	<!--
		(!navigator.cookieEnabled) ? document.getElementById('coockie_disabled').style.display = 'block' : null;
	-->
	</script>
	<noscript>
		<p style="color: red; text-align: center;"><?php echo @JAVASCRIPT_DISABLED;?>
</p>
	</noscript>

	<table style="width: 100%;">
		<tr>
			<td align="center">
				<?php if ($_smarty_tpl->tpl_vars['errors']->value){?>
					<?php echo $_smarty_tpl->getSubTemplate ("adm.errors.message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				<?php }?>
			</td>
		</tr>
		<tr>
			<td align="center">
				<form action="<?php echo @CONF_ADMIN_FILE;?>
" method="post" enctype="multipart/form-data">
				<table cellspacing="0" cellpadding="0" class="table_normal" style="width: 350px; border: 0px; text-align: left;">
					<tr>
						<td colspan="2" align="center" style="background-color: #CC3333;">
							<p style="font-size: 12px; font-weight: bold; color: #FFFFFF;"><?php echo @FORM_ADMIN_LOGIN_HEAD;?>
</p>
						</td>
					</tr>
					<tr>
						<td rowspan="3" align="left" style="width: 90px;">
							<img src="<?php echo @TEMPLATE_PATH_ADMIN;?>
images/login.png" alt="">
						</td>
						<td style="padding-top: 10px;">
							<b><?php echo @FORM_LOGIN;?>
</b>
							<p class="p_5"><input type="text" name="login" class="text" size="30"></p>
						</td>
					</tr>
					<tr>
						<td>
							<b><?php echo @FORM_PASSWORD;?>
</b>
							<p class="p_5"><input type="password" name="password" class="text" size="30"></p>
						</td>
					</tr>
					<?php if ($_smarty_tpl->tpl_vars['secure']->value){?>
					<tr>
						<td align="left" nowrap>
							<table>
								<tr>
									<td align="right"><?php echo $_smarty_tpl->getSubTemplate ("adm.securimage.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</td>
									<td align="left"><p class="p_5"><input type="text" size="10" name="keystring" class="text"></p></td>
								</tr>
							</table>
						</td>
					</tr>
					<?php }?>
					<tr>
						<td colspan="2" align="center">
							<p class="p_5"><input type="submit" name="authorize" value="<?php echo @FORM_BUTTON_LOGIN;?>
" class="button"></p>
						</td>
					</tr>
				</table>
				</form>
			</td>
		</tr>
	</table>
</body>
</html>
<?php }} ?>