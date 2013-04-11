{* Ошибки *}
{if $errors}
	{include file="adm.errors.message.tpl"}
{/if}
{if $xmlTemplate}
	<table style="width: 95%; height: 85%; border: 0px; margin: 10px 25px; background-color: #FFFFCC;" cellpadding="0" cellspacing="0">
		{* Верхний рекламный блок *}
		<tr>
			<td colspan="3" style="width: 100%; height: 5%; border: 1px solid #000000;">
				<div class="ui-state-disabled" style="float: right;">{$smarty.const.FORM_CONF_SERVICE_DESIGNER_ADVERTISEMENT_TOP}</div><br>
			</td>
		</tr>
		{* Шапка сайта *}
		<tr>
			<td colspan="3" style="width: 100%; height: 5%; border: 1px solid #000000; text-align: center;">
				<div class="ui-state-disabled" style="float: right;">{$smarty.const.FORM_CONF_SERVICE_DESIGNER_HEAD}</div><br>
				{if $xmlTemplate.head_site}
					<ul class="blocklist_head_site" id="head_site">
						{foreach from=$xmlTemplate.head_site item="block"}
							<li class="ui-state-default state-disabled portlet" id="{$block}" style="cursor: default; width: 98%;">
								<span class="del_block ui-icon ui-icon-close" style="float: right; cursor: pointer; margin-right: 5px;" title="{$smarty.const.FORM_ACTION_DELETE}">&nbsp;</span>
								<div style="padding: 3px; color: #CC3333;">{$arrTemplates.head_site[$block].header} / {$arrTemplates.head_site[$block].description}</div>
							</li>
						{/foreach}
					</ul>
				{else}
					<input type="button" class="head_site add_block button" value="{$smarty.const.FORM_BUTTON_ADD}..." style="margin: 10px;">
					<div class="blocklist_head_site" id="head_site"></div>
				{/if}
			</td>
		</tr>
		<tr>
			{* Левая панель сайта *}
			<td style="width: 20%; height: 60%; border: 1px solid #000000; text-align: center; vertical-align: top;">
				<div class="ui-state-disabled" style="float: right;">{$smarty.const.FORM_CONF_SERVICE_DESIGNER_LEFT_SIDE}</div>
				<input type="button" class="sides add_block button" value="{$smarty.const.FORM_BUTTON_ADD}..." style="margin: 10px;">
				<ul class="blocklist_sides" id="left_side">
					{if $xmlTemplate.left_side}
						{foreach from=$xmlTemplate.left_side item="block"}
							<li class="ui-state-default portlet" id="{$block}">
								<span class="ui-icon ui-icon-arrow-4-diag" style="float: left;">&nbsp;</span>
								<span class="del_block ui-icon ui-icon-close" style="float: right; cursor: pointer; margin-right: 5px;" title="{$smarty.const.FORM_ACTION_DELETE}">&nbsp;</span><br>
								<div class="portlet-header">{$arrTemplates.sides[$block].header}</div>
								<div class="portlet-content">{$arrTemplates.sides[$block].description}</div>
							</li>
						{/foreach}
					{/if}
				</ul>
			</td>
			{* Центральная панель сайта *}
			<td style="width: 60%; height: 60%; border: 1px solid #000000; text-align: center; vertical-align: top;">
				<table style="width: 100%; height: 100%; border: 0px;" cellpadding="0" cellspacing="0">
					{* Верхний рекламный блок *}
					<tr>
						<td style="width: 100%; height: 10%; border-bottom: 1px solid #000000; vertical-align: top;">
							<div class="ui-state-disabled" style="float: right;">{$smarty.const.FORM_CONF_SERVICE_DESIGNER_ADVERTISEMENT}</div>
						</td>
					</tr>
					{* Подключаемый шаблон *}
					<tr>
						<td style="width: 100%; height: 80%; vertical-align: top;">
							<div class="ui-state-disabled" style="float: right;">{$smarty.const.FORM_CONF_SERVICE_DESIGNER_CENTER_SIDE}</div>
							<ul class="blocklist_center" id="center_side">
								{if $xmlTemplate.center_side}
									{foreach from=$xmlTemplate.center_side item="block"}
										<li class="ui-state-default portlet" id="{$block}">
											<span class="ui-icon ui-icon-arrow-4-diag" style="float: left;">&nbsp;</span>
											<span class="del_block ui-icon ui-icon-close" style="float: right; cursor: pointer; margin-right: 5px;" title="{$smarty.const.FORM_ACTION_DELETE}">&nbsp;</span><br>
											<div class="portlet-header">{$arrTemplates.sides[$block].header}</div>
											<div class="portlet-content">{$arrTemplates.sides[$block].description}</div>
										</li>
									{/foreach}
								{/if}
							</ul>
						</td>
					</tr>
					{* Рекламный блок *}
					<tr>
						<td style="width: 100%; height: 10%; border-top: 1px solid #000000; vertical-align: top;">
							<div class="ui-state-disabled" style="float: right;">{$smarty.const.FORM_CONF_SERVICE_DESIGNER_ADVERTISEMENT}</div>
						</td>
					</tr>

				</table>
			</td>
			{* Правая панель сайта *}
			<td style="width: 20%; height: 60%; border: 1px solid #000000; text-align: center; vertical-align: top;">
				<div class="ui-state-disabled" style="float: right;">{$smarty.const.FORM_CONF_SERVICE_DESIGNER_RIGHT_SIDE}</div>
				<input type="button" class="sides add_block button" value="{$smarty.const.FORM_BUTTON_ADD}..." style="margin: 10px;">
				<ul class="blocklist_sides" id="right_side">
					{if $xmlTemplate.right_side}
						{foreach from=$xmlTemplate.right_side item="block"}
							<li class="ui-state-default portlet" id="{$block}">
								<span class="ui-icon ui-icon-arrow-4-diag" style="float: left;">&nbsp;</span>
								<span class="del_block ui-icon ui-icon-close" style="float: right; cursor: pointer; margin-right: 5px;" title="{$smarty.const.FORM_ACTION_DELETE}">&nbsp;</span><br>
								<div class="portlet-header">{$arrTemplates.sides[$block].header}</div>
								<div class="portlet-content">{$arrTemplates.sides[$block].description}</div>
							</li>
						{/foreach}
					{/if}
				</ul>
			</td>
		</tr>
		{* Футер сайта *}
		<tr>
			<td colspan="3" style="width: 100%; height: 5%; border: 1px solid #000000; text-align: center;">
				<div class="ui-state-disabled" style="float: right;">{$smarty.const.FORM_CONF_SERVICE_DESIGNER_FOOT}</div><br>
				{if $xmlTemplate.foot_site}
					<ul class="blocklist_foot_site" id="foot_site">
						{foreach from=$xmlTemplate.foot_site item="block"}
							<li class="ui-state-default state-disabled portlet" id="{$block}" style="cursor: default; width: 98%;">
								<span class="del_block ui-icon ui-icon-close" style="float: right; cursor: pointer; margin-right: 5px;" title="{$smarty.const.FORM_ACTION_DELETE}">&nbsp;</span>
								<div style="padding: 3px; color: #CC3333;">{$arrTemplates.foot_site[$block].header} / {$arrTemplates.foot_site[$block].description}</div>
							</li>
						{/foreach}
					</ul>
				{else}
					<input type="button" class="foot_site add_block button" value="{$smarty.const.FORM_BUTTON_ADD}..." style="margin: 10px;">
					<div class="blocklist_foot_site" id="foot_site"></div>
				{/if}
			</td>
		</tr>
		{* Нижний рекламный блок *}
		<tr>
			<td colspan="3" style="width: 100%; height: 5%; border: 1px solid #000000;">
				<div class="ui-state-disabled" style="float: right;">{$smarty.const.FORM_CONF_SERVICE_DESIGNER_ADVERTISEMENT_BOTTOM}</div>
			</td>
		</tr>
	</table>
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&amp;s=designer&amp;action=save" method="post" enctype="multipart/form-data" id="save_design" style="text-align: center;">
		<input type="submit" class="button" value="{$smarty.const.FORM_BUTTON_SAVE}" style="margin: 10px;">
	</form>
{/if}

