<div class="DesignLeftSideBarBlockWrapperB">
    <h3 class="sideBlockHeader" id="whoOnline">{$smarty.const.SITE_BLOCK_ATTENDEES}</h3>
    <div class="ContentWrapper">
    	{if $whoOnline}
            <table class="whoonline">
                <tr>
                    <th>{$smarty.const.SITE_BLOCK_ATTENDEES_GUESTS}:</th>
                    <td>[ <strong>{$whoOnline.guests}</strong> ]</td>
                </tr>
                <tr>
                    <th>{$smarty.const.SITE_BLOCK_ATTENDEES_USERS}:</th>
                    <td>[ <strong>{$whoOnline.users}</strong> ]</td>
                </tr>
                <tr>
                    <th>{$smarty.const.SITE_BLOCK_ATTENDEES_TOTAL}:</th>
                    <td>[ <strong>{$whoOnline.guests+$whoOnline.users}</strong> ]</td>
                </tr>
            </table>
    	{else}
    	   {$smarty.const.ERROR_NON_DATA}
    	{/if}
    </div>
</div>