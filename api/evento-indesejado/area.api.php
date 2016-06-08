<?php

include_once '../../_app/Config.inc.php';
$Read = new WsAreaTrabalho();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $Read->setSetor_id($data->area_id);
            $Read->Execute()->delete();
        endforeach;
        echo "Setor excluido com sucesso!";

    elseif (!empty($request->edited)):
        //editar
        $Read->setThis($request);
        if (!$Read->Execute()->update(NULL, "area_id")):
            $status = ($request->area_status ? '1' : '0');
            $Read->Execute()->update("area_id={$request->area_id}&area_status={$status}", "area_id");
            echo "Status Atualizado | ";
        endif;
        echo "Setor editado com sucesso!";
    else:
        //adicionar
        $Read->setThis($request);
        $Read->Execute()->insert();
        echo "Setor adicionado com sucesso!";
    endif;
else:
    $Read->Execute()->findAll();
    echo json_encode($Read->Execute()->getResult());
endif;
