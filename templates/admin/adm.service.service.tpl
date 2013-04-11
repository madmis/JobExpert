
{if $errors}{include file="adm.errors.message.tpl"}{/if}

{if $action.htaccess}
	{include file="adm.service.service.htaccess.tpl"}
{else}
	<table style="padding-left: 20px;">
		<tr style="height: 22px;">
			<td class="detail" id="deleteDBCache"><span class="detail">{$smarty.const.MENU_SERVICES_DELETE_DB_CACHE}</span></td>
			<td class="resAction">&nbsp;</td>
		</tr>
		<tr style="height: 22px;">
			<td id="deleteTmplCache"><span class="detail">{$smarty.const.MENU_SERVICES_DELETE_TMPL_CACHE}</span></td>
			<td class="resAction">&nbsp;</td>
		</tr>
		<tr style="height: 22px;">
			<td>
				<a href="{$smarty.const.CONF_ADMIN_FILE}?m=service&s=service&action=htaccess">{$smarty.const.MENU_SERVICES_HTACCESS}</a>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>

	<script type="text/javascript">
	$( function() {
		/***** Functions *****/
		$.fn.performAction = function(id) {
			$.ajax({ type: 'post', url: '/admajax.php',
				data: id + "=1",
				//data: ({ id: true }),
				success: function( response ) {
					response = $.parseJSON(response);

					if (response.success) {
						$('#' + id).next('.resAction').html('<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" title="{$smarty.const.MESSAGE_CACHE_CLEAR_SUCCESS}" alt="{$smarty.const.MESSAGE_CACHE_CLEAR_SUCCESS}">');
					} else {
						$('#' + id).next('.resAction').html('<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" title="{$smarty.const.MESSAGE_WARNING_NOT_DELETE_CACHE_FILES}" alt="{$smarty.const.MESSAGE_WARNING_NOT_DELETE_CACHE_FILES}">');
					}
				}
			});
			return false;
		}

		$('#deleteDBCache').click( function() {
			$(this).next('.resAction').html('<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/loading.gif" alt="loading">');
			$(this).performAction('deleteDBCache');
		});

		$('#deleteTmplCache').click( function() {
			$(this).next('.resAction').html('<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/loading.gif" alt="loading">');
			$(this).performAction('deleteTmplCache');
		});


	});
	</script>
{/if}