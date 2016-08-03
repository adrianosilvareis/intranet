<?php

$Read = new WsAreaTrabalho();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setArea_id($id);
            $Read->Execute()->find();
            Check::JsonReturn($Read->Execute()->getResult(), 'Área não encontrada!', '404');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma área cadastrado!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request->area_id)):
            //update
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'area_id');
            echo json_encode($request);
        else:
            //salvar
            $request->area_status = 1;
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            if ($insert):
                $request->area_id = (int) $Read->Execute()->MaxFild("area_id");
            endif;
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setArea_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}