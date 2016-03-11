<?php

include_once '../../_app/Config.inc.php';
$Read = new WsSetor();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $Read->setSetor_id($data->setor_id);
            $Read->Execute()->delete();
        endforeach;
        echo "Setor excluido com sucesso!";

    elseif (!empty($request->edited)):
        //editar
        $Read->setThis($request);
        if (!$Read->Execute()->update(NULL, "setor_id")):
            $status = ($request->setor_status ? '1' : '0');
            $Read->Execute()->update("setor_id={$request->setor_id}&setor_status={$status}", "setor_id");
            echo "Status Atualizado | ";
        endif;
        echo "Setor editado com sucesso!";
    else:
        //adicionar
        $request->setor_category = "geral";
        $Read->setThis($request);
        $Read->Execute()->insert();
        echo "Setor adicionado com sucesso!";
    endif;
else:
    $Read->Execute()->Query("setor_type = 1 ORDER BY setor_content");
    echo json_encode($Read->Execute()->getResult());
endif;
