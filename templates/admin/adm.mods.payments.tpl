{if $errors}{include file="adm.errors.message.tpl"}{/if}

{* MOD MENU *}
{if $modMenu}
<p style="padding-left: 10px;">
	{foreach from=$modMenu item="item" name="i"}
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$item.icon}" alt="{$item.text}">
		<a href="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments&amp;action={$item.action}&amp;id={$item.id}">
			{$item.text}
		</a>
		{if !$smarty.foreach.i.last}&nbsp;|&nbsp;{/if}
	{/foreach}
</p>
{/if}

{if $action.config}
	{include file=$config_template}
{elseif $action.payments}
	{include file=$paymentsTemplate}
{elseif $action.mt}
	{include file=$mtTemplate}
{elseif $action.lt}
	{include file=$ltTemplate}
{else}
	<p class="sub_menu">
		<span class="colorbox_help" id="HELP_ADMIN_MODS_PAYMENTS">
			<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}">
		</span>
	</p>
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments" method="post">
	<table class="dataTable100">
		<thead>
			<tr>
				<td>{$smarty.const.TABLE_COLUMN_NAME}</td>
				<td>{$smarty.const.TABLE_COLUMN_TITLE}</td>
				<td>{$smarty.const.TABLE_COLUMN_TOKEN}</td>
				<td>{$smarty.const.TABLE_COLUMN_OPTIONS}</td>
				<td><input type="checkbox" class="checked_all"></td>
			</tr>
		</thead>
		<tbody>
		{if $mods}
			{foreach from=$mods item="mod"}
				<tr>
					<td>
						{if $mod.token eq 'active' OR $mod.token eq 'disabled'}
							<a href="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments&amp;action=config&amp;id={$mod.id}">{$mod.id}</a>
						{else}
							{$mod.id}
						{/if}
					</td>
					<td>{$mod.title}</td>
					<td class="alignCenter">
						{if $mod.token eq 'active'}
							<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/on.png" alt="{$smarty.const.FORM_MOD_ON}" title="{$smarty.const.FORM_MOD_ON}">
						{elseif $mod.token eq 'disabled'}
							<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/off.png" alt="{$smarty.const.FORM_MOD_OFF}" title="{$smarty.const.FORM_MOD_OFF}">
						{else}
							<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/errpage.png" alt="{$smarty.const.FORM_MOD_NOT_INSTALL}" title="{$smarty.const.FORM_MOD_NOT_INSTALL}">
						{/if}
					</td>
					<td class="alignCenter" style="width: 24px;">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/edit.png" data-id="{$mod.id}" data-title="{$mod.title}" class="mod_edit" style="cursor: pointer;" alt="{$smarty.const.FORM_ACTION_EDIT}" title="{$smarty.const.FORM_ACTION_EDIT}">
					</td>
					<td class="alignCenter" style="width: 10px;"><input type="checkbox" name="payments[{$mod.id}]" class="checkbox_entry"></td>
				</tr>
			{/foreach}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="10" class="alignRight">
					<select name="action" class="select">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						<option value="install">{$smarty.const.FORM_ACTION_INSTALL_SELECTED}</option>
						<option value="enable">{$smarty.const.FORM_ACTION_ENABLE_SELECTED}</option>
						<option value="disable">{$smarty.const.FORM_ACTION_DISABLE_SELECTED}</option>
						<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
					</select>
					<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
				</td>
			</tr>
		</tfoot>
		{else}
				<tr>
					<td class="alignCenter" colspan="10">{$smarty.const.TABLE_NOT_DATA}</td>
				</tr>
			</tbody>
		{/if}
	</table>
	</form>

	<div id="editModDialog" style="display: none;"></div>

	{* Диалоговое окно - Сообщение об успешном завершении операции *}
	<div id="messSuccess" title="{$smarty.const.MESSAGE_ACTION_SUCCESS}!" style="display: none;">
		<div class="ui-dialog-content">
			<div style="font-weight: bold;">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" style="margin: 0px 10px; vertical-align: bottom; float: left;" alt="">
				<span id="messSuccessTitle">{$smarty.const.MESSAGE_CHANGE_SAVED}</span>
			</div>
		</div>
	</div>


	<script type="text/javascript">
	$( function() {

		/***** Functions *****/
		$.fn.showDialog = function(id, title) {
			$('#editModDialog').dialog({
				autoOpen: true,
				modal: true,
				//open: function () { $(this).html( data ); },
				height: 500,
				width: 700,
				title: title,
				buttons: {
						'{$smarty.const.FORM_BUTTON_SAVE}': function() {
 							var title = $(this).find('input[name="title"]').val();
 							var description = ('' == '{$smarty.const.CONF_USE_VISUAL_EDITOR}') ? $('textarea').text() : tinyMCE.activeEditor.getContent({ format : 'text' });

							$.ajax({ type: 'post', url: '/admajax.php',
								data: ({ savePamentModData: id, modTitle: title, modDescr: description }),
								success: function( response ) {
									response = $.parseJSON(response);

									if (response.success) {
										$('#editModDialog').dialog('close');
										$('#messSuccess').dialog('open');
									} else {
										$.$.alert(response.error);
									}
								}
							});
						},
						'{$smarty.const.SITE_CLOSE}': function() { $(this).dialog('close');	}
				},
				close: function() {
					$(this).dialog('option', { beforeClose: function() { } });
				}
			});

			return false;
		}

		//включаем все переключатели в таблице	
		$('.checked_all').click(function() {
			(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
		});

		// проверяем выбранное действие
		$("form:last").submit( function() {
			if (!$('select[name="action"] option:selected').val()) {
				$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
				return false;
			} else {
				if (!$('form:last input:checked').size()) {
					$.alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
					return false;
				}

				return ( $("select[name='action'] option:selected").val() === 'del' ) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
			}
		});

		// редактирование данных мода
		$('.mod_edit').click(function() {
			$('#overlay, #dialog').show();
			var title = $(this).data('title');
			var id = $(this).data('id');

			$.ajax({ type: 'post', url: '/admajax.php',
				data: ({ getPamentModData: id }),
				success: function( data ) {
					if ('errorModNotExists' == data) {
						$.alert('{$smarty.const.ERROR_FILE_NOT_FOUND}');
					} else {
						$('#editModDialog').html( data );
						$('#editModDialog').showDialog( id, title );
					}
					$('#overlay, #dialog').hide();
				}
			});
		});

		$('#messSuccess').dialog({
			autoOpen: false,
			modal: true,
			draggable: false,
			resizable: false,
			buttons: {
				'{$smarty.const.SITE_CLOSE}': function() {
					$(this).dialog('close');
				}
			},
			beforeClose: function() {
				window.location.reload();
			}
		});
	});
	</script>
{/if}
