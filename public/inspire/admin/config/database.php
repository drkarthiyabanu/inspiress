<?php

// include_once 'functions.php';
// include_once 'phpqrcode/qrlib.php';
// include_once '../logging/index.php';
## DB Connection ##

function connect()
{
    $host = "localhost";
	$username = 'admin_edinz';
	$password = 'Ke2FES@e4evxIUT';
	
    //$username = "root";
    //$password = "";
    $db_name = "admin_edinz";
    try {
        $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
        // info("database", "Connection Success");
    } catch (PDOException $exception) {
        error("database", "Connection Failed");
        echo "Connection error: " . $exception->getMessage();
    }
    return $conn;
}

function json($data, $message, $statusCode, $status)
{
    $response = array();
    $response['status'] = $status;
    $response['statusCode'] = $statusCode;
    $response['message'] = $message;
    $response['result'] = $data;
    if (isset($data)) {
        return json_encode($response);
    } else {
        $response['result'] = (object) [];
        return json_encode($response);
    }
}
function response($data, $code)
{
    header("HTTP/1.1 " . $code . " " . getStatusMessage($code));
    header("Content-Type:application/json");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $code = ($code) ? $code : "200";
    echo $data;
    exit;
}

function getStatusMessage($code)
{
    $status = array(100 => 'Continue', 101 => 'Switching Protocols', 200 => 'OK', 201 => 'Created', 202 => 'Accepted', 203 => 'Non-Authoritative Information', 204 => 'No Content', 205 => 'Reset Content', 206 => 'Partial Content',
        300 => 'Multiple Choices', 301 => 'Moved Permanently', 302 => 'Found', 303 => 'See Other', 304 => 'Not Modified', 305 => 'Use Proxy', 306 => '(Unused)', 307 => 'Temporary Redirect', 400 => 'Bad Request', 401 => 'Unauthorized',
        402 => 'Payment Required', 403 => 'Forbidden', 404 => 'Not Found', 405 => 'Method Not Allowed', 406 => 'Not Acceptable', 407 => 'Proxy Authentication Required', 408 => 'Request Timeout', 409 => 'Conflict', 410 => 'Gone',
        411 => 'Length Required', 412 => 'Precondition Failed', 413 => 'Request Entity Too Large', 414 => 'Request-URI Too Long', 415 => 'Unsupported Media Type', 416 => 'Requested Range Not Satisfiable', 417 => 'Expectation Failed', 500 => 'Internal Server Error',
        501 => 'Not Implemented', 502 => 'Bad Gateway', 503 => 'Service Unavailable', 504 => 'Gateway Timeout', 505 => 'HTTP Version Not Supported');
    return ($status[$code]) ? $status[$code] : $status["500"];
}


## Site Link ##
function getSiteLink()
{
    $siteLink = "https://edinztech.com/inspire/";
    return $siteLink;
}


## GUID Generator ##
function guid()
{
    if (function_exists('com_create_guid') === true) {
        return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}