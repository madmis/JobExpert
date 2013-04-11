{if $errors}{include file="errors.message.tpl"}{/if}

<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=feedback")}" method="post" enctype="multipart/form-data">
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
    		<tr>
            	<th colspan="2">{*$namePage[0].name*}&nbsp;</th>
            </tr>
            <tr>
            	<td colspan="2" class="last AlignLeft">
                	<div class="paddingText5">
                    	<strong>{$smarty.const.FORM_SUBJECT}&nbsp;<span class="text-red">*</span></strong><br>
                		<select name="subject">
                    	{foreach from=$subject item="subj"}
                    		<option value="{$subj}" {if $return_data.subject eq $subj}selected{/if}>{$subj}</option>
                    	{/foreach}
                		</select>
                        <br><br>
                        <strong>{$smarty.const.FORM_EMAIL}&nbsp;<span class="text-red">*</span></strong><br>
                        <input type="text" name="email" size="40" value="{$return_data.email}">
                        <br><br>
                  		<strong>{$smarty.const.FORM_MESSAGE}&nbsp;<span class="text-red">*</span></strong><br>
                		<textarea name="message" cols="60" rows="10">{$return_data.message}</textarea>

                      	{if $smarty.const.SECURE_CAPTCHA}   <br><br>
                      	<table>
                      		<tr>
                      			<td style="text-align: right;">{include file="securimage.tpl"}</td>
                      			<td style="text-align: left;"><input type="text" name="keystring"></td>
                      		</tr>
                      	</table><br>
                    	{/if}

                        <div class="submitButtonLight">
                        	<input type="submit" class="shadow01red" name="send" value="{$smarty.const.FORM_BUTTON_SEND}">
                    	</div>

                    </div>
                </td>
            </tr>
    	</table>
    </div>
</form>