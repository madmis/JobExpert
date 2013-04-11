<div class="sub_menu" style="text-align: left;">
    <span style="float: left;">
        <form action="{$smarty.const.CONF_ADMIN_FILE}?m=service&amp;s=manager.templates" method="post" enctype="multipart/form-data">
            &nbsp;{$smarty.const.FORM_CONF_EDITOR_TEMPLATES_LIST}:&nbsp;
            <select name="currTemplate" class="templateSelect">
				{foreach from=$templates item="template"}
                <option value="{$template}"{if $template eq $currTemplate} selected{/if}>{$template}</option>
				{/foreach}
            </select>
        </form>
    </span>
    <span class="cloneTemplate" style="margin-left: 15px; cursor: pointer; display: none;">
        <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/clone.png" alt="" title="{$smarty.const.FORM_EDITOR_TEMPLATE_CLONE_BUTTON_TITLE}">
    </span>
	{if 'default' neq $currTemplate}
    <span class="deleteTemplate" style="margin-left: 10px; cursor: pointer;">
        <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/delTab.png" alt="" title="{$smarty.const.FORM_EDITOR_TEMPLATE_DELETE_BUTTON_TITLE}">
    </span>
	{else}
    <span id="defaulTemplateWarning" style="margin-left: 10px; cursor: pointer; color: #CC3333;">
			{$smarty.const.WARNING_EDITOR_TEMPLATE_DEFAULT_TEMPLATE}
    </span>
	{/if}
    <span class="colorbox_help" id="HELP_ADMIN_SERVICE_EDITOR_TEMPLATES" style="float: right;">
        <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
    </span>
</div>

<div id="tabTemplate" style="width: 97%;">
    <ul>
        <li><a href="#tpl">{$smarty.const.FORM_CONF_EDITOR_TEMPLATE_TPL_TAB_NAME}</a></li>
        <li><a href="#css">{$smarty.const.FORM_CONF_EDITOR_TEMPLATE_CSS_TAB_NAME}</a></li>
        <li><a href="#pics">{$smarty.const.FORM_CONF_EDITOR_TEMPLATE_PICS_TAB_NAME}</a></li>
    </ul>
    <div id="tpl" style="width: 97%;">
        <div style="margin: 0px 0px 5px 5px;">
			{$smarty.const.FORM_CONF_EDITOR_TEMPLATE_TPL_FILES_LIST}:&nbsp;
            <select name="listTemplates">
			{foreach from=$listTemplates item="fileTemplate"}
                <option value="{$fileTemplate.id|upper}">{$fileTemplate.name}</option>
			{/foreach}
            </select>
            <span class="addTplFile" style="margin-left: 10px; cursor: pointer;">
                <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/addTplFile.png" alt="" title="{$smarty.const.FORM_EDITOR_TEMPLATE_TPL_FILES_ADD_BUTTON_TITLE}">
            </span>
            <span class="delTplFile" style="margin-left: 10px; cursor: pointer;">
                <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/delTplFile.png" alt="" title="{$smarty.const.FORM_EDITOR_TEMPLATE_TPL_FILES_DELETE_BUTTON_TITLE}">
            </span>
			{if 'default' neq $currTemplate}
            <span class="updateTemplate" style="margin-left: 10px; cursor: pointer;">
                <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/reload.png" alt="" title="{$smarty.const.FORM_EDITOR_TEMPLATE_CHECK_LIST_FILES_BUTTON_TITLE}">
            </span>
			{/if}
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
                        <div><input id="tplSave" type="button" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="css" style="width: 97%;">
        <div style="margin: 0px 0px 5px 5px;">
			{$smarty.const.FORM_CONF_EDITOR_TEMPLATE_CSS_FILES_LIST}:&nbsp;
            <select name="listCSS">
			{foreach from=$listCSS item="fileCSS"}
                <option value="{$fileCSS.id|upper}">{$fileCSS.name}</option>
			{/foreach}
            </select>
            <span class="addCssFile" style="margin-left: 10px; cursor: pointer;">
                <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/addCssFile.png" alt="" title="{$smarty.const.FORM_EDITOR_TEMPLATE_CSS_FILES_ADD_BUTTON_TITLE}">
            </span>
            <span class="delCssFile" style="margin-left: 10px; cursor: pointer; display: none;">
                <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/delCssFile.png" alt="" title="{$smarty.const.FORM_EDITOR_TEMPLATE_CSS_FILES_DELETE_BUTTON_TITLE}">
            </span>
        </div>
        <table class="tmpl_mail_table">
            <tbody class="tmpl_mail_body">
                <tr>
                    <td>
                        <textarea id="cssContent" class="cssContent" cols="113" rows="32" wrap="off" style="position: static; display: none;"></textarea>
                        <div><input id="cssSave" type="button" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="pics">
        <div class="picsContent" style="height: 600px; position: static;">
            <iframe src="/core/modules/tinybrowser/control.php?type=image&amp;configFile=configEditorTemplates.php" style="width: 100%; height: 100%; border: none;"></iframe>
        </div>
    </div>
