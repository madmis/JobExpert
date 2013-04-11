<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:53:32
         compiled from "templates/site/default\authorize.tpl" */ ?>
<?php /*%%SmartyHeaderCode:175344fb7517c9ab840-45516046%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b95fa7a1cd563b2c5bfc41eedba52e9a6b6892d' => 
    array (
      0 => 'templates/site/default\\authorize.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175344fb7517c9ab840-45516046',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'chpu' => 0,
    'namePage' => 0,
    'return_data' => 0,
    'secure' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb7517cb3cc8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb7517cb3cc8')) {function content_4fb7517cb3cc8($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['errors']->value){?><?php echo $_smarty_tpl->getSubTemplate ("errors.message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>

<form action="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=authorize");?>
" method="post" enctype="multipart/form-data">
<div class="DesignMainPageBody">
    <table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
        <tr>
            <th colspan="2"><?php echo $_smarty_tpl->tpl_vars['namePage']->value[0]['name'];?>
</th>
        </tr>
        <tr>
            <td colspan="2" class="last AlignLeft">
                <div class="paddingText5">
                    <table cellspacing="0" cellpadding="0">
                        <tr>
                            <td rowspan="5" style="width: 70px; text-align: left;">
                                <img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/login.png" alt="">
                            </td>
                            <td>
                                <strong><?php echo @FORM_EMAIL;?>
</strong><br>
                                <input type="text" name="email" size="30" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['return_data']->value['email'])===null||$tmp==='' ? @FORM_EMAIL : $tmp);?>
">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong><?php echo @FORM_PASSWORD;?>
</strong><br>
                                <input type="password" name="password" size="30" value="<?php echo @FORM_PASSWORD;?>
">
                            </td>
                        </tr>
                        <?php if ($_smarty_tpl->tpl_vars['secure']->value){?>
                        <tr>
                            <td align="left" nowrap>
                                <table>
                                    <tr>
                                        <td align="right"><?php echo $_smarty_tpl->getSubTemplate ("securimage.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</td>
                                        <td align="left"><input type="text" name="keystring" size="10"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php }?>
                        <tr>
                            <td>
                                <input type="checkbox" name="remember"> <?php echo @FORM_REMEMBER;?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="submitButtonLight"><input type="submit" class="shadow01red" name="send" value="<?php echo @FORM_BUTTON_SEND;?>
"></div><br>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</div>
</form>



<?php }} ?>