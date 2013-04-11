<div style="margin: 0px 0px 5px 5px;">
	{$smarty.const.FORM_CONF_EDITOR_TEMPLATE_TPL_FILES_LIST}:&nbsp;
    <select name="listTemplates">
	{foreach from=$listTemplates item="fileTemplate"}
        <option value="{$fileTemplate.id}">{$fileTemplate.name}</option>
	{/foreach}
    </select>
    <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" class="help" alt="{$smarty.const.FORM_IMG_HELP}" style="cursor: pointer;">
</div>
<div class="bigPageHelp">{$smarty.const.JUR_MAIN_HELP}</div>
<div style="display: none;">
	{foreach from=$listTemplates item="fileTemplate"}
		<div id="{$fileTemplate.id}">{$fileTemplate.desc}</div>
	{/foreach}
</div>
<table class="tmpl_mail_table">
    <thead class="tmpl_mail_head">
        <tr>
            <td id="tplDescription"></td>
        </tr>
    </thead>
    <tbody class="tmpl_mail_body">
        <tr>
            <td>
                <textarea id="tplContent" class="tplContent" cols="114" rows="30" wrap="off" style="position: static; display: none;"></textarea>
                <div>
                	<input id="tplSave" type="button" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button">
                	<input id="tplDefault" type="button" value="{$smarty.const.FORM_BUTTON_DEFAULT}" class="button">
                </div>
            </td>
        </tr>
    </tbody>
</table>

<script type="text/javascript" src="core/modules/edit_area/edit_area_full.js"></script>
<script type="text/javascript">
<!--
function showOverlay() {
    $('#overlay, #dialog').show();
}
function hideOverlay() {
    $('#overlay, #dialog').hide();
}
(function($) {
    editAreaLoader.init({
        id: 'tplContent',
        min_height: 530,
        min_width: 940,
        font_size: 8,
        word_wrap: true,
        allow_toggle: false,
        start_highlight: true,
        syntax: 'html',
        language: 'ru',
        allow_resize: 'no',
        syntax_selection_allow: 'css,html,js',
        toolbar: "|, undo, redo, |, select_font, |, syntax_selection, |, search, go_to_line, |, highlight, reset_highlight, change_smooth_selection, |, help",
        EA_init_callback: 'showOverlay',
        EA_load_callback: 'hideOverlay'
    });
})(jQuery);
    
$(function() {
	$('.help').click( function() {
		$('.bigPageHelp').toggle();
	});

	$('select[name="listTemplates"]').change(function() {
	    $('#overlay, #dialog, select[name="listTemplates"]').show();
	    $.get(
	        '/admajax.php',
	        { action: 'getFileContent', fileName: 'core/mods/payments/jur/templates/' + $('select[name="listTemplates"] option:selected').text() },
	        function(resp) {
				$('#tplDescription').html( $('#' + $('select[name="listTemplates"] option:selected').val()).text() );

	            if ($('#frame_tplContent').size()) {
	                editAreaLoader.setValue('tplContent', resp);
	            } else {
	                $('.tplContent').val(resp);
	            }
	            $('#overlay, #dialog').hide();
	        }
	    );
	}).change();

    $('#tplSave').click(function() {
        if (!$('select[name="listTemplates"] option:selected').text()) {
            $.alert('{$smarty.const.ERROR_FILE_NOT_SELECTED}');
            return false;
        }
        $('#overlay, #dialog').show();
        $.post(
            '/admajax.php?action=putFileContent',
            { fileName: 'core/mods/payments/jur/templates/' + $('select[name="listTemplates"] option:selected').text(), fileContents: editAreaLoader.getValue('tplContent') },
            function(resp) {
                if ('success' == resp) {
                    $('select[name="listTemplates"]').change();
                    $.alert('{$smarty.const.MESSAGE_CHANGE_SAVED}');
                } else {
                    $.alert('{$smarty.const.ERROR_NOT_SAVE_CHANGE}');
                }
                $('#overlay, #dialog').hide();
            }
        );
    });

    $('#tplDefault').click(function() {
    	$('#overlay, #dialog').show();
		$.get(
			'/admajax.php',
			{ action: 'getFileContent', fileName: 'core/mods/payments/jur/templates/tmp/' + $('select[name="listTemplates"] option:selected').text() },
			function(resp) {
				$('#tplDescription').html( $('#' + $('select[name="listTemplates"] option:selected').val()).text() );

				if ($('#frame_tplContent').size()) {
					editAreaLoader.setValue('tplContent', resp);
				} else {
					$('.tplContent').val(resp);
				}
				$('#overlay, #dialog').hide();
			}
		);
    });
});

    -->
</script>