<p class="sub_menu"><span class="colorbox_help" id="HELP_ADMIN_MANAGER_ARTICLES"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}"></span></p>

{if $errors}{include file="adm.errors.message.tpl"}{/if}

{* Добавление статей *}
{if $actions.add OR $actions.edit}
	{include file="adm.manager.articles.add.tpl"}
{* Архив статей *}
{elseif $actions.archived}
	{include file="adm.manager.articles.archived.tpl"}
{* Статьи ожидающие редактирования *}
{elseif $actions.correction}
	{include file="adm.manager.articles.correction.tpl"}
{* Модерация статей *}
{elseif $actions.moderate}
	{include file="adm.manager.articles.moderate.tpl"}
{* Настройки статей *}
{elseif $actions.config}
	{include file="adm.manager.articles.config.tpl"}
{* Комментарии *}
{elseif $actions.comments}
	{include file="adm.manager.articles.comments.list.tpl"}
{* Список статей *}
{else}

	<form action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="get">
	<input type="hidden" name="m" value="manager">
	<input type="hidden" name="s" value="articles">
	<input type="hidden" name="do" value="filter">
	<table style="width: 100%; border-spacing: 0px;" class="otbor_table">
		<thead class="otbor_head" id="articles">
			<tr><td>{$smarty.const.TABLE_FORM_SELECTION}</td></tr>
		</thead>
		<tbody>
			<tr>
				<td class="alignLeft" style="width: 100%;">
					<table style="width: 100%;" class="hidden_table" id="articles_otbor">
						<tbody class="otbor_body">
							<tr>
								<td>
									{$smarty.const.FORM_ID}&nbsp;<input type="text" name="id" value="{$retFields.id}">
									<span class="colorbox_help" id="HELP_ADMIN_PATTERN_FILTER_ID"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}"></span>
								</td>
								<td>
									{$smarty.const.FORM_ID_USER}&nbsp;<input type="text" name="id_user" value="{$retFields.id_user}">
									<span class="colorbox_help" id="HELP_ADMIN_PATTERN_FILTER_ID"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}"></span>
								</td>
								<td>
									{$smarty.const.FORM_AUTHOR}&nbsp;<input type="text" name="author" size="30" value="{$retFields.author}">
									<span class="colorbox_help" id="HELP_ADMIN_PATTERN_FILTER_STRING"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}"></span>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									{$smarty.const.FORM_TITLE}&nbsp;<input type="text" name="title" size="50" value="{$retFields.title}">
									<span class="colorbox_help" id="HELP_ADMIN_PATTERN_FILTER_STRING"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}"></span>
								</td>
								<td >
									{$smarty.const.FORM_ARTICLES_SECTION}&nbsp;
									<select name="id_section">
										<option value="" style="font-weight: bold;">------- {$smarty.const.FORM_DICTIONARY_ART_SECTIONS_AFFILIATION_ALL} -------</option>
									{if $sections.split.none}
										{foreach from=$sections.split.none item="section"}
											<option value="{$section.id}" {if $retFields.id_section eq $section.id}selected{/if}>{$section.name}</option>
										{/foreach}
									{/if}
										<option value="" style="font-weight: bold;">------- {$smarty.const.FORM_TYPE_EMPLOYER} -------</option>
									{if $sections.split.employer}
										{foreach from=$sections.split.employer item="section"}
											<option value="{$section.id}" {if $retFields.id_section eq $section.id}selected{/if}>{$section.name}</option>
										{/foreach}
									{/if}
										<option value="" style="font-weight: bold;">------- {$smarty.const.FORM_TYPE_COMPETITOR} -------</option>
									{if $sections.split.competitor}
										{foreach from=$sections.split.competitor item="section"}
											<option value="{$section.id}" {if $retFields.id_section eq $section.id}selected{/if}>{$section.name}</option>
										{/foreach}
									{/if}
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									{$smarty.const.FORM_DATE}:&nbsp;
									{$smarty.const.SITE_FROM}&nbsp;<input type="text" name="sDate" class="datepicker" size="10" value="{$retFields.sDate}">
									{$smarty.const.SITE_UNTO}&nbsp;<input type="text" name="eDate" class="datepicker" size="10" value="{$retFields.eDate}">
								</td>
								<td>{$smarty.const.FORM_RECORDS}&nbsp;<input type="text" name="records" size="5" value="{$retFields.records}"></td>
							</tr>
						</tbody>
						<tfoot class="otbor_foot">
							<tr>
								<td colspan="3"><input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></td>
							</tr>
						</tfoot>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	</form>
	<br>

	<form action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="post">
	<table class="dataTable100">
		<thead>
			<tr>
				<td>{$smarty.const.TABLE_COLUMN_ID}</td>
				<td>{$smarty.const.TABLE_COLUMN_TITLE}</td>
				<td>{$smarty.const.TABLE_COLUMN_SECTION}</td>
				<td>{$smarty.const.TABLE_COLUMN_AFFILIATION}</td>				
				<td>{$smarty.const.TABLE_COLUMN_USER_ID}</td>				
				<td>{$smarty.const.TABLE_COLUMN_AUTHOR}</td>				
				<td>{$smarty.const.TABLE_COLUMN_DATE}</td>
				<td>{$smarty.const.TABLE_COLUMN_OPTIONS}</td>
				<td><input type="checkbox" class="checked_all"></td>
			</tr>
		</thead>
		<tbody>
	{if $arrArticles}
		{foreach from=$arrArticles item="arrArticle" name="i"}
			<tr>
				<td class="alignCenter">{$arrArticle.id}</td>
				<td title="{$arrArticle.title|escape}">
					<span class="detail">{$arrArticle.title|truncate}</span>
					<input type="hidden" value="{$arrArticle.id}">
				</td>
				<td title="{$sections.full[$arrArticle.id_section].name}">{$sections.full[$arrArticle.id_section].name|truncate:20}</td>
				<td class="alignCenter">
					{foreach from=$sections.full item="section"}
						{if $section.id eq $arrArticle.id_section}
							{if $section.affiliation eq 'employer'}
								{$smarty.const.FORM_TYPE_EMPLOYER}
							{elseif $section.affiliation eq 'competitor'}
								{$smarty.const.FORM_TYPE_COMPETITOR}
							{else}
								{$smarty.const.FORM_DICTIONARY_ART_SECTIONS_AFFILIATION_ALL}
							{/if}
						{/if}
					{/foreach}
				</td>
				<td class="alignCenter">
					{if $arrArticle.id_user}
						<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=detail&amp;id={$arrArticle.id_user}" target="_blank">{$arrArticle.id_user}</a>
					{else}
						{$arrArticle.id_user}
					{/if}
				</td>
				<td class="alignCenter">{$arrArticle.author}</td>
				<td class="alignCenter" style="white-space: nowrap;">
					{$arrArticle.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$arrArticle.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}
				</td>
				<td class="alignCenter">
					<a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=articles&amp;action=edit&amp;id={$arrArticle.id}">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/edit.png" alt="{$smarty.const.FORM_ACTION_EDIT}" title="{$smarty.const.FORM_ACTION_EDIT}">
					</a>
				</td>
				<td class="alignCenter"><input type="checkbox" name="articles[{$arrArticle.id}]" class="checkbox_entry"></td>
			</tr>
		{/foreach}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="10" class="alignCenter">
					{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}/{$allRecords}
					<span style="float: right;">
					<select name="action">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						<option value="archived">{$smarty.const.FORM_ACTION_ARCHIVE}</option>
						<option value="delete">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
					</select>
					<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
					</span>
				</td>
			</tr>
		</tfoot>
	{else}
			<tr>
				<td colspan="9" class="alignCenter">{$smarty.const.TABLE_NOT_DATA}</td>
			</tr>
		</tbody>
	{/if}
	</table>
	</form>

	<p class="alignCenter">{$strPages}</p>

<script type="text/javascript">
<!--
$( function() {

	//Подробный просмотр
	$('.detail').click(function() {
		$('#overlay, #dialog').show();
		var id = $(this).next('input').val();

		$.ajax({ type: 'post', url: '/admajax.php',
			data: ({ getArticleDetail: id, strQuery: '{$qString}' }),
			success: function(data) {
				$('#overlay, #dialog').hide();
				$.colorbox({ html: data, width: '80%', height: '90%', opacity: 0, scrolling: true });
			}
		});
	});

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

			return ( $("select[name='action'] option:selected").val() === 'delete' ) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
		}
	});
});
-->
</script>

{/if}