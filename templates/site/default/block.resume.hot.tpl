{if $hot.resume && 'resume' neq $menu && 'hot' neq $actPage}
	<div class="DesignLeftSideBarBlockWrapperB" style="padding:0px 9px 35px 2px;">
		<h3 class="sideBlockHeader" id="hotResumes" style="margin-left: 4px;">{$smarty.const.SITE_HOT_RESUMES}</h3>
		<div class="DesignMainPageBody">
			{foreach from=$hot.resume item="resume" name="resume"}
				<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;" title="{$resume.title|escape}, {$sections[$resume.id_section].name|escape}, {$regions[$resume.id_region].name|escape}, {$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$resume.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$resume.pay_from} {$resume.currency}">
					<tr>
	                	<th><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=view&amp;id=`$resume.tId`")}" style="display:block;" class="light">{$resume.title|escape|truncate:55:'...'}</a></th>
	                </tr>
	                <tr>
	                	<td class="last">
	                    	{$regions[$resume.id_region].name|escape}<br>
	                        {$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}<br>
	                        <strong>{$resume.pay_from}&nbsp;{$resume.currency}</strong>
	                    </td>
	                </tr>
	        	</table>
			{/foreach}
			{if $cntRecords.hot.resume > $smarty.const.CONF_RESUME_HOT_SHOW_PERPAGE}
				<div class="AlignRight">
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=hot")}">{$smarty.const.SITE_ALL} {$smarty.const.SITE_HOT_RESUMES}...</a>
				</div>
			{/if}
	    </div>
    </div>
{/if}