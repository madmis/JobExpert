<div class="sub_menu">
	<div style="float: left;">
		<form action="{$smarty.const.CONF_ADMIN_FILE}{$seoUrl}" method="post" enctype="multipart/form-data">
			&nbsp;{$smarty.const.FORM_SELECT_LANGUAGE}:&nbsp;
			<select name="currLocaliz" class="langSelect">
				{foreach from=$langs item="lang"}
					<option value="{$lang}"{if $lang eq $currLang} selected{/if}>{$lang}</option>
				{/foreach}
			</select>
		</form>
	</div>
	<div class="colorbox_help" id="HELP_ADMIN_SEO_FILES">
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}">
	</div>
</div>

{if $seo}
<form action="{$smarty.const.CONF_ADMIN_FILE}{$seoUrl}" method="post" enctype="multipart/form-data">
{foreach from=$seo key="key" item="item"}
<table style="width: 100%; border: 0px;" cellspacing="10" cellpadding="5">
	<thead class="data_head" style="cursor: pointer;">
		<tr>
			<td class="toggleList">{$key}</td>
		</tr>
	</thead>
	<tbody class="data_body">
		<tr>
			<td>
				<textarea name="{$key}" cols="100" rows="3" style="padding: 5px;">{$item}</textarea>
			</td>
		</tr>
	</tbody>
</table>
{/foreach}
<table style="width: 100%; border: 0px;" cellspacing="10" cellpadding="5">
	<tfoot class="data_foot">
		<tr>
			<td><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></td>
		</tr>
	</tfoot>
</table>
</form>
{/if}
	

<script type="text/javascript">
<!--
$(function() {
    $('.langSelect').change(function() {
		$(this).parent('form').submit();
	});
	$('.toggleList').click(function() {
		$(this).parents('thead').next().toggle();
	});
});
-->
</script>
