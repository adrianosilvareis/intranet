<?php

$Read = new WsUsers();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setUser_id($id);
            $Read->Execute()->find();
            if ($Read->Execute()->getResult()) :
                echo json_encode($Read->Execute()->getResult());
            else :
                http_response_code(404);
            endif;
        elseif (!empty($query) && $query == 'ativos'):
            $Read->Execute()->Query("user_status=1");
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma meta cadastrada!', '204');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma meta cadastrada!', '204');
        endif;

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