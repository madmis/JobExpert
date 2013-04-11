<p class="sub_menu">
	<span class="colorbox_help" id="HELP_ADMIN_MANAGER_FILE">
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
	</span>
</p>


{if $errors}
	{include file="adm.errors.message.tpl"}
{/if}
{* Настройки файл-менеджера *}
{if $action.config}
	{include file="adm.manager.file.config.tpl"}
{* Картинки *}
{elseif $action.images}
	{include file="adm.manager.file.images.tpl"}
{* Файлы *}
{elseif $action.files}
	{include file="adm.manager.file.files.tpl"}
{* Форма загрузки файлов *}
{else}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=file" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="0" class="otbor_table">
		<thead class="otbor_head" id="load_file">
			<tr>
				<td>
				   {$smarty.const.TABLE_HEAD_FILES_LOAD}
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td align="left" style="width: 100%; border: 0px;">
					<table style="width: 100%; border: 0px;" class="hidden_table" id="load_file_otbor">
						<tbody class="otbor_body">
							<tr>
								<td style="padding: 2px 5px;">
									<input type="file" name="load_file" class="text" size="50">
								</td>
								<td style="padding: 5px;">
									<input type="radio" name="type" value="file" checked> {$smarty.const.TABLE_COLUMN_FILE}
									<input type="radio" name="type" value="image"> {$smarty.const.TABLE_COLUMN_IMAGE}
								</td>
							</tr>
						</tbody>
						<tfoot class="otbor_foot">
							<tr>
								<td colspan="2" style="padding: 2px 5px;">
									<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
								</td>
							</tr>
						</tfoot>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	</form> 
{/if}