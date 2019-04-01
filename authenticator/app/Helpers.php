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
