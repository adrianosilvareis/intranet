<?php

$WsAcesso = new WsAcesso();


$WsAcesso->setAcesso_id(1);
$WsAcesso->setAcesso_status(1);

$WsAcesso->Execute()->update(null, "acesso_id");
var_dump($WsAcesso);
