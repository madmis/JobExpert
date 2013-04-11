<?php

(!defined('SDG')) ? die ('Triple protection!') : null;

define('HELP_USER', '<p>In the box you must specify the ID of the desired user.</p><p>ID must contain only digits.</p><p>The search is performed on the database and everything.</p>');

define('HELP_USER_PHONE', '<p>Enter your phone number.</p><p>This number will be automatically inserted in you add to your ad.</p><p>Specify the number so it was always clear who found your ad.</p><p style="color: red;">+44-20-7330-7500</p>');

define('HELP_USER_FIRST_NAME', '<p>Enter your name.</p><p>The name will be added automatically inserted in your ad.</p>');

define('HELP_USER_LAST_NAME', '<p>Enter your last name.</p><p>Surname will be automatically inserted in you add to your ad.</p>');

define('HELP_USER_ALIAS', '<p>Enter your Alias.</p><p>Alias - is in fact your name in the System.</p><p>When you add news or articles (if you have the appropriate rights),  the alias will be placed in the <b>Author</b> field. In all adds comments will display your alias.</p><p>Alias <strong>is unique</strong> and <strong>is a required</strong> field.</p>');

define('HELP_USER_GENDER', '<p>Specify your gender.</p><p>The field is not required,  but if you give the floor,  then when you add your ads sex will be determined automatically.</p>');

define('HELP_USER_BIRTHDAY', '<p>Enter your birth date.</p><p>The field is not required,  but if you specify the date,  then when you add your age ad will be automatically detected.</p>');

define('HELP_USER_COMPANY_NAME', '<p>Enter your company provided.</p>');

define('HELP_USER_COMPANY_DISCRIPTION', '<p>Enter a description of the company.</p><p>Also in the box you can enter any relevant information about the company.</p>');

define('HELP_USER_COMPANY_LOGO', '<p>In the field,  enter the path to the logo.</p><p>The logo should be an image format: GIF,  JPG or PNG.</p>');

define('HELP_USER_HIDE_ADDITIONAL_COMPANY_DATA', '<p>Enabling this setting allows you to hide the extra data (name and phone number) of the company.</p><p>In this case,  the job of these data will be available as before.</p>');

define('HELP_USER_PRE_IP', '<p><b>Previous IP</b> - IP-address that was carried out previous entry in the personal office.</p><p><b>Current IP</b> - Your current IP-address.</p>');

define('HELP_USER_NEWS_PUBLICATION', '<p> The fields specify the date and time of the publication of news. </ p> <p> If the publication date of the current date,  the news will be published in due time.</p><p><b>Attention!</b> state news defined settings,  which sets the administrator. If it is set included moderation of news,  the news will be published (including the date of publication) only after a pass moderation.</p>');

define('HELP_ANNOUNCE_INPUT_PHONE', 'In the field enter the phone number you can use the following characters: <b>"+" -</b> ", " <b>(",  ")</b> "and the numbers <b>0</b> to <b>9</b><br><br><b>For example:</b> +38 (067) 456-78-09.<br><br>In the note you can provide additional information with respect to this phone,  for example,  indicate that the phone number is a priority,  or that you can make calls only from 9:00 to 18:00.');

define('HELP_ANNOUNCE_TEXTAREA_COMPANY_DISCRIPTION', 'General information about what the company does. <br><br><b>For example:</b> Building of housing and administrative value; Software Development.');

define('HELP_ANNOUNCE_TEXTAREA_REQUIREMENTS', 'Use this field to specify additional requirements or suggestions to the applicant.<br><br><b>For example: </b> successful experience in active sales,  car ownership,  responsibility,  initiative,  interpersonal skills.');

define('HELP_ANNOUNCE_TEXTAREA_DUTESWORK', '<b>Highlight the key functions and responsibilities of the vacant post</b><br><br>Describe them briefly and clearly by writing each separately.');

define('HELP_ANNOUNCE_TEXTAREA_CONDITIONS', '<b>In this field,  specify the conditions.</b><br><br><b>Such as:</b><br> - Information about the company;<br> - The location of work;<br> - Salaries,  bonuses,  benefits;<br> - Existence and content of social package,  etc.');

define('HELP_ANNOUNCE_TEXTAREA_EXT_INFO', 'Use this field to enter additional information about the posted vacancy.<br><br>Information you consider important and which would also draw the attention of the applicant.');

define('HELP_ANNOUNCE_RADIOBOX_USER_TYPE', 'This field must specify the type of job posters.<br><br><b>"Direct employer"</b> - if you are looking for staff directly for their company.<br><br><b>"Employment agency"</b> - if you provide recruiting services on behalf of the Companies to Work For.');

