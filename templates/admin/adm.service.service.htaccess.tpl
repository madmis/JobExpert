<div style="padding: 10px 20px">
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&s=service&action=htaccess" method="post">
	<textarea cols="100" rows="30" name="htaccess">{$htaccess}</textarea>
	<p>
		<input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button">
		<input type="button" id="defaultHtaccess" value="{$smarty.const.FORM_BUTTON_DEFAULT}" class="button">
	</p>
</form>
</div>

<script type="text/javascript">
$( function() {
	$('#defaultHtaccess').click( function() {
		$.ajax({ type: 'post', url: '/admajax.php',
			data: ({ defaultHtaccess: 1 }),
			success: function( data ) {
				$('textarea[name="htaccess"]').text(data);
			}
		});
	});
});
</script>
