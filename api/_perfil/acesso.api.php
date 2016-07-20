<?php

include "../../_app/Config.inc.php";
$Read = new Controle('ws_acesso');
$Read->findAll();

echo json_encode($Read->getResult());
