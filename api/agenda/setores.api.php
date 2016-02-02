<?php

include "../../_app/Config.inc.php";
$AgendaSetor = new AgendaSetor();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $AgendaSetor->setSetor_id($data->setor_id);
            $AgendaSetor->Execute()->delete();
        endforeach;
        echo "excluido com sucesso!";

    elseif (!empty($request->edited)):
        //editar
        $AgendaSetor->setThis($request);
        $AgendaSetor->Execute()->update(NULL, "setor_id");
        echo "Editado com sucesso!";
    else:
        //adicionar
        $AgendaSetor->setThis($request);
        $AgendaSetor->Execute()->insert();
        echo "Adicionado com sucesso!";
    endif;
else:
    $AgendaSetor->Execute()->findAll();
    echo json_encode($AgendaSetor->Execute()->getResult());
endif;
