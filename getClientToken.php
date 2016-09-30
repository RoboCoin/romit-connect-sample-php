<?php

require_once './postRequest.php';

$config = parse_ini_file('../config.ini');

function getClientToken() {

    global $config;

    // get a client access token
    $requestBody = array(
        'client_id' => $config['client_id'],
        'client_secret' => $config['client_secret'],
        'grant_type' => 'client_credentials'
    );
    $response = postRequest('/oauth/token', $requestBody);
    return $response['access_token'];
}