</div>

{* Диалоговое окно - Форма клонирования шаблона *}
<div id="cloneTemplate" title="{$smarty.const.FORM_EDITOR_TEMPLATE_CLONE_TITLE}" style="display: none;">
    <div id="emptyNameTemplate" class="errors ui-state-error ui-corner-all" style="padding: 5px; margin: 10px; display: none;">
        <span class="ui-icon ui-icon-alert" style="float: left; margin: 0px 10px;"></span>
		{$smarty.const.ERROR_FIELD_NAME_EMPTY}
    </div>
    <div id="waitProcessingCloneTemplate" class="processing ui-widget-content ui-corner-all" style="padding: 5px; margin: 10px; text-align: center; display: none;">
        <div style="margin: 15px;">{$smarty.const.MESSAGE_PROCESSING_PLEASE_WAIT}...</div>
        <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/processing.gif" alt="">
    </div>
    <form action="#" id="fCloneTemplate">
        <fieldset class="ui-corner-all">
            <input type="hidden" name="currTemplate" value="{$currTemplate}">
            <label for="nameTemplate">{$smarty.const.FORM_EDITOR_TEMPLATE_FIELD_NAME}:</label>
            <input type="text" name="nameTemplate" id="nameTemplate" size="30" maxlength="50" class="text ui-widget-content ui-corner-all">
            <br><br>
            <input type="checkbox" name="includeCss" id="includeCss" checked="checked" class="ui-widget-content ui-corner-all">
            <label for="includeCss">{$smarty.const.FORM_EDITOR_TEMPLATE_CSS_INCLUDE}</label>
            <br>
            <input type="checkbox" name="includePics" id="includePics" checked="checked" class="ui-widget-content ui-corner-all">
            <label for="includePics">{$smarty.const.FORM_EDITOR_TEMPLATE_PICS_INCLUDE}</label>
            <br>
            <input type="checkbox" name="emptyTemplateFiles" id="emptyTemplateFiles" class="ui-widget-content ui-corner-all">
            <label for="emptyTemplateFiles">{$smarty.const.FORM_EDITOR_TEMPLATE_FILES_CREATE_EMPTY}</label>
        </fieldset>
    </form>
</div>

{* Диалоговое окно - Удаление шаблона *}
<div id="deleteTemplate" title="{$smarty.const.FORM_EDITOR_TEMPLATE_DELETE_TITLE}" style="display: none;">
    <div id="waitProcessingDelTemplate" class="processing ui-widget-content ui-corner-all" style="padding: 5px; margin: 10px; text-align: center; display: none;">
        <div style="margin: 15px;">{$smarty.const.MESSAGE_PROCESSING_PLEASE_WAIT}...</div>
        <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/processing.gif" alt="">
    </div>
    <div class="ui-state-highlight ui-corner-all" style="padding: 5px; margin: 10px; text-align: center;">
        <span class="ui-icon ui-icon-help" style="float: right; margin: 0px 5px;"></span>
		{$smarty.const.MESSAGE_WARNING_TEMPLATE_DELETE}
    </div>
