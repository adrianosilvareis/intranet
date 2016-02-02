<?php

include "../../_app/Config.inc.php";
$Read = new Controle('app_cidades');
$Read->findAll();

echo json_encode($Read->getResult());
