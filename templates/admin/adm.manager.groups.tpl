<p class="sub_menu">
	<span class="colorbox_help" id="HELP_ADMIN_MANAGER_GROUPS">
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}">
	</span>
</p>

{* Шаблон вывода ошибок *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

{* Шаблон настроек групп, типов и прав *}
{if $action.config}
	{include file="adm.manager.groups.config.tpl"}
{* Шаблон редактирования прав группы *}
{elseif $action.edit}
	{include file="adm.manager.groups.edit.tpl"}
{else}

	{* Форма добавления группы *}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=groups" method="post" enctype="multipart/form-data">
		<p><input type="text" name="arrBindFields[id]" size="20" value="" class="text"> <input type="submit" value="{$smarty.const.FORM_BUTTON_ADD_GROUP}" class="button"></p>
	</form>

	{* Список групп *}
	<div style="float: left; width: 40%;">
		<table style="width: 100%; border-spacing: 5px;" cellpadding="5">
			<thead class="data_head">
				<tr>
					<td>{$smarty.const.TABLE_COLUMN_GROUP}</td>
					<td>{$smarty.const.TABLE_COLUMN_OPTIONS}</td>
				</tr>
			</thead>
			<tbody class="data_body">
				{foreach from=$arrGroups item="group"}
				<tr class="tr_hover">
					<td>
						<a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=groups&amp;action=edit&amp;id={$group.id}" title="{$smarty.const.FORM_ACTION_EDIT}">{$group.id|upper}</a>
					</td>
					<td id="{$group.id}" class="group_detail">
						{$smarty.const.TABLE_COLUMN_RIGHTS}
						<div class="hidden_table">
							<div id="open_{$group.id}">
							<table style="border-spacing: 3px;" cellpadding="5">
								<tr class="data_head">
									<td colspan="2">{$group.id|upper}</td>
								</tr>
								<tr class="data_body">
									<td class="subhead" colspan="2">{$smarty.const.TABLE_COLUMN_RIGHTS}</td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RIGHT_EDIT_VACANCY}</td>
									<td style="text-align: center;"><img {if $group.edit_vacancy}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RIGHT_DEL_VACANCY}</td>
									<td style="text-align: center;"><img {if $group.del_vacancy}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RIGHT_EDIT_RESUME}</td>
									<td style="text-align: center;"><img {if $group.edit_resume}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RIGHT_DEL_RESUME}</td>
									<td style="text-align: center;"><img {if $group.del_resume}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
							{if $group.id neq 'guest'}
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RIGHT_ADD_ARTICLES}</td>
									<td style="text-align: center;"><img {if $group.add_articles}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RIGHT_EDIT_ARTICLES}</td>
									<td style="text-align: center;"><img {if $group.edit_articles}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RIGHT_ARC_ARTICLES}</td>
									<td style="text-align: center;"><img {if $group.arc_articles}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RIGHT_DEL_ARTICLES}</td>
									<td style="text-align: center;"><img {if $group.del_articles}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RIGHT_ADD_NEWS}</td>
									<td style="text-align: center;"><img {if $group.add_news}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RIGHT_EDIT_NEWS}</td>
									<td style="text-align: center;"><img {if $group.edit_news}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RIGHT_ARC_NEWS}</td>
									<td style="text-align: center;"><img {if $group.arc_news}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RIGHT_DEL_NEWS}</td>
									<td style="text-align: center;"><img {if $group.del_news}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
							{/if}
								<tr class="data_body">
									<td class="subhead" colspan="2">{$smarty.const.TABLE_COLUMN_RESP}</td>
								</tr>
							{if $group.id neq 'guest'}
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RESP_MODER_ACCOUNT}</td>
									<td style="text-align: center;"><img {if $group.moder_account}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
							{/if}
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RESP_ACT_VACANCY}</td>
									<td style="text-align: center;"><img {if $group.act_vacancy}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RESP_ACT_RESUME}</td>
									<td style="text-align: center;"><img {if $group.act_resume}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RESP_MODER_VACANCY}</td>
									<td style="text-align: center;"><img {if $group.moder_vacancy}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RESP_MODER_RESUME}</td>
									<td style="text-align: center;"><img {if $group.moder_resume}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
							{if $group.id neq 'guest'}
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RESP_MODER_ARTICLES}</td>
									<td style="text-align: center;"><img {if $group.moder_articles}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
								<tr class="data_body">
									<td style="white-space: nowrap;">{$smarty.const.FORM_GROUP_RESP_MODER_NEWS}</td>
									<td style="text-align: center;"><img {if $group.moder_news}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.FORM_YES}"{else}src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.FORM_NO}"{/if}></td>
								</tr>
							{/if}

							</table>
							</div>
						</div>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
		</div>
	
	<div style="float: left; width: 50%;" id="detail">
		
	</div>

<script type="text/javascript">
<!--
$(function() {
	//Подробный просмотр
	$('.group_detail').click(function() {
		var targ = $('#open_' + $(this).attr('id')).html();
		$('#detail').html(targ);
	});
});
-->
</script>

{/if}

