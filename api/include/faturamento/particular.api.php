<?php

require 'models/AdminPart.class.php';

$AdminPart = new AdminPart();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $AdminPart->Find($id);
        else:
            $AdminPart->FindAll();
        endif;
        break;
    case "POST":
        if (!empty($request) && is_array($request)):
            $AdminPart->ExeExport($request);
        elseif (!empty($request->part_id)):
            //update
            $AdminPart->ExeUpdate($id, $request);
        else:
            //salvar
            $AdminPart->ExeCreate($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $AdminPart->ExeDelete($id);
        break;

    default:
        break;
}