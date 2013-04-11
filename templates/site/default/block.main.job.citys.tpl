{if $user_type eq 'agent' OR $user_type eq 'competitor'}
	{assign var="text" value="Работа"}
	{assign var="type" value="$user_type/vacancy"}
{else}
	{assign var="text" value="Резюме"}
	{assign var="type" value="$user_type/resume"}
{/if}

<table class="mainBodyTable" cellspacing="0">
	<tr>
		<th colspan="3"></th>
	</tr>
	<tr>
		<td style="vertical-align: top;">
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/139-kiev.html" title="{$text} в Киеве">{$text} в Киеве</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/12-simferopol.html" title="{$text} в Симферополе">{$text} в Симферополе</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/20-vinnica.html" title="{$text} в Виннице">{$text} в Виннице</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/39-luck.html" title="{$text} в Луцке">{$text} в Луцке</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/48-dnepropetrovsk.html" title="{$text} в Днепропетровске">{$text} в Днепропетровске</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/69-doneck.html" title="{$text} в Донецке">{$text} в Донецке</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/93-zhitomir.html" title="{$text} в Житомире">{$text} в Житомире</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/108-uzhgorod.html" title="{$text} в Ужгороде">{$text} в Ужгороде</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/115-zaporozhe.html" title="{$text} в Запорожье">{$text} в Запорожье</a></div>
			</div>
		</td>
		<td style="vertical-align: top;">
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/129-ivano-frankovsk.html" title="{$text} в Ивано-Франковске">{$text} в Ивано-Франковске</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/171-kirovograd.html" title="{$text} в Кировограде">{$text} в Кировограде</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/191-lugansk.html" title="{$text} в Луганске">{$text} в Луганске</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/227-lvov.html" title="{$text} во Львове">{$text} во Львове</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/247-nikolaev.html" title="{$text} в Николаеве">{$text} в Николаеве</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/264-odessa.html" title="{$text} в Одессе">{$text} в Одессе</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/280-poltava.html" title="{$text} в Полтаве">{$text} в Полтаве</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/292-rovno.html" title="{$text} в Ровно">{$text} в Ровно</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/304-sumy.html" title="{$text} в Суммах">{$text} в Суммах</a></div>
			</div>
		</td>
		<td class="last" style="vertical-align: top;">
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/321-ternopol.html" title="{$text} в Тернополе">{$text} в Тернополе</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/339-harkov.html" title="{$text} в Харькове">{$text} в Харькове</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/348-herson.html" title="{$text} в Херсоне">{$text} в Херсоне</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/345-novaya-kahovka.html" title="{$text} в Новой Каховке">{$text} в Новой Каховке</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/361-hmelnickiy.html" title="{$text} в Хмельницком">{$text} в Хмельницком</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/376-cherkassy.html" title="{$text} в Черкассах">{$text} в Черкассах</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/393-chernigov.html" title="{$text} в Чернигове">{$text} в Чернигове</a></div>
			</div>
			<div class="DesignCenterSideBarBlockWrapper">
				<div class="newsBlockLast"><a href="{$smarty.const.CONF_SCRIPT_URL}{$type}/citys/405-chernovcy.html" title="{$text} в Черновцах">{$text} в Черновцах</a></div>
			</div>
		</td>
	</tr>
</table>
