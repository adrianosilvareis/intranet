<?php

include "../../_app/Config.inc.php";
$Read = new WsSetorType();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $Read->setType_id($data->type_id);
            $Read->Execute()->delete();
        endforeach;
        echo "excluido com sucesso!";

    elseif (!empty($request->edited)):
        //editar
        $Read->setThis($request);
        $Read->Execute()->update(NULL, "type_id");
        echo "Editado com sucesso!";
    else:
        //adicionar
        $Read->setThis($request);
        $Read->Execute()->insert();
        echo "Adicionado com sucesso!";
    endif;
else:
    $Read->Execute()->Query("type_status=1");
    echo json_encode($Read->Execute()->getResult());
endif;
