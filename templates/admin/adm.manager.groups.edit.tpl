<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=groups&amp;action=edit&amp;id={$arrGroup.rights.id}" method="post" enctype="multipart/form-data">
<table style="width: 100%; border-spacing: 5px;" cellpadding="5">
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_NAME}</td>
		<td>
			<input type="text" name="id" size="50" value="{$arrGroup.rights.id|upper}" class="text" readonly="readonly">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_ID">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	
{* Права группы *}
	<tr>
		<td colspan="3" class="data_head">
			{$smarty.const.TABLE_COLUMN_RIGHTS}
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RIGHT_EDIT_VACANCY}</td>
		<td>
			<input type="radio" name="arrRights[edit_vacancy]" value="1" {if $arrGroup.rights.edit_vacancy}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrRights[edit_vacancy]" value="0" {if !$arrGroup.rights.edit_vacancy}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RIGHT_EDIT_VACANCY">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RIGHT_DEL_VACANCY}</td>
		<td>
			<input type="radio" name="arrRights[del_vacancy]" value="1" {if $arrGroup.rights.del_vacancy}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrRights[del_vacancy]" value="0" {if !$arrGroup.rights.del_vacancy}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RIGHT_DEL_VACANCY">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RIGHT_EDIT_RESUME}</td>
		<td>
			<input type="radio" name="arrRights[edit_resume]" value="1" {if $arrGroup.rights.edit_resume}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrRights[edit_resume]" value="0" {if !$arrGroup.rights.edit_resume}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RIGHT_EDIT_RESUME">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RIGHT_DEL_RESUME}</td>
		<td>
			<input type="radio" name="arrRights[del_resume]" value="1" {if $arrGroup.rights.del_resume}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrRights[del_resume]" value="0" {if !$arrGroup.rights.del_resume}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RIGHT_DEL_RESUME">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
{* разрешаем менять права новостей только в том случае, если группа не ГОСТЬ *}
{if $arrGroup.rights.id !== 'guest'}
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RIGHT_ADD_ARTICLES}</td>
		<td>
			<input type="radio" name="arrRights[add_articles]" value="1" {if $arrGroup.rights.add_articles}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrRights[add_articles]" value="0" {if !$arrGroup.rights.add_articles}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RIGHT_ADD_ARTICLES">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RIGHT_EDIT_ARTICLES}</td>
		<td>
			<input type="radio" name="arrRights[edit_articles]" value="1" {if $arrGroup.rights.edit_articles}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrRights[edit_articles]" value="0" {if !$arrGroup.rights.edit_articles}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RIGHT_EDIT_ARTICLES">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RIGHT_ARC_ARTICLES}</td>
		<td>
			<input type="radio" name="arrRights[arc_articles]" value="1" {if $arrGroup.rights.arc_articles}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrRights[arc_articles]" value="0" {if !$arrGroup.rights.arc_articles}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RIGHT_ARC_ARTICLES">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RIGHT_DEL_ARTICLES}</td>
		<td>
			<input type="radio" name="arrRights[del_articles]" value="1" {if $arrGroup.rights.del_articles}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrRights[del_articles]" value="0" {if !$arrGroup.rights.del_articles}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RIGHT_DEL_ARTICLES">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RIGHT_ADD_NEWS}</td>
		<td>
			<input type="radio" name="arrRights[add_news]" value="1" {if $arrGroup.rights.add_news}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrRights[add_news]" value="0" {if !$arrGroup.rights.add_news}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RIGHT_ADD_NEWS">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RIGHT_EDIT_NEWS}</td>
		<td>
			<input type="radio" name="arrRights[edit_news]" value="1" {if $arrGroup.rights.edit_news}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrRights[edit_news]" value="0" {if !$arrGroup.rights.edit_news}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RIGHT_EDIT_NEWS">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RIGHT_ARC_NEWS}</td>
		<td>
			<input type="radio" name="arrRights[arc_news]" value="1" {if $arrGroup.rights.arc_news}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrRights[arc_news]" value="0" {if !$arrGroup.rights.arc_news}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RIGHT_ARC_NEWS">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RIGHT_DEL_NEWS}</td>
		<td>
			<input type="radio" name="arrRights[del_news]" value="1" {if $arrGroup.rights.del_news}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrRights[del_news]" value="0" {if !$arrGroup.rights.del_news}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RIGHT_DEL_NEWS">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
{/if}
	
{* Обязанности группы *}
	<tr>
		<td colspan="3" class="data_head">
			{$smarty.const.TABLE_COLUMN_RESP}
		</td>
	</tr>
{* если группа не ГОСТЬ *}
{if $arrGroup.rights.id !== 'guest'}
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RESP_MODER_ACCOUNT}</td>
		<td>
			<input type="radio" name="arrResp[moder_account]" value="1" {if $arrGroup.resp.moder_account}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrResp[moder_account]" value="0" {if !$arrGroup.resp.moder_account}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RESP_MODER_ACCOUNT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
{/if}
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RESP_ACT_VACANCY}</td>
		<td>
			<input type="radio" name="arrResp[act_vacancy]" value="1" {if $arrGroup.resp.act_vacancy}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrResp[act_vacancy]" value="0" {if !$arrGroup.resp.act_vacancy}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RESP_ACT_ANNOUNCE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RESP_ACT_RESUME}</td>
		<td>
			<input type="radio" name="arrResp[act_resume]" value="1" {if $arrGroup.resp.act_resume}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrResp[act_resume]" value="0" {if !$arrGroup.resp.act_resume}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RESP_ACT_ANNOUNCE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RESP_MODER_VACANCY}</td>
		<td>
			<input type="radio" name="arrResp[moder_vacancy]" value="1" {if $arrGroup.resp.moder_vacancy}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrResp[moder_vacancy]" value="0" {if !$arrGroup.resp.moder_vacancy}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RESP_MODER_ANNOUNCE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RESP_MODER_RESUME}</td>
		<td>
			<input type="radio" name="arrResp[moder_resume]" value="1" {if $arrGroup.resp.moder_resume}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrResp[moder_resume]" value="0" {if !$arrGroup.resp.moder_resume}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RESP_MODER_ANNOUNCE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
{* если группа не ГОСТЬ *}
{if $arrGroup.rights.id !== 'guest'}
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RESP_MODER_ARTICLES}</td>
		<td>
			<input type="radio" name="arrResp[moder_articles]" value="1" {if $arrGroup.resp.moder_articles}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrResp[moder_articles]" value="0" {if !$arrGroup.resp.moder_articles}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RESP_MODER_ARTICLES">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr class="data_body">
		<td>{$smarty.const.FORM_GROUP_RESP_MODER_NEWS}</td>
		<td>
			<input type="radio" name="arrResp[moder_news]" value="1" {if $arrGroup.resp.moder_news}checked{/if}> {$smarty.const.FORM_YES}
			<input type="radio" name="arrResp[moder_news]" value="0" {if !$arrGroup.resp.moder_news}checked{/if}> {$smarty.const.FORM_NO}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_GROUP_RESP_MODER_NEWS">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
{/if}

	<tr>
		<td style="text-align: center;" colspan="3">
			<input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button">
			{if $arrGroup.rights.id !== "guest" AND $arrGroup.rights.id !== "user"}
				<input type="submit" name="delete" value="{$smarty.const.FORM_BUTTON_DELETE}" class="button">
			{/if}
		</td>
	</tr>
</table>
</form>
