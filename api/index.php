<?php

session_start();
include_once '../_app/Config.inc.php';

$request = json_decode(file_get_contents("php://input"));
$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$Link = new Link();

require(__DIR__ . '/' . $Link->getAPI());