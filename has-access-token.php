<?php

require_once './postRequest.php';

$config = parse_ini_file('../config.ini');

session_start();

if (array_key_exists('access_token', $_SESSION) && array_key_exists('access_token_expires', $_SESSION)) {

    $accessTokenExpiration = strtotime($_SESSION['access_token_expires']);
    if ($accessTokenExpiration > time()) {

        echo "1";

    } elseif (array_key_exists('refresh_token', $_SESSION) && array_key_exists('refresh_token_expires', $_SESSION)) {

        $refreshTokenExpires = strtotime($_SESSION['refresh_token_expires']);
        if ($refreshTokenExpires > time()) {

            $requestParams = array(
                'client_id' => $config['client_id'],
                'client_secret' => $config['client_secret'],
                'refresh_token' => $_SESSION['refresh_token'],
                'grant_type' => 'refresh_token'
            );
            $response = postRequest('/oauth/token');

            $_SESSION['access_token'] = $response['access_token'];
            $_SESSION['access_token_expires'] = $response['access_token_expires'];
            $_SESSION['refresh_token'] = $response['refresh_token'];
            $_SESSION['refresh_token_expires'] = $response['refresh_token_expires'];

            echo "1";

        } else {

            echo "0";
        }

    } else {

        echo "0";
    }

} else {

    echo "0";

}