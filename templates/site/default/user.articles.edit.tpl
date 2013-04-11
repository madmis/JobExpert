{if $arrArticle}
	<div class="Design_panesBGWrapper">
		<div class="Design_panesBG">
			<ul class="Design_tabs">
				<li><a class="active" href="javascript:void(0);" style="cursor: default;">{$smarty.const.FORM_ARTICLES_EDIT}</a></li>
			</ul>
			<div class="Design_panes">
				<div>
				<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.articles&amp;action=edit&amp;id=`$arrArticle.tId`")}" method="post" enctype="multipart/form-data">
					{if $arrArticle.token eq 'correction'}
					<table class="Design_panesFormTable">
						{* ADMIN COMMENTS *}
						<tr>
							<td colspan="2">
								<p><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="attention">&nbsp;<strong>{$smarty.const.FORM_ADMIN_COMMENTS}</strong></p>
								<div class="paddingTextBoth5">{$arrArticle.comments}</div>

							</td>
						</tr>
					</table>
					<br><hr class="Design_panesDelimiter"><br>
					{/if}
					<table class="Design_panesFormTable">
						{* ARTICLE SECTION *}
						<tr>
							<td class="name">{$smarty.const.FORM_SECTIONS}&nbsp;<span class="text-red">*</span></td>
							<td class="form">
								<select name="arrBindFields[id_section]">
								{if $arrArtSections.split.none}
									<option value="" style="font-weight: bold;">------- {$smarty.const.FORM_GENERAL} -------</option>
									{foreach from=$arrArtSections.split.none item="section"}
										<option value="{$section.id}" {if $retFields}{if $retFields.arrBindFields.id_section eq $section.id}selected="selected"{/if}{else}{if $arrArticle.id_section eq $section.id}selected="selected"{/if}{/if}>{$section.name}</option>
									{/foreach}
								{/if}
								{if ($user_type eq 'agent' OR $user_type eq 'employer' OR $user_type eq 'company') AND $arrArtSections.split.employer}
									<option value="" style="font-weight: bold;">------- {$smarty.const.FORM_TYPE_EMPLOYER} -------</option>
									{foreach from=$arrArtSections.split.employer item="section"}
										<option value="{$section.id}" {if $retFields}{if $retFields.arrBindFields.id_section eq $section.id}selected="selected"{/if}{else}{if $arrArticle.id_section eq $section.id}selected="selected"{/if}{/if}>{$section.name}</option>
									{/foreach}
								{/if}
								{if ($user_type eq 'agent' OR $user_type eq 'competitor') AND $arrArtSections.split.competitor}
									<option value="" style="font-weight: bold;">------- {$smarty.const.FORM_TYPE_COMPETITOR} -------</option>
									{foreach from=$arrArtSections.split.competitor item="section"}
										<option value="{$section.id}" {if $retFields}{if $retFields.arrBindFields.id_section eq $section.id}selected="selected"{/if}{else}{if $arrArticle.id_section eq $section.id}selected="selected"{/if}{/if}>{$section.name}</option>
									{/foreach}
								{/if}
								</select>
							</td>
						</tr>
					</table>
					<br>
					<table class="Design_panesFormTable">
						{* ARTICLE PUBLICATION DATE *}
						<tr>
							<td class="name" style="white-space: nowrap;">{$smarty.const.FORM_PUBLICATION_DATE}&nbsp;<span class="text-red">*</span></td>
							<td class="form">
								{* Определяем дату *}
								{if $retFields.arrBindFields.date}{assign var="date" value=$retFields.arrBindFields.date}{else}{assign var="date" value=$arrArticle.datetime}{/if}
								{html_select_date time=$date field_array="date" field_order="DMY" end_year="+3" month_format="%m"}
							</td>
							<td class="name" style="white-space: nowrap;">{$smarty.const.FORM_PUBLICATION_TIME}&nbsp;<span class="text-red">*</span></td>
							<td class="form">
								{if $retFields.arrBindFields.time}{assign var="time" value=$retFields.arrBindFields.time}{else}{assign var="time" value=$arrArticle.datetime}{/if}
								{html_select_time time=$time field_array="time" use_24_hours=true display_seconds=false minute_interval="5"}
            					<span class="user_help" id="HELP_ARTICLES_PUBLICATION_DATE">
            						<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/info.png" alt="Info">
            					</span>
							</td>
						</tr>
					</table>
					<br>
					<table class="Design_panesFormTable">
						{* ARTICLE TITLE *}
						<tr>
							<td class="name">{$smarty.const.FORM_TITLE}&nbsp;<span class="text-red">*</span></td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="text" name="arrBindFields[title]" value="{if $retFields}{$retFields.arrBindFields.title|escape}{else}{$arrArticle.title|escape}{/if}" style="width:600px;" maxlength="255">
							</td>
						</tr>
					</table>
					<br><hr class="Design_panesDelimiter"><br>
					<table class="Design_panesFormTable">
						{* ARTICLE SMALL TEXT *}
						<tr>
							<td class="name">{$smarty.const.FORM_SMALL_TEXT}&nbsp;<span class="text-red">*</span></td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea name="arrBindFields[small_text]" rows="5" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{if $retFields}{$retFields.arrBindFields.small_text}{else}{$arrArticle.small_text}{/if}</textarea>
							</td>
						</tr>
					</table>
					<br>
					<table class="Design_panesFormTable">
						{* ARTICLE TEXT *}
						<tr>
							<td class="name">{$smarty.const.FORM_TEXT}&nbsp;<span class="text-red">*</span></td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea name="arrBindFields[text]" rows="5" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{if $retFields}{$retFields.arrBindFields.text}{else}{$arrArticle.text}{/if}</textarea>
							</td>
						</tr>
					</table>
					<br>
					<table class="Design_panesFormTable">
						{* ARTICLE KEYWORDS *}
						<tr>
							<td class="name">{$smarty.const.FORM_KEYWORDS}</td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea name="arrNoBindFields[meta_keywords]" rows="2" cols="70">{if $retFields}{$retFields.arrNoBindFields.meta_keywords}{else}{$arrArticle.meta_keywords}{/if}</textarea>
							</td>
						</tr>
					</table>
					<br>
					<table class="Design_panesFormTable">
						{* ARTICLE DESCRIPTION *}
						<tr>
							<td class="name" style="white-space: nowrap;">{$smarty.const.FORM_DESCRIPTION}</td>
							<td class="form">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea name="arrNoBindFields[meta_description]" rows="2" cols="70">{if $retFields}{$retFields.arrNoBindFields.meta_description}{else}{$arrArticle.meta_description}{/if}</textarea>
							</td>
						</tr>
					</table>
					<table class="Design_panesFormTable">
						{* NEWS COMMENTS *}
						<tr>
							<td class="name" colspan="2">
								<label><input type="checkbox" name="arrNoBindFields[noComments]" {if $arrArticle.noComments}checked="checked"{/if}>&nbsp;{$smarty.const.FORM_NO_COMMENTS}</label>
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