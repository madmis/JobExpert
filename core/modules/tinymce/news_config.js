tinyMCE.init({
	mode : "specific_textareas",
	editor_selector : "tinymce",
	language : "ru",
	/* PLUGINS */
	plugins : "autosave,fullscreen,advlist",
	relative_urls : false,
	remove_script_host : true,
	/* THEMES */
	theme : "advanced",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
	theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,outdent,indent,|,formatselect,fontselect,fontsizeselect,|",
	theme_advanced_buttons2 : "bullist,numlist,|,sub,sup,|,link,unlink,anchor,image,|,forecolor,backcolor,|",
	theme_advanced_buttons3 : "hr,charmap,removeformat,visualaid,|,cut,copy,paste,|,undo,redo,|,cleanup,help,code,|,fullscreen,|",
	// Example content CSS (should be your site CSS)
	content_css : "/core/modules/tinymce/sd/style.css"
});