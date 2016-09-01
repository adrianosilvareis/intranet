<?php

require 'models/AdminInco.class.php';

$AdminInco = new AdminInco();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $AdminInco->Find($id);
        else:
            $AdminInco->FindAll();
        endif;
        break;
    case "POST":
        if (!empty($request) && is_array($request)):
            $AdminInco->ExeExport($request);
        elseif (!empty($request->inco_id)):
            //update
            $AdminInco->ExeUpdate($id, $request);
        else:
            //salvar
            $AdminInco->ExeCreate($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $AdminInco->ExeDelete($id);
        break;
    default:
        break;
}