</div>

{* Диалоговое окно - Форма добавления файла шаблона *}
<div id="addTplFile" title="{$smarty.const.FORM_EDITOR_TEMPLATE_TPL_FILES_ADD_TITLE}" style="display: none;">
    <div id="emptyAddTplFileFields" class="errors ui-state-error ui-corner-all" style="padding: 5px; margin: 10px; display: none;">
        <span class="ui-icon ui-icon-alert" style="float: left; margin: 0px 10px;"></span>
		{$smarty.const.ERROR_EMPTY_FORM_FIELDS}
    </div>
    <form action="#" id="fAddTplFile">
        <fieldset class="ui-corner-all">
            <input type="hidden" name="currTemplate" value="{$currTemplate}">
            <label for="nameTplFile">{$smarty.const.FORM_FILE_NAME}:</label>
            <input type="text" name="nameTplFile" id="nameTplFile" size="50" maxlength="50" class="text ui-widget-content ui-corner-all">
            <br><br>
            <label for="discriptionTplFile">{$smarty.const.FORM_EDITOR_TEMPLATE_TPL_FILE_FIELD_DESCRIPTION}:</label>
            <br>
            <input type="text" name="discriptionTplFile" id="discriptionTplFile" size="100" maxlength="255" class="text ui-widget-content ui-corner-all">
        </fieldset>
    </form>
</div>

{* Диалоговое окно - Удаление файла шаблона *}
<div id="delTplFile" title="{$smarty.const.FORM_EDITOR_TEMPLATE_TPL_FILES_DELETE_TITLE}" style="display: none;">
    <div class="ui-state-highlight ui-corner-all" style="padding: 5px; margin: 10px; text-align: center;">
        <span class="ui-icon ui-icon-help" style="float: right; margin: 0px 5px;"></span>
		{$smarty.const.MESSAGE_WARNING_TPL_FILE_DELETE}
    </div>
</div>

{* Диалоговое окно - Форма добавления файла стилей шаблона *}
<div id="addCssFile" title="{$smarty.const.FORM_EDITOR_TEMPLATE_CSS_FILES_ADD_TITLE}" style="display: none;">
    <div id="emptyNameCssFile" class="errors ui-state-error ui-corner-all" style="padding: 5px; margin: 10px; display: none;">
        <span class="ui-icon ui-icon-alert" style="float: left; margin: 0px 10px;"></span>
		{$smarty.const.ERROR_FILE_NAME_EMPTY}
    </div>
    <form action="#" id="fAddCssFile">
        <fieldset class="ui-corner-all">
            <input type="hidden" name="currTemplate" value="{$currTemplate}">
            <label for="nameCssFile">{$smarty.const.FORM_FILE_NAME}:</label>
            <input type="text" name="nameCssFile" id="nameCssFile" size="30" maxlength="50" class="text ui-widget-content ui-corner-all">
        </fieldset>
    </form>
</div>

{* Диалоговое окно - Удаление файла стилей шаблона *}
<div id="delCssFile" title="{$smarty.const.FORM_EDITOR_TEMPLATE_CSS_FILES_DELETE_TITLE}" style="display: none;">
    <div class="ui-state-highlight ui-corner-all" style="padding: 5px; margin: 10px; text-align: center;">
        <span class="ui-icon ui-icon-help" style="float: right; margin: 0px 5px;"></span>
		{$smarty.const.MESSAGE_WARNING_CSS_FILE_DELETE}
    </div>
</div>

