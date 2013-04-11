{if $smarty.const.CONF_USE_VISUAL_EDITOR}
<!-- TinyMCE -->
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/modules/tinymce/basic_config.js"></script>
<!-- TinyMCE -->
{/if}

{if $modData}
	<p><input type="text" name="title" maxlength="200" size="80" value="{$modData.title}"></p>
	<textarea name="description" rows="15" cols="80"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$modData.description}</textarea>
{/if}