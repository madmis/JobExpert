<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="Resource-type" content="document">
		<meta name="Document-state" content="dynamic">
		<title>{$smarty.const.INSTALLATION_TITLE}</title>
		<link rel="stylesheet" type="text/css" href="install/templates/style/style.css">

		<!-- JQUERY -->
		<script type="text/javascript" src="core/js/jquery/jquery.js"></script>
		<script type="text/javascript" src="core/js/jquery/plugins/jquery.cookie.js"></script>
		<!-- JQUERY -->

		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	</head>
	<body>
		<!-- Проверка кукисов и JavaScript -->
		<div id="cookieDisabled">{$smarty.const.COOKIE_DISABLED}</div>
		<script type="text/javascript">
		<!--
			(!navigator.cookieEnabled) ? $('#cookieDisabled').show(1000) : null;
		-->
		</script>
		<noscript><div id="noScript">{$smarty.const.JAVASCRIPT_DISABLED}</div></noscript>
		<!-- Проверка кукисов и JavaScript -->

		<div class="tHead">
			<img src="install/templates/images/logo.png" alt="Logo" class="tLogo">
			<img src="install/templates/images/ttext.png" alt="{$smarty.const.INSTALLATION_TITLE}" class="tText">
		</div>

		<div class="tCenter">
			{* Ошибки *}
			{if $arrErrors}
				<div class="error">
					{foreach from=$arrErrors item="error"}
						<p>{$error}</p>
					{/foreach}
				</div>
			{/if}
			{* Подключаемый шаблон *}
			{include file=$mainTemplate}
		</div>

		<div class="tBottom">
			<img src="install/templates/images/ru.png" alt="{$smarty.const.INSTALLATION_TITLE}" class="tLang" id="russian" alt="RU" title="RU">
			<img src="install/templates/images/uk.png" alt="{$smarty.const.INSTALLATION_TITLE}" class="tLang" id="english" alt="EN" title="EN">
			<p><a href="{$smarty.const.SDG_URL}" class="copy">&copy; SD-Group</a></p>
		</div>
	</body>
</html>

<script type="text/javascript">
<!--
$(function() {
	$('.tLang').click( function() {
		$.cookie('instLang', this.id);
		location.reload();
	});
	
});
-->
</script>