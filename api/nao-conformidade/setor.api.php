<?php

include "../../_app/Config.inc.php";
$NcSetor = new NcSetor();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $NcSetor->setSetor_id($data->setor_id);
            $NcSetor->Execute()->delete();
        endforeach;
        echo "Setor excluido com sucesso!";

    elseif (!empty($request->edited)):
        //editar
        $NcSetor->setThis($request);
        $NcSetor->Execute()->update(NULL, "setor_id");
        echo "Setor editado com sucesso!";
    else:
        //adicionar
        $NcSetor->setThis($request);
        $NcSetor->Execute()->insert();
        echo "Setor adicionado com sucesso!";
    endif;
else:
    $AgendaSetor->Execute()->findAll();
    echo json_encode($AgendaSetor->Execute()->getResult());
endif;
