<div class="Design_panesBGWrapper">
	<div class="Design_panesBG">
		<ul class="Design_tabs">
			<li><a class="active" href="javascript:void(0);" style="cursor: default;">{$smarty.const.FORM_NEWS_ADD}</a></li>
		</ul>
		<div class="Design_panes">
			<div>
			<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.news&amp;action=add")}" method="post" enctype="multipart/form-data">
				<table class="Design_panesFormTable">
					{* NEWS PUBLICATION DATE *}
					<tr>
						<td class="name" style="white-space: nowrap;">{$smarty.const.FORM_PUBLICATION_DATE}&nbsp;<span class="text-red">*</span></td>
						<td class="form">
							{html_select_date time=$retFields.arrBindFields.date field_array="date" field_order="DMY" end_year="+3" month_format="%m"}
						</td>
						<td class="name" style="white-space: nowrap;">{$smarty.const.FORM_PUBLICATION_TIME}&nbsp;<span class="text-red">*</span></td>
						<td class="form">
							{html_select_time time=$retFields.arrBindFields.time field_array="time" use_24_hours=true display_seconds=false minute_interval="5"}
            				<span class="user_help" id="HELP_ARTICLES_PUBLICATION_DATE">
            					<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt="Info">
            				</span>
						</td>
					</tr>
				</table>
				<br>
				<table class="Design_panesFormTable">
					{* NEWS TITLE *}
					<tr>
						<td class="name">{$smarty.const.FORM_TITLE}&nbsp;<span class="text-red">*</span></td>
						<td class="form">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="text" name="arrBindFields[title]" value="{$retFields.arrBindFields.title|escape}" style="width:600px;" maxlength="255">
						</td>
					</tr>
				</table>
				<br><hr class="Design_panesDelimiter"><br>
				<table class="Design_panesFormTable">
					{* NEWS SMALL TEXT *}
					<tr>
						<td class="name">{$smarty.const.FORM_SMALL_TEXT}&nbsp;<span class="text-red">*</span></td>
						<td class="form">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<textarea name="arrBindFields[small_text]" rows="5" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$retFields.arrBindFields.small_text}</textarea>
						</td>
					</tr>
				</table>
				<br>
				<table class="Design_panesFormTable">
					{* NEWS TEXT *}
					<tr>
						<td class="name">{$smarty.const.FORM_TEXT}&nbsp;<span class="text-red">*</span></td>
						<td class="form">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<textarea name="arrBindFields[text]" rows="5" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$retFields.arrBindFields.text}</textarea>
						</td>
					</tr>
				</table>
				<br>
				<table class="Design_panesFormTable">
					{* NEWS KEYWORDS *}
					<tr>
						<td class="name">{$smarty.const.FORM_KEYWORDS}</td>
						<td class="form">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<textarea name="arrNoBindFields[meta_keywords]" rows="2" cols="70">{$retFields.arrNoBindFields.meta_keywords}</textarea>
						</td>
					</tr>
				</table>
				<br>
				<table class="Design_panesFormTable">
					{* NEWS DESCRIPTION *}
					<tr>
						<td class="name" style="white-space: nowrap;">{$smarty.const.FORM_DESCRIPTION}</td>
						<td class="form">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<textarea name="arrNoBindFields[meta_description]" rows="2" cols="70">{$retFields.arrNoBindFields.meta_description}</textarea>
						</td>
					</tr>
				</table>
				<table class="Design_panesFormTable">
					{* NEWS COMMENTS *}
					<tr>
						<td class="name" colspan="2">
							<label><input type="checkbox" name="arrNoBindFields[noComments]" {if $retFields.arrNoBindFields.noComments}checked="checked"{/if}>&nbsp;{$smarty.const.FORM_NO_COMMENTS}</label>
						</td>
					</tr>
				</table>
				<br><hr class="Design_panesDelimiter">
				<table class="Design_panesFormTable">
					<tr>
						<td>
                			<div class="submitButtonLight" style="text-align: center;">
								<input type="submit" class="shadow01red"  name="save" value="{$smarty.const.FORM_BUTTON_SAVE}">
							</div>
						</td>
					</tr>
				</table>
			</form>
			</div>		
		</div>
	</div>
</div>


{if $smarty.const.CONF_USE_VISUAL_EDITOR}
<!-- TinyMCE -->
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/modules/tinymce/news_config.js"></script>
<!-- TinyMCE -->
{/if}
