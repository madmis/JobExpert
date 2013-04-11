<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:07
         compiled from "templates/site/default\block.statistics.tpl" */ ?>
<?php /*%%SmartyHeaderCode:305784faa4897677271-70163194%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f0586cdd3b2d24680eabb4724910bf991cc6ff7' => 
    array (
      0 => 'templates/site/default\\block.statistics.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '305784faa4897677271-70163194',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'statistics' => 0,
    'user_email' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa48976fc59',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa48976fc59')) {function content_4faa48976fc59($_smarty_tpl) {?><div class="DesignLeftSideBarBlockWrapper">
	<h3 class="sideBlockHeader" id="statistic"><?php echo @SITE_BLOCK_STATISTICS;?>
</h3>
    <div class="ContentWrapper">
    	<?php if ($_smarty_tpl->tpl_vars['statistics']->value){?>
            <table class="statistics">
                <tr>
                    <th><?php echo @SITE_BLOCK_STATISTICS_USERS;?>
:</th>
                    <td>[ <strong><?php echo $_smarty_tpl->tpl_vars['statistics']->value['users'];?>
</strong> ]</td>
                </tr>
                <tr>
                    <th><?php echo @SITE_BLOCK_STATISTICS_VACANCYS;?>
:</th>
                    <td>[ <strong><?php echo $_smarty_tpl->tpl_vars['statistics']->value['vacancys'];?>
</strong> ]</td>
                </tr>
                <tr>
                    <th><?php echo @SITE_BLOCK_STATISTICS_RESUMES;?>
:</th>
                    <td>[ <strong><?php if (!$_smarty_tpl->tpl_vars['user_email']->value){?><?php echo $_smarty_tpl->tpl_vars['statistics']->value['resumes_v'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['statistics']->value['resumes_m'];?>
<?php }?></strong> ]</td>
                </tr>
            </table>
    	<?php }else{ ?>
    	   <?php echo @ERROR_NON_DATA;?>

    	<?php }?>
    </div>
</div><?php }} ?>