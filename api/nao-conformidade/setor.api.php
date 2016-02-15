<?php

include_once '../../_app/Config.inc.php';
$WsSetor = new WsSetor();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $WsSetor->setSetor_id($data->setor_id);
            $WsSetor->Execute()->delete();
        endforeach;
        echo "Setor excluido com sucesso!";

    elseif (!empty($request->edited)):
        //editar
        $WsSetor->setThis($request);
        $WsSetor->Execute()->update(NULL, "setor_id");
        echo "Setor editado com sucesso!";
    else:
        //adicionar
        $request->setor_category = "nao-conformidade";
        $WsSetor->setThis($request);
        $WsSetor->Execute()->insert();
        echo "Setor adicionado com sucesso!";
    endif;
else:
    $WsSetor->setSetor_category("nao-conformidade");
    $WsSetor->Execute()->Query("#setor_category#");
    echo json_encode($WsSetor->Execute()->getResult());
endif;
