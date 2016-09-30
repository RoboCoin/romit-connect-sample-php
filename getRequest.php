<?php

$config = parse_ini_file('../config.ini');

function getRequest($url, $token) {

    global $config;

    $ch = curl_init($config['api_base'] . $url);

    $headers = array(
        'Content-type: application/json',
        'Authorization: Bearer ' . $token
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $jsonResponse = json_decode($response, true);

    if (!$jsonResponse['success']) {
        throw new Exception('Exception: ' . $jsonResponse['error']['message']);
    }

    return $jsonResponse['response'];
}