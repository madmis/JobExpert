{if $errors}{include file="errors.message.tpl"}{/if}
	
<div class="Design_panesComments">
	<div class="Design_panesBG">
		<table class="commentsForm" cellpadding="0">
			<tr>
				<td>
					<ul class="Design_tabs">
						<li><a class="active">{$smarty.const.FORM_COMMENTS} (<span id="countComments">0</span>)</a></li>
					</ul>
					<span class="hideComments">
						<a href="javascript:void(0);" rel="nofollow" id="hideCommentsForm">{$smarty.const.FORM_COMMENTS_HIDE_FORM}</a>
						<a href="javascript:void(0);" rel="nofollow" id="hideComments">{$smarty.const.FORM_COMMENTS_HIDE_COMMENTS}</a>
					</span>
					<input type="hidden" id="articleId" value="{$article.id}">
				</td>
			</tr>
		</table>
			<table class="commentsForm" id="blockComments" cellpadding="0">
			{if $smarty.const.CONF_ARTICLES_COMMENTS_REGISTER && !$user_email}
			<tr>
				<td class="DesignUserDataTopData">
				{$smarty.const.MESSAGE_COMMENTS_REGISTER}&nbsp;(<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=register")}">{$smarty.const.MENU_REGISTER}</a>)
				</td>
			</tr>
			{else}
			<tr>
				<td class="DesignUserDataTopData">
					<form action="" id="addComment" method="post">
						<strong class="shadow01">{$smarty.const.FORM_COMMENT}:</strong><br>
						<textarea cols="75" rows="7" id="commentText"></textarea>
                        {if !$user_email}
                            <p>{$smarty.const.SITE_USER_ALIAS}&nbsp;<input type="text" id="userName" size="40" maxlength="40"></p>
                        {else}
                            <input type="hidden" id="userName"> 
                        {/if}
						<div class="Design_panes">
                            {if $smarty.const.SECURE_CAPTCHA}<br>
                              <table>
                                  <tr>
                                      <td style="text-align: right;">{include file="securimage.tpl"}</td>
                                      <td style="text-align: left;"><input type="text" id="keystring"></td>
                                  </tr>
                              </table><br>
                            {/if}

							<div class="submitButtonLight" align="center">
                        		<input type="submit" class="shadow01red" name="save" value="{$smarty.const.FORM_BUTTON_ADD}">
							</div>
						</div>
					</form>
				</td>
			</tr>
			{/if}
			<tr>
				<td class="DesignUserDataTopData">
					<div id="viewComments"></div>
				</td>
			</tr>
		</table>
	</div>
</div>


<script type="text/javascript">
<!--
$(function() {
	/***** Functions *****/
	$.fn.hideComments = function(id) {
		$(this).toggle();
		$('#hideCommentsForm').toggle();
		if ( $(this).is(':hidden') ) {
			$.cookie('hideComments', true, { path: '/', expires: 7 });
			$('#hideComments').text('{$smarty.const.FORM_COMMENTS_SHOW_COMMENTS}');
		} else {
			$.cookie('hideComments', null, { path: '/', expires: 0 });
			$('#hideComments').text('{$smarty.const.FORM_COMMENTS_HIDE_COMMENTS}');
			$('#viewComments').ajaxGetComments(id);
		}
		return false;
	}

	$.fn.hideCommentsForm = function() {
		$(this).toggle();
		if ( $(this).is(':hidden') ) {
			$('#hideCommentsForm').text('{$smarty.const.FORM_COMMENTS_SHOW_FORM}');
			$.cookie('hideCommentsForm', true, { path: '/', expires: 7 });
		} else {
			$('#hideCommentsForm').text('{$smarty.const.FORM_COMMENTS_HIDE_FORM}');
			$.cookie('hideCommentsForm', null, { path: '/', expires: 0 });
		}
		return false;
	}

	// функция загрузки комментариев
	$.fn.ajaxGetComments = function(id, order) {
		if (!id) {
			return false;
		}

		var postData = 'getCommentsA=' + id;

		if (order) {
			postData = 'getCommentsA=' + id + '&order=' + order;
		}

		$('#overlay, #dialog').show();
		// подгружаем комментарии
		$.ajax({ type: 'post', url: '/ajax.php', data: postData,
			success: function( response ) {
				$('#viewComments').html(response);
			},
			complete: function() {
				$('#overlay, #dialog').hide();
			}
		});

		return false;
	}
	/***** END Functions *****/


	var id = $('#articleId').val();

	// получаем количество комментариев
	$.ajax({ type: 'post', url: '/ajax.php', data: 'getCountCommentsA=' + id,
		success: function( response ) {
			$('#countComments').html(response);
		}
	});

	if ($.cookie('hideCommentsForm')) {
		$('#addComment').hideCommentsForm();
	}

	// если комментарии скрыты, скрываем все, кроме заголовка
	if ($.cookie('hideComments'))
	{
		$('#blockComments').hideComments(id);
	} else {
		// подгружаем комментарии
		$('#viewComments').ajaxGetComments(id);

		// сортировка комментариев
		$("a[id^='ord']").live('click', function() {
			var ordId = $(this).attr('id');

			// подгружаем комментарии
			$('#viewComments').ajaxGetComments(id, ordId);
		});

		// добавляем комментарий
		$("#addComment").submit( function() {
			var text = $('#commentText').val();

			if (text.length < 1) {
				alert ('{$smarty.const.ERROR_COMMENT_TEXT_EMPTY}');
				return false;
			} else if (!id) {
				alert ('{$smarty.const.ERROR_COMMENT_ARTICLE_NOT_FOUND}');
				return false;
			}

			$('#overlay, #dialog').show();

			$.ajax({ type: 'post', url: '/ajax.php',
                     data: 'addCommentA=' + text + '&articleId=' + id + '&userName=' + $('#userName').val() + '&keystring=' + $('#keystring').val(),
				success: function( response ) {
					response = $.parseJSON(response);

					if (response.success) {
						var count = $('#countComments').html();
						$('#countComments').html( count * 1 + 1 );
						$('#commentText').val('');
                        // очищаем и обновляем капчу
                        $('#keystring').val('')
                        $('#refresh_si').trigger('click');

						// обновляем список комментариев
						$('#viewComments').ajaxGetComments(id);
					} else {
						alert(response.error);
                        // очищаем и обновляем капчу
                        $('#keystring').val('')
                        $('#refresh_si').trigger('click');
					}
				},
				complete: function() {
					$('#overlay, #dialog').hide();
				}
			});
			return false;
		});

    	// Скрываем форму комментариев
		$('#hideCommentsForm').live('click', function() {
			$('#addComment').hideCommentsForm();
		});
	}

	// Скрываем комментарии
	$('#hideComments').click( function() {
		$('#blockComments').hideComments(id);
	});
	
});
-->
</script>