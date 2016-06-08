<?php

include_once '../../_app/Config.inc.php';
$Read = new NcOrigem();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $Read->setOrigem_id($data->origem_id);
            $Read->Execute()->delete();
        endforeach;
        echo "Origem excluido com sucesso!";

    elseif (!empty($request->edited)):
        //editar
        $Read->setThis($request);
        if (!$Read->Execute()->update(NULL, "origem_id")):
            $status = ($request->origem_status ? '1' : '0');
            $Read->Execute()->update("origem_id={$request->origem_id}&origem_status={$status}", "origem_id");
            echo "Status Atualizado | ";
        endif;
        echo "Origem editado com sucesso!";
    else:
        //adicionar
        $Read->setThis($request);
        $Read->Execute()->insert();
        echo "Origem adicionado com sucesso!";
    endif;
else:
    $Read->Execute()->findAll();
    echo json_encode($Read->Execute()->getResult());
endif;
