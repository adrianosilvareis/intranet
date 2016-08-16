<?php

$Read = new SftGlosaGuia();

function setDados($request, $userlogin = null) {

    unset($request->aten);
    unset($request->unid);
    unset($request->conv);

    $userlogin = (!empty($userlogin) ? (object) $userlogin : null);
    $request = (object) array_map("trim", (array) $request);
    $request = (object) array_map("strip_tags", (array) $request);
    $request->glosa_value = (float) str_replace(',', '.', $request->glosa_value);

    if (empty($request->glosa_id)) {
        $request->faturista_id = $userlogin->user_id;
        $request->glosa_date = date('Y-m-d');
    }

    return $request;
}

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
            $request = setDados($request);
            $Read->setThis($request);
            $Read->Execute()->update(NULL, 'glosa_id');
            echo json_encode($request);
        else:
            //salvar
            $request = setDados($request, $userlogin);
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
