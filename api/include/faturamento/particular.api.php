<?php

$Read = new SftParticular();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setPart_id($id);
            $Read->Execute()->find();
            Check::JsonReturn($Read->Execute()->getResult(), 'Os não encontrada!', '404');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma OS cadastrada!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request->part_id)):
            //update
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'part_id');
            echo json_encode($request);
        else:
            //salvar
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            if ($insert):
                $request->part_id = (int) $Read->Execute()->MaxFild('part_id');
            endif;
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setPart_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}