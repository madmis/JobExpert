<form action="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=common&amp;action=confVacancy" method="post" enctype="multipart/form-data">
	<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_VACANCY_ACTIVATE_THERM}</td>
			<td><input type="text" name="cvat" size="5" value="{$smarty.const.CONF_VACANCY_ACTIVATE_THERM}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_VACANCY_ACTIVATE_THERM">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_VACANCY_CORRECTION_THERM}</td>
			<td><input type="text" name="cvct" size="5" value="{$smarty.const.CONF_VACANCY_CORRECTION_THERM}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_VACANCY_CORRECTION_THERM">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_VACANCY_PAYMENT_THERM}</td>
			<td><input type="text" name="cvpt" size="5" value="{$smarty.const.CONF_VACANCY_PAYMENT_THERM}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_VACANCY_PAYMENT_THERM">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_VACANCY_VIP_THERM}</td>
			<td><input type="text" name="cvvipt" size="5" value="{$smarty.const.CONF_VACANCY_VIP_THERM}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_VIP_STATUS">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_VACANCY_VIP_SHOW}</td>
			<td><input type="checkbox" name="cvvips"{if $smarty.const.CONF_VACANCY_VIP_SHOW} checked="checked"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_VACANCY_VIP_SHOW">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_VACANCY_VIP_SHOW_PERPAGE}</td>
			<td><input type="text" name="cvvipsp" size="5" value="{$smarty.const.CONF_VACANCY_VIP_SHOW_PERPAGE}" class="text"{if !$smarty.const.CONF_VACANCY_VIP_SHOW} disabled="disabled"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_VACANCY_VIP_SHOW_PERPAGE">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>

		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_VACANCY_HOT_THERM}</td>
			<td><input type="text" name="cvhott" size="5" value="{$smarty.const.CONF_VACANCY_HOT_THERM}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_HOT_STATUS">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>

		<tr>
			<td>{$smarty.const.FORM_CONF_VACANCY_HOT_SHOW_PERPAGE}</td>
			<td><input type="text" name="cvhotsp" size="5" value="{$smarty.const.CONF_VACANCY_HOT_SHOW_PERPAGE}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_VACANCY_HOT_SHOW_PERPAGE">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_VACANCY_LAST_SHOW}</td>
			<td><input type="checkbox" name="cvls"{if $smarty.const.CONF_VACANCY_LAST_SHOW} checked="checked"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_VACANCY_LAST_SHOW">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_VACANCY_LAST_SHOW_PERPAGE}</td>
			<td><input type="text" name="cvlsp" size="5" value="{$smarty.const.CONF_VACANCY_LAST_SHOW_PERPAGE}" class="text"{if !$smarty.const.CONF_VACANCY_LAST_SHOW} disabled="disabled"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_VACANCY_LAST_SHOW_PERPAGE">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
	</table>
	<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>

{*Настройки сортировки Вакансий*}
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=common&amp;action=confVacancy" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
		<thead class="data_head">
			<tr>
				<td style="width: 65%;">{$smarty.const.TABLE_VACANCYS_SORT_HEAD}</td>
				<td style="width: 25%;">{$smarty.const.TABLE_COLUMN_SORT}</td>
			</tr>
		</thead>
		<tbody class="data_body">
			{foreach from=$sortFields item="sort" name="sort"}
				<tr class="tr_hover portlet">
					<td style="width: 65%;">{$sort.discription}</td>
					<td style="width: 25%; text-align: center;">
						<select name="arrSortList[{$sort.sortField}]" class="select">
							<option value="">{$smarty.const.ANNOUNCE_SORT_OFF}</option>
							<option value="ASC"{if $sort.sortOrder eq 'ASC'} selected="selected"{/if}>{$smarty.const.ANNOUNCE_SORT_UP}</option>
							<option value="DESC"{if $sort.sortOrder eq 'DESC'} selected="selected"{/if}>{$smarty.const.ANNOUNCE_SORT_DOWN}</option>
						</select>
					</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
	<p style="text-align: center;"><input type="submit" name="sort" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>

{*Настройки TITLE-страницы просмотра Вакансий*}
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=common&amp;action=confVacancy" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
		<thead class="data_head">
			<tr>
				<td style="width: 65%;">{$smarty.const.TABLE_VACANCYS_PAGE_TITLE_HEAD}</td>
				<td style="width: 5%;">-</td>
			</tr>
		</thead>
		<tbody class="data_body">
			{foreach from=$pTitle item="title" name="title"}
				<tr class="tr_hover portlet">
					<td style="width: 65%;">{$title.discription}</td>
					<td style="width: 5%; text-align: center;">
						<input type="checkbox" name="title[]" value="{$title.varValue}"{if $title.varChecked} checked="checked"{/if}>
					</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
	<p style="text-align: center;"><input type="submit" name="pTitle" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>
<script type="text/javascript">
<!--
	$(document).ready(function() {
		$('.data_body').sortable({
			revert: true,
		}).disableSelection();
	});
-->
</script>