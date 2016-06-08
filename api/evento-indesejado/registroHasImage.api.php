<?php

include_once '../../_app/Config.inc.php';
$Read = new NcRegImage();

$Read->Execute()->findAll();
echo json_encode($Read->Execute()->getResult());