<?php

require 'models/AdminGlosa.class.php';

$AdminGlosa = new AdminGlosa();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $AdminGlosa->Find($id);
        else:
            $AdminGlosa->FindAll();
        endif;
        break;
    case "POST":
        if (!empty($request) && is_array($request)):
            $AdminGlosa->ExeExport($request);
        elseif (!empty($request->glosa_id)):
            //update
            $AdminGlosa->ExeUpdate($id, $request);
        else:
            //salvar
            $AdminGlosa->ExeCreate($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $AdminGlosa->ExeDelete($id);
        break;

    default:
        break;
}
