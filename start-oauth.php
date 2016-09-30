<?php

require_once './postRequest.php';
require_once './getClientToken.php';

$config = parse_ini_file('../config.ini');

$clientToken = getClientToken();

session_start();

// start the oauth flow
$requestBody = array(
    'client_id' => $config['client_id'],
    'response_type' => 'code',
    'redirect_uri' => $config['redirect_uri'],
    'scope' => ['DEFAULT', 'USER_READ'],
    'state' => session_id(),
    'phone' => $_POST['phone'],
    'email' => $_POST['email'],
    'first' => $_POST['first-name'],
    'last' => $_POST['last-name'],
    'currency' => 'USD',
    'refresh' => true,
    'call' => false
);
postRequest('/oauth', $requestBody, $clientToken);
