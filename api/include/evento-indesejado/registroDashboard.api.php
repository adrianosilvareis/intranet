<?php

$Read = new NcRegistro();

switch ($method) {
    case "GET":
        //retorna todos os itens
        $SQL = "SELECT 
            r.reg_id, r.reg_impacto_paciente, r.reg_finalizado, r.reg_date_cadastro, 
            ur.user_nickname as 'recebido_nickname', ur.user_name as 'recebido_name', ur.user_lastname as 'recebido_lastname',
            uc.user_nickname as 'cadastro_nickname', uc.user_name as 'cadastro_name', uc.user_lastname as 'cadastro_lastname',
            a.area_title
            FROM nc_registro r 
            JOIN ws_users ur ON(ur.user_id = r.user_recebimento)
            JOIN ws_users uc ON(uc.user_id = r.user_cadastro)
            JOIN ws_area_trabalho a ON(a.area_id = r.area_recebimento)";

        $Read->Execute()->FullRead($SQL);
        Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma origem cadastrado!', '204');

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