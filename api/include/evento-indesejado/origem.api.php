<?php

$Read = new NcOrigem();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setOrigem_id($id);
            $Read->Execute()->find();
            Check::JsonReturn($Read->Execute()->getResult(), 'Origem não encontrada!', '404');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma origem cadastrado!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request->origem_id)):
            //update
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'origem_id');
            echo json_encode($request);
        else:
            //salvar
            $request->origem_status = 1;
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            if ($insert):
                $request->origem_id = (int) $Read->Execute()->MaxFild("origem_id");
            endif;
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setOrigem_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}
