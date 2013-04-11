{* Верхний переключатель языков, маленькие кнопки навигации *}
<table style="width: 100%; border: 0px;" cellpadding="0" cellspacing="0">
	<tr>
		<td class="DesignTopLogo" nowrap="nowrap">
			<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type")}" title="{$smarty.const.CONF_SITE_NAME}">
				<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/topLogo.png" alt="{$smarty.const.CONF_SITE_NAME}">
			</a>
			<!--<g:plusone size="tall"></g:plusone>-->
		</td>
		<td class="DesignTopLangButtons">
			{if $siteLangs}
				<ul class="langMenu">
					{foreach from=$siteLangs item='lang' name='langs'}
						<li id="{$lang.id}"{if !$smarty.foreach.langs.first} class="hidden{if $smarty.foreach.langs.last} last{/if}"{/if}>
							<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icoLangs/{$lang.id}.png" title="{$lang.description}" alt="">
						</li>
					{/foreach}
				</ul>
				<div class="ulLabel">{$smarty.const.SITE_LANGUAGE}:&nbsp;</div>
			{else}
				&nbsp;
			{/if}
		</td>
		<td class="DesignTopNaviButtonDelimiter40">&nbsp;</td>
		<td class="DesignTopNaviButtonHome">
			<a class="active" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type")}" title="{$smarty.const.MENU_MAIN}"></a>
		</td>
		<td class="DesignTopNaviButtonMap">
			<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=sitemap")}" title="{$smarty.const.MENU_SITEMAP}"></a>
		</td>
		<td class="DesignTopNaviButtonContact">
			<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=feedback")}" title="{$smarty.const.MENU_FEEDBACK}"></a>
		</td>
		<td class="DesignTopNaviButtonDelimiter10">&nbsp;</td>
	</tr>
</table>
{* Логотип *}
{* Ссылки сабменю *}
{include file="top.menu.tpl"}
<script type="text/javascript">
<!--
$(document).ready(function() {
	$('.langMenu li:first').wrapInner(document.createElement('span'));
	$('.langMenu').click(function () {
		$(this).find('.hidden').slideToggle().click(function () {
			$.cookie('currLang', $(this).attr('id'), { path: '/', expires: 30 });
			location.reload();
			var currLang = $(this).clone().removeClass('hidden last').wrapInner(document.createElement('span'));
			$('.langMenu').empty().append(currLang);
		});
	});
});
-->
</script>