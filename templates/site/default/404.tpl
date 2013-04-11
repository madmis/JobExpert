<!DOCTYPE html>
<html>
	<head>
		<meta charset="{$smarty.const.CONF_DEFAULT_CHARSET}">

		<meta name="Resource-type" content="document">
		<meta name="Document-state" content="dynamic">

		<title>{$smarty.const.ERROR_404} - {$smarty.const.ERROR_404_DESCRIPTION}</title>

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
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td style="background-color: #CC3333; color: #FFFFFF; font-weight: bold; font-size: 28pt; padding: 5px;">
					<i>{$smarty.const.CONF_SITE_NAME}</i>
				</td>
			</tr>
			<tr>
				<td>
					<h1 style="color: #CC3333; text-align: center;">- {$smarty.const.ERROR_404} -</h1>
				</td>
			</tr>
			<tr>
				<td style="text-align: center;">
					<p>{$smarty.const.ERROR_404_MESSAGE_REQUIRED_PAGE} '<b>http://{$smarty.server.HTTP_HOST}{$smarty.server.REQUEST_URI}</b>' {$smarty.const.ERROR_404_MESSAGE_NOT_EXIST}!</p>
				</td>
			</tr>
			<tr>
				<td>
					<p class="p_5 p_bold">{$smarty.const.ERROR_404_RECOMMENDATIONS}:</p>
   					<ul type="disc" style="margin: 0px 0px 20px 0px;">
   						<li>{$smarty.const.ERROR_404_RECOMMENDATIONS_CHECK_URL}</li>
   						<li>{$smarty.const.ERROR_404_RECOMMENDATIONS_BACK_TO} <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type")}">{$smarty.const.ERROR_404_RECOMMENDATIONS_BACK_TO_MAIN_PAGE_LINK}</a> {$smarty.const.ERROR_404_RECOMMENDATIONS_BACK_TO_MAIN_PAGE}</li>
   					</ul>
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