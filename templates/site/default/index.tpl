<!DOCTYPE html>
<html>

{* Подключаем header сайта *}
{include file="head.tpl"}

	<body>
		<!-- Проверка кукисов и JavaScript -->
		<div id="coockie_disabled">{$smarty.const.COOKIE_DISABLED}</div>
		<script type="text/javascript">
		<!--
			(!navigator.cookieEnabled) ? $('#coockie_disabled').show(1000) : null;
		-->
		</script>
		<noscript><p class="noscript">{$smarty.const.JAVASCRIPT_DISABLED}</p></noscript>
		<!-- Проверка кукисов и JavaScript -->

		{if $xmlTemplate}
			<table style="width: 100%; min-width:1200px;" cellpadding="0" cellspacing="0">

				{* Верхний рекламный блок *}
				{if $mods.adsimple.token eq 'active' && $advert->get('toper')}
					<tr>
						<td colspan="3" style="padding: 5px;">
							<center>{$advert->getShuffleCode('toper')}</center>
						</td>
					</tr>
				{/if}

				{* Шапка сайта *}
				{if $xmlTemplate.head_site}
					<tr>
						<td colspan="3">
							{foreach from=$xmlTemplate.head_site item="block"}
								{include file=$block}
							{/foreach}
						</td>
					</tr>
				{/if}

				<tr>
					{* Левая панель сайта *}
						{if $xmlTemplate.left_side}
							<td class="DesignSideBarLeft" valign="top">
								{foreach from=$xmlTemplate.left_side item="block"}
									{if $block eq 'advertisment'}
										{if $mods.adsimple.token eq 'active' && $advert->get('advertisement_left')}
											<table cellspacing="0" cellpadding="0" style="width: 100%;">
												<tr>
													<td class="text_block">
														{$advert->getShuffleCode('advertisement_left')}
													</td>
												</tr>
											</table>
										{/if}
									{else}
										{include file=$block}
									{/if}
								{/foreach}
							</td>
						{/if}

					{* Центральная панель сайта *}
						<td align="center" class="td_center">

							{* Рекламный блок *}
							{if $mods.adsimple.token eq 'active' AND $advert->get('advertisement_top')}
								{$advert->getShuffleCode('advertisement_top')}
							{/if}

							{if $namePage|default:false}
								<h1 class="DesignPageHeader">
									{foreach from=$namePage item="page" name="page"}
										{if $page.link}
											<a href="{$page.link}" title="{$page.name}">{$page.name|truncate:150:'...'}</a>{if !$smarty.foreach.page.last}&nbsp;&raquo;{/if}
										{else}
											{$page.name|truncate:150:'...'}{if !$smarty.foreach.page.last}&nbsp;&raquo;{/if}
										{/if}
									{/foreach}
								</h1>
							{/if}

							{* Подключаемый шаблон *}
							{include file=$main_template}

							{* Рекламный блок *}
							{if $mods.adsimple.token eq 'active' AND $advert->get('advertisement_bottom')}
								{$advert->getShuffleCode('advertisement_bottom')}
							{/if}

							<!-- Holy hack for IE6 min-width -->
							<div style="width:650px; height:1px; font-size:1px; clear:both;">&nbsp;</div>
						</td>

					{* Правая панель сайта *}
						{if $xmlTemplate.right_side}
							<td class="DesignSideBarRight" valign="top">
								{foreach from=$xmlTemplate.right_side item="block"}
									{if $block eq 'advertisment'}
										{if $mods.adsimple.token eq 'active' && $advert->get('advertisement_right')}
											<table cellspacing="0" cellpadding="0" style="width: 100%;">
												<tr>
													<td class="text_block">
														{$advert->getShuffleCode('advertisement_right')}
													</td>
												</tr>
											</table>
										{/if}
									{else}
										{include file=$block}
									{/if}
								{/foreach}
							</td>
						{/if}
				</tr>

				<tr>
					<td colspan="3">
						{include file='block.main.footer.job.sections.tpl'}
					</td>
				</tr>

				{* Футер сайта *}
				{if $xmlTemplate.foot_site}
					<tr>
						<td colspan="3">
							{foreach from=$xmlTemplate.foot_site item="block"}
								{include file=$block}
							{/foreach}
						</td>
					</tr>
				{/if}

				{* Нижний рекламный блок *}
				{if $mods.adsimple.token eq 'active' AND $advert->get('bottomer')}
					<tr>
						<td colspan="3" style="padding: 5px;">
							<center>{$advert->getShuffleCode('bottomer')}</center>
						</td>
					</tr>
				{/if}

			</table>
		{/if}

		{if $smarty.const.TEMPLATE_DEBUGGING}
			<div id="lastQuerys" style="display: none;">
				{foreach from=$ScriptWorkReport.ListAllQuerysToDB item="query"}
					<p>{if $query.Query}{$query.Query}{else}{$query.QuerySelect}{/if}</p>
				{/foreach}
			</div>
			<script type="text/javascript">
			<!--
				$(document).ready(function() {
					//запросы к базе
					$('.lastQuerys').click(function() {
						$.fn.colorbox({ html: $('#lastQuerys').html(), preloading: true, opacity: 0, open: true, maxWidth: '100%', maxHeight: '100%', scrolling: true });
						$(this).parent().css('overflow-x','hidden');
					});
				});
			-->
			</script>
		{/if}

		<script type="text/javascript">
		<!--
			$(document).ready(function() {
				// проверяем кукисы меню
				if (currCookie = $.cookie('closedUserBlocks')) {
					for (var i in arrlist = currCookie.split(',')) {
						$('#' + arrlist[i]).addClass('closed').next().hide();
					}
				}
				// обрабатываем клики меню
				$('.sideBlockHeader').click(function() {
					$(this).toggleClass('closed').next().toggle('fast');
					var arrlist = [];
					$('.closed').each(function() {
						arrlist.push($(this).attr('id'));
					});
					$.cookie('closedUserBlocks', arrlist.join(), { path: '/', expires: 30 });
				});
				$('.openLink').click(function () {
					window.location.href = $(this).find('.gotoLink').val();
				});
			});
		-->
		</script>
	</body>
</html>