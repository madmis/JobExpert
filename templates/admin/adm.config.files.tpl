{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=config&amp;s=files" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_FILES_MAX_SIZE}</td>
		<td><input type="text" name="max_size" size="10" value="{$smarty.const.CONF_FILES_MAX_SIZE}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_FILES_MAX_SIZE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td colspan="3" style="font-weight: bold; text-align: center;">{$smarty.const.TABLE_HEAD_IMAGES}</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_FILES_IMG_CREATE_WATERMARK}</td>
		<td><input type="checkbox" name="create_watermark" {if $smarty.const.CONF_FILES_IMG_CREATE_WATERMARK}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_FILES_CREATE_WATERMARK">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tbody id="wm_body" style="display: none;">
	<tr>
		<td>{$smarty.const.FORM_FILES_IMG_CREATE_WATERMARK_ON}</td>
		<td>
			<input type="radio" name="watermark_on" value="source" {if $smarty.const.CONF_FILES_IMG_CREATE_WATERMARK_ON ne 'all'}checked{/if}> {$smarty.const.FORM_SOURCE}
			<input type="radio" name="watermark_on" value="all" {if $smarty.const.CONF_FILES_IMG_CREATE_WATERMARK_ON eq 'all'}checked{/if}> {$smarty.const.FORM_ALL}
		</td>
		<td align="center">
			<span class="colorbox_help" id="HELP_ADMIN_FILES_CREATE_WATERMARK_ON">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_FILES_IMG_WATERMARK_ALIGNMENT}</td>
		<td>
			<input type="radio" name="watermark_alignment" value="L:T" {if $smarty.const.CONF_FILES_IMG_WATERMARK_ALIGNMENT eq 'L:T'}checked{/if}>
			<input type="radio" name="watermark_alignment" value="C:T" {if $smarty.const.CONF_FILES_IMG_WATERMARK_ALIGNMENT eq 'C:T'}checked{/if}>
			<input type="radio" name="watermark_alignment" value="R:T" {if $smarty.const.CONF_FILES_IMG_WATERMARK_ALIGNMENT eq 'R:T'}checked{/if}>
			<br>
			<input type="radio" name="watermark_alignment" value="L:M" {if $smarty.const.CONF_FILES_IMG_WATERMARK_ALIGNMENT eq 'L:M'}checked{/if}>
			<input type="radio" name="watermark_alignment" value="C:M" {if $smarty.const.CONF_FILES_IMG_WATERMARK_ALIGNMENT eq 'C:M'}checked{/if}>
			<input type="radio" name="watermark_alignment" value="R:M" {if $smarty.const.CONF_FILES_IMG_WATERMARK_ALIGNMENT eq 'R:M'}checked{/if}>
			<br>
			<input type="radio" name="watermark_alignment" value="L:B" {if $smarty.const.CONF_FILES_IMG_WATERMARK_ALIGNMENT eq 'L:B'}checked{/if}>
			<input type="radio" name="watermark_alignment" value="C:B" {if $smarty.const.CONF_FILES_IMG_WATERMARK_ALIGNMENT eq 'C:B'}checked{/if}>
			<input type="radio" name="watermark_alignment" value="R:B" {if $smarty.const.CONF_FILES_IMG_WATERMARK_ALIGNMENT eq 'R:B'}checked{/if}>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_FILES_WATERMARK_ALIGNMENT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_FILES_IMG_WATERMARK_TYPE}</td>
		<td>
			<input type="radio" name="watermark_type" value="image" {if $smarty.const.CONF_FILES_IMG_WATERMARK_TYPE ne 'text'}checked{/if}> {$smarty.const.FORM_IMAGE}
			<input type="radio" name="watermark_type" value="text" {if $smarty.const.CONF_FILES_IMG_WATERMARK_TYPE eq 'text'}checked{/if}> {$smarty.const.FORM_TEXT}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_FILES_WATERMARK_TYPE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	</tbody>

