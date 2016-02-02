<?php

include "../../_app/Config.inc.php";
$Read = new Controle('app_estados');
$Read->findAll();

echo json_encode($Read->getResult());
