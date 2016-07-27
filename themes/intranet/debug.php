<?php

$WsAcesso = new WsAcesso();


$WsAcesso->setAcesso_id(1);
$WsAcesso->setAcesso_status(false);

var_dump($WsAcesso->Execute()->update(null, 'acesso_id'));
