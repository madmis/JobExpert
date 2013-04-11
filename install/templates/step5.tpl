<form action="install.php?step=5" method="post" enctype="multipart/form-data">
<h2 class="center">{$smarty.const.ADMIN_CONF_HEAD}</h2>
<table class="centerTable configTable">
	<tr>
		<td>{$smarty.const.ADMIN_CONF_ADMINFILE}</td>
		<td><input type="text" name="adminfile" value="{$smarty.const.CONF_ADMIN_FILE}"></td>
	</tr>
	<tr class="thead">
		<td colspan="3">{$smarty.const.ADMIN_CONF_DATA}</td>
	</tr>
	<tr>
		<td>{$smarty.const.ADMIN_CONF_LOGIN}</td>
		<td><input type="text" name="login" value="{$retFields.login|default:$smarty.const.SDG_DEFAULT_ADMIN_LOGIN}"></td>
	</tr>
	<tr>
		<td>{$smarty.const.ADMIN_CONF_PASSWORD}</td>
		<td><input type="text" name="password" value="{$retFields.password|default:$smarty.const.SDG_DEFAULT_ADMIN_PASSWORD}"></td>
	</tr>
	<tr>
		<td>{$smarty.const.ADMIN_CONF_EMAIL}</td>
		<td><input type="text" name="email" size="40" value="{$retFields.email|default:$smarty.const.SDG_DEFAULT_ADMIN_EMAIL}"></td>
	</tr>
</table>
<div class="form">
	<span class="floatLeft"><a href="install.php?step=4" class="prevButton"><< {$smarty.const.BUTTON_PREV}</a></span>
	<span class="floatRight"><input type="submit" name="step5" class="nextButton" value="{$smarty.const.BUTTON_NEXT} >>"></span>
</div>
</form>