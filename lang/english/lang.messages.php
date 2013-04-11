<?php

(!defined('SDG')) ? die ('Triple protection!') : null;

define('MESSAGE_REDIRECT_URL_AUTOREDIRECT_AFTER', 'Automatic redirect after');

define('MESSAGE_REDIRECT_URL_NOTRESPONSIBLE', 'Administration is not responsible for the content of external websites');

define('MESSAGE_REDIRECT_URL_RECOMMENDATIONS', 'We strongly recommend that you do not indicate any personal information to third-party sites (E-Mail, password, etc.)');

define('MESSAGE_REDIRECT_URL_LEAVE', 'You are leaving the site on the external link provided by one of the member');

define('MESSAGE_CLICK_NOWAIT', 'Click here if you do not want to wait');

define('MESSAGE_WARNING_NOT_SELECT_RECORDS', 'Do not choose which records to change!');

define('MESSAGE_DELETE_RECORD', 'Are you sure you want to delete the entry?');

define('MESSAGE_DELETE_RECORDS', 'Are you sure you want to delete the selected records?');

define('MESSAGE_DELETE_FILE', 'Are you sure you want to delete the file?');

define('MESSAGE_WARNING_UNKNOWN_ACTION', 'Caused by an unknown force!');

define('MESSAGE_WARNING_PAYMENT_NO_MORE_THAN_ONE_RECORD', 'For payment you must select no more than one record!');

define('MESSAGE_NEED_AUTHORIZE', 'Attention! Authorization is required.');

define('MESSAGE_CHANGE_SAVED', 'Changes saved!');

define('MESSAGE_NEWS_ADDED', 'The news was successfully added!');

define('MESSAGE_SUBSCRIPTION_ADDED', 'Subscribe successfully added!');

define('MESSAGE_TEST_SUBSCRIPTION_WAS_SEND', 'A test mailing was completed successfully. Check your mailbox.');

define('MESSAGE_CHANGE_SAVED_REDIRECT', 'Click here if your browser does not automatically redirect you.');

define('MESSAGE_WAS_SEND', 'Your message has been sent. Expect an answer.');

define('MESSAGE_USER_REGISTERED', 'You are already registered!');

define('MESSAGE_ACTIVATE_REG_USER', '<p align="center"><b>Registration completed successfully.</b></p><p>you entered on the email-address the message was sent,   which indicates a link to activate your account and activation code,   which you can enter into the field below.</p><p><b>Please NOTE</b>,   you can not use the registration data until such time as there is no complete the activation procedure. On expiry of <b>'. CONF_USER_ACTIVATE_DELETE. '</b> hours,   if your account is activated,   information about it will be removed from the system. Re-register with the same Email-address as it will be possible only after <b>'. CONF_USER_ACTIVATE_DELETE. '</b> hours.</p><p> If you have any difficulties registering,   please contact us through our feedback form.</p>');

define('MESSAGE_REGISTER_SUCCESS', 'Congratulations! The account is registered successfully.');

define('MESSAGE_REGISTER_SUCCESS_DO_PAYMENT', 'Registration of this type of account you paid!');

define('MESSAGE_REGISTER_SUCCESS_DO_PAYMENT_TEXT', 'To complete the registration process is necessary to pay for the use of your account. Now you will be redirected to the choice of payment system. After payment of this amount,   your account will be activated.');

define('MESSAGE_REGISTER_SUCCESS_ACTIVATE_USER', 'On specified when registering your Email-address the message was sent,   which indicates a link to activate your account and activation code.');

define('MESSAGE_REGISTER_SUCCESS_TEXT', 'You can now log into your account using the specified during registration: Login (Email) and Password.');

define('MESSAGE_NEW_PASS_CONFIRM', 'To your specified Email-address send a message to confirm the password change!');

define('MESSAGE_NEW_PASS_SUCCESS', 'To your specified Email-address sent a new password. <br> After logging in to the office user must change your password.');

define('MESSAGE_SELECT_TYPE', '<p align="center"><b>Before you start using the services of a site,   you should select the account type.</b></p><p align="center"> On the selected account type will depend on the set of available actions.</p><p align="center" style="color: red;"> <b>Please note:</b> After you select,   the type of account can not be changed. Change the account type can only <b>administrator.</b></p>');

define('MESSAGE_NOT_RIGHTS', '<p align="center"><b>You are not authorized to perform this action.</b></p><p align="center"> For rights contact your administrator.</p>');

define('MESSAGE_PASSWORD_HAS_BEEEN_CHANGED', 'Password successfully changed!');

define('MESSAGE_ACCOUNT_MODERATE', 'Account for moderation!');

define('MESSAGE_ACCOUNT_MODERATE_TEXT', 'At the moment your account is in moderation.<br>Once your account is verified,   we will notify you by Email,   specified during registration.');

define('MESSAGE_NOT_FOUND_RECORDS', 'Unfortunately,   your search did not match! Please refine your search.');

define('MESSAGE_PYMENT_WAS_SUCCESS', 'The payment was successful!');

define('MESSAGE_PYMENT_SUCCESSFULLY_ADDED', 'Payment has been successfully added. Watch out,   you will be contacted by an administrator.');

define('MESSAGE_PYMENT_WAS_SUCCESS_REGISTER', 'Your account has been activated successfully.');

define('MESSAGE_SUBSCRIPTION_ADD_PAYMENT', 'Adding this subscription is a paid service!');

define('MESSAGE_SUBSCRIPTION_ADD_PAYMENT_TEXT', '<p>To complete the process of adding a subscription,   you must pay the fee. Now you will be redirected to the choice of payment system. After payment of this amount subscribed will be activated.</p><p>If you do not want or can not pay now,   try to pay later. Any unpaid subscriptions are stored in the relevant section of your personal account.</p>');

define('MESSAGE_SUBSCRIPTION_WAS_SUCCESS_PAYMENT', 'Subscribe successfully activated!');

define('MESSAGE_ALIAS_FREE', 'Alias free!');

define('MESSAGE_MODERATE_ARTICLE', 'News/Articles sent to the moderation!');

define('MESSAGE_MODERATE_ARTICLE_TEXT', 'News/Articles sent to the moderation! <br> As soon as the News/Articles will be checked by the administrator,   we will notify you by Email,   specified during registration.');

define('MESSAGE_COMMENTS_COMPLAINT', 'Are you sure you want to send a complaint to comment');

define('MESSAGE_COMMENTS_DELETE', 'Are you sure you want to delete this comment?');

define('MESSAGE_COMMENTS_REGISTER', 'Comments can be added only for members');

define('MESSAGE_COMMENTS_COMPLAINT_SEND', 'Complaint sent! In the near future,  your complaint will be reviewed and processed.');

define('MESSAGE_COMMENTS_COMPLAINT_NOT_SEND', 'Unable to send a complaint!');

define('MESSAGE_COMMENTS_NOT_DELETE', 'Unable to remove a comment!');
