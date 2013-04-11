
{if $errors}
	{include file="errors.message.tpl"}
{* Просмотр выбранной новости *}
{elseif $action.view}
	{if $news}
		<div class="DesignMainPageBody">
			<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
			      <tr><th colspan="2">{$news.title}</th></tr>
			      <tr>
			          <td colspan="2" class="last AlignLeft"><div class="paddingTextBoth5">{$news.text}</div></td>
			     </tr>
			     <tr>
			        <td class="AlignLeft noBorderRight">
			            <div class="paddingTextBoth55"><strong>{$smarty.const.TABLE_COLUMN_AUTHOR}:</strong> {$news.author}</div>
			        </td>
			        <td class="last AlignRight noBorderLeft">
			            <div class="paddingTextBoth55">
			                {$news.datetime|date_format:$smarty.const.CONF_DATE_FORMAT} {$news.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}
			            </div>
			        </td>
			     </tr>
			</table>
		</div>
		{if $smarty.const.CONF_NEWSES_COMMENTS AND !$news.noComments AND 'archived' != $news.token}
        	{include file="news.comments.add.tpl"}
        {/if}
	{else}
		<div class="ErrorBlockWrapper">
			<div class="ErrorHeader">{$smarty.const.ERROR_NON_DATA}</div>
			<div class="ErrorBlock"><ul><li>{$smarty.const.ERROR_NON_DATA}</li></ul></div>
		</div>
	{/if}

{else} {* Просмотр всех новостей *}

	{if $news}
        <div class="DesignMainPageBody">
        {foreach from=$news item="one_news"}
          <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
                  <tr>
                      <th colspan="2"><a style="display:block;" class="light" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=news&amp;action=view&amp;id=`$one_news.tId`")}">{$one_news.title}</a></th>
                  </tr>
                  <tr>
                      <td colspan="2" class="last AlignLeft">
                          <div class="paddingTextBoth5">
                              {$one_news.small_text}
                          </div>
                      </td>
                 </tr>
                 <tr>
                    <td class="AlignLeft noBorderRight">
                        <div class="paddingTextBoth55">
                            <strong>{$smarty.const.TABLE_COLUMN_AUTHOR}:</strong> {$one_news.author}
                        </div>
                    </td>
                    <td class="last AlignRight noBorderLeft">
                        <div class="paddingTextBoth55">
                            {$one_news.datetime|date_format:$smarty.const.CONF_DATE_FORMAT} {$one_news.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}
                        </div>
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
	<p align="center">{$string_page}</p>
{/if}