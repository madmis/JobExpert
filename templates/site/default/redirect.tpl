<!DOCTYPE html>
<html>
	<head>
		<meta charset="{$smarty.const.CONF_DEFAULT_CHARSET}">

		<meta name="Resource-type" content="document">
		<meta name="Document-state" content="static">

		<title>{$smarty.const.CONF_DEFAULT_TITLE}</title>

		<meta name="Keywords" content="{$smarty.const.CONF_DEFAULT_KEYWORDS}">
		<meta name="Description" content="{$smarty.const.CONF_DEFAULT_DESCRIPTION}">

        <script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/js/jquery/jquery.js"></script>

		<style type="text/css">
			p {
				color: #000000;
				font-size: 14px;
				font-family: Verdana, Sans-serif;
				padding: 0px 0px 15px 0px;
			}
			p.redirect {
				padding: 15px 0px 0px 0px;
				border-top: 2px dotted #FFFFFF;
			}

            #noWait {
				font-size: 10px;
                cursor: pointer;
            }
		</style>
	</head>
	<body>
		<table border="0" width="100%">
			<tr>
				<td align="center">
					<table border="0" width="80%" style="margin-top: 100px; text-align: center;">
						<tr>
							<td style="background-color: #DA6969; color: #FFFFFF; font-family: Verdana, Sans-serif; font-weight: bold; text-align: center;">
                                {$smarty.const.SITE_ATTENTION}!
							</td>
						</tr>
						<tr>
							<td style="padding: 15px; background-color: #F4D7D7; font-family: Verdana, Sans-serif; text-align: center;">
								<p>
                                    {$smarty.const.MESSAGE_REDIRECT_URL_LEAVE}.
                                    <br>
                                    {$smarty.const.MESSAGE_REDIRECT_URL_RECOMMENDATIONS}.
                                </p>
								<p>
                                    {$smarty.const.MESSAGE_REDIRECT_URL_NOTRESPONSIBLE}.
                                </p>
								<p class="redirect">
                                    {$smarty.const.MESSAGE_REDIRECT_URL_AUTOREDIRECT_AFTER}&nbsp;
                                    <span id="redirect" data-url="{$redirect}" style="font-weight: bold;">15</span>
                                </p>
                                <div id="noWait">{$smarty.const.MESSAGE_CLICK_NOWAIT}...</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
        <script type="text/javascript">
        <!--
        $(document).ready(function () {
            var timeOut = $('#redirect').text()*1,
				validUrl = $('#redirect').data('url');

			validUrl = 'http://' + validUrl.replace('http://', '')
			setTimeout(function() {
                window.location.href = validUrl;
            }, timeOut*1000);
            setInterval(function() {
                if (0 < timeOut) {
                    $('#redirect').text(--timeOut);
                } else {
                    $('#redirect').text('...');
                }
            }, 1000)
            $('#noWait').click(function() {
                window.location.href = validUrl;
            });
        });
        -->
        </script>
	</body>
</html>