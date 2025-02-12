<?php

if( ! defined('TTRPG-LV') ) exit;

$version = '0.2';


$group = $_REQUEST['group'] ?? false;


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
