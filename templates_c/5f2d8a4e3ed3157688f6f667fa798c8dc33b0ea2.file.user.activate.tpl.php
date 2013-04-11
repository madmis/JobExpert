<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:53:13
         compiled from "templates/site/default\user.activate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149734fb7516915a3f1-64351221%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f2d8a4e3ed3157688f6f667fa798c8dc33b0ea2' => 
    array (
      0 => 'templates/site/default\\user.activate.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149734fb7516915a3f1-64351221',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'chpu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb7516920c61',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb7516920c61')) {function content_4fb7516920c61($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['errors']->value){?><?php echo $_smarty_tpl->getSubTemplate ("errors.message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>

<form action="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.activate");?>
" method="post" enctype="multipart/form-data">
    <div class="DesignMainPageBody">
        <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
            <tr>
                <th>&nbsp;</th>
            </tr>
            <tr>
                <td class="last AlignLeft">
                    <div class="paddingText5">
                        <?php echo @MESSAGE_ACTIVATE_REG_USER;?>
<br>
                            <table><tr><td>
                                <strong><?php echo @FORM_ACTIVATE_CODE;?>
</strong>&nbsp;
                                <input type="text" name="code" size="50" value="">
                            </td><td>
                                <div class="submitButtonLight">
                                    <input type="submit" class="shadow01red" value="<?php echo @FORM_BUTTON_SEND;?>
">
                                </div>
                            </td></tr></table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form><?php }} ?>