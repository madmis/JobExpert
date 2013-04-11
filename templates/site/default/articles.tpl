{if $errors}
	{include file="errors.message.tpl"}
{* Просмотр выбранной статьи *}
{elseif $action.view}
	{include file="articles.view.tpl"}
{* Список статей по разделу *}
{elseif $action.section}
	{if $articles}
		<div class="DesignMainPageBody">
		{foreach from=$articles item="article"}
			<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
				<tr>
					<th colspan="2">
						<a class="light" style="display:block;" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?{if 'none' neq $artSections.full[$article.id_section].affiliation}ut=$user_type&amp;{/if}do=articles&amp;action=view&amp;id=`$article.tId`")}"><b>{$article.title}</b></a>
					</th>
				</tr>
				<tr>
					<td colspan="2" class="last AlignLeft">
						<div class="paddingTextBoth5">
							{$article.small_text}
						</div>
					</td>
				</tr>
				<tr>
					<td class="AlignLeft noBorderRight">
						<div class="paddingTextBoth55">
							<strong>{$smarty.const.FORM_DATE}: </strong> {$article.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}
							{if $article.author}&nbsp;|&nbsp;<strong>{$smarty.const.FORM_ARTICLES_AUTHOR}:</strong> {$article.author}{/if}
						</div>
					</td>
					<td class="last AlignRight noBorderLeft">
						<div class="votes" style="float:right;">{$article.votes} {$smarty.const.FORM_ARTICLES_VOTES}</div>
						<div class="base" style="float:right; height:16px; margin-top:-2px;"><div class="average" style="width: {$article.rating}%;">&nbsp;</div></div>
						<div class="rating" style="float:right;">{$smarty.const.FORM_ARTICLES_RATING}: {$article.rating}</div>
					</td>
				</tr>
			</table>
        {/foreach}
		</div>

		<p style="text-align: center;">{$strPages}</p>
	{else}
		<div class="ErrorBlockWrapper">
			<div class="ErrorHeader">{$smarty.const.ERROR_NON_DATA}</div>
			<div class="ErrorBlock">
				<ul>
					<li>{$smarty.const.ERROR_NON_DATA}</li>
				</ul>
			</div>
		</div>
	{/if}
{* Все разделы и статьи *}
{else}
	{* Выводим список разделов *}
	{if $artSections}
		<div class="InfoBlockWrapper" style="margin-left:5px; margin-right:-5px;">
			<div class="withoutHeader"></div>
			<div class="InfoBlock">
			<div>
				<div id="section_list">
				{if $artSections.split.none}
					{* СТАТЬИ ОБЩИЕ *}
					<table class="tableList">
						<tr>
						{foreach from=$artSections.split.none item="section" name="i"}
							<td class="tdTableList">
								<table class="tableSubList">
									<tr>
										<td class="td1">
											<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=rss&amp;action=articles&amp;subaction=section&amp;id=`$section.tId`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/rss_10.png" alt="RSS"></a>
											{if $section.count}
												<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=articles&amp;action=section&amp;id=`$section.tId`")}">{$section.name}</a>
											{else}
												{$section.name}
											{/if}
										</td>
										<td class="td2"></td>
										<td class="td3">{$section.count}</td>
									</tr>
								</table>
							</td>

							{if $smarty.foreach.i.last}
								{if $smarty.foreach.i.iteration is div by 2}
									</tr>
								{else}
									<td colspan="3">&nbsp;</td></tr>
								{/if}
							{elseif $smarty.foreach.i.iteration is div by 2}
								</tr>
							{/if}
						{/foreach}
					</table>
				{/if}

   				{if $artSections.split.employer}
					{if $user_type eq 'employer' OR $user_type eq 'company' OR  $user_type eq 'agent'}
					<table class="tableList">
						<tr>
							<th colspan="2">{$smarty.const.FORM_TYPE_EMPLOYER}</th>
						</tr>					
						<tr>
						{foreach from=$artSections.split.employer item="section" name="i"}
							<td class="tdTableList">
								<table class="tableSubList">
									<tr>
										<td class="td1">
											<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=rss&amp;action=articles&amp;subaction=section&amp;id=`$section.tId`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/rss_10.png" alt="RSS"></a>
											{if $section.count}
												<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=articles&amp;action=section&amp;id=`$section.tId`")}">{$section.name}</a>
											{else}
												{$section.name}
											{/if}
										</td>
										<td class="td2"></td>
										<td class="td3">{$section.count}</td>
									</tr>
								</table>
							</td>

							{if $smarty.foreach.i.last}
								{if $smarty.foreach.i.iteration is div by 2}
									</tr>
								{else}
									<td colspan="3">&nbsp;</td></tr>
								{/if}
							{elseif $smarty.foreach.i.iteration is div by 2}
								</tr>
							{/if}
						{/foreach}
					</table>
					{/if}
				{/if}

				{if $artSections.split.competitor}
					{if $user_type eq 'competitor' OR  $user_type eq 'agent'}
					<table class="tableList">
						<tr>
							<th colspan="2">{$smarty.const.FORM_TYPE_COMPETITOR}</th>
						</tr>					
						<tr>
						{foreach from=$artSections.split.competitor item="section" name="i"}
							<td class="tdTableList">
								<table class="tableSubList">
									<tr>
										<td class="td1">
											<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=rss&amp;action=articles&amp;subaction=section&amp;id=`$section.tId`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/rss_10.png" alt="RSS"></a>
											{if $section.count}
												<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=articles&amp;action=section&amp;id=`$section.tId`")}">{$section.name}</a>
											{else}
												{$section.name}
											{/if}
										</td>
										<td class="td2"></td>
										<td class="td3">{$section.count}</td>
									</tr>
								</table>
							</td>

							{if $smarty.foreach.i.last}
								{if $smarty.foreach.i.iteration is div by 2}
									</tr>
								{else}
									<td colspan="3">&nbsp;</td></tr>
								{/if}
							{elseif $smarty.foreach.i.iteration is div by 2}
								</tr>
							{/if}
						{/foreach}
					</table>
					{/if}
				{/if}
				</div>
				<div class="clearLeft" style="border:none; margin:0px; padding:0px;">&nbsp;</div>
			</div>
			</div>
		</div>

	{/if}

	{*---------------------------------------------*}

	{if $articles}
		<div style="clearLeft">&nbsp;</div>
		<div class="DesignMainPageBody">
		{foreach from=$articles item="article"}
			<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
				<tr>
					<th colspan="2">
						<a class="light" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?{if 'none' neq $artSections.full[$article.id_section].affiliation}ut=$user_type&amp;{/if}do=articles&amp;action=section&amp;id=`$artSections.full[$article.id_section].tId`")}">{$artSections.full[$article.id_section].name}</a>&nbsp;&raquo;&nbsp;
						<a class="light" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?{if 'none' neq $artSections.full[$article.id_section].affiliation}ut=$user_type&amp;{/if}do=articles&amp;action=view&amp;id=`$article.tId`")}"><span style="font-weight:normal">{$article.title}</span></a>
					</th>
				</tr>
				<tr>
					<td colspan="2" class="last AlignLeft">
						<div class="paddingTextBoth5">{$article.small_text}</div>
					</td>
				</tr>
				<tr>
					<td class="AlignLeft noBorderRight">
						<div class="paddingTextBoth55">
							<strong>{$smarty.const.FORM_DATE}: </strong> {$article.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}
							{if $article.author}&nbsp;|&nbsp;<strong>{$smarty.const.FORM_ARTICLES_AUTHOR}:</strong> {$article.author}{/if}
						</div>
					</td>
					<td class="last AlignRight noBorderLeft">
						<div class="votes" style="float:right;">{$article.votes} {$smarty.const.FORM_ARTICLES_VOTES}</div>
						<div class="base" style="float:right; height:16px; margin-top:-2px;"><div class="average" style="width: {$article.rating}%;">&nbsp;</div></div>
						<div class="rating" style="float:right;">{$smarty.const.FORM_ARTICLES_RATING}: {$article.rating}</div>
					</td>
				</tr>
			</table>
		{/foreach}
		</div>
	{else}
		<div class="ErrorBlockWrapper">
			<div class="ErrorHeader">{$smarty.const.ERROR_NON_DATA}</div>
			<div class="ErrorBlock">
				<ul><li>{$smarty.const.ERROR_NON_DATA}</li></ul>
			</div>
		</div>
	{/if}
{*---------------------------------------------*}
	<p style="text-align: center;">{$strPages}</p>
{/if}