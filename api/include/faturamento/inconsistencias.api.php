<?php

$Read = new SftInconsistenciaGuia();

function setDados($request, $userlogin = null) {

    unset($request->aten);
    unset($request->unid);
    unset($request->conv);

    $userlogin = (!empty($userlogin) ? (object) $userlogin : null);
    $request = (object) array_map("trim", (array) $request);
    $request = (object) array_map("strip_tags", (array) $request);

    if (empty($request->inco_id)) {
        $request->faturista_id = $userlogin->user_id;
        $request->inco_date = date('Y-m-d');
    }

    return $request;
}

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setInco_id($id);
            $Read->Execute()->find();
            Check::JsonReturn($Read->Execute()->getResult(), 'Inconsistência de Guia não encontrada!', '404');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma Inconsistência cadastrada!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request) && is_array($request)):
            var_dump($request);
        elseif (!empty($request->inco_id)):
            //update
            $request = setDados($request);
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'inco_id');
            echo json_encode($request);
        else:
            //salvar
            $request = setDados($request, $userlogin);
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            if ($insert):
                $request->inco_id = (int) $Read->Execute()->MaxFild("inco_id");
            endif;
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setInco_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}
