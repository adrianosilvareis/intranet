<?php

$Read = new WsAcesso();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setAcesso_id($id);
            $Read->Execute()->find();
            Check::JsonReturn($Read->Execute()->getResult(), 'Acesso não encontrado!', '404');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhum acesso cadastrado!', '204');
        endif;
        break;
    case "POST":
        if ($request->acesso_id):
            //update
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'acesso_id');
            echo json_encode($request);
        else:
            //salvar
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setAcesso_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}