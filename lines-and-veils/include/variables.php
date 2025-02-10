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


$server_name = $_SERVER['SERVER_NAME'] ?? '';

$debug = false;
if( $server_name === 'local.maxhaessle.in' || $server_name === 'preview.npi.re' ) {
	$debug = true;
}

if( $debug ) $version .= '.'.time(); // cache buster for dev
