<?php

include "../../_app/Config.inc.php";
$AgendaEndereco = new AgendaEndereco();

$request = json_decode(file_get_contents("php://input"));

if (!empty($request)):

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $AgendaEndereco->setEndereco_id($data->endereco_id);
            $AgendaEndereco->Execute()->delete();
        endforeach;
        echo "excluido com sucesso!";

    elseif (!empty($request->edited)):
        //editar
        $AgendaEndereco->setThis($request);
        $AgendaEndereco->Execute()->update(NULL, "endereco_id");
        echo "Editado com sucesso!";
    else:
        //adicionar
        $AgendaEndereco->setThis($request);
        $AgendaEndereco->Execute()->insert();
        echo "Adicionado com sucesso!";
    endif;
    
else:
    $AgendaEndereco->Execute()->findAll();
    echo json_encode($AgendaEndereco->Execute()->getResult());
endif;