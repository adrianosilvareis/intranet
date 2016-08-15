<?php

$Read = new SftNaoConformidade();

function setData($request) {

    $request = (object) array_map("trim", (array) $request);
    $request = (object) array_map("strip_tags", (array) $request);

    if (empty($request->ncon_id)) {
        $request->ncon_date = date("Y-m-d");
        $request->ncon_status = 1;
    }

    return $request;
}

switch ($method) {
    case "GET":
        //retorna todos os itens
        if (isset($id)):
            $Read->setNcon_id($id);
            $Read->Execute()->find();
            if ($Read->Execute()->getResult()):
                echo json_encode($Read->Execute()->getResult());
            else:
                http_response_code(404);
            endif;
        elseif (!empty($query) && $query == 'ativos'):
            $Read->Execute()->Query("ncon_status=1");
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma não conformidade cadastrada!', '204');
        else:
            $Read->Execute()->findAll();
            Check::JsonReturn($Read->Execute()->getResult(), 'Nenhuma não conformidade cadastrada!', '204');
        endif;
        break;
    case "POST":
        if (!empty($request->ncon_id)):
            //update
            $request = setData($request);
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'ncon_id');
            echo json_encode($request);
        else:
            //salvar
            $request = setData($request);
            $Read->setThis($request);
            $insert = $Read->Execute()->insert();
            if ($insert):
                $request->ncon_id = (int) $Read->Execute()->MaxFild("ncon_id");
            endif;
            echo json_encode($request);
        endif;
        break;
    case "DELETE":
        //deleta arquivo
        $Read->setNcon_id($id);
        $delete = $Read->Execute()->delete();
        echo json_encode($delete);
        break;

    default:
        break;
}
