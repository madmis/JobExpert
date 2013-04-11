/**** Функции *****/
(function($) {
    $.getScript('/core/js/jquery/ui/jquery.ui.dialog.js');
	$.alert = function(msgText, msgTitle) {
		(!msgTitle) ? msgTitle = $('#msgAlert').dialog('option', 'title') : $.noop;
		$('#msgAlertContent').html(msgText);
		$('#msgAlert').dialog('option', {
			width: 'auto',
			title: '<span class="ui-icon ui-icon-alert" style="float: left; margin: 0px 5px;"></span><span>' + msgTitle + '</span>',
			close: function() {
				$('#msgAlert').dialog('option', {
					title: msgTitle
				});
			}
		}).dialog('open');
	}
})(jQuery);

/**** Действия *****/
$(document).ready(function()
{
/***** Функция перезагрузки CAPTCHA *****/
	$('#refresh_si').click(function()
	{
		$('#si').attr('src', '/core/si/si.php?sid=' + Math.random());
		return false;
	});

/***** скрытие/отображение блоков *****/
	$("table.hidden_table").each(function (i)
	{
		if (this.id && $.cookie(this.id))
		{
			$(this).show();
      	}
	});

	$('.otbor_head[id]').click(function ()
	{
		var id = $(this).attr('id') + '_otbor';
			
		if ( $('#' + id).is(':hidden') )
		{
			$('#' + id).show();
			$.cookie(id, {expires: 7});			
		}
		else
		{
			$('#' + id).hide();
			$.cookie(id, null);
		}
	});
	
/***** Функция подтверждения удаления записей *****/
	var check_box = new Array();

	$('.delete').click(function ()
	{
		if ( $(this).is(':checked') )
		{
			check_box[$(this).attr('id')] = true;
		}
		else
		{
			check_box[$(this).attr('id')] = false;
		}
	});
	
	$('#delete').click(function ()
	{
		var delConfirm = false;

		for (var i in check_box)
		{
			if (check_box[i])
			{
       			delConfirm = true;
			}
		}

	    if (delConfirm && confirm('Delete selected records?'))
		{
			return $("form:last").submit();
		}
		else
		{
			return false;
		}

		return false;
	});

/***** Функция включения/отключения всех чекбоксов *****/
// отключена. Теперь делается отдельно в каждом шаблоне.
/*
	$('#s_all').click(function ()
	{
		var s_all = $(this);
		$(".check").each(function ()
		{
			if ( s_all.is(':checked') )
			{
				$('.check').attr('checked', true);
			}
			else
			{
				$('.check').attr('checked', false);
			}
		});
	});
*/

/***** Отображение картинок (требуется плагин colorbox для JQuery - лежит в modules) *****/
	$('.colorbox_img').colorbox({preloading: true, maxWidth:'100%', maxHeight:'100%', photo:true});
/***** Отображение справки для админки *****/
	$('.colorbox_help').click(function() {
		var targ = '/admajax.php?q=' + $(this).attr('id');
		$.fn.colorbox({href:targ, preloading:true, width:'75%', opacity:0, open:true});
	});

	$('.mods_help').click(function() {
		var targ = '#mod_' + $(this).attr('id');
		$.fn.colorbox({href:targ, preloading:true, inline:true, width:'75%', opacity:0, open:true});
	});

/***** Отображение справки для пользовательской части *****/
	$('.user_help').click(function() {
		var targ = '/ajax.php?q=' + $(this).attr('id');
		$.fn.colorbox({href:targ, preloading:true, width:'75%', opacity:0, open:true});
	});
});