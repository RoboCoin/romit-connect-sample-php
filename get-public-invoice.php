<?php

require_once './getRequest.php';
require_once './getClientToken.php';
require_once './sendJson.php';

sendJson(getRequest('/invoice/' . $_GET['invoiceId'], getClientToken()));