<?php

if( ! defined('LINESANDVEILS') ) exit;

$version = '0.3';


$lang = $options['language'] ?? 'en';

$group = $_REQUEST['group'] ?? false;


// automatically create data folder, if it is missing
if( ! is_dir('data') ) {
	$oldumask = umask(0); // we need this for permissions of mkdir to be set correctly
	if( mkdir( 'data/', 0775, false ) === false ) {
		echo '<p><strong>Error: could not create <em>data/</em> subfolder.</strong> Please make sure that the folder is writeable.</p>';
		exit;
	}
	umask($oldumask); // we need this after changing permissions with mkdir
}


$topics = [];

if( $group ) {
	$group = sanitize_title($group);


	if( file_exists('data/'.$group.'.json') ) {
		$data = file_get_contents('data/'.$group.'.json');

		if( $data ) {
			$topics = json_decode(trim($data), true) ?? [];
		}

	}

}


$debug = false;
if( isset($_SERVER['LOCAL_DEV']) ) {
	$debug = true;
}

if( $debug ) $version .= '.'.time(); // cache buster for dev
