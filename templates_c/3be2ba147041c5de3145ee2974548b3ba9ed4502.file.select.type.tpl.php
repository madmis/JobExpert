<?php /* Smarty version Smarty-3.1.5, created on 2012-05-19 11:53:46
         compiled from "templates/site/default\select.type.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173344fb7518a9f26c1-07694985%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3be2ba147041c5de3145ee2974548b3ba9ed4502' => 
    array (
      0 => 'templates/site/default\\select.type.tpl',
      1 => 1336142862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173344fb7518a9f26c1-07694985',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'chpu' => 0,
    'arrTypes' => 0,
    'type' => 0,
    'return_data' => 0,
    'arrPayments' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4fb7518acc04f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb7518acc04f')) {function content_4fb7518acc04f($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['errors']->value){?><?php echo $_smarty_tpl->getSubTemplate ("errors.message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>

<form action="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=select.type");?>
" method="post" enctype="multipart/form-data">
    <div class="DesignMainPageBody">
        <table class="mainBodyTable" cellspacing="0">
            <tr>
                <th>&nbsp;</th>
            </tr>
            <tr>
                <td class="last">
                    <div class="paddingText5">
                        <?php echo @MESSAGE_SELECT_TYPE;?>

                    </div>
                </td>
            </tr>
            <tr class="noBorderBottom">
                <td class="last padding10">
                    <?php  $_smarty_tpl->tpl_vars["type"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["type"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arrTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["type"]->key => $_smarty_tpl->tpl_vars["type"]->value){
$_smarty_tpl->tpl_vars["type"]->_loop = true;
?>
                        <input type="radio" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['return_data']->value['type']==$_smarty_tpl->tpl_vars['type']->value){?>checked<?php }?>> 
                        <?php if ($_smarty_tpl->tpl_vars['type']->value=="agent"){?>
				            <?php echo @FORM_TYPE_AGENT;?>
<?php if ($_smarty_tpl->tpl_vars['arrPayments']->value['register_agent']){?><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/money_dollar.png"  class="middle" alt="<?php echo @SITE_PAYMENT_SERVICE;?>
" title="<?php echo @SITE_PAYMENT_SERVICE;?>
"><?php }?>
			            <?php }elseif($_smarty_tpl->tpl_vars['type']->value=="company"){?>
				            <?php echo @FORM_TYPE_COMPANY;?>
<?php if ($_smarty_tpl->tpl_vars['arrPayments']->value['register_company']){?><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/money_dollar.png"  class="middle" alt="<?php echo @SITE_PAYMENT_SERVICE;?>
" title="<?php echo @SITE_PAYMENT_SERVICE;?>
"><?php }?>
			            <?php }elseif($_smarty_tpl->tpl_vars['type']->value=="employer"){?>
				            <?php echo @FORM_TYPE_EMPLOYER;?>
<?php if ($_smarty_tpl->tpl_vars['arrPayments']->value['register_employer']){?><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/money_dollar.png"  class="middle" alt="<?php echo @SITE_PAYMENT_SERVICE;?>
" title="<?php echo @SITE_PAYMENT_SERVICE;?>
"><?php }?>
			            <?php }elseif($_smarty_tpl->tpl_vars['type']->value=="competitor"){?>
				            <?php echo @FORM_TYPE_COMPETITOR;?>
<?php if ($_smarty_tpl->tpl_vars['arrPayments']->value['register_competitor']){?><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/icons/money_dollar.png"  class="middle" alt="<?php echo @SITE_PAYMENT_SERVICE;?>
" title="<?php echo @SITE_PAYMENT_SERVICE;?>
"><?php }?>
			            <?php }?>
		            <?php } ?>
		        </td>
	        </tr>
	        <tr class="noBorderBottom">
		        <td class="last padding10">
			        <span class="st_text">
				        <?php echo @FORM_FIRST_NAME;?>
<span class="text-red">*</span>
			        </span>
                    <span class="st_input">
                        <input type="text" name="first_name" value="<?php echo $_smarty_tpl->tpl_vars['return_data']->value['first_name'];?>
" class="text" maxlength="32" size="50">
			        </span>
		        </td>
	        </tr>
	        <tr class="noBorderBottom">
		        <td class="last padding10">
			        <span  class="st_text">
				        <?php echo @FORM_LAST_NAME;?>
<span class="text-red">*</span>
			        </span>
			        <span class="st_input">
				        <input type="text" name="last_name" value="<?php echo $_smarty_tpl->tpl_vars['return_data']->value['last_name'];?>
" class="text" maxlength="32" size="50">
			        </span>
		        </td>
	        </tr>
	        <tr>
		        <td class="last padding10">
			        <span  class="st_text">
				        <?php echo @FORM_PHONE;?>
<span class="text-red">*</span>
			        </span>
			        <span class="st_input">
				        <input type="text" name="phone" value="<?php echo $_smarty_tpl->tpl_vars['return_data']->value['phone'];?>
" class="text" maxlength="25" size="50">
			        </span>
		        </td>
	        </tr>
	<tr>
		<td class="padding10">
            <div style="margin: 0 auto;" class="submitButtonLight">
                <input type="submit" class="shadow01red" value="<?php echo @FORM_BUTTON_SAVE;?>
">
            </div>
		</td>
	</tr>
</table>
    </div>
</form><?php }} ?>