define('HELP_ANNOUNCE_RADIOBOX_VISIBILITY', '<b>Seen everything.</b> By choosing this option,  you tell that you want to <b>all</b> (whether registered or not registered on this site,  users) have been able to find and view your resume.<br><br><b>Seen everything (less contact).</b> If you want to look for work,  but do not want to disclose their contacts (e-mail,  name,  address,  phone number),  select this option . As a result,  when viewed by users (both registered and not registered on the site) Your resume Your contact details will be hidden.</b><br><br><b>Seen members.</b> By choosing this option,  you tell that you want only registered on this site,  employers were able to find and view your resume. Since employers are usually looking for a summary and does not publish the vacancy,  we recommend you choose this option if you have special reasons not to do so.<br><br><b>Seen members (less contact).</b> This option is similar to Option <b>Seen everything (less contact).</b> with the only difference is that your resume (with hidden contact information) will be able to find and view only registered on this site employers.<br><br><b>Hidden to all.</b> If you choose this option,  a summary will be hidden,  and it will not be to find and view other users. At the same time,  if necessary,  you can send a resume by e-mail.<br><br> Status "Hidden to all" useful:<ul><li>instead of removing resume when you are not looking for work (unless your resume again required,  will not need to recreate it,  it will be possible only to change the status);</li><li>when looking for work only in active mode (by sending your resume to jobs they liked,  but do not want employers to find your own).</li></ul>');

define('HELP_ANNOUNCE_OPTION_LANGUAGE_DEGREE', '<b>Levels of knowledge of foreign languages:</b><br><br><b>Zero</b> - The language has never been studied. The use and understanding of just some words,  greetings,  expressions. Knowledge of grammar is not.<br><br><b>Elementary</b> - a limited vocabulary,  basic knowledge of grammar. Understand simple sentences,  explanations and instructions.<br><br><b>Below Average</b> - Knowledge of grammar pretty good,  but the vocabulary is limited. In familiar situations may support the conversation,  which is slowly and clearly.<br><br><b>Average</b> - Fluency in everyday topics,  but freedom of expression and limited vocabulary. Reading,  writing and listening at a good level.<br><br><b>Above Average</b> - A high level of grammar. Fluently read and speak,  allowing for minor errors in the speech. Freely participate in conversations on familiar topics,  can lead a debate and argue their point of view.<br><br><b>Advanced</b> - Advanced vocabulary and high level of grammar. Effective oral and written language,  however,  there may be errors in complex sentences and lack of idiomatic turns. Easy to read any text.<br><br><b>Expert</b> - A rich vocabulary. Expert level knowledge of grammar,  oral and written speech,  freedom to construct complex sentences turnovers. Language skills to perfection on the level of expert.');

define('HELP_VACANCY_INPUT_TITLE', 'As a rule,  a job title - this is the first that will see the competitor.<br><br>So try this title to indicate the most accurate information that describes the vacant position.<br><br><b>For example:</b> Technical Director,  Sales Manager,  C++ Developer');

define('HELP_RESUME_INPUT_TITLE', 'Typically,  the header summary - this is the first thing the employer sees.<br><br>So try this title to indicate the most valuable information that describes your knowledge and activities.<br><br><b>For example:</b> An experienced programmer PHP,  Sales of household goods,  the Registrar of English proficiency.');

define('HELP_VACANCY_CHECKBOX_PUBLIC_EMAIL', '<b>Attention!</b> In order to protect the email addresses of our users from spam,  the site by default,  all Email listed in the questionnaire by adding ads to be hidden.<br><br>Send a message to a hidden address,  you can using the form on our website by clicking on "Send" on page detailed view ads.<br><br>If you have a public Email-address and what he would want to appear when viewing messages,  select the option: "Show Email-address in the ad"');

define('HELP_RESUME_CHECKBOX_PUBLIC_EMAIL', '<b>Attention!</b> In order to protect the email addresses of our users from spam,  the site by default,  all Email listed in the questionnaire by adding ads to be hidden.<br><br>Send a message to a hidden address,  you can using the form on our website by clicking on "Send" on page detailed view ads.<br><br>If you have a public Email-address and what he would want to appear when viewing messages,  select the option: "Show Email-address in the ad"');

define('HELP_RESUME_INPUT_EXPIRE_PERIOD', 'In these fields,  you must specify the period in which you worked at this place<br><br>It is necessary to specify the month and year started.<br><br>Leave the end date blank if you continue to work there.');

define('HELP_RESUME_TEXTAREA_ABOUTINFO', 'Use this field to add a summary of information that are considered important and which would also draw the attention of the employer.<br><br><b>For example:</b> hobbies,  personal qualities,  life principles,  achievements.');

define('HELP_SUBSCRIPTION_SEND_TEST_MAIL', '<p>If you want to get a test message with ads for the last N-hours,  set this switch.</p><p>This setting only works for free subscriptions.</p>');

define('HELP_SUBSCRIPTION_FPA', 'F (free) - free; P (payment) - Paid; A (announce) - added to the ad.');

define('HELP_ARTICLES_PUBLICATION_DATE', '<p>If the publication date of the current date,  the News/Article will be published in due time. Until that time,  News/Article appears in the public section.</p><p>When setting the date of publication,  keep in mind that the News/Article may be sent for moderation (this defines the resource manager). In this case,  the News/Article appears in the public section only after it will be moderated (regardless of the date of publication)</p>');
