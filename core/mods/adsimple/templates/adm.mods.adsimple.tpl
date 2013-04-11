<p class="sub_menu">
	<span class="mods_help" id="adsimple_help"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png"></span>
<div class="open_close"><div id="mod_adsimple_help">{$smarty.const.MOD_ADSIMPLE_HELP}</div></div>
</p>

{if $errors}<div class="td_errors">{foreach from=$errors item="error"}<p>{$error}</p>{/foreach}</div>{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&s=adsimple" method="post" enctype="multipart/form-data">
	<table style="width: 70%; margin: 20px;">
		<tr>
			<td>
				<select name="ad_position">
					<option value="">{$smarty.const.MOD_ADSIMPLE_FORM_SELECT_PLACE}</option>
					<option value="toper" {if $return_data.ad_position eq 'toper'}selected{/if}>{$smarty.const.MOD_ADSIMPLE_FORM_TOPER}</option>
					<option value="advertisement_top" {if $return_data.ad_position eq 'advertisement_top'}selected{/if}>{$smarty.const.MOD_ADSIMPLE_FORM_ADVERTISEMENT_TOP}</option>
					<option value="advertisement_bottom" {if $return_data.ad_position eq 'advertisement_bottom'}selected{/if}>{$smarty.const.MOD_ADSIMPLE_FORM_ADVERTISEMENT_BOTTOM}</option>
					<option value="bottomer" {if $return_data.ad_position eq 'bottomer'}selected{/if}>{$smarty.const.MOD_ADSIMPLE_FORM_BOTTOMER}</option>
					<option value="advertisement_left" {if $return_data.ad_position eq 'advertisement_left'}selected{/if}>{$smarty.const.MOD_ADSIMPLE_FORM_ADVERTISEMENT_LEFT}</option>
					<option value="advertisement_right" {if $return_data.ad_position eq 'advertisement_right'}selected{/if}>{$smarty.const.MOD_ADSIMPLE_FORM_ADVERTISEMENT_RIGHT}</option>
				</select>
				<input type="hidden" id="index" name="index" value="" />
			</td>
			<td>
			{$smarty.const.MOD_ADSIMPLE_FORM_ENABLE_SHOW} <input type="checkbox" id="token" name="token" {if $return_data.token}checked{/if}>
		</td>
	</tr>
	<tr>
		<td colspan="2"><textarea cols="80" rows="10" name="advert">{$return_data.advert|default:false}</textarea></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></td>
	</tr>
</table>
</form>

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&s=adsimple" method="post" enctype="multipart/form-data">
<input type="submit" name="delete" value="{$smarty.const.FORM_ACTION_DELETE_SELECTED}" class="button">
{foreach from=$advert item="adv" key="key"}
	<h2 style="margin-bottom: 0px;">{$key}</h2>
	<table style="width: 95%; margin-bottom: 40px;">
		<thead class="data_head">
			<tr>
				<td>{*$smarty.const.MOD_ADSIMPLE_TABLE_ROW_ALIGNMENT*}№</td>
				<td>{$smarty.const.MOD_ADSIMPLE_TABLE_ROW_CODE}</td>
				<td>{$smarty.const.MOD_ADSIMPLE_TABLE_ROW_STATE}</td>
				<td>-</td>
			</tr>
		</thead>
		<tbody class="data_body">
			{foreach from=$adv item="i" key="k"}
			<tr>
				<td id="{$key}{$k}" class="{$key}">{$k}</td>
				<td code="{$i.htmlcode}"><code>{$i.htmlcode|truncate:80:" ...":true}</code></td>
				<td align="center">{$i.token}<input type="hidden" id="token" value="{$i.token}"></td>
				<td align="center"><input type="checkbox" name="{$key}[{$k}]" class="checkbox_entry"></td>
			</tr>
			{/foreach}
		</tbody>
	</table>
{/foreach}
</form>

<script type="text/javascript">
<!--
$( function() {
	$('.data_body').children().click( function() {
		$('#index').val($(this).find('td[id]').attr('id'));
		var tt = $(this).find('td[id]').attr('class');
		$('select option[value="' + tt + '"]').attr('selected', 'selected');
		var val = $(this).find('#token').val();
		(val == 'active') ? $("#token:checkbox").attr('checked', true) : $("#token:checkbox").attr('checked', false);
		$('textarea').text('').text($(this).find('td[code]').attr('code'));
	});
		
	$('select').change( function() {
		$('#index').val('');
	});
});
-->
</script>
