<?php

require_once './postRequest.php';
require_once './getClientToken.php';

$response = json_decode(file_get_contents("php://input"), true);

$config = parse_ini_file('../config.ini');

$state = $response['response']['state'];
$code = $response['response']['code'];

$requestBody = array(
    'client_id' => $config['client_id'],
    'client_secret' => $config['client_secret'],
    'code' => $code,
    'grant_type' => 'authorization_code',
    'redirect_uri' => $config['redirect_uri']
);
$response = postRequest('/oauth/token', $requestBody, getClientToken());

// store this data somewhere better than a session
session_start();
session_id($state);
$_SESSION['access_token'] = $response['access_token'];
$_SESSION['access_token_expires'] = $response['access_token_expires'];
$_SESSION['refresh_token'] = $response['refresh_token'];
$_SESSION['refresh_token_expires'] = $response['refresh_token_expires'];
