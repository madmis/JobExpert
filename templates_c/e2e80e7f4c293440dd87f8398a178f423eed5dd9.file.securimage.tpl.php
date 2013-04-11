<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:52:33
         compiled from "templates/site/default\securimage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:320234fb751412128c9-38399125%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2e80e7f4c293440dd87f8398a178f423eed5dd9' => 
    array (
      0 => 'templates/site/default\\securimage.tpl',
      1 => 1336142862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '320234fb751412128c9-38399125',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sid' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb7514123fba',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb7514123fba')) {function content_4fb7514123fba($_smarty_tpl) {?><img id="si" src="<?php echo @CONF_SCRIPT_URL;?>
core/si/si.php?sid=<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
" alt="error Captcha!">&nbsp;<img src="<?php echo @CONF_SCRIPT_URL;?>
core/si/images/refresh.gif" title="<?php echo @FORM_CAPTCHA_REFRESH;?>
" alt="<?php echo @FORM_CAPTCHA_REFRESH;?>
" id="refresh_si" style="cursor: pointer; border: 0px;"><?php }} ?>