{if $arrNews}
	<div class="Design_panesBGWrapper">
		<div class="Design_panesBG">
			<ul class="Design_tabs">
				<li><a class="active" href="javascript:void(0);" style="cursor: default;">{$smarty.const.FORM_NEWS_EDIT}</a></li>
			</ul>
			<div class="Design_panes">
				<div>
				<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.news&amp;action=edit&amp;id=`$arrNews.tId`")}" method="post" enctype="multipart/form-data">
					{if $arrNews.token eq 'correction'}
					<table class="Design_panesFormTable">
						{* ADMIN COMMENTS *}
						<tr>
							<td colspan="2">
								<p><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="attention">&nbsp;<strong>{$smarty.const.FORM_ADMIN_COMMENTS}</strong></p>
								<div class="paddingTextBoth5">{$arrNews.comments|nl2br}</div>

							</td>
						</tr>
					</table>
					<br><hr class="Design_panesDelimiter"><br>
					{/if}
					<table class="Design_panesFormTable">
						{* NEWS PUBLICATION DATE *}
						<tr>
							<td class="name" style="white-space: nowrap;">{$smarty.const.FORM_PUBLICATION_DATE}&nbsp;<span class="text-red">*</span></td>
							<td class="form">
								{* Определяем дату *}
								{if $retFields.arrBindFields.date}{assign var="date" value=$retFields.arrBindFields.date}{else}{assign var="date" value=$arrNews.datetime}{/if}
								{html_select_date time=$date field_array="date" field_order="DMY" end_year="+3" month_format="%m"}
							</td>
							<td class="name" style="white-space: nowrap;">{$smarty.const.FORM_PUBLICATION_TIME}&nbsp;<span class="text-red">*</span></td>
							<td class="form">
								{if $retFields.arrBindFields.time}{assign var="time" value=$retFields.arrBindFields.time}{else}{assign var="time" value=$arrNews.datetime}{/if}
								{html_select_time time=$time field_array="time" use_24_hours=true display_seconds=false minute_interval="5"}
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
								<input type="text" name="arrBindFields[title]" value="{if $retFields}{$retFields.arrBindFields.title|escape}{else}{$arrNews.title|escape}{/if}" style="width:600px;" maxlength="255">
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
								<textarea name="arrBindFields[small_text]" rows="5" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{if $retFields}{$retFields.arrBindFields.small_text}{else}{$arrNews.small_text}{/if}</textarea>
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
								<textarea name="arrBindFields[text]" rows="5" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{if $retFields}{$retFields.arrBindFields.text}{else}{$arrNews.text}{/if}</textarea>
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
								<textarea name="arrNoBindFields[meta_keywords]" rows="2" cols="70">{if $retFields}{$retFields.arrNoBindFields.meta_keywords}{else}{$arrNews.meta_keywords}{/if}</textarea>
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
								<textarea name="arrNoBindFields[meta_description]" rows="2" cols="70">{if $retFields}{$retFields.arrNoBindFields.meta_description}{else}{$arrNews.meta_description}{/if}</textarea>
							</td>
						</tr>
					</table>
					<table class="Design_panesFormTable">
						{* NEWS COMMENTS *}
						<tr>
							<td class="name" colspan="2">
								<label><input type="checkbox" name="arrNoBindFields[noComments]" {if $arrNews.noComments}checked="checked"{/if}>&nbsp;{$smarty.const.FORM_NO_COMMENTS}</label>
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
{/if}