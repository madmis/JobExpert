tinyMCE.init({
	accessibility_warnings : false,
	mode : "specific_textareas",
	editor_selector : "tinymce",
	language : "ru",
	width : "640",
	height : "300",

	/* PLUGINS */
	file_browser_callback : "tinyBrowser",
	plugins : "fullscreen,advlist,preview,table",

	/* THEMES */
	theme : "advanced",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,outdent,indent,|,formatselect,fontselect,fontsizeselect,|",
	theme_advanced_buttons2 : "bullist,numlist,|,sub,sup,|,link,unlink,anchor,image,|,forecolor,backcolor,|,tablecontrols,|",
	theme_advanced_buttons3 : "hr,charmap,removeformat,visualaid,|,cut,copy,paste,|,undo,redo,|,cleanup,help,code,|,fullscreen,preview,|",
	plugin_preview_width : "800",
    plugin_preview_height : "600",

	// Example content CSS (should be your site CSS)
	content_css : "/core/modules/tinymce/sd/style.css"
});
