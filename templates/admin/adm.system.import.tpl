{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}
{* Отображение процесса импорта БД *}
{if $importShowProgress || $importContinueProgress}
	<div id="importDescription">
		<table class="tmpl_mail_table">
			<thead class="tmpl_mail_head">
				<tr>
					<td>
						{if $importShowProgress}
							{$smarty.const.FORM_SYSTEM_IMPORT_DESCRIPTION}
						{else}
							{$smarty.const.FORM_SYSTEM_IMPORT_CONTINUE_DESCRIPTION}
						{/if}
					</td>
				</tr>
			</thead>
			<tbody class="tmpl_mail_body">
				<tr><td><input id="importStart" type="button" value="{if $importShowProgress}{$smarty.const.FORM_BUTTON_EXECUTE}{else}{$smarty.const.FORM_BUTTON_CONTINUE}{/if}" class="button"></td></tr>
			</tbody>
		</table>
	</div>
	<div id="importProgress" style="display: none;">
		{if $warnings}{include file="adm.warnings.message.tpl"}{/if}
		<div style="margin-left: 20px;">
			<p style="font-weight: bold;">
				{$smarty.const.FORM_SYSTEM_IMPORT_DB_TITLE}:
				<span style="margin-left: 5px; font-weight: normal;">
					{$smarty.const.FORM_SYSTEM_IMPORT_DB_TO_COMPLETE_TIME}
					<span id="sBar_total" style="margin-left: 5px;"></span>
				</span>
			</p>
			<div id="dBar_total" style="line-height: 15px; position: relative; top: 15px; left: 655px; font-weight: bold;"></div>
			<div id="pBar_total"></div>
		</div>
		<div class="pBar_job_subscription" style="display: none;">
			<p class="p_5">
				{$smarty.const.FORM_SYSTEM_IMPORT_TABLE_SUBSRIPTIONS}
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" id="iBar_job_subscription" alt="" style="display: none; vertical-align: bottom;">
			</p>
			<div id="pBar_job_subscription"></div>
		</div>
		<div class="pBar_job_vacancy" style="display: none;">
			<p class="p_5">
				{$smarty.const.FORM_SYSTEM_IMPORT_TABLE_VACANCYS}
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" id="iBar_job_vacancy" alt="" style="display: none; vertical-align: bottom;">
			</p>
			<div id="pBar_job_vacancy"></div>
		</div>
		<div class="pBar_job_resume" style="display: none;">
			<p class="p_5">
				{$smarty.const.FORM_SYSTEM_IMPORT_TABLE_RESUMES}
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" id="iBar_job_resume" alt="" style="display: none; vertical-align: bottom;">
			</p>
			<div id="pBar_job_resume"></div>
		</div>
		<div class="pBar_main_city" style="display: none;">
			<p class="p_5">
				{$smarty.const.FORM_SYSTEM_IMPORT_TABLE_CITYS}
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" id="iBar_main_city" alt="" style="display: none; vertical-align: bottom;">
			</p>
			<div id="pBar_main_city"></div>
		</div>
		<div class="pBar_main_region" style="display: none;">
			<p class="p_5">
				{$smarty.const.FORM_SYSTEM_IMPORT_TABLE_REGIONS}
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" id="iBar_main_region" alt="" style="display: none; vertical-align: bottom;">
			</p>
			<div id="pBar_main_region"></div>
		</div>
		<div class="pBar_job_profession" style="display: none;">
			<p class="p_5">
				{$smarty.const.FORM_SYSTEM_IMPORT_TABLE_PROFESSIONS}
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" id="iBar_job_profession" alt="" style="display: none; vertical-align: bottom;">
			</p>
			<div id="pBar_job_profession"></div>
		</div>
		<div class="pBar_job_section" style="display: none;">
			<p class="p_5">
				{$smarty.const.FORM_SYSTEM_IMPORT_TABLE_SECTIONS}
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" id="iBar_job_section" alt="" style="display: none; vertical-align: bottom;">
			</p>
			<div id="pBar_job_section"></div>
		</div>
		<div class="pBar_main_users" style="display: none;">
			<p class="p_5">
				{$smarty.const.FORM_SYSTEM_IMPORT_TABLE_USERS}
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" id="iBar_main_users" alt="" style="display: none; vertical-align: bottom;">
			</p>
			<div id="pBar_main_users"></div>
		</div>
		<div class="pBar_job_news" style="display: none;">
			<p class="p_5">
				{$smarty.const.FORM_SYSTEM_IMPORT_TABLE_NEWS}
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" id="iBar_job_news" alt="" style="display: none; vertical-align: bottom;">
			</p>
			<div id="pBar_job_news"></div>
		</div>
	</div>
