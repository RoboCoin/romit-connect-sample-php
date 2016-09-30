<?php

require_once './getRequest.php';
require_once './sendJson.php';

session_start();

sendJson(getRequest('/user', $_SESSION['access_token']));
