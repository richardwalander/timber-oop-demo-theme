<?php
require 'vendor/autoload.php';

use TimberTheme\Theme;

/* 	only call init on base theme if it is active 
	i.e. should not be called if parent theme, then
	only child theme init should be called */
	
if(get_template_directory() === get_stylesheet_directory()) {
	$theme = Theme::getInstance();
	$theme->init();
}