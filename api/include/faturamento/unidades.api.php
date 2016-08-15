<?php

$Read = new ImpPostos();

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setPostos_id($id);
            $Read->Execute()->find();
            if ($Read->Execute()->getResult()) :
                echo json_encode($Read->Execute()->getResult());
            else :
                http_response_code(404);
            endif;
        elseif (!empty($query) && $query == 'ativos'):
            $Read->Execute()->Query("postos_ativo=1");
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma unidade cadastrada!', '204');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma unidade cadastrada!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request->postos_id)):
            //update
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'postos_id');
            echo json_encode($request);
        else:
            //salvar            
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            if ($insert):
                $request->postos_id = (int) $Read->Execute()->MaxFild("postos_id");
            endif;
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setPostos_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}
