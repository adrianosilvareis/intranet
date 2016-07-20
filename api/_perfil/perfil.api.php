<?php

include "../../_app/Config.inc.php";
$Read = new Controle('ws_perfil');
$Read->findAll();

echo json_encode($Read->getResult());
