<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:08
         compiled from "templates/site/default\block.site.foot.tpl" */ ?>
<?php /*%%SmartyHeaderCode:118294faa4898355af6-40887426%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff012ae0b9941a604295f130fcfd8e779114e68b' => 
    array (
      0 => 'templates/site/default\\block.site.foot.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '118294faa4898355af6-40887426',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'year' => 0,
    'chpu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa48983f322',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa48983f322')) {function content_4faa48983f322($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'I:\\home\\Smarty\\plugins\\modifier.date_format.php';
?><div style="height: 2px; background-color:#413C3C;"></div>

<table width="100%" class="footerCopyrights">
	<tr>
		<td style="white-space: nowrap;">
			<?php $_smarty_tpl->tpl_vars["year"] = new Smarty_variable(smarty_modifier_date_format(time(),"%Y"), null, 0);?>
			engine Expert
			<span class="lastQuerys" style="cursor: default">&copy;</span>
			<a href="http://sd-group.org.ua/" target="_blank">SD-Group</a>
			<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['year']->value+5;?>

		</td>
		<td style="text-align: right;">
			<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=rss");?>
"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/rss_20.png" alt="RSS" style="background-color: #CC0000;"></a>
			<a href="http://www.php.net/" rel="nofollow"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/generic/php.gif" alt="Developed using PHP" title="Developed using PHP" style="background-color: #FFF;"></a>
			<a href="http://www.mysql.com/" rel="nofollow"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/generic/mysql.gif" alt="Developed using MySql" title="Developed using MySql" style="background-color: #FFF;"></a>
		</td>
	</tr>
</table>
<div id="overlay"></div>
<div id="dialog"><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/loading.gif" alt=""></div><?php }} ?>