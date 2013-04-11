<form action="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=common&amp;action=confResume" method="post" enctype="multipart/form-data">
	<table style="width: 100%;" class="data_table" cellspacing="2" cellpadding="2">
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_RESUME_ACTIVATE_THERM}</td>
			<td><input type="text" name="crat" size="5" value="{$smarty.const.CONF_RESUME_ACTIVATE_THERM}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_RESUME_ACTIVATE_THERM">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_RESUME_CORRECTION_THERM}</td>
			<td><input type="text" name="crct" size="5" value="{$smarty.const.CONF_RESUME_CORRECTION_THERM}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_RESUME_CORRECTION_THERM">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_RESUME_PAYMENT_THERM}</td>
			<td><input type="text" name="crpt" size="5" value="{$smarty.const.CONF_RESUME_PAYMENT_THERM}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_RESUME_PAYMENT_THERM">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_RESUME_VIP_THERM}</td>
			<td><input type="text" name="crvipt" size="5" value="{$smarty.const.CONF_RESUME_VIP_THERM}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_VIP_STATUS">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_RESUME_VIP_SHOW}</td>
			<td><input type="checkbox" name="crvips"{if $smarty.const.CONF_RESUME_VIP_SHOW} checked="checked"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_RESUME_VIP_SHOW">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_RESUME_VIP_SHOW_PERPAGE}</td>
			<td><input type="text" name="crvipsp" size="5" value="{$smarty.const.CONF_RESUME_VIP_SHOW_PERPAGE}" class="text"{if !$smarty.const.CONF_RESUME_VIP_SHOW} disabled="disabled"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_RESUME_VIP_SHOW_PERPAGE">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_ANNOUNCES_RESUME_HOT_THERM}</td>
			<td><input type="text" name="crhott" size="5" value="{$smarty.const.CONF_RESUME_HOT_THERM}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_HOT_STATUS">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_RESUME_HOT_SHOW_PERPAGE}</td>
			<td><input type="text" name="crhotsp" size="5" value="{$smarty.const.CONF_RESUME_HOT_SHOW_PERPAGE}" class="text"></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_RESUME_HOT_SHOW_PERPAGE">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_RESUME_LAST_SHOW}</td>
			<td><input type="checkbox" name="crls"{if $smarty.const.CONF_RESUME_LAST_SHOW} checked="checked"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_RESUME_LAST_SHOW">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_RESUME_LAST_SHOW_PERPAGE}</td>
			<td><input type="text" name="crlsp" size="5" value="{$smarty.const.CONF_RESUME_LAST_SHOW_PERPAGE}" class="text"{if !$smarty.const.CONF_RESUME_LAST_SHOW} disabled="disabled"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_RESUME_LAST_SHOW_PERPAGE">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_RESUME_ADD_PHOTO}</td>
			<td><input type="checkbox" name="crap"{if $smarty.const.CONF_RESUME_ADD_PHOTO} checked="checked"{/if}></td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_RESUME_ADD_PHOTO">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_RESUME_ADD_PHOTO_RESOLUTION_CONV}</td>
			<td>
				<input type="text" name="crapmw" size="5" value="{$smarty.const.CONF_RESUME_ADD_PHOTO_MAXWIDTH}" class="text"{if !$smarty.const.CONF_RESUME_ADD_PHOTO} readonly="readonly"{/if}>
				х
				<input type="text" name="crapmh" size="5" value="{$smarty.const.CONF_RESUME_ADD_PHOTO_MAXHEIGHT}" class="text"{if !$smarty.const.CONF_RESUME_ADD_PHOTO} readonly="readonly"{/if}>
			</td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_RESUME_ADD_PHOTO_RESOLUTION_CONV">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
		<tr>
			<td>{$smarty.const.FORM_CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE}</td>
			<td>
				<input type="text" name="crapfms" size="5" value="{$smarty.const.CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE}" class="text"{if !$smarty.const.CONF_RESUME_ADD_PHOTO} readonly="readonly"{/if}>
			</td>
			<td style="text-align: center;">
				<span class="colorbox_help" id="HELP_ADMIN_CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
				</span>
			</td>
		</tr>
	</table>
	<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>

{*Настройки сортировки Резюме*}
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=common&amp;action=confResume" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="2" cellpadding="2">
		<thead class="data_head">
			<tr>
				<td style="width: 65%;">{$smarty.const.TABLE_RESUMES_SORT_HEAD}</td>
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

{*Настройки TITLE-страницы просмотра Резюме*}
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=common&amp;action=confResume" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="2" cellpadding="2">
		<thead class="data_head">
			<tr>
				<td style="width: 65%;">{$smarty.const.TABLE_RESUMES_PAGE_TITLE_HEAD}</td>
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