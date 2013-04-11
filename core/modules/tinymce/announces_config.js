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
	theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,outdent,indent,|,fontselect,fontsizeselect,|,bullist,numlist,|,cut,copy,paste,|,undo,redo,|,fullscreen",
	theme_advanced_buttons2 : false,
	theme_advanced_buttons3 : false,
	// Example content CSS (should be your site CSS)
	content_css : "/core/modules/tinymce/sd/style.css"
});