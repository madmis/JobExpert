<form action="install.php?step=1" method="post" enctype="multipart/form-data">
<h2 class="center">{$smarty.const.DB_CONFIG_HEAD}</h2>
<table class="centerTable configTable">
	<tr class="thead">
		<td colspan="2">{$smarty.const.DB_CONFIG_MYSQL_HEAD}</td>
	</tr>
	<tr>
		<td>{$smarty.const.DB_CONFIG_MYSQL_SERVER}</td>
		<td><input type="text" name="db_host" value="{$retFields.db_host|default:$smarty.const.SDG_DEFAULT_DB_HOST}"></td>
	</tr>
	<tr>
		<td>{$smarty.const.DB_CONFIG_MYSQL_NAME}</td>
		<td><input type="text" name="db_name" value="{$retFields.db_name|default:$smarty.const.SDG_DEFAULT_DB_NAME}"></td>
	</tr>
	<tr>
		<td>{$smarty.const.DB_CONFIG_MYSQL_USER}</td>
		<td><input type="text" name="db_user" value="{$retFields.db_user|default:$smarty.const.SDG_DEFAULT_DB_USER}"></td>
	</tr>
	<tr>
		<td>{$smarty.const.DB_CONFIG_MYSQL_PASSWORD}</td>
		<td><input type="text" name="db_pass" value="{$retFields.db_pass|default:$smarty.const.SDG_DEFAULT_DB_PASS}"></td>
	</tr>
	<tr class="thead">
		<td colspan="2">{$smarty.const.DB_CONFIG_ADDITIONAL_DATA_HEAD}</td>
	</tr>
	<tr>
		<td>{$smarty.const.DB_CONFIG_ADDITIONAL_DATA_DB_PREFIX}</td>
		<td><input type="text" name="db_prefix" value="{$retFields.db_prefix|default:$smarty.const.SDG_DEFAULT_DB_PREFIX}"></td>
	</tr>
	<tr>
		<td>{$smarty.const.DB_CONFIG_ADDITIONAL_DATA_USER_PREFIX}</td>
		<td><input type="text" name="usr_prefix" value="{$retFields.usr_prefix|default:$smarty.const.SDG_DEFAULT_USR_PREFIX}"></td>
	</tr>
	<tr>
		<td>{$smarty.const.DB_CONFIG_ADDITIONAL_DATA_DB_CHARSET}</td>
		<td>
			<select name="db_charset">
				{foreach from=$arrDBCharset item="dbCharset"}
				<option value="{$dbCharset}" {if $retFields.db_charset eq $dbCharset}selected{/if}>{$dbCharset}</option>
				{/foreach}
			</select>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.DB_CONFIG_ADDITIONAL_DATA_DEFAULT_CHARSET}</td>
		<td>
			<select name="site_charset">
				{foreach from=$arrSiteCharset item="siteCharset"}
				<option value="{$siteCharset}" {if $retFields.site_charset eq $siteCharset}selected{/if}>{$siteCharset}</option>
				{/foreach}
			</select>
		</td>
	</tr>
</table>
<div class="form">
	<!--<span class="floatLeft"><a href="install.php?step=2" class="prevButton"><< {$smarty.const.BUTTON_PREV}</a></span>-->
	<span class="floatRight"><input type="submit" name="step1" class="nextButton" value="{$smarty.const.BUTTON_NEXT} >>"></span>
</div>
</form>