<div class="extend_blocks" style="display: none;">

	<div class="head_site">
		<ul class="blocklist_head_site">
			{foreach from=$arrTemplates.head_site item="block" key="tmpl"}
				<li class="ui-state-default portlet" id="{$tmpl}" style="width: 98%;">
					<span class="del_block ui-icon ui-icon-close" style="float: right; cursor: pointer; margin-right: 5px;" title="{$smarty.const.FORM_ACTION_DELETE}">&nbsp;</span>
					<div style="padding: 3px; color: #CC3333;">{$arrTemplates.head_site[$tmpl].header} / {$arrTemplates.head_site[$tmpl].description}</div>
				</li>
			{/foreach}
		</ul>
	</div>

	<div class="sides">
		<ul class="blocklist_sides">
			<li class="ui-state-default portlet" id="advertisment">
				<span class="ui-icon ui-icon-arrow-4-diag" style="float: left;">&nbsp;</span>
				<span class="del_block ui-icon ui-icon-close" style="float: right; cursor: pointer; margin-right: 5px;" title="{$smarty.const.FORM_ACTION_DELETE}">&nbsp;</span><br>
				<div class="portlet-header">Реклама</div>
				<div class="portlet-content">Рекламный блок</div>
			</li>
			{foreach from=$arrTemplates.sides item="block" key="tmpl"}
				<li class="ui-state-default portlet" id="{$tmpl}">
					<span class="ui-icon ui-icon-arrow-4-diag" style="float: left;">&nbsp;</span>
					<span class="del_block ui-icon ui-icon-close" style="float: right; cursor: pointer; margin-right: 5px;" title="{$smarty.const.FORM_ACTION_DELETE}">&nbsp;</span><br>
					<div class="portlet-header">{$arrTemplates.sides[$tmpl].header}</div>
					<div class="portlet-content">{$arrTemplates.sides[$tmpl].description}</div>
				</li>
			{/foreach}
		</ul>
	</div>

	<div class="foot_site">
		<ul class="blocklist_foot_site">
			{foreach from=$arrTemplates.foot_site item="block" key="tmpl"}
				<li class="ui-state-default portlet" id="{$tmpl}" style="width: 98%;">
					<span class="del_block ui-icon ui-icon-close" style="float: right; cursor: pointer; margin-right: 5px;" title="{$smarty.const.FORM_ACTION_DELETE}">&nbsp;</span>
					<div style="padding: 3px; color: #CC3333;">{$arrTemplates.foot_site[$tmpl].header} / {$arrTemplates.foot_site[$tmpl].description}</div>
				</li>
			{/foreach}
		</ul>
	</div>

