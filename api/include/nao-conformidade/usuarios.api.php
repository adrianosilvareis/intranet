<?php

$Read = new WsUsers();

switch ($method) {
    case "GET":
        //retorna todos os itens
        $Read->Execute()->findAll();
        Check::JsonReturn($Read->Execute()->getResult(), 'Nenhum usuario cadastrado!', '204');

        break;
    case "POST":
        //update não implementado
        echo json_encode($request);
        break;
    case "DELETE":
        //deleta não implementado
        echo json_encode($delete);
        break;

    default:
        break;
}