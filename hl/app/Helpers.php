<?php

function apiReturn ($data = [], $message = 'Message', $status = 'status', $errors = []) {

	$return = [
		'data' => $data,
		'message' => $message,
		'status' => $status,
		'errors' => $errors,
	];

	return response()->json($return);
}

// Date to Carbon
function carbon ($date) {
	return \Carbon\Carbon::createFromTimeStamp(strtotime($date));
}

// Generate token, 32 by default
function generateToken ($length = 32) {
	$x = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
	return substr(str_shuffle(str_repeat($x, ceil($length / strlen($x)))), 1, $length);
}

function zencrypt ($string) {
	$salt = 'zolvere6969';
	$pepper = 696923;
	return base64_encode($salt.$pepper.$string);
}

function zdecrypt ($string) {
	$salt = 'zolvere6969';
	$pepper = 696923;

	if (!base64_decode($string, true)) return json_encode(['status' => 'failed', 'message' => 'EMAIL_DECODING_FAILED!']);

	$decoded_string = base64_decode($string);
	$string = str_replace($salt, '', $decoded_string);
	$string = str_replace($pepper, '', $string);
	return $string;
}


?>
