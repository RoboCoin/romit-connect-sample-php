<?php

function sendJson($content) {
    header('Content-Type: application/json');
    echo json_encode($content);
}