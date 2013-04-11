<!DOCTYPE html>
<html>
	<head>
		<meta charset="{$smarty.const.CONF_DEFAULT_CHARSET}">

		<meta name="Resource-type" content="document">
		<meta name="Document-state" content="static">

		<title>{$smarty.const.CONF_DEFAULT_TITLE}</title>

		<meta name="Keywords" content="{$smarty.const.CONF_DEFAULT_KEYWORDS}">
		<meta name="Description" content="{$smarty.const.CONF_DEFAULT_DESCRIPTION}">

		<style type="text/css">
			a.white:link {
				text-decoration: none;
				color: #FFFFFF;
				font-family: Verdana, Sans-serif;
			}
			a.white:visited {
				text-decoration: none;
				color: #FFFFFF;
				font-family: Verdana, Sans-serif;
			}
			a.white:active {
				text-decoration: none;
				color: #FFFFFF;
				font-family: Verdana, Sans-serif;
			}
			a.white:hover {
				text-decoration: none;
				color: #000000;
				font-family: Verdana, Sans-serif;
			}
			.copyright {
				background-color: #CC3333;
				color: #FFFFFF;
				padding: 5px;
				font-size: 8pt;
				text-align: center;
				font-family: Verdana, Sans-serif;
				cursor: default;
			}
		</style>
	</head>
	<body>

		<script type="text/javascript">
		<!--
		var srcImage;
		var arrImages;

		function preloadImages() {
			if (document.images) {
				srcImage = preloadImages.arguments;
				arrImages = new Array(srcImage.length);

				for (var i = 0; i < srcImage.length; i++) {
					arrImages[i] = new Image;
					arrImages[i].src = srcImage[i];
				}
			}
		}

		preloadImages('{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/maintenance.png');
		-->
		</script>

		<table style="width: 100%;">
			<tr>
				<td style="background-color: #CC3333; color: #FFFFFF; font-weight: bold; font-size: 28pt; padding: 3px;">
					<i>{$smarty.const.CONF_SITE_NAME}</i>
				</td>
			</tr>
			<tr>
				<td style="text-align: center;">
					<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/maintenance.png" alt="">
				</td>
			</tr>
			<tr>
				<td class="copyright">
					{assign var="year" value=$smarty.now|date_format:"%Y"}
					Works on the engine <a href="http://sd-group.org.ua/" class="white"><b>Expert</b></a><br>
					&copy;&nbsp;<a href="http://sd-group.org.ua/" class="white"><b>SD-Group</b></a>&nbsp;{$year} - {$year + 5}
				</td>
			</tr>
		</table>
	</body>
</html>