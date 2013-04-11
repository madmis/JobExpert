<?php /* Smarty version Smarty-3.1.5, created on 2012-05-09 14:36:04
         compiled from "templates/site/default\top.menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:220254faa4894619032-61179406%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25d7b0b76e9e8b642b1fd0b69882dc8150639a75' => 
    array (
      0 => 'templates/site/default\\top.menu.tpl',
      1 => 1336142860,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '220254faa4894619032-61179406',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu' => 0,
    'chpu' => 0,
    'user_type' => 0,
    'user_email' => 0,
    'action' => 0,
    'codex' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4faa4894de4d4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faa4894de4d4')) {function content_4faa4894de4d4($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include 'I:\\home\\Smarty\\plugins\\function.counter.php';
?>

<ul class="DesignTopSubMenu">

     <li class="delimiter">&nbsp;</li>

     <?php echo smarty_function_counter(array('start'=>0,'print'=>false),$_smarty_tpl);?>


     <li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if (($_tmp1%2)){?>even<?php }else{ ?>odd<?php }?>">
     <div class="delimiter">
     <?php if ($_smarty_tpl->tpl_vars['menu']->value=='main'){?>
          <a class="active"><?php echo @MENU_MAIN;?>
</a>
     <?php }else{ ?>
          <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value));?>
"><?php echo @MENU_MAIN;?>
</a>
     <?php }?>
     </div>
     </li>

 	 <?php if ($_smarty_tpl->tpl_vars['user_type']->value!='competitor'){?>
        <li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp2=ob_get_clean();?><?php if (($_tmp2%2)){?>even<?php }else{ ?>odd<?php }?>">
         <div class="delimiter">
	    <?php if ($_smarty_tpl->tpl_vars['menu']->value=='add_vacancy'){?>
            <a class="active"><?php echo @MENU_VACANCY_ADD;?>
</a>
        <?php }else{ ?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=vacancy&amp;action=add");?>
"><?php echo @MENU_VACANCY_ADD;?>
</a>
        <?php }?>
        </div>
        </li>
	 <?php }?>

     <?php if ($_smarty_tpl->tpl_vars['user_type']->value=='competitor'||$_smarty_tpl->tpl_vars['user_type']->value=='agent'){?>
         <li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp3=ob_get_clean();?><?php if (($_tmp3%2)){?>even<?php }else{ ?>odd<?php }?>">
         <div class="delimiter">
         <?php if ($_smarty_tpl->tpl_vars['menu']->value=='add_resume'){?>
             <a class="active"><?php echo @MENU_RESUME_ADD;?>
</a>
         <?php }else{ ?>
             <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=resume&amp;action=add");?>
"><?php echo @MENU_RESUME_ADD;?>
</a>
         <?php }?>
         </div>
         </li>
     <?php }?>
     <li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp4=ob_get_clean();?><?php if (($_tmp4%2)){?>even<?php }else{ ?>odd<?php }?>">
     <div class="delimiter">
	 <?php if ($_smarty_tpl->tpl_vars['user_type']->value=='agent'){?>
		<?php if ($_smarty_tpl->tpl_vars['menu']->value=='search'){?>
            <a class="active"><?php echo @MENU_SEARCH;?>
</a>
        <?php }else{ ?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=search");?>
"><?php echo @MENU_SEARCH;?>
</a>
        <?php }?>
	 <?php }elseif($_smarty_tpl->tpl_vars['user_type']->value=='employer'||$_smarty_tpl->tpl_vars['user_type']->value=='company'){?>
		<?php if ($_smarty_tpl->tpl_vars['menu']->value=='search'){?>
            <a class="active"><?php echo @MENU_SEARCH_RESUME;?>
</a>
        <?php }else{ ?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=search");?>
"><?php echo @MENU_SEARCH_RESUME;?>
</a>
        <?php }?>
	 <?php }elseif($_smarty_tpl->tpl_vars['user_type']->value=='competitor'){?>
		<?php if ($_smarty_tpl->tpl_vars['menu']->value=='search'){?>
            <a class="active"><?php echo @MENU_SEARCH_VACANCY;?>
</a>
        <?php }else{ ?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=search");?>
"><?php echo @MENU_SEARCH_VACANCY;?>
</a>
        <?php }?>
	 <?php }?>
     </div>
     </li>

     <li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp5=ob_get_clean();?><?php if (($_tmp5%2)){?>even<?php }else{ ?>odd<?php }?>">
     <div class="delimiter">
     <?php if ($_smarty_tpl->tpl_vars['menu']->value=='articles'){?>
        <a class="active"><?php echo @MENU_ARTICLES;?>
</a>
     <?php }else{ ?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=articles");?>
"><?php echo @MENU_ARTICLES;?>
</a>
     <?php }?>
     </div>
     </li>

     <li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp6=ob_get_clean();?><?php if (($_tmp6%2)){?>even<?php }else{ ?>odd<?php }?>">
     <div class="delimiter">
     <?php if ($_smarty_tpl->tpl_vars['menu']->value=='companies'){?>
        <a class="active"><?php echo @MENU_COMPANIES;?>
</a>
     <?php }else{ ?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=companies");?>
"><?php echo @MENU_COMPANIES;?>
</a>
     <?php }?>
     </div>
     </li>

     <li class="<?php ob_start();?><?php echo smarty_function_counter(array(),$_smarty_tpl);?>
<?php $_tmp7=ob_get_clean();?><?php if (($_tmp7%2)){?>even<?php }else{ ?>odd<?php }?>">
     <div class="delimiter">
     <?php if ($_smarty_tpl->tpl_vars['menu']->value=='agencies'){?>
        <a class="active"><?php echo @MENU_AGENCIES;?>
</a>
     <?php }else{ ?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?do=agencies");?>
"><?php echo @MENU_AGENCIES;?>
</a>
     <?php }?>
     </div>
     </li>

	<?php if (!$_smarty_tpl->tpl_vars['user_email']->value){?>
     	<li class="right">
			<?php if ($_smarty_tpl->tpl_vars['user_type']->value=='competitor'){?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=employer");?>
"><?php echo @MENU_EMPLOYER;?>
 <span class="arr">&rarr;</span></a>
			<?php }elseif($_smarty_tpl->tpl_vars['user_type']->value=='employer'){?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=competitor");?>
"><?php echo @MENU_COMPETITOR;?>
 <span class="arr">&rarr;</span></a>
			<?php }?>
     	</li>
	 <?php }?>
</ul>
<?php if (@CONF_USER_REGISTER){?>
	<div class="DesignSubMenuPanelAuth"> 
		<?php if ($_smarty_tpl->tpl_vars['user_email']->value){?>
			<table>
				<tr>
					<th><?php echo @SITE_USER_PANEL;?>
</th>
					<td>&nbsp;&nbsp;</td>
					<td><?php echo $_smarty_tpl->tpl_vars['user_email']->value;?>
</td>
					<td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/topMenuLinksDelimiter.png" alt=""></td>
					<td><?php if ($_smarty_tpl->tpl_vars['menu']->value=='user.data'){?><?php echo @MENU_USER_DATA;?>
<?php }else{ ?><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.data");?>
"><?php echo @MENU_USER_DATA;?>
</a><?php }?></td>
					<td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/topMenuLinksDelimiter.png" alt=""></td>
				<?php if ($_smarty_tpl->tpl_vars['user_type']->value=='employer'||$_smarty_tpl->tpl_vars['user_type']->value=='company'||$_smarty_tpl->tpl_vars['user_type']->value=='agent'){?>
					<td><?php if ($_smarty_tpl->tpl_vars['menu']->value=='user.announces'&&$_smarty_tpl->tpl_vars['action']->value=='vacancy'){?><?php echo @MENU_MY_VACANCYS;?>
<?php }else{ ?><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.announces&amp;action=vacancy&amp;token=active");?>
"><?php echo @MENU_MY_VACANCYS;?>
</a><?php }?></td>
					<td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/topMenuLinksDelimiter.png" alt=""></td>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['user_type']->value=='competitor'||$_smarty_tpl->tpl_vars['user_type']->value=='agent'){?>
					<td><?php if ($_smarty_tpl->tpl_vars['menu']->value=='user.announces'&&$_smarty_tpl->tpl_vars['action']->value=='resume'){?><?php echo @MENU_MY_RESUMES;?>
<?php }else{ ?><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.announces&amp;action=resume&amp;token=active");?>
"><?php echo @MENU_MY_RESUMES;?>
</a><?php }?></td>
					<td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/topMenuLinksDelimiter.png" alt=""></td>
				<?php }?>
					<td><?php if ($_smarty_tpl->tpl_vars['menu']->value=='subscription'){?><?php echo @MENU_SUBSCRIPTION;?>
<?php }else{ ?><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=subscription");?>
"><?php echo @MENU_SUBSCRIPTION;?>
</a><?php }?></td>
					<td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/topMenuLinksDelimiter.png" alt=""></td>
				<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['add_news']){?>
					<td><?php if ($_smarty_tpl->tpl_vars['menu']->value=='user.news'){?><?php echo @MENU_MY_NEWS;?>
<?php }else{ ?><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.news&amp;action=active");?>
"><?php echo @MENU_MY_NEWS;?>
</a><?php }?></td>
					<td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/topMenuLinksDelimiter.png" alt=""></td>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['codex']->value['rights']['add_articles']){?>
					<td><?php if ($_smarty_tpl->tpl_vars['menu']->value=='user.articles'){?><?php echo @MENU_MY_ARTICLES;?>
<?php }else{ ?><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=user.articles&amp;action=active");?>
"><?php echo @MENU_MY_ARTICLES;?>
</a><?php }?></td>
					<td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/topMenuLinksDelimiter.png" alt=""></td>
				<?php }?>
					<td><?php if ($_smarty_tpl->tpl_vars['menu']->value=='change.password'){?><?php echo @MENU_CHANGE_PASSWORD;?>
<?php }else{ ?><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=change.password");?>
"><?php echo @MENU_CHANGE_PASSWORD;?>
</a><?php }?></td>
					<td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/topMenuLinksDelimiter.png" alt=""></td>
					<td><a href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=logout");?>
"><?php echo @MENU_LOGOUT;?>
</a></td>
				</tr>
			</table>
		<?php }else{ ?>
			<form action="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=authorize");?>
" method="post" enctype="multipart/form-data">
				<table>
					<tr>
						<?php if ($_smarty_tpl->tpl_vars['menu']->value!='authorize'){?>
						<th><?php echo @MENU_AUTHORIZE;?>
</th>
						<td>&nbsp;&nbsp;</td>
						<td><input class="text" type="text" name="email" size="20" value="<?php echo @FORM_EMAIL;?>
"></td>
						<td><input class="text" type="password" name="password" size="20" value="<?php echo @FORM_PASSWORD;?>
"></td>
						<td><input type="checkbox" name="remember"></td>
						<td><?php echo @FORM_REMEMBER;?>
</td>
						<td>
							<div class="submitButtonDark">
								<input type="submit" class="shadow01red" value="<?php echo @FORM_BUTTON_LOGIN;?>
">
							</div>
						</td>
						<td>&nbsp;&nbsp;</td>
						<?php }?>
						<td><?php if ($_smarty_tpl->tpl_vars['menu']->value=='register'){?><?php echo @MENU_REGISTER;?>
<?php }else{ ?><a class="ddlink" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=register");?>
"><?php echo @MENU_REGISTER;?>
</a><?php }?></td>
						<td><img src="<?php echo @CONF_SCRIPT_URL;?>
<?php echo @TEMPLATE_PATH;?>
images/design/topMenuLinksDelimiter.png" alt=""></td>
						<td><?php if ($_smarty_tpl->tpl_vars['menu']->value=='new.pass'){?><?php echo @MENU_FORGOT_PASSWORD;?>
<?php }else{ ?><a class="ddlink" href="<?php echo $_smarty_tpl->tpl_vars['chpu']->value->createChpuUrl((@CONF_SCRIPT_URL)."index.php?ut=".($_smarty_tpl->tpl_vars['user_type']->value)."&amp;do=new.pass");?>
"><?php echo @MENU_FORGOT_PASSWORD;?>
</a><?php }?></td>
					</tr>
				</table>
			</form>

			<script type="text/javascript">
			<!--
				$(function() {
					$('input[name="email"]').focus( function() {
						if ($(this).val() == '<?php echo @FORM_EMAIL;?>
') {
							$('input[name="email"]').val('');
							$('input[name="password"]').val('');
						}
					});

					$('input[name="email"]').blur( function() {
						if (!$(this).val()) {
							$('input[name="email"]').val('<?php echo @FORM_EMAIL;?>
');
							$('input[name="password"]').val('<?php echo @FORM_PASSWORD;?>
');
						}
					});
				});
			-->
			</script>
		<?php }?>
	</div>
<?php }?>
<?php }} ?>