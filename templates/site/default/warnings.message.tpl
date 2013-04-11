<div class="ErrorBlockWrapper">
	<div class="ErrorHeader">{*$smarty.const.WARNINGS_MESSAGE_BOX_HEADER*}</div>
	<div class="ErrorBlock">
		<ul>
			{foreach from=$warnings item="warning"}
				<li>{$warning}</li>
			{/foreach}
		</ul>
	</div>
</div>