</div>

<script type="text/javascript">
<!--
	$(document).ready(function() {
		$('.portlet').addClass('ui-widget ui-widget-content ui-helper-clearfix ui-corner-all').find('.portlet-header').addClass('ui-widget-header ui-corner-all');

		$('.blocklist_head_site').sortable({
			revert: true,
			connectWith: '.blocklist_head_site',
			cancel: '.state-disabled'
		}).disableSelection();

		$('.blocklist_sides').sortable({
			revert: true,
			connectWith: '.blocklist_sides',
			cancel: '.state-disabled'
		}).disableSelection();

		$('.blocklist_foot_site').sortable({
			revert: true,
			connectWith: '.blocklist_foot_site',
			cancel: '.state-disabled'
		}).disableSelection();

		$('.add_block').click(function() {
			if ($(this).hasClass('sides')) {
				currClass = '.sides';
			} else if ($(this).hasClass('head_site')) {
				currClass = '.head_site';
			} else if ($(this).hasClass('foot_site')) {
				currClass = '.foot_site';
			}

			var targ = $('.extend_blocks').find(currClass);
			$.fn.colorbox({ inline: true, href: targ, width: '40%', height: '60%', opacity: 0, scrolling: true });
			$(targ).parent().css('overflow-x','hidden').parent().parent().parent().parent().draggable().css('cursor','move');
		});

		$('.del_block').click(function() {
			if (confirm('{$smarty.const.MESSAGE_DELETE_BLOCK}')) {
				$(this).parent().remove();
			}
		});

		$('#save_design').submit(function() {
			$('.blocklist_head_site, .blocklist_sides, .blocklist_foot_site').each(function() {
				var arrBlocks = $(this).sortable('toArray')
				for (block in arrBlocks) {
					$('#save_design').prepend('<input type="hidden" name="arrBlocks[' + $(this).attr('id') + '][]" value="' + arrBlocks[block] + '">');
				}
			});
		});
	});
-->
</script>