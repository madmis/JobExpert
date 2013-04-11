<table style="width: 100%;">
	<tr>
		<td style="text-align: left;">
			<div class="views">
				<div class="block" id="block" title="Block"></div>
				<div class="list" id="list" title="List"></div>
			</div>
		</td>
	</tr>
</table>

{* Просмотр картинок в расширенном виде *}
<div id="id_block" class="table_views">
	<form id="f_block" action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=file&amp;action=images" method="post">
	<table style="width: 100%;" cellspacing="5" cellpadding="3">
		<thead class="data_head">
			<tr>
				<td style="text-align: center;" colspan="2">{$smarty.const.TABLE_HEAD_IMAGES}</td>
			</tr>
		</thead>
		<tbody class="data_body">
	{if $arrImages}
			<tr>
				<td style="text-align: center; border: none;" colspan="2">
				{foreach from=$arrImages item="image"}
					<table cellpadding="0" cellspacing="0" class="imgTable">
						<tbody>
							<tr>
								<td>
									<div class="imgBlock">
										<span style="float: right;"><input type="checkbox" name="images[{$image.filename}]"></span>
										<span style="float: left; font-size: 10px;">
											{$smarty.const.L_LINK}: 
											<a href="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.CONF_FILEMANAGER_PATH_TO_IMAGES}{$image.filename}" target="_blank">
											<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/link.png" alt="">
											</a>
										</span>
										<div class="imgBlockD">
											<a href="{$smarty.const.CONF_FILEMANAGER_PATH_TO_IMAGES}{$image.filename}" class="colorbox_img" title="{$smarty.const.L_TYPE}&nbsp;{$image.ext}&nbsp;|&nbsp;{$image.width}x{$image.height}&nbsp;|&nbsp;{$smarty.const.L_SIZE}&nbsp;{$image.sizekb}&nbsp;{$smarty.const.L_KB}">
												<img src="{$smarty.const.CONF_FILEMANAGER_PATH_TO_IMAGES}thumbs/thumb_{$image.filename}" class="fmImg">
											</a>
										</div>
										<div class="imgName">{$image.name}</div>
										<div class="imgData">
											{$smarty.const.L_TYPE} {$image.ext}<br>{$smarty.const.L_SIZE} {$image.sizekb} {$smarty.const.L_KB}<br>{$image.width}x{$image.height}
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				{/foreach}
				</td>
			</tr>
		</tbody>
		<tfoot class="data_foot">
			<tr>
				<td style="text-align: center;" width="50%">
					{$smarty.const.TABLE_TOTAL_FILES}: {$count}
				</td>
				<td style="text-align: right;">
					<select name="action" class="select">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
					</select>
					<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
				</td>
			</tr>
		</tfoot>
	{else}
			<tr>
				<td style="text-align: center;" colspan="10">
					{$smarty.const.TABLE_NOT_DATA}
				</td>
			</tr>
		</tbody>
	{/if}
	</table>
	</form>