{* Диалоговое окно - Сообщение об успешном завершении операции *}
<div id="messSuccess" title="{$smarty.const.MESSAGE_ACTION_SUCCESS}!" style="display: none;">
    <div class="ui-dialog-content">
        <div style="font-weight: bold;">
            <img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" style="margin: 0px 10px; vertical-align: bottom; float: left;" alt="">
            <span id="messSuccessTitle"></span>
        </div>
        <div class="ui-widget-content ui-corner-all" id="messSuccessContent" style="margin: 10px 0px; padding: 15px;"></div>
    </div>
</div>

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
        $.getScript('/core/js/jquery/ui/jquery.ui.tabs.js', function() {
            $('#tabTemplate').tabs();
        });
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

    $(document).ready(function() {
        $('a[href="#css"]').click(function() {
            if (0 < $('#frame_cssContent').size()) {
                return;
            }
            showOverlay();
            editAreaLoader.init({
                id: 'cssContent',
                min_height: 530,
                min_width: 940,
                font_size: 8,
                word_wrap: true,
                allow_toggle: false,
                start_highlight: true,
                syntax: 'css',
                language: 'ru',
                allow_resize: 'no',
                syntax_selection_allow: 'css',
                toolbar: '|, undo, redo, |, select_font, |, syntax_selection, |, search, go_to_line, |, highlight, reset_highlight, change_smooth_selection, |, help',
                EA_load_callback: 'hideOverlay'
            });
        });

        $('.templateSelect').change(function() {
            $(this).parent('form').submit();
        });

        $('select[name="listTemplates"]').change(function() {
            if (1 > $(this).children().size()) {
                $(this).hide();
                $('.cloneTemplate').hide();
                return false;
            }
            $('#overlay, #dialog, select[name="listTemplates"], .cloneTemplate').show();
            $.get(
                '/admajax.php',
                { action: 'getFileContent', fileName: 'templates/site/{$currTemplate}/' + $('select[name="listTemplates"] option:selected').text() },
                function(resp) {
                    $.get(
                        '/admajax.php',
                        { q: 'HELP_ADMIN_TEMPLATE_DESCRIPTION_' + $('select[name="listTemplates"] option:selected').val() },
                        function(desc) {
                            $('#tplDescription').html(desc);
                        }
                    );
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
                { fileName: 'templates/site/{$currTemplate}/' + $('select[name="listTemplates"] option:selected').text(), fileContents: editAreaLoader.getValue('tplContent') },
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

        $('select[name="listCSS"]').change(function() {
            if (1 > $(this).children().size()) {
                $(this).hide();
                $('.delCssFile').hide();
                return false;
            }
            $('#overlay, #dialog, select[name="listCSS"], .delCssFile').show();
            $.get(
                '/admajax.php',
                { action: 'getFileContent', fileName: 'templates/site/{$currTemplate}/style/' + $('select[name="listCSS"] option:selected').text() },
                function(resp) {
                    if ($('#frame_cssContent').size()) {
                        editAreaLoader.setValue('cssContent', resp);
                    } else {
                        $('.cssContent').text(resp);
                    }
                    $('#overlay, #dialog').hide();
                }
            );
        }).change();

        $('#cssSave').click(function() {
            if (!$('select[name="listCSS"] option:selected').text()) {
                $.alert('{$smarty.const.ERROR_FILE_NOT_SELECTED}');
                return false;
            }
            $('#overlay, #dialog').show();
            $.post(
                '/admajax.php?action=putFileContent',
                { fileName: 'templates/site/{$currTemplate}/style/' + $('select[name="listCSS"] option:selected').text(), fileContents: editAreaLoader.getValue('cssContent') },
                function(resp) {
                    if ('success' == resp) {
                        $('select[name="listCSS"]').change();
                        $.alert('{$smarty.const.MESSAGE_CHANGE_SAVED}');
                    } else {
                        $.alert('{$smarty.const.ERROR_NOT_SAVE_CHANGE}');
                    }
                    $('#overlay, #dialog').hide();
                }
            );
        });

        $('#messSuccess').dialog({
            autoOpen: false,
            modal: true,
            draggable: false,
            resizable: false,
            buttons: {
                '{$smarty.const.SITE_CLOSE}': function() {
                    $('#messSuccessContent').text('');
                    $(this).dialog('close');
                }
            },
            close: function() {
                $(this).dialog('option', { beforeClose: function() { } });
            }
        });

        $('#cloneTemplate').dialog({
            autoOpen: false,
            modal: true,
            width: 'auto',
            draggable: false,
            resizable: false,
            buttons: {
                '{$smarty.const.SITE_CLONE}': function() {
                    if (!$('#nameTemplate').val()) {
                        $('#emptyNameTemplate').show();
                        $('#nameTemplate').focus();
                        return false;
                    } else {
                        var thisDialog = $(this);
                        var tmpB = thisDialog.dialog('option', 'buttons');
                        thisDialog.dialog('option', { buttons: {} }).children().hide();
                        $('#waitProcessingCloneTemplate').show();
                        $.post(
                            '/admajax.php?action=cloneTemplate',
                            $('#fCloneTemplate').serialize(),
                            function(resp) {
                                thisDialog.dialog('option', { buttons: tmpB }).dialog('close').children().show();
                                $('#waitProcessingCloneTemplate').hide();
                                if ('success' === resp) {
                                    $('#messSuccessTitle').html('{$smarty.const.FORM_CONF_EDITOR_TEMPLATE_CREATE_SUCCESS_TITLE}!');
                                    $('#messSuccessContent').html('{$smarty.const.FORM_CONF_EDITOR_TEMPLATE_CREATE_SUCCESS_MESSAGE}');
                                    $('#messSuccess').dialog('option', {
                                        width: 'auto',
                                        beforeClose: function() {
                                            $.cookie('adm_currTmplManage', $('#nameTemplate').val(), { path: '/', expires: 30 });
                                            window.location = '{$smarty.const.CONF_ADMIN_FILE}?m=service&s=manager.templates';
                                        }
                                    }).dialog('open');
                                } else {
                                    switch (resp) {
                                        case 'errTemplateExsists':
                                            resp = '{$smarty.const.ERROR_CLONE_TEMPLATE_EXSISTS}';
                                            break;
                                        case 'errCloningTemplateIsEmpty':
                                            resp = '{$smarty.const.ERROR_CLONE_TEMPLATE_IS_EMPTY}';
                                            break;
                                        case 'errCreateDirTemplate':
                                        case 'errCreateDirTemplateStyle':
                                        case 'errCreateDirTemplateImages':
                                            $.post('/admajax.php?action=delDir', { nameDir: 'templates/site/' + $('#nameTemplate').val() });
                                            resp = '{$smarty.const.ERROR_CLONE_TEMPLATE_CREATE_DIR_FAILED}';
                                            break;
                                        default:
                                            resp = '{$smarty.const.ERROR_UNDEFINED}';
                                            break;
                                    }
                                    $.alert(resp);
                                }
                            }
                        );
                    }
                },
                '{$smarty.const.SITE_CANCEL}': function() {
                    $(this).dialog('close');
                }
            }
        });

        $('.cloneTemplate').click(function() {
            $('.errors').hide();
            $('#cloneTemplate').dialog('open');
        });

        $('#deleteTemplate').dialog({
            autoOpen: false,
            modal: true,
            width: 'auto',
            draggable: false,
            resizable: false,
            buttons: {
                '{$smarty.const.FORM_BUTTON_DELETE}': function() {
                    var thisDialog = $(this);
                    var tmpB = thisDialog.dialog('option', 'buttons');
                    thisDialog.dialog('option', { buttons: {} }).children().hide();
                    $('#waitProcessingDelTemplate').show();
                    $.post(
                        '/admajax.php?action=deleteTemplate',
                        { nameTemplate: '{$currTemplate}' },
                        function(resp) {
                            thisDialog.dialog('option', { buttons: tmpB }).dialog('close').children().show();
                            $('#waitProcessingCloneTemplate').hide();
                            if ('success' === resp) {
                                $('#messSuccessTitle').html('{$smarty.const.MESSAGE_TEMPLATE_DELETE_SUCCESS_TITLE}!');
                                $('#messSuccessContent').html('{$smarty.const.MESSAGE_TEMPLATE_DELETE_SUCCESS_MESSAGE}');
                                $('#messSuccess').dialog('option', {
                                    width: 'auto',
                                    beforeClose: function() {
                                        $.cookie('adm_currTmplManage', '{$smarty.const.CONF_TEMPLATE}', { path: '/', expires: 30 });
                                        window.location = '{$smarty.const.CONF_ADMIN_FILE}?m=service&s=manager.templates';
                                    }
                                }).dialog('open');
                            } else {
                                switch (resp) {
                                    case 'errDelDefaultTemplate':
                                        resp = '{$smarty.const.ERROR_DELETE_TEMPLATE_NAME_DEFAULT}';
                                        break;
                                    case 'errDelConfTemplate':
                                        resp = '{$smarty.const.ERROR_DELETE_TEMPLATE_CONF_DEFAULT}';
                                        break;
                                    case 'errDelTemplate':
                                        resp = '{$smarty.const.ERROR_DELETE_TEMPLATE_FAILED}';
                                        break;
                                    default:
                                        resp = '{$smarty.const.ERROR_UNDEFINED}';
                                        break;
                                }
                                $.alert(resp);
                            }
                        }
                    );
                },
                '{$smarty.const.SITE_CANCEL}': function() {
                    $(this).dialog('close');
                }
            }
        });

        $('.deleteTemplate').click(function() {
            $('.errors').hide();
            $('#deleteTemplate').dialog('open');
        });

        $('.updateTemplate').click(function() {
            $('#overlay, #dialog').show();
            $.post(
                '/admajax.php?action=updateTemplate',
                { nameTemplate: '{$currTemplate}' },
                function(resp) {
                    $('#overlay, #dialog').hide();
                    resp = $.parseJSON(resp);
                    if ('success' === resp.result) {
                        $('#messSuccessTitle').html('{$smarty.const.MESSAGE_TEMPLATE_UPDATE_SUCCESS_TITLE}!');
                        $('#messSuccessContent').html('{$smarty.const.MESSAGE_TEMPLATE_UPDATE_SUCCESS_MESSAGE}');
                        $('#messSuccess').dialog('option', {
                            width: 'auto',
                            beforeClose: function() {
                                $.each(resp.listFiles, function(i, val) {
                                    val.name = '' + val.name;
                                    $(new Option(val.name, val.id, false, true)).addClass('new_option').prependTo('select[name="listTemplates"]');
                                });
                                $('select[name="listTemplates"]').change();
                            }
                        }).dialog('open');
                    } else {
                        switch (resp.result) {
                            case 'tplListDiffNotFound':
                                resp = '{$smarty.const.MESSAGE_TEMPLATE_UPDATE_LIST_DIFF_NOT_FOUND}';
                                break;
                            default:
                                resp = '{$smarty.const.ERROR_UNDEFINED}';
                                break;
                        }
                        $.alert(resp);
                    }
                }
            );
        });

        $('#addTplFile').dialog({
            autoOpen: false,
            modal: true,
            width: 'auto',
            draggable: false,
            resizable: false,
            buttons: {
                '{$smarty.const.FORM_BUTTON_ADD}': function() {
                    if (!$('#nameTplFile').val()) {
                        $('#emptyAddTplFileFields').show();
                        $('#nameTplFile').focus();
                        return false;
                    } else if (!$('#discriptionTplFile').val()) {
                        $('#emptyAddTplFileFields').show();
                        $('#discriptionTplFile').focus();
                        return false;
                    } else {
                        var thisDialog = $(this);
                        var nameTplFile = $('#nameTplFile').val();
                        $.post(
                            '/admajax.php?action=addTplFile',
                            $('#fAddTplFile').serialize(),
                            function(resp) {
                                thisDialog.dialog('close');
                                $('#nameTplFile, #discriptionTplFile').val('');
                                if ('success' === resp) {
                                    $('#messSuccessTitle').html('{$smarty.const.MESSAGE_FILE_ADD_SUCCESS_TITLE}!');
                                    $('#messSuccessContent').html('{$smarty.const.MESSAGE_TPL_FILE_ADD_SUCCESS_MESSAGE}');
                                    $('#messSuccess').dialog('option', {
                                        width: 'auto',
                                        beforeClose: function() {
                                            $('select[name="listTemplates"]').append(new Option(nameTplFile, nameTplFile.replace('.', '_'), true, true)).change();
                                        }
                                    }).dialog('open');
                                } else {
                                    switch (resp) {
                                        case 'errTplFileExists':
                                            resp = '{$smarty.const.ERROR_FILES_EXISTS_FILE_NAME}';
                                            break;
                                        case 'errParams':
                                            resp = '{$smarty.const.MESSAGE_WARNING_UNKNOWN_ACTION}';
                                            break;
                                        default:
                                            resp = '{$smarty.const.ERROR_UNDEFINED}';
                                            break;
                                    }
                                    $.alert(resp);
                                }
                            }
                        );
                    }
                },
                '{$smarty.const.SITE_CANCEL}': function() {
                    $(this).dialog('close');
                }
            }
        });

        $('.addTplFile').click(function() {
            $('.errors').hide();
            $('#addTplFile').dialog('open');
        });

        $('#delTplFile').dialog({
            autoOpen: false,
            modal: true,
            width: 'auto',
            draggable: false,
            resizable: false,
            buttons: {
                '{$smarty.const.FORM_BUTTON_DELETE}': function() {
                    var thisDialog = $(this);
                    $.post(
                        '/admajax.php?action=delTplFile',
                        { 'nameTplFile': $('select[name="listTemplates"] option:selected').text(), 'currTemplate': '{$currTemplate}' },
                        function(resp) {
                            thisDialog.dialog('close');
                            if ('success' === resp) {
                                $('#messSuccessTitle').html('{$smarty.const.MESSAGE_FILE_SUCCESSFULLY_DELETED_TITLE}!');
                                $('#messSuccessContent').html('{$smarty.const.MESSAGE_TPL_FILE_SUCCESSFULLY_DELETED_MESSAGE}');
                                $('#messSuccess').dialog('option', {
                                    width: 'auto',
                                    beforeClose: function() {
                                        $('select[name="listTemplates"] option:selected').remove();
                                        $('select[name="listTemplates"]').change();
                                    }
                                }).dialog('open');
                            } else {
                                switch (resp) {
                                    case 'errFileNotExists':
                                        resp = '{$smarty.const.ERROR_FILE_NOT_FOUND}'
                                        break;
                                    case 'errParams':
                                        resp = '{$smarty.const.MESSAGE_WARNING_UNKNOWN_ACTION}'
                                        break;
                                    default:
                                        resp = '{$smarty.const.ERROR_UNDEFINED}'
                                        break;
                                }
                                $.alert(resp);
                            }
                        }
                    );
                },
                '{$smarty.const.SITE_CANCEL}': function() {
                    $(this).dialog('close');
                }
            }
        });

        $('.delTplFile').click(function() {
            if (!$('select[name="listTemplates"] option:selected').text()) {
                return false;
            } else {
                $('#delTplFile').dialog('open');
            }
        });

        $('#addCssFile').dialog({
            autoOpen: false,
            modal: true,
            width: 'auto',
            draggable: false,
            resizable: false,
            buttons: {
                '{$smarty.const.FORM_BUTTON_ADD}': function() {
                    if (!$('#nameCssFile').val()) {
                        $('#emptyNameCssFile').show();
                        $('#nameCssFile').focus();
                        return false;
                    } else {
                        var thisDialog = $(this);
                        var nameCssFile = $('#nameCssFile').val();
                        $.post(
                            '/admajax.php?action=addCssFile',
                            $('#fAddCssFile').serialize(),
                            function(resp) {
                                thisDialog.dialog('close');
                                $('#nameCssFile').val('');
                                if ('success' === resp) {
                                    $('#messSuccessTitle').html('{$smarty.const.MESSAGE_FILE_ADD_SUCCESS_TITLE}!');
                                    $('#messSuccessContent').html('{$smarty.const.MESSAGE_CSS_FILE_ADD_SUCCESS_MESSAGE}');
                                    $('#messSuccess').dialog('option', {
                                        width: 'auto',
                                        beforeClose: function() {
                                            $('select[name="listCSS"]').append(new Option(nameCssFile, nameCssFile, true, true)).change();
                                        }
                                    }).dialog('open');
                                } else {
                                    switch (resp) {
                                        case 'errCssFileExists':
                                            resp = '{$smarty.const.ERROR_FILES_EXISTS_FILE_NAME}';
                                            break;
                                        case 'errParams':
                                            resp = '{$smarty.const.MESSAGE_WARNING_UNKNOWN_ACTION}';
                                            break;
                                        default:
                                            resp = '{$smarty.const.ERROR_UNDEFINED}';
                                            break;
                                    }
                                    $.alert(resp);
                                }
                            }
                        );
                    }
                },
                '{$smarty.const.SITE_CANCEL}': function() {
                    $(this).dialog('close');
                }
            }
        });

        $('.addCssFile').click(function() {
            $('.errors').hide();
            $('#addCssFile').dialog('open');
        });

        $('#delCssFile').dialog({
            autoOpen: false,
            modal: true,
            width: 'auto',
            draggable: false,
            resizable: false,
            buttons: {
                '{$smarty.const.FORM_BUTTON_DELETE}': function() {
                    var thisDialog = $(this);
                    $.post(
                        '/admajax.php?action=delFile',
                        { 'nameFile': 'templates/site/{$currTemplate}/style/' + $('select[name="listCSS"] option:selected').text() },
                        function(resp) {
                            thisDialog.dialog('close');
                            if ('success' === resp) {
                                $('#messSuccessTitle').html('{$smarty.const.MESSAGE_FILE_SUCCESSFULLY_DELETED_TITLE}!');
                                $('#messSuccessContent').html('{$smarty.const.MESSAGE_CSS_FILE_SUCCESSFULLY_DELETED_MESSAGE}');
                                $('#messSuccess').dialog('option', {
                                    width: 'auto',
                                    beforeClose: function() {
                                        $('select[name="listCSS"] option:selected').remove();
                                        $('select[name="listCSS"]').change();
                                    }
                                }).dialog('open');
                            } else {
                                switch (resp) {
                                    case 'errFileNotExists':
                                        resp = '{$smarty.const.ERROR_FILE_NOT_FOUND}'
                                        break;
                                    case 'errParams':
                                        resp = '{$smarty.const.MESSAGE_WARNING_UNKNOWN_ACTION}'
                                        break;
                                    default:
                                        resp = '{$smarty.const.ERROR_UNDEFINED}'
                                        break;
                                }
                                $.alert(resp);
                            }
                        }
                    );
                },
                '{$smarty.const.SITE_CANCEL}': function() {
                    $(this).dialog('close');
                }
            }
        });

        $('.delCssFile').click(function() {
            if (!$('select[name="listCSS"] option:selected').text()) {
                return false;
            } else {
                $('#delCssFile').dialog('open');
            }
        });

        $('#fCloneTemplate, #fAddCssFile').submit(function() {
            return false;
        });
    });
    -->
</script>