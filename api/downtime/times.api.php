<?php

include "../../_app/Config.inc.php";
$WsSetor = new WsSetor();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $WsSetor->setSetor_id($data->setor_id);
            $WsSetor->Execute()->delete();
        endforeach;
        echo "excluido com sucesso!";

    elseif (!empty($request->edited)):
        //editar
        $WsSetor->setThis($request);
        $WsSetor->Execute()->update(NULL, "setor_id");
        echo "Editado com sucesso!";
    else:
        //adicionar
        $request->setor_category = "agenda";
        $WsSetor->setThis($request);
        $WsSetor->Execute()->insert();
        echo "Adicionado com sucesso!";
    endif;
else:
    $WsSetor->setSetor_category("agenda");
    $WsSetor->Execute()->Query("#setor_category#");
    echo json_encode($WsSetor->Execute()->getResult());
endif;