</div>
{* Просмотр картинок списком *}
<div id="id_list" class="table_views">
	<form id="f_list" action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=file&amp;action=images" method="post">
	<table style="width: 100%;" cellspacing="2" cellpadding="0">
		<thead class="data_head">
			<tr>
				<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_TYPE}</td>
				<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_FILE}</td>
				<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_LINK}</td>
				<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_SIZE}</td>
				<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_DATE}</td>
				<td style="text-align: center;"><input type="checkbox" id="s_all"></td>
			</tr>
		</thead>
		<tbody class="fm data_body">
	{if $arrImages}
		{foreach from=$arrImages item="image"}
			<tr class="file">
				<td style="text-align: center;">
					<a href="{$smarty.const.CONF_FILEMANAGER_PATH_TO_IMAGES}{$image.filename}" class="colorbox_img" title="{$smarty.const.L_TYPE}&nbsp;{$image.ext}&nbsp;|&nbsp;{$image.width}x{$image.height}&nbsp;|&nbsp;{$smarty.const.L_SIZE}&nbsp;{$image.sizekb}&nbsp;{$smarty.const.L_KB}">
						<img src="{$smarty.const.CONF_FILEMANAGER_PATH_TO_IMAGES}thumbs/thumb_{$image.filename}" class="fmIcoImg">
					</a>
				</td>
				<td style="text-align: left;">
					{$image.filename}
				</td>
				<td style="text-align: center;" title="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.CONF_FILEMANAGER_PATH_TO_IMAGES}{$image.filename}">
					<a href="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.CONF_FILEMANAGER_PATH_TO_IMAGES}{$image.filename}" target="_blank">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/link.png" alt="">
					</a>
				</td>
				<td style="text-align: center;" title="{$smarty.const.L_SIZE} {$image.sizekb} {$smarty.const.L_KB}">
					{$image.size}
				</td>
				<td style="text-align: center;" title="{$smarty.const.L_CHANGED} {$image.date|date_format:$smarty.const.CONF_DATE_FORMAT} {$image.date|date_format:$smarty.const.CONF_TIME_FORMAT}">
					{$image.date|date_format:$smarty.const.CONF_DATE_FORMAT}
				</td>
				<td style="text-align: center;">
					<input type="checkbox" name="images[{$image.filename}]">
				</td>
			</tr>
		{/foreach}
		</tbody>
		<tfoot class="fm_foot data_foot">
			<tr>
				<td colspan="2" style="text-align: center;">
					{$smarty.const.TABLE_TOTAL_FILES}: {$count}
				</td>
				<td colspan="4" style="text-align: right;">
					<select name="action" class="select">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
					</select>
					<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
				</td>
			</tr>
		</tfoot>
	{else}
			<tr>
				<td style="text-align: center;" colspan="10">
					{$smarty.const.TABLE_NOT_DATA}
				</td>
			</tr>
		</tbody>
	{/if}
	</table>
	</form>
</div>


<script type="text/javascript">
<!--
$(document).ready( function()
{
	$('.imgTable').live('mouseover', function() {
		$(this).addClass('imgBlockHover');
		$(this).find('.imgData').css('color', '#CC3333');
	});
	$('.imgTable').live('mouseout', function() {
		$(this).removeClass('imgBlockHover');
		$(this).find('.imgData').css('color', '#FFFFFF');
	});
	$('.file').live('mouseover', function()	{
		$(this).addClass('fileBlockHover');
	});
	$('.file').live('mouseout', function()	{
		$(this).removeClass('fileBlockHover');
	});
	
	// отображаем списками и блоками
	if (currCookie = $.cookie('fmimg_views')) {
		$('#' + currCookie).addClass('select');
		$('div.table_views').hide().filter('#id_' + currCookie).fadeIn('normal');
	} else {
		$('#block').addClass('select');
		$('div.table_views').hide().filter('#id_block').fadeIn('normal');
		$.cookie('fmimg_views', 'block', { path: '/', expires: 30 });
	}

	$('div.views > div').click( function() {
		$('div.table_views').hide().filter('#id_' + $(this).attr('id')).fadeIn('normal');
		$(this).parent().children('div').removeClass('select');
		$(this).addClass('select');
		$.cookie('fmimg_views', $(this).attr('id'), { path: '/', expires: 30 });
	});
	
	//включаем все переключатели в таблице
	$('#s_all').click(function() {
		var current = $(this);
		$(':checkbox[name^="images"]').each(function() {
			(current.is(':checked')) ? $(this).attr('checked', true) : $(this).attr('checked', false);
      	});
	});
	
	// проверяем выбранное действие
	$('form').submit(function() {
		var id = $(this).attr('id');
		if (!$('#' + id + ' select[name="action"] option:selected').val()) {
			$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
			return false;
		} else if (!$('#' + id + ' input:checked').size()) {
				$.alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
				return false;
		} else {
			return ($('#' + id + ' select[name="action"] option:selected').val() === 'del') ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
		}
	});
});
-->
</script>

