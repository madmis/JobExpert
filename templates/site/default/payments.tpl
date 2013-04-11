{if $errors}
	{include file="errors.message.tpl"}
{/if}

{if $include_template}
	{include file=$include_template}
{else}
	<table class="payModTable">
		<tr>
	{foreach from=$modsList item="mod"}
		{if $mod.title}{assign var="modTitle" value=$mod.title}{else}{assign var="modTitle" value=$mod.id}{/if}
		<td>
			<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=payments&amp;mod=`$mod.id`")}" title="{$modTitle}">
				<img src="{$smarty.const.CONF_SCRIPT_URL}core/mods/payments/{$mod.id}/templates/images/logo.png" alt="{$modTitle}" title="{$modTitle}">
			</a>
			{if $mod.description}
				<br>
				<span class="detail imLink">{$mod.id}</span>
				<div>{$mod.description}</div>
			{/if}
		</td>
	{/foreach}
		</tr>
	</table>
	
    <script type="text/javascript">
	<!--
	$(function() {
		$('.detail').click( function () {
			$.colorbox({ html: $(this).next('div').html(), width: '60%', opacity: 0, scrolling: true, title: $(this).prev().prev().attr('title') });
		});
	});
	-->
	</script>
{/if}