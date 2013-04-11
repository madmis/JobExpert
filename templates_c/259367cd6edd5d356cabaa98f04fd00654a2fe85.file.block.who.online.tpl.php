<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:07
         compiled from "templates/site/default\block.who.online.tpl" */ ?>
<?php /*%%SmartyHeaderCode:183714faa4897704975-80398126%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '259367cd6edd5d356cabaa98f04fd00654a2fe85' => 
    array (
      0 => 'templates/site/default\\block.who.online.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '183714faa4897704975-80398126',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'whoOnline' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa489777e51',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa489777e51')) {function content_4faa489777e51($_smarty_tpl) {?><div class="DesignLeftSideBarBlockWrapperB">
    <h3 class="sideBlockHeader" id="whoOnline"><?php echo @SITE_BLOCK_ATTENDEES;?>
</h3>
    <div class="ContentWrapper">
    	<?php if ($_smarty_tpl->tpl_vars['whoOnline']->value){?>
            <table class="whoonline">
                <tr>
                    <th><?php echo @SITE_BLOCK_ATTENDEES_GUESTS;?>
:</th>
                    <td>[ <strong><?php echo $_smarty_tpl->tpl_vars['whoOnline']->value['guests'];?>
</strong> ]</td>
                </tr>
                <tr>
                    <th><?php echo @SITE_BLOCK_ATTENDEES_USERS;?>
:</th>
                    <td>[ <strong><?php echo $_smarty_tpl->tpl_vars['whoOnline']->value['users'];?>
</strong> ]</td>
                </tr>
                <tr>
                    <th><?php echo @SITE_BLOCK_ATTENDEES_TOTAL;?>
:</th>
                    <td>[ <strong><?php echo $_smarty_tpl->tpl_vars['whoOnline']->value['guests']+$_smarty_tpl->tpl_vars['whoOnline']->value['users'];?>
</strong> ]</td>
                </tr>
            </table>
    	<?php }else{ ?>
    	   <?php echo @ERROR_NON_DATA;?>

    	<?php }?>
    </div>
</div><?php }} ?>