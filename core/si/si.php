<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Настройки капчи
********************************************************/
/**
 * @package
 * @todo
 */

include_once 'securimage.php';

$securimage = new securimage();

// Change some settings

$securimage -> image_width = 80;
$securimage -> image_height = 40;
$securimage -> perturbation = 0.0; // 1.0 = high distortion, higher numbers = more distortion
//$securimage -> image_bg_color = new Securimage_Color("#FFFFFF");//new Securimage_Color(rand(0, 128), rand(0, 128), rand(0, 128));
$securimage -> text_color = new Securimage_Color(rand(0, 64), rand(0, 128), rand(0, 128));//new Securimage_Color("#FF0000");
//$securimage -> text_transparency_percentage = 65; // 100 = completely transparent
$securimage -> num_lines = 0;
//$securimage -> image_type = SI_IMAGE_PNG;
$securimage -> code_length = 5;
$securimage -> charset = '2345689';//'2345689ABCDEFYZ';//'ABCDEFGHKLMNPRSTUVWYZabcdefghklmnprstuvwyz23456789';
$securimage -> expiry_time = 3600; 
//$securimage -> use_wordlist = true;
$securimage -> ttf_file = '../fonts/arial.ttf';
//$securimage -> text_angle_minimum = 10;
//$securimage -> text_angle_maximum = 2;
//$securimage -> use_multi_text = true;
//$securimage -> multi_text_color = array(new Securimage_Color(rand(0, 128), rand(0, 128), rand(0, 128)));//new Securimage_Color("#0099CC");
//$securimage->background_directory = './backgrounds';


$securimage -> show('backgrounds/bg3.jpg'); // alternate use:  $securimage->show('/path/to/background_image.jpg');


 