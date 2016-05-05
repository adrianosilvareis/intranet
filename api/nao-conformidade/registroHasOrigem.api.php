<?php

include_once '../../_app/Config.inc.php';
$Read = new RegistroHasOrigem();

$request = json_decode(file_get_contents("php://input"));

$Read->Execute()->findAll();
echo json_encode($Read->Execute()->getResult());
