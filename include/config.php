<?php

if( ! defined('LINESANDVEILS') ) exit;


$options_default = [
	'language' => 'en',
];


if( file_exists('custom/config.php') ) {
	$options = include( 'custom/config.php' );
	$options = array_merge( $options_default, $options );
}
