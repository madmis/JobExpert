<div class="DesignLeftSideBarBlockWrapper">
	<h3 class="sideBlockHeader" id="statistic">{$smarty.const.SITE_BLOCK_STATISTICS}</h3>
    <div class="ContentWrapper">
    	{if $statistics}
            <table class="statistics">
                <tr>
                    <th>{$smarty.const.SITE_BLOCK_STATISTICS_USERS}:</th>
                    <td>[ <strong>{$statistics.users}</strong> ]</td>
                </tr>
                <tr>
                    <th>{$smarty.const.SITE_BLOCK_STATISTICS_VACANCYS}:</th>
                    <td>[ <strong>{$statistics.vacancys}</strong> ]</td>
                </tr>
                <tr>
                    <th>{$smarty.const.SITE_BLOCK_STATISTICS_RESUMES}:</th>
                    <td>[ <strong>{if !$user_email}{$statistics.resumes_v}{else}{$statistics.resumes_m}{/if}</strong> ]</td>
                </tr>
            </table>
    	{else}
    	   {$smarty.const.ERROR_NON_DATA}
    	{/if}
    </div>
</div>