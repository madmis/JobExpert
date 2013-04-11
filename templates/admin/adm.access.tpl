<!DOCTYPE html>
<html>
	<head>
		<meta charset="{$smarty.const.CONF_DEFAULT_CHARSET}">

		<link rel="stylesheet" type="text/css" href="{$smarty.const.TEMPLATE_PATH_ADMIN}style/style.css">

		<title>{$smarty.const.FORM_ADMIN_LOGIN_HEAD}</title>
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
		{$smarty.const.COOKIE_DISABLED}
	</p>
	<script type="text/javascript">
	<!--
		(!navigator.cookieEnabled) ? document.getElementById('coockie_disabled').style.display = 'block' : null;
	-->
	</script>
	<noscript>
		<p style="color: red; text-align: center;">{$smarty.const.JAVASCRIPT_DISABLED}</p>
	</noscript>

	<table style="width: 100%;">
		<tr>
			<td align="center">
				{* Ошибки *}
				{if $errors}
					{include file="adm.errors.message.tpl"}
				{/if}
			</td>
		</tr>
		<tr>
			<td align="center">
				<form action="{$smarty.const.CONF_ADMIN_FILE}" method="post" enctype="multipart/form-data">
				<table cellspacing="0" cellpadding="0" class="table_normal" style="width: 350px; border: 0px; text-align: left;">
					<tr>
						<td colspan="2" align="center" style="background-color: #CC3333;">
							<p style="font-size: 12px; font-weight: bold; color: #FFFFFF;">{$smarty.const.FORM_ADMIN_LOGIN_HEAD}</p>
						</td>
					</tr>
					<tr>
						<td rowspan="3" align="left" style="width: 90px;">
							<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/login.png" alt="">
						</td>
						<td style="padding-top: 10px;">
							<b>{$smarty.const.FORM_LOGIN}</b>
							<p class="p_5"><input type="text" name="login" class="text" size="30"></p>
						</td>
					</tr>
					<tr>
						<td>
							<b>{$smarty.const.FORM_PASSWORD}</b>
							<p class="p_5"><input type="password" name="password" class="text" size="30"></p>
						</td>
					</tr>
					{if $secure}
					<tr>
						<td align="left" nowrap>
							<table>
								<tr>
									<td align="right">{include file="adm.securimage.tpl"}</td>
									<td align="left"><p class="p_5"><input type="text" size="10" name="keystring" class="text"></p></td>
								</tr>
							</table>
						</td>
					</tr>
					{/if}
					<tr>
						<td colspan="2" align="center">
							<p class="p_5"><input type="submit" name="authorize" value="{$smarty.const.FORM_BUTTON_LOGIN}" class="button"></p>
						</td>
					</tr>
				</table>
				</form>
			</td>
		</tr>
	</table>
</body>
</html>