<!-- Если водяной знак КАРТИНКА -->
	<tbody id="image_body" style="display: none;">
	<tr>
		<td>{$smarty.const.FORM_FILES_IMG_WATERMARK}</td>
		<td>
			<img src="{$smarty.const.CONF_FILES_IMG_WATERMARK_IMAGE}" style="background-color: #CC3333;" align="absmiddle">
			<br>
			<input type="text" name="watermark_image" value="{$smarty.const.CONF_FILES_IMG_WATERMARK_IMAGE}" class="text" size="50">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_FILES_WATERMARK_IMAGE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	</tbody>

<!-- END Если водяной знак КАРТИНКА -->

<!-- Если водяной знак ТЕКСТ -->
	<tbody id="text_body" style="display: none;">
	<tr>
		<td>{$smarty.const.FORM_FILES_IMG_WATERMARK}</td>
		<td><input type="text" name="watermark_text" value="{$smarty.const.CONF_FILES_IMG_WATERMARK_TEXT}" class="text" size="50"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_FILES_WATERMARK_TEXT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_FILES_IMG_WATERMARK_FONT}</td>
		<td>
			<select name="font" class="select">
			{foreach from=$fonts item="font"}
				<option value="{$font}" {if $font eq $smarty.const.CONF_FILES_IMG_WATERMARK_FONT}selected{/if}>{$font}</option>
			{/foreach}
			</select>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_FILES_WATERMARK_FONT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_FILES_IMG_WATERMARK_FONT_SIZE}</td>
		<td><input type="text" name="font_size" size="10" value="{$smarty.const.CONF_FILES_IMG_WATERMARK_FONT_SIZE}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_FILES_WATERMARK_FONT_SIZE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_FILES_IMG_WATERMARK_FONT_COLOR}</td>
		<td>
			<input type="text" name="font_color" size="20" value="{$smarty.const.CONF_FILES_IMG_WATERMARK_FONT_COLOR}" class="text"> 
			<span id="fc" style="float: center; border: 1px solid #000000; background-color: {$smarty.const.CONF_FILES_IMG_WATERMARK_FONT_COLOR};">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_FILES_WATERMARK_FONT_COLOR">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_FILES_IMG_WATERMARK_TRANSPARENT}</td>
		<td><input type="text" name="transparent" size="10" value="{$smarty.const.CONF_FILES_IMG_WATERMARK_TRANSPARENT}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_FILES_WATERMARK_TRANSPARENT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	</tbody>
<!-- END Если водяной знак ТЕКСТ -->
	
</table>

<p align="center"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>

<script type="text/javascript">
<!--
// Функция выбора типа водяного знака
function selectWatermark(val) {
	if (val === 'text')	{
		$('#image_body').hide();
		$('#text_body').show(0);
	} else {
		$('#text_body').hide();
		$('#image_body').show(0);
	}
}

// Функция Включения/Отключения водяного знака
function enableWatermark(obj) {
	if ( $(obj).is(':checked') ) {
		$('#wm_body').show(0);
 
 		/******* Выбор типа водяного знака *******/
		($("input:checked[name='watermark_type']")).each(function (i) {
			var val = $(this).val();
			selectWatermark(val);
		});
	} else {
		$('#wm_body').hide();
		$('#image_body').hide();
		$('#text_body').hide();
	}
}


$(document).ready(function() {
/******* Прорисовка введенного в поле текста *******/
	$("input[name='font_color']").change(function () {
		var color = $(this).val();
		$('#fc').css({ 'background-color' : color });
	});

/******* Включение/Отключение водяного знака *******/
	$("input:checkbox[name='create_watermark']").each(function (i) {
		var obj = $(this);
		enableWatermark(obj);
	});

	$("input:checkbox[name='create_watermark']").change(function () {
		var obj = $(this);
		enableWatermark(obj);
	});

/******* Выбор типа водяного знака *******/
	$("input:radio[name='watermark_type']").change(function () {
		var val =  $(this).val();
		selectWatermark(val);
	});
});
-->
</script>