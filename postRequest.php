<?php

$config = parse_ini_file('../config.ini');

function postRequest($url, $params = null, $token = null) {

    global $config;

    $ch = curl_init($config['api_base'] . $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if ($params) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    }

    $headers = array('Content-type: application/json');

    if ($token) {
        array_push($headers, 'Authorization: Bearer ' . $token);
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);

    $jsonResponse = json_decode($response, true);

    if (!array_key_exists('success', $jsonResponse) || !$jsonResponse['success']) {
        if (array_key_exists('error', $jsonResponse) && array_key_exists('message', $jsonResponse['error'])) {
            throw new Exception($jsonResponse['error']['message']);
        } else {
            throw new Exception('Unknown exception');
        }
    }

    return $jsonResponse['response'];
}
