<table cellpadding="0" cellspacing="0" style="width: 100%;">
	<tr>
		<td class="menu_pane">
			{foreach from=$admMenu item="menu"}
				<div class="menu_title" {$menu.attr}>
					<table cellpadding="0" cellspacing="0" style="width: 100%;">
						<tr>
							<td>
								<img class="menu_ico" src="{$menu.ico}" alt="{$menu.name}">{$menu.name}
							</td>
						</tr>
					</table>
				</div>
				<div class="menu_content">
					{foreach from=$menu.content item="menu_content" name="menu_content"}
						{if !$menu_content.subMenu}
							<table cellpadding="0" cellspacing="0" style="width: 100%;">
								<tr>
									<td class="menu_dots{if $smarty.foreach.menu_content.last}l{/if}"></td>
									<td>
										<img class="menu_ico" src="{$menu_content.ico}" alt="{$menu_content.name}"><a href="{$menu_content.link}">{$menu_content.name}</a>
									</td>
								</tr>
							</table>
						{else}
							<div class="submenu_title" {$menu_content.attr}>
								<table cellpadding="0" cellspacing="0" style="width: 100%;">
									<tr style="white-space: nowrap;">
										<td class="menu_dots{if $smarty.foreach.menu_content.last}l{/if}"></td>
										<td>
											<img class="menu_ico" src="{$menu_content.ico}" alt="{$menu_content.name}">{$menu_content.name}
										</td>
									</tr>
								</table>
							</div>
							<div class="submenu_content">
								<table cellpadding="0" cellspacing="0" style="width: 100%;">
									{foreach from=$menu_content.content item="submenu_content" name="submenu_content"}
										<tr>
											<td class="menu_{if $smarty.foreach.menu_content.last}no{/if}dot"></td>
											<td class="menu_dots{if $smarty.foreach.submenu_content.last}l{/if}"></td>
											<td>
												<img class="menu_ico" src="{$submenu_content.ico}" alt="{$submenu_content.name}"><a href="{$submenu_content.link}">{$submenu_content.name}</a>
											</td>
										</tr>
									{/foreach}
								</table>
							</div>
						{/if}
					{/foreach}
				</div>
			{/foreach}
		</td>
	</tr>
</table>
<table class="copyright">
	<tr>
		<td>
			{assign var="year" value=$smarty.now|date_format:"%Y"}
			Works on the engine <a href="http://sd-group.org.ua/" class="white"><b>Expert</b></a><br>
			<span class="lastQuerys">&copy;</span>&nbsp;<a href="http://sd-group.org.ua/" class="white"><b>SD-Group</b></a>&nbsp;{$year} - {$year + 5}
		</td>
	</tr>
</table>
<script type="text/javascript">
<!--
	// проверяем кукисы меню
	if (currCookie = $.cookie('openAdmMenu')) {
		for (var i in arrlist = currCookie.split(',')) {
			$('#' + arrlist[i]).toggleClass('open').next().show();
		}
	}
	// раскрываем текущий раздел меню
	$('#{$currMenu}').removeClass('hide').next().show('fast');
-->
</script>