<div class="ErrorBlockWrapper">
	<div class="ErrorHeader">{*$smarty.const.ERRORS_MESSAGE_BOX_HEADER*}</div>
	<div class="ErrorBlock">
		<ul>
			{foreach from=$errors item="error"}
				<li>{$error}</li>
			{/foreach}
		</ul>
	</div>
</div>