<script type="text/javascript">
<!--
(function($) {
	$.fn.doImportDB = function(action, param) {
		$.getJSON('/admajax.php?action=' + action, function(resp){
			// общий прогресс-бар
			param.totalPercents = Math.round(++param.totalComplete * 100 / param.totalData);
			param.bar.total.progressbar({ value: param.totalPercents });
			$('#dBar_total').text(param.totalPercents + '%');
			// прогресс-бар таблиц
			param.tablePercents = Math.round(++param[resp.table + 'Complete'] * 100 / param[resp.table + 'Data']);
			(100 == param.tablePercents) ? $('#iBar_' + resp.table).show() : $.noop;
			param.bar[resp.table].progressbar({ value: param.tablePercents });
			// рекурсивно выполняем импорт, пока скрипт возвращает результат
			if (resp.onProgress) {
				// вычисляем время выполнения импорта
				param.timeToComplite = Math.round((new Date().getTime() - param.startTime) / param.totalComplete * (param.totalData - param.totalComplete));
				param.min = Math.floor(param.timeToComplite / 60000);
				param.sec = Math.round((param.timeToComplite - param.min * 60000 ) / 1000);
				(59 < param.sec) ? param.sec = 59 : $.nopp;
				param.min = (param.min > 0) ? '<b>' + ((param.min < 10) ? '0' + param.min : param.min) + '</b> {$smarty.const.SITE_MINUTE} ' : '';
				param.sec = '<b>' + ((param.sec < 10) ? '0' + param.sec : param.sec) + '</b> {$smarty.const.SITE_SECOND}'
				$('#sBar_total').html(param.min + param.sec);
				// рекурсивный вызов
				$.fn.doImportDB('mdsDoImportDB', param);
			} else { // иначе сообщаем об окончании импорта
				$('#sBar_total').parent().text('{$smarty.const.FORM_SYSTEM_IMPORT_DB_COMPLETED}');
				$('#dBar_total').css({ color: '#ffffff'});
				// переводим сайт в рабочий режим
				$.post('/admajax.php', { maintenance: 'off' });
			}
		});
	}
})(jQuery);

$(document).ready(function() {
	// вызываем функцию импорта
	$('#importStart').click(function () {
		// переводим сайт на обслуживание
		$.post('/admajax.php', { maintenance: 'on' });
		// удаляем информационный блок
		$('#importDescription').remove();
		// инициируем объект параметров
		var param = {
			bar: {},
			min: 0,
			sec: 0,
			totalData: 0,
			totalPercents: 0,
			totalComplete: 0,
			timeToComplite: 0,
			startTime: new Date().getTime()
		}
		// заполняем объект параметров, из полученных данных
		$.each($.parseJSON('{$importData}'), function(k, data){
			// вычисляем общее количество запросов
			param.totalData += data.size * 1;
			// вычисляем количество запросов к каждой таблице
			param[data.table + 'Data'] = data.size * 1;
			param[data.table + 'Complete'] = 0;
			// инициируем прогресс-бар для отображения хода импорта таблицы
			param.bar[data.table] = $('#pBar_' + data.table).css({
				width: '650px',
				height: '5px'
			}).progressbar();
			// отображаем блок
			$('.pBar_' + data.table).css({ margin: '30px' }).show();
		});
		// инициируем общий прогресс-бар для отображения хода импорта
		param.bar.total = $('#pBar_total').css({
			width: '700px',
			height: '15px'
		}).progressbar();
		// запускаем импорт
		$.fn.doImportDB('mdsDoImportDB', param);
		// отображаем процесс импорта
		$('#importProgress').show();
	});
});
-->
</script>
{* Отображение формы импорта БД *}
{else}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=system&amp;s=import&amp;action=mds" method="post">
		<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
			<tr>
				<td>{$smarty.const.FORM_SITE_URL}</td>
				<td><input type="text" name="script_url" size="80" value="" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_SITE_URL">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="font-weight: bold; text-align: center;">{$smarty.const.FORM_DATABASE}</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_DBHOST}</td>
				<td><input type="text" name="dbhost" value="" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_DBHOST">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_DBNAME}</td>
				<td><input type="text" name="dbname" value="" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_DBNAME">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_DBUSER}</td>
				<td><input type="text" name="dbuser" value="" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_DBUSER">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_DBPASSWORD}</td>
				<td><input type="text" name="dbpassword" value="" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_DBPASSWORD">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td colspan="3" style="font-weight: bold; text-align: center;">{$smarty.const.FORM_TABLES}</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_SYSTEM_IMPORT_NAME_TABLE_USERS}</td>
				<td><input type="text" name="table_users" value="job_user" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_NAME_TABLE_USERS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_SYSTEM_IMPORT_NAME_TABLE_VACANCYS}</td>
				<td><input type="text" name="table_vacancy" value="job_vacancy" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_NAME_TABLE_VACANCYS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_SYSTEM_IMPORT_NAME_TABLE_RESUMES}</td>
				<td><input type="text" name="table_resume" value="job_resume" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_NAME_TABLE_RESUMES">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_SYSTEM_IMPORT_NAME_TABLE_SECTIONS}</td>
				<td><input type="text" name="table_section" value="job_razdel" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_NAME_TABLE_SECTIONS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_SYSTEM_IMPORT_NAME_TABLE_PROFESSIONS}</td>
				<td><input type="text" name="table_profession" value="job_profecy" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_NAME_TABLE_PROFESSIONS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_SYSTEM_IMPORT_NAME_TABLE_REGIONS}</td>
				<td><input type="text" name="table_region" value="job_oblast" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_NAME_TABLE_REGIONS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_SYSTEM_IMPORT_NAME_TABLE_CITYS}</td>
				<td><input type="text" name="table_city" value="job_city" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_NAME_TABLE_CITYS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_SYSTEM_IMPORT_NAME_TABLE_SUBSRIPTIONS}</td>
				<td><input type="text" name="table_subscription" value="job_subscription" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_NAME_TABLE_SUBSRIPTIONS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
			<tr>
				<td>{$smarty.const.FORM_SYSTEM_IMPORT_NAME_TABLE_NEWS}</td>
				<td><input type="text" name="table_news" value="job_news" class="text"></td>
				<td style="text-align: center;">
					<span class="colorbox_help" id="HELP_ADMIN_IMPORT_NAME_TABLE_NEWS">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
					</span>
				</td>
			</tr>
		</table>
		<p style="text-align: center;"><input type="submit" name="execute" value="{$smarty.const.FORM_BUTTON_SEND}" class="button"></p>
	</form>
{/if}