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
        $Read->Execute()->update(NULL, "setor_id");
        echo "Setor editado com sucesso!";
    else:
        //adicionar
        $request->setor_category = "nao-conformidade";
        $Read->setThis($request);
        $Read->Execute()->insert();
        echo "Setor adicionado com sucesso!";
    endif;
else:
    $Read->setSetor_category("nao-conformidade");
    $Read->Execute()->Query("#setor_category#");
    echo json_encode($Read->Execute()->getResult());
endif;
