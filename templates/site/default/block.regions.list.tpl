    <div class="DesignLeftSideBarBlockWrapperB">
        <h3 class="sideBlockHeader" id="regionsList">{$smarty.const.MENU_ANNOUNCES_NAVIGATOR}&nbsp;{$smarty.const.MENU_ANNOUNCES_NAVIGATOR_ON_REGIONS}</h3>
        <ul>
            {* ------------------------ *}
            {assign var="i" value="1"}

            {if $menu eq "vacancy" && ($actPage.regions|default:false || $actPage.citys|default:false)}
                {assign var="i" value=$i+1}
            {/if}
            {* ------------------------ *}
            <li class="{if ($i%2)}even{else}odd{/if}">
                <a class="withIcon" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&amp;action=regions")}">{$smarty.const.FORM_VACANCYS_HEAD}</a>
                <a class="icon" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=rss&amp;action=vacancy")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/sideBarMenuRss.png" alt="RSS"></a>
            </li>

			{if $menu eq "vacancy" && ($actPage.regions|default:false || $actPage.citys|default:false)}
                {assign var="i" value=$i+1}
                <li class="CategoriesLists">
                <table cellpadding="0" cellspacing="0" style="width:223px;">
					{foreach from=$regions item="region" name="region"}
						<tr>
							<td><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&amp;action=regions&amp;id=`$region.tId`")}">{$region.name}</a>&nbsp;</td>
							<td class="counter">&nbsp;[<strong>{$region.cnt_vacancy}</strong>]</td>
							<td>&nbsp;<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=rss&amp;action=vacancy&amp;subaction=region&amp;id=`$region.tId`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/sideBarMenuRss10.png" alt="RSS"></a></td>
						</tr>
					{/foreach}
				</table><br>
                </li>
			{/if}
            {* ------------------------ *}
            {assign var="i" value=$i+1}
            <li class="{if ($i%2)}even{else}odd{/if}">
                <a class="withIcon"  href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=regions")}">{$smarty.const.FORM_RESUMES_HEAD}</a>
                <a class="icon" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=rss&amp;action=resume")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/sideBarMenuRss.png" alt="RSS"></a>
            </li>
             {if $menu eq "resume" && ($actPage.regions|default:false || $actPage.citys|default:false)}
                <li class="CategoriesLists">
                <table cellpadding="0" cellspacing="0" style="width:223px;">
					{foreach from=$regions item="region" name="region"}
						<tr>
   							<td><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=regions&amp;id=`$region.tId`")}">{$region.name}</a>&nbsp;</td>
							<td class="counter">&nbsp;[<strong>{if !$user_email}{$region.cnt_resume_v}{else}{$region.cnt_resume_m}{/if}</strong>]</td>
							<td>&nbsp;<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=rss&amp;action=resume&amp;subaction=region&amp;id=`$region.tId`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/sideBarMenuRss10.png" alt="RSS"></a></td>
						</tr>
					{/foreach}
				</table>
                </li>
			{/if}
        </ul>
    </div>


