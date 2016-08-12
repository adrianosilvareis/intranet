<?php

$Read = new SftGlosaGuia();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setGlosa_id($id);
            $Read->Execute()->find();
            Check::JsonReturn($Read->Execute()->getResult(), 'Glosa de Guia não encontrada!', '404');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma Glosa cadastrada!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request->glosa_id)):
            //update
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'glosa_id');
            echo json_encode($request);
        else:
            //salvar
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            if ($insert):
                $request->glosa_id = (int) $Read->Execute()->MaxFild("glosa_id");
            endif;
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setGlosa_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}
