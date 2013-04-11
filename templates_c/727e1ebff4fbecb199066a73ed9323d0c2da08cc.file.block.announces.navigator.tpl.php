<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:07
         compiled from "templates/site/default\block.announces.navigator.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103044faa4897786710-30282919%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '727e1ebff4fbecb199066a73ed9323d0c2da08cc' => 
    array (
      0 => 'templates/site/default\\block.announces.navigator.tpl',
      1 => 1336142862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103044faa4897786710-30282919',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user_type' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa48977c827',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa48977c827')) {function content_4faa48977c827($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['user_type']->value=='competitor'){?>
	<?php echo $_smarty_tpl->getSubTemplate ("block.vacancy.list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif($_smarty_tpl->tpl_vars['user_type']->value=='employer'||$_smarty_tpl->tpl_vars['user_type']->value=='company'){?>
	<?php echo $_smarty_tpl->getSubTemplate ("block.resume.list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif($_smarty_tpl->tpl_vars['user_type']->value=='agent'){?>
	<?php echo $_smarty_tpl->getSubTemplate ("block.sections.list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php echo $_smarty_tpl->getSubTemplate ("block.regions.list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?><?php }} ?>