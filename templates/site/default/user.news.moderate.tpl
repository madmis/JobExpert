<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.news&amp;action=moderate")}" method="post" enctype="multipart/form-data">
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" style="border-spacing: 0px;">
            <tr>
				<th colspan="2">{$smarty.const.TABLE_COLUMN_TITLE}</th>
				<th>{$smarty.const.TABLE_COLUMN_PUBLICATION_DATE}</th>
            </tr>
		{if $arrNewses}
			{foreach from=$arrNewses item="arrNews" name="i"}
			<tr class="tr_hover" style="cursor: default;">
				<td class="VRIcon"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/mainBodyTableVRIcon.gif" alt=""></td>
				<td class="AlignLeft" style="padding: 5px;" title="{$arrNews.title|escape}">
					<span class="detail imLink">{$arrNews.title|truncate}</span>
					<input type="hidden" value="{$arrNews.id}">
				</td>
				<td class="last">{$arrNews.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$arrNews.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</td>
			</tr>
			{/foreach}
		{else}
			<tr>
        		<td class="last" style="text-align: center;" colspan="5">{$smarty.const.TABLE_NOT_DATA}</td>
			</tr>
		{/if}
		</table>
	</div>
</form>

<script type="text/javascript">
<!--
$(function() {
	//Подробный просмотр
	$('.detail').click(function() {
		$('#overlay, #dialog').show();
		var id = $(this).next('input').val();
		var title = $(this).parent('td').attr('title');

		$.ajax({ type: 'post', url: '/ajax.php',
			data: ({ getNewsDetail: id }),
			success: function(data) {
				$('#overlay, #dialog').hide();
				$.colorbox({ html: data, width: '80%', height: '90%', opacity: 0, scrolling: true, title: title });
			}
		});
	});
});
-->
</script>