<?php

define( 'LINESANDVEILS', 'post' );

include_once('include/helper.php');
include_once('include/config.php');
include_once('include/variables.php');
include_once('include/language.php');


if( ! $group ) {
	url_redirect();
}

$redirect = 'index.php?group='.$group;


$data = [];

foreach( $_POST as $key => $value ) {

	if( ! str_starts_with($key, 'topic_') ) continue;

	if( ! in_array($value, ['okay','veil','line', 'not-my-char']) ) continue;

	$key = str_replace('topic_','',$key);

	$name = $_POST[$key];

	$original_value = $topics[$name] ?? false;
	if( $original_value === 'veil' && ( $value === 'okay' || $value === 'not-my-char' ) ) {
		$value = 'veil';
	} elseif( $original_value === 'not-my-char' && $value === 'okay' ) {
		$value = 'veil';
	} elseif( $original_value === 'line' && $value !== 'line' ) {
		$value = 'line';
	}

	$data[$name] = $value;
}


if( ! count($data) ) {
	url_redirect($redirect.'&error=nodata');
}


if( ! file_put_contents("data/".$group.".json", json_encode($data)) ) {
	url_redirect($redirect.'&error=save');
}

url_redirect($redirect.'&success');

